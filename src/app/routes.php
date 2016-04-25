<?php

use Nero\Core\Routing\Router;

/*****************************************************************************
 * This is where you register the routes that you want to respond to.
 * It's really easy, supply the http method(verb), url, and controller@method.
 ****************************************************************************/

Router::registerRoute('get', '/welcome', 'IntroController@welcome');
Router::registerRoute('get', '/test', 'IntroController@test');
