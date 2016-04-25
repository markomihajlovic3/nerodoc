<?php

namespace Nero\Core\Routing;

use Pimple\Container;

/***************************************************************************
 * Dispatcher is responsible for dispatching the route
 * to the right controller and method and injecting it with dependecies.
 * This is done through the use of reflection API. Dispatcher
 * gets the route info(assoc array) as argument to the dispatchRoute
 * method. It then examines the methods signature to find out its
 * dependecies which are resolved from the container and injected into
 * the invocation of the method. It is assumed that the arguments of
 * the built-in types(which are resolved from the route) are listed first
 * in the method, followed by the class type ones which are resolved from
 * the IoC container.
 ****************************************************************************/
class Dispatcher
{
    private $container = null;
    private $controller = null;
    private $method = "";
    private $params = [];


    /**
     * Constructor, injected with a container
     *
     * @param Pimple\Container $container
     * @return void
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }


    /**
     * Dispatch the route to the controller and inject it with dependencies
     *
     * @param assoc array $route 
     * @return Nero\Core\Http\Response
     */
    public function dispatchRoute($route)
    {
        //contains the full name of the controller to be used by the reflection api
        $controllerName = "Nero\\App\\Controllers\\". ucfirst($route['controller']);

        //contains the instance of the controller used for the invocation of the method on it
        $this->controller = $this->loadController($route['controller']);

        //contains the name of the method that should be invoked
        $this->method     = $route['method'];

        //contains parameters extracted from the url
        $this->params     = $route['params'];

        //inspect the methods expected parameters using reflection
        $reflectionMethod = new \ReflectionMethod($controllerName, $this->method);
        $expectedParameters = $reflectionMethod->getParameters();

        //lets first compare the expected route parameters with the ones from the supplied route
        $expectedRouteParametersCount = 0;
        foreach($expectedParameters as $parameter){
            if($parameter->getClass() == false)
                $expectedRouteParametersCount++;
        }
        
        //throw 404 exception if there is a mismatch between expected route parameters and supplied parameters
        if(count($this->params) != $expectedRouteParametersCount){
            if(inDevelopment())
                throw new \Exception("Expected parameters mismatch.");
            else
                throw new \Exception("404", 404);
        }


        //we can resolve the expected classes from the IoC container
        foreach($expectedParameters as $parameter){
            if($parameter->getClass()){
                //if the expected parameter is a class resolve it from the IoC container and add it to the params
                $className = $this->extractClassName($parameter->getClass()->name);
                if($this->container[$className])
                    $this->params[] = $this->container[$className];
                else
                    throw new \Exception("$className service provider not registered!");
            }
        }

        //finaly lets invoke the method with the all the parameters
        return $reflectionMethod->invokeArgs($this->controller, $this->params);
    }


    /**
     * Get the class name only, without namespace
     *
     * @param string $fullClassName 
     * @return string
     */
    private function extractClassName($fullClassName)
    {
        $bits = explode('\\',$fullClassName);
        return $bits[count($bits) - 1];
    }


    /**
     * Load the controller class based on name
     *
     * @param string $controllerName 
     * @return Controller object
     */
    private function loadController($controllerName)
    {
        $className = "Nero\\App\\Controllers\\" . ucfirst($controllerName);
        if(class_exists($className))
            return new $className;
        else{
            if(inDevelopment())
                throw new \Exception("Controller '$controllerName' does not exist.");
            else
                throw new \Exception("404", 404);
        }
    }
}
