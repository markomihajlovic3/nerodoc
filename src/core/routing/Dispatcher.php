<?php

namespace Nero\Core\Routing;


use Nero\Core\Reflection\Resolver;

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
    private $resolver = null;
    private $method = "";
    private $urlParameters = [];


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

        //contains the name of the method that should be invoked
        $this->method = $route['method'];

        //contains parameters extracted from the url
        $this->urlParameters = $route['params'];

        //lets create the resolver which will do all the reflection work for us
        $this->resolver = new Resolver($controllerName, $this->method);

        //throw 404 exception if there is a mismatch between expected url parameters and supplied parameters
        $this->checkForParameterCountMismatch();

        //finaly lets invoke the method with the all the parameters and get the response
        $response = $this->invokeMethod();

        //if its a simple string, wrap it into the response class
        if(is_string($response))
            return new \Nero\Core\Http\Response($response);


        return $response;
    }


    /**
     * Merge the final parameter array and invoke the method with it
     *
     * @return mixed
     */
    private function invokeMethod()
    {
        //lets resolve class parameters and create the final array of parameters(containing url and class parameters)
        $resolvedObjects = $this->resolver->resolveClassParameters();

        //merge url and class parameters
        $parameters = array_merge($this->urlParameters, $resolvedObjects);

        //lets finally invoke the method and return its response
        return $this->resolver->invoke($parameters);
    }


    /**
     * Throw exception if there is a url parameter mismatch
     *
     * @return void
     */
    private function checkForParameterCountMismatch()
    {
        $nonClassParameterCount = $this->resolver->nonClassParameterCount();

        if(count($this->urlParameters) != $nonClassParameterCount){
            if(inDevelopment())
                throw new \Exception("Expected parameters mismatch.");
            else
                throw new \Exception("404", 404);
        }
    }
}
