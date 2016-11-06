<?php

namespace Nero\App\Controllers;

use Nero\Services\Auth;
use Nero\App\Models\User;
use Symfony\Component\HttpFoundation\Request;


/*
 * ProfileController 
 */
class ProfileController extends BaseController
{

    public function show($username)
    {
	//get the user from the db by username
	$data['user'] = User::whereUsername($username)[0];

	//if there is no user at this url redirect
	if(empty($data['user']))
	    return redirect();

	//check if the profile is editable(logged in user owns the profile)
	$data['editable'] = (container('Auth')->user()->id == $data['user']->id) ? true : false;

	//show the profile info page and pass it data
	return view()->add('partials/header')
		     ->add('profile/show', $data)
		     ->add('partials/footer');
    }


    public function uploadPicture($username, Request $request)
    {
	//check if there already exist profile image, if it does - delete it
	$files = glob("users/{$username}/*"); //get all file names
	foreach($files as $file){ // iterate files
	    if(is_file($file))
		unlink($file); // delete file
	}

	//move the uploaded file to the user directory
	$picture = $request->files->get('picture');
	$picture->move('users/' . $username, '/profile.' . $picture->getClientOriginalExtension());
	$filename = "profile." . $picture->getClientOriginalExtension();

	//update the db for the user
	$user = User::whereUsername($username)[0];
	$user->profile_image = $filename;
	$user->save();

	//return the user to the profile page
	return redirect("profile/{$username}");
    }




    public function update($username, Request $request)
    {
	//find the user
	$user = User::whereUsername($username)[0];

	//update the user
	$data = $request->query->all();

	foreach($data as $key => $value){
	    $user->{$key} = $value;
	}

	//save the user
	$user->save();
	
	//return user as json
	return json($user);
    }

}
