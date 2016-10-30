<?php

namespace Nero\App\Controllers;

use Nero\Services\Auth;
use Nero\App\Models\Topic;
use Nero\App\Models\Post;
use Symfony\Component\HttpFoundation\Request;


class ForumController extends BaseController
{
    /**
     * Show index of topics
     *
     */
    public function index()
    {
        $data['topics'] = Topic::all();

        return view()->add('partials/header')
                     ->add('forum/index', $data)
                     ->add('partials/footer');
    }


    /**
     * Store a new topic
     *
     * @param Request $request 
     * @return Redirect response
     */
    public function storeTopic(Request $request, Auth $auth)
    {
        $validated = $this->validate($request->request->all(), [
            'title' => 'required'
        ]);

        //return back if validation failed
        if(!$validated)
            return redirect()->back();

        //collect needed data
        $data['title'] = $request->request->get('title');
        $data['user_id'] = $auth->user()->id;
        $data['created_at'] = time();

        //create a new topic and redirect
        $newTopic = Topic::create($data);
        return redirect("forum/topics/" . $newTopic->id);
    }


    public function storePost($topicID, Request $request, Auth $auth)
    {
        $validated = $this->validate($request->request->all(), [
            'content' => 'required'
        ]);

        //return back if validation failed
        if(!$validated)
            return redirect()->back();

        //collect needed data
        $data['topic_id'] = $topicID;
        $data['user_id']  = $auth->user()->id;
        $data['content']  = $request->request->get('content');
        $data['created_at'] = time();

        //create new post and redirect back
        $newPost = Post::create($data);
        return redirect()->back();
    }


    public function show($topicID, Request $request, Auth $auth)
    {
        $data['topic'] = Topic::find($topicID);

        return view()->add('partials/header')
                     ->add('forum/show', $data)
                     ->add('partials/footer');
    }

}
