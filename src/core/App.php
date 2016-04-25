<?php

namespace Nero\Core;

use Nero\Core\Routing\RouterInterface;
use Pimple\Container;
use Symfony\Component\HttpFoundation\Request;

/************************************************************************************
 * App is the next bottleneck of the application after the front controller bootstrap.
 * It is a high level representation of the framework. It is responsible
 * for handling a http request and returning back the response to the user.
 * This is done by utilizing the router and a dispatcher. 
 ***********************************************************************************/
class App
{
    private $router = null;
    private $container = null;
    private $dispatcher = null;


    /**
     * Constructor, injected with router implementation and IoC container
     *
     * @param IRouter $router 
     * @param Pimple\Container $container
     */
    public function __construct(RouterInterface $router, Container $container)
    {
        $this->router = $router;
        $this->container = $container;
        $this->dispatcher = $this->container['Dispatcher'];
    }
    
    
    /**
     * High level function for handling a http request
     *
     * @param Request $request
     * @return Nero\Core\Http\Response
     */
    public function handle(Request $request)
    {
        //resolve the requested url from the router
        $route = $this->router->route($request);

        //and pass it to the dispatcher for invoking the controller and constructing the response
        $response = $this->dispatcher->dispatchRoute($route);

        //lets return the response we got
        return $response;
    }
}
