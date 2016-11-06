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
Router::register('post', '/auth/login', 'AuthController@login');
Router::register('get', '/auth/logout', 'AuthController@logout');

//profile pages
Router::register('get', '/profile/{username}', 'ProfileController@show')->filters('AuthFilter');
Router::register('post', '/profile/{username}/upload', 'ProfileController@uploadPicture')->filters('AuthFilter');

//documentation
Router::register('get', '/docs', 'DocsController@index');
Router::register('get', '/docs/installation', 'DocsController@installation');

//forum pages
Router::register('get', '/forum', 'ForumController@index')->filters('AuthFilter');
Router::register('post', '/forum', 'ForumController@storeTopic')->filters('AuthFilter');
Router::register('post', '/forum/topics/{id}', 'ForumController@storePost')->filters('AuthFilter');
Router::register('get', '/forum/topics/{id}', 'ForumController@show')->filters('AuthFilter');


//ajax route
Router::register('get', '/ajax/profile/{username}', 'ProfileController@update')->filters('AuthFilter');
