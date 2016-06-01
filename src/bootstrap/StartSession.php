<?php

namespace Nero\Bootstrap;


class StartSession
{
    /**
     * Bootup method
     *
     * @param Container $container 
     * @return void
     */
    public function boot($container)
    {
        session_start();
    }


}
