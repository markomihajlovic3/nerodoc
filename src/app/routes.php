<?php

use Nero\Core\Routing\Router;

/*****************************************************************************
 * This is where you register the routes that you want to respond to.
 * It's really easy, supply the http method(verb), url, and controller@method.
 ****************************************************************************/


//simple routes demonstrate different possible responses(views, json, redirects and simple text)
Router::registerRoute('get', '/', 'IntroController@welcome');
Router::registerRoute('get', '/json', 'IntroController@json');
Router::registerRoute('get', '/redirect', 'IntroController@redirect');
Router::registerRoute('get', '/text', 'IntroController@text');
Router::registerRoute('get', '/user/{id}', 'IntroController@user');
Router::registerRoute('get', '/post', 'IntroController@post');
Router::registerRoute('get', '/testlogin', 'IntroController@testLogin');

Router::registerRoute('get', '/login', 'IntroController@showLogin');
Router::registerRoute('get', '/register', 'IntroController@showRegister');
Router::registerRoute('post', '/register', 'IntroController@store');
Router::registerRoute('post', '/login', 'IntroController@login');

Router::registerRoute('get', '/session', 'IntroController@session');
Router::registerRoute('get', '/logout', 'IntroController@logout');
