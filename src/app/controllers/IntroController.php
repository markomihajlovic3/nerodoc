<?php

namespace Nero\App\Controllers;


class IntroController extends BaseController
{
    public function welcome()
    {
        //lets greet the user
        return view()->add('nero/welcome');
    }
}
