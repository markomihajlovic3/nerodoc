<?php

namespace Nero\App\Controllers;

//import what we need
use Nero\Services\Auth;
use Symfony\Component\HttpFoundation\Request;


/*
 * Controller responsible for logging and registering users
 */
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


    /**
     * Register a new user
     *
     * @param Request $request 
     * @return redirect response
     */
    public function store(Request $request, Auth $auth)
    {
        //validate data
        $validated = $this->validate($request->request->all(), [
            'username' => 'required|unique:users',
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'password_confirmation' => 'required|match:password'
        ]);

        //validation passed
        if($validated && $auth->register($request->request->all())){
            container('Session')->destroyOldInput();

            //user registered, go to login page
            return redirect('auth/login');
        } 

        //validation failed, return back to registration form with old input 
        return redirect()->back()->withOld($request->request->all());
    }


    /**
     * Show login form
     *
     */
    public function showLogin()
    {
        return view()->add('partials/header')
                     ->add('auth/login')
                     ->add('partials/footer');
    }


    /**
     * Login a user
     *
     * @param Request $request 
     * @param Auth $auth        
     * @return Redirect response
     */
    public function login(Request $request, Auth $auth)
    {
        $validated = $this->validate($request->request->all(), [
            'username' => 'required',
            'password' => 'required'
        ]);

        //logged in, redirect
        if($validated && $auth->login($request->request->get('username'), $request->request->get('password'))){
            container('Session')->destroyOldInput();
            return redirect();
        }

        //not logged in, return back with old input
        return redirect()->back()->withOld($request->request->all());
    }


    /**
     * Logout a user
     *
     * @param Auth $auth 
     * @return Redirect response
     */
    public function logout(Auth $auth)
    {
        $auth->logout();

        return redirect();
    }

}
