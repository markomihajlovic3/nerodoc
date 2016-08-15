<?php

namespace Nero\Services;

use Session;
use Nero\Core\Database\QB;


class Auth
{
    /**
     * Register a new user
     *
     * @param array $data 
     * @return bool
     */
    public function register(array $data)
    {
        //get the auth config 
        $authTable = config('auth_table');

        //hash the password
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

        //we dont need password confirmation
        unset($data['password_confirmation']);

        return QB::table($authTable)->insert($data);
    }


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
        $queryResult = QB::table($authTable)->where($authKey, '=', $key)->limit(1)->get();

        //check password
        if($queryResult){
            if(password_verify($password, $queryResult['password'])){
                container('Session')->set("user", $queryResult);;
                return true;
            }
        }

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
        $modelName = ucfirst(config('auth_return_model'));

        $fullModelName = "Nero\App\Models\\$modelName";

        if(! class_exists($fullModelName))
            throw new \Exception("Model $fullModelName does not exist.");


        return $fullModelName::fromArray($data);
    }

}
