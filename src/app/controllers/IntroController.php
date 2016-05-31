<?php

namespace Nero\App\Controllers;

use \Nero\App\Models\User;
use \Nero\App\Models\Post;
use \Nero\Core\Database\DB;
use \Nero\Core\Database\QB;
use \Nero\Services\Auth;
use Symfony\Component\HttpFoundation\Request;

//simple controller that demonstrates different responses 
class IntroController extends BaseController
{
    public function welcome()
    {
        //lets greet the user with a view
        return view()->add('nero/welcome');
    }


    public function json()
    {
        //sample data
        $data['greeting'] = 'Welcome to Nero';

        //lets return the data in json format
        return json($data);
    }


    public function redirect()
    {
        //lets redirect the user to the welcome page
        return redirect();
    }


    public function text()
    {
        //lets just return string, which will be converted to response behind the scenes
        return "Welcome to Nero!";
    }


    public function user($id, Auth $auth)
    {
        $result = (new User)->testQB();



        if($auth->login('marko@example.com', 'password'))
            echo "We loged you in!<br/>";
        else
            echo "Not logged in!<br/>";

        return json($result);
    }


    public function testLogin()
    {
        return "Welcome to login !";
    }


    public function showLogin()
    {
        return view()->add('login');
    }


    public function login(Request $request, Auth $auth)
    {
        $email = $request->request->get('email');
        $password = $request->request->get('password');

        if($auth->login($email, $password)){
            return redirect('session');
        }
        else
            return "Should login $email and $password";
    }


    public function logout()
    {
        session_destroy();

        return redirect('login');
    }


    public function showRegister()
    {
        return view()->add('register');
    }


    public function store(Request $request)
    {
        //lets save the user
        $data['email'] = $request->request->get('email');

        $data['password'] = password_hash($request->request->get('password'), PASSWORD_DEFAULT);


        $result = QB::table('users')->insert($data);

        return redirect('login');
    }


    public function session()
    {
        echo "SESSION part";

        return view()->add('session');
    }


    public function post()
    {
        $user = Post::find(3)->user();
        
        if($user)
            return "Hey {$user->name}, you created some posts on our site!";
        else
            return "No such user!";
    }

    

}
