<?php

/**
 * Return the array containing all the config information
 *
 * @return assoc array
 */
return [
    //build target, used for error reporting
    'build' => 'development',

    //database config
    'db_hostname' => 'localhost',
    'db_username' => 'root',
    'db_password' => 'password',
    'db_name'     => 'database',

    //default route config(used with Basic Router)
    'default_controller' => 'Welcome',
    'default_method'     => 'index',

    //site config
    'base_path' => 'http://localhost/nero/public/'
];
