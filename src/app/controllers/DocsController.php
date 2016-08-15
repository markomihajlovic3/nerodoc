<?php

namespace Nero\App\Controllers;

class DocsController extends BaseController
{
    public function index()
    {
        return view()->add('partials/header')
                     ->add('docs/index')
                     ->add('partials/footer');
    }


    public function installation()
    {
        return view()->add('partials/header')
                     ->add('docs/installation')
                     ->add('partials/footer');
    }


}


