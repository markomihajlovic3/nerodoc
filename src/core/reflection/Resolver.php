<?php

namespace Nero\Core\Reflection;

//should document class
class Resolver
{
    private $targetName;
    private $reflectionMethod;


    /**
     * Constructor, inject with target and method
     *
     * @param string $target 
     * @param string $method 
     * @return void
     */
    public function __construct($target, $method)
    {
        $this->targetName = $target;

        $this->reflectionMethod = new \ReflectionMethod($target, $method);
    }


    /**
     * Get the targeted method expected non class parameter count
     *
     * @return int
     */
    public function nonClassParameterCount()
    {
        $expectedParameters = $this->reflectionMethod->getParameters();
        
        $count = 0;
        foreach($expectedParameters as $parameter){
            if($parameter->getClass() == false)
                $count++;
        }

        return $count;
    }


    /**
     * Get the array of objects resolved from the IoC container
     *
     * @return array
     */
    public function resolveClassParameters()
    {
        $objects = [];

        $expectedParameters = $this->reflectionMethod->getParameters();

        //we can resolve the expected classes from the IoC container
        foreach($expectedParameters as $parameter){
            if($parameter->getClass()){
                //extract the class name
                $className = $this->extractClassName($parameter->getClass()->name);

                //resolve it from the container
                if(container($className))
                    $objects[] = container($className);
                else
                    throw new \Exception("$className class does not exist!");
            }
        }

        return $objects;
    }



    /**
     * Resolve the dependencies and invoke the method
     *
     * @return mixed
     */
    public function resolveInvoke()
    {
        $resolvedObjects = $this->resolveClassParameters();

        return $this->invoke($resolvedObjects);
    }


    /**
     * Invoke the method and return its results
     *
     * @param array $parameters 
     * @return mixed
     */
    public function invoke(array $parameters = [])
    {
        $object = null;

        //lets create the target object and invoke its method
        if(class_exists($this->targetName))
            $object = new $this->targetName;
        else{
            if(inDevelopment())
                throw new \Exception("Controller '$controllerName' does not exist.");
            else
                throw new \Exception("404", 404);
        }

        
        return $this->reflectionMethod->invokeArgs($object, $parameters);
    }


    /**
     * Utility for extracting class name only, non namespaced
     *
     * @param string $fullClassName 
     * @return string
     */
    private function extractClassName($fullClassName)
    {
        $parts = explode('\\',$fullClassName);
        return $parts[count($parts) - 1];
    }
}
