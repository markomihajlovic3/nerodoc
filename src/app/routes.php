<?php

use Nero\Core\Routing\Router;

/*****************************************************************************
 * This is where you register the routes that you want to respond to.
 * It's really easy, supply the http method(verb), url, and controller@method.
 ****************************************************************************/


//simple routes demonstrate different possible responses(views, json, redirects)
Router::registerRoute('get', '/welcome', 'IntroController@welcome');
Router::registerRoute('get', '/json', 'IntroController@json');
Router::registerRoute('get', '/redirect', 'IntroController@redirect');
Router::registerRoute('get', '/text', 'IntroController@text');

