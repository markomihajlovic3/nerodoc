<?php

namespace Nero\App\Controllers;


/*******************************************************
 * Base controller implements the basic functionality
 * of loading up models
 * Users will extend the BaseControllers and implement
 * their own logic.
 ******************************************************/
class BaseController
{
    /**
     * Load up a model
     *
     * @param string $name 
     * @return Model object
     */
    public function model($name)
    {
        $className = "Nero\\App\\Models\\" . ucfirst($name) . ucfirst('Model');
        if(class_exists($className))
            return new $className;
        else
            throw new \Exception("Model does not exist.");
    }

}
