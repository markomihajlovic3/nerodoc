<?php

//we are using Pimple for dependency injection and symfony http request class
use Pimple\Container;
use Symfony\Component\HttpFoundation\Request;


//create the container to handle the services
$container = new Container();

//Let's add the services
$container["RouterInterface"] = function($c){
    return new Nero\Core\Routing\Router;
};


$container['App'] = function($c){
    return new Nero\Core\App($c['RouterInterface']);
};


$container['Request'] = function($c){
    return Request::createFromGlobals();
};


$container['Dispatcher'] = function($c){
    return new Nero\Core\Routing\Dispatcher;
};


$container['Auth'] = function($c){
    return new Nero\Services\Auth;
};


$container['Session'] = function($c){
    return new Nero\Services\Session;
};




//lets return the container 
return $container;
