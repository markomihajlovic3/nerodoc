<?php

namespace Nero\Core\Routing;


class Route
{
    public $method;
    public $url;
    public $handler;
    public $patternRegEx;
    public $filters = [];


    public function filters()
    {
        $filters = func_get_args();

        foreach($filters as $filter)
            $this->filters[] = $filter;
    }
    

}
