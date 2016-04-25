<?php

namespace Nero\Core\Http;


/*******************************************************
 * Simple Response class encapsulates working with
 * responses that we are sending to the user.
 * You can add a view to be rendered with data,
 * redirect the user or send a json response for APIs.
 *******************************************************/
abstract class Response
{
    /**
     * Set a response header
     *
     * @param string $value 
     * @return Nero\Core\Http\Response
     */
    public function header($value)
    {
        header($value);

        return $this;
    }


    /**
     * Will be implemented by subclasses
     *
     * @return mixed
     */
    abstract public function send();
}
