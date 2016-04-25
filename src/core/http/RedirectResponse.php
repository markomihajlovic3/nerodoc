<?php

namespace Nero\Core\Http;


class RedirectResponse extends Response
{
    private $redirectPath;


    /**
     * Constructor, path can be set directly
     *
     * @param string $to 
     * @return void
     */
    public function __construct($to)
    {
        $this->redirectPath = basePath() . $to;
    }


    /**
     * to, used to specify the redirect location
     *
     * @param string $location 
     * @return Nero\Core\Http\RedirectResponse
     */
    public function to($location)
    {
        $this->redirectPath = basePath() . $location;

        return $this;
    }


    /**
     * Send, used for sending the response to the user
     *
     */
    public function send()
    {
        header("Location: $this->redirectPath");
    }
}
