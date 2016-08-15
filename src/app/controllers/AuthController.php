<?php

namespace Nero\App\Controllers;

use Symfony\Component\HttpFoundation\Request;


class AuthController extends BaseController
{

    /**
     * Show register form
     *
     * @param Request $request 
     * @return view
     */
    public function register()
    {
        return view()->add('partials/header')
                     ->add('auth/register')
                     ->add('partials/footer');
    }


    public function showLogin()
    {
        return view()->add('partials/header')
                     ->add('auth/login')
                     ->add('partials/footer');
    }

}
