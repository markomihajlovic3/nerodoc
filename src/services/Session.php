<?php

namespace Nero\Services;


class Session
{
    /**
     * Set a new session variable
     *
     * @param string $key 
     * @param string $value 
     * @return void
     */
    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }


    /**
     * Get a session variable
     *
     * @param string $key 
     * @return mixed
     */
    public function get($key)
    {
        if(isset($_SESSION[$key]))
            return $_SESSION[$key];
        else
            return false;
    }


    /**
     * Flash a variable to session
     *
     * @param string $key 
     * @param string $value 
     * @return void
     */
    public function flash($key, $value)
    {
        $_SESSION['flash'] = [$key => $value];
    }


    /**
     * Return flash variable
     *
     * @param string $key 
     * @return mixed
     */
    public function getFlash($key)
    {
        if(isset($_SESSION['flash'][$key]))
            return $_SESSION['flash'][$key];

        return false;
    }


    /**
     * Destroy a flash variable
     *
     * @return void
     */
    public function destroyFlash()
    {
        unset($_SESSION['flash']);
    }


}
