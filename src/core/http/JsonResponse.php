<?php

namespace Nero\Core\Http;


class JsonResponse extends Response
{
    private $jsonData;

    /**
     * Constructor, data can be passed in directly
     *
     * @param array $data 
     * @return void
     */
    public function __construct(array $data)
    {
        $this->jsonData = $data;
    }


    /**
     * Data, used for setting the json data
     *
     * @param array $data 
     * @return Nero\Core\Http\JsonResponse
     */
    public function data(array $data)
    {
        $this->jsonData = $data;

        return $this;
    }


    /**
     * Send, send the information back to the user
     *
     * @return json data
     */
    public function send()
    {
        echo json_encode($this->jsonData);
    }


}
