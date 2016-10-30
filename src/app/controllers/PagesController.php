<?php

namespace Nero\App\Controllers;


class PagesController extends BaseController
{
    public function home()
    {
        return view()->add('partials/header')
                     ->add('pages/home')
                     ->add('partials/footer');
    }

}
