<?php

namespace Nero\App\Controllers;

use \Nero\App\Models\User;
use \Nero\App\Models\Post;


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


    public function user($id)
    {
        //$user = User::find(1);

        $posts = User::find(1)->posts();

        print_r($posts);
        
        /*
        foreach($posts as $post){
            echo "Title : {$post->title}<br/>";
        }

        */
        return "Hey, you made it this far, the result set is " . count($posts);
    }


    public function post()
    {
        $user = Post::find(3)->user();

        return "Hey {$user->name}, you created some posts on our site!";
    }

    

}
