<?php

use Nero\Core\Routing\Router;

/*****************************************************************************
 * This is where you register the routes that you want to respond to.
 * It's really easy, supply the http method(verb), url, and controller@method.
 ****************************************************************************/

//simple routes demonstrate different possible responses(views, json, redirects and simple text)
Router::register('get', '/', 'IntroController@welcome');
Router::register('get', '/json', 'IntroController@json');
Router::register('get', '/redirect', 'IntroController@redirect');
Router::register('get', '/text', 'IntroController@text');


//dev
Router::register('get', '/index', 'DevController@index');
Router::register('get', '/show', 'DevController@show');
