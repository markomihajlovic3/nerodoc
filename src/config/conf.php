<?php

/**
 * Return the array containing all the config info
 *
 * @return assoc array
 */
return [
    //build target, used for error reporting
    'build' => 'development',

    //database config
    'db_hostname' => 'localhost',
    'db_username' => 'root',
    'db_password' => 'street27',
    'db_name'     => 'larablog',

    //default route config(used with Basic Router)
    'default_controller' => 'Welcome',
    'default_method'     => 'index',

    //site config
    'base_path' => 'http://localhost/nero/public/'
];
