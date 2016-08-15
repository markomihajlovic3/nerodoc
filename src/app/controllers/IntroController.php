<?php

namespace Nero\App\Controllers;


//simple controller that demonstrates different responses 
class IntroController extends BaseController
{

    /**
     * Welcome to the Nero framework
     *
     * @param creativity
     * @param elegance
     * @return awesome
     */
    public function welcome($id, Request $request)
    {
        //lets get the data using a Model
        $data['user'] = User::find($id);

        //lets greet the user with our new data
        return view()->add('nero/welcome', $data);
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

}
