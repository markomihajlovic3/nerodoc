<?php

namespace Nero\App\Models;


class Topic extends Model
{

    public function user()
    {
        return $this->belongsTo('users')[0];
    }



    public function posts()
    {
        return $this->hasMany('posts');
    }

}
