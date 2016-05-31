<?php

namespace Nero\Services;

use Session;
use Nero\Core\Database\QB;


class Auth
{
    /**
     * Implement logging in of a user
     *
     * @param string $key 
     * @param string $password 
     * @return bool
     */
    public function login($key, $password)
    {
        //get the auth config 
        $authTable = config('auth_table');
        $authKey = config('auth_key');

        //query db 
        $queryResult = QB::table($authTable)->where($authKey, '=', $key)->get();

        //check password
        if(password_verify($password, $queryResult['password'])){
            container('Session')->set("user", $queryResult);;
            return true;
        }
        else
            return false;
    }


    /**
     * Logout a user
     *
     */
    public function logout()
    {
        session_destroy();
    }


    /**
     * Register a new user
     *
     * @param array $data 
     * @return bool
     */
    public function register(array $data)
    {
        
    }


    /**
     * Check if the user is logged in
     *
     * @return bool
     */
    public function check()
    {
        $session = container('Session');

        if($session->get('user'))
            return true;
        else
            return false;
    }


    /**
     * Return the user in the form of a model
     *
     * @return Model
     */
    public function user()
    {
        $session = container('Session');
        
        if($userData = $session->get('user')){
            $model = $this->createModel($userData);

            return $model;
        }

        return false;
    }


    /**
     * Create a model instance from array data
     *
     * @param array $queryResult 
     * @return Model
     */
    private function createModel(array $data)
    {
        $modelName = config('auth_return_model');

        $fullModelName = "Nero\App\Models\\$modelName";

        if(! class_exists($fullModelName))
            throw new \Exception("Model $fullModelName does not exist.");


        return $fullModelName::fromArray($data);
    }

}
