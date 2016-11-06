<?php

namespace Nero\App\Models;


use Nero\App\Models\User;
use Nero\App\Models\Post;

class Topic extends Model
{

    public function user()
    {
        return $this->belongsTo('users', User::class)[0];
    }



    public function posts()
    {
        return $this->hasMany('posts', Post::class);
    }

    
    public function numberOfPosts()
    {
	return count($this->posts());
    }
}
