<?php

namespace Nero\Core\Http;

/*******************************************************************************
 * RedirectResponse implements the needed funcionality for redirecting the users
 * to different urls. It implements the send abstract method.
 *******************************************************************************/
class RedirectResponse extends Response
{
    private $redirectPath;


    /**
     * Constructor, path can be set directly
     *
     * @param string $to 
     * @return void
     */
    public function __construct($to = "")
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


    public function back()
    {
        $request = container('Request');
        $this->redirectPath = basePath() . ltrim($request->getPathInfo(), '/');

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
