<?php

use Nero\Core\Routing\Router;

/*****************************************************************************
 * This is where you register the routes that you want to respond to.
 * It's really easy, supply the http method(verb), url, and controller@method.
 ****************************************************************************/

//static pages
Router::register('get', '/', 'PagesController@home');


//auth pages
Router::register('get', '/auth/register', 'AuthController@register');
Router::register('post', '/auth/register', 'AuthController@store');
Router::register('get', '/auth/login', 'AuthController@showLogin');


//documentation
Router::register('get', '/docs', 'DocsController@index');
Router::register('get', '/docs/installation', 'DocsController@installation');


//forum pages
Router::register('get', '/forum', 'ForumController@index')->filters('AuthFilter');
