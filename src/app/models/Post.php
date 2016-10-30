<?php

namespace Nero\App\Models;


class Post extends Model
{
    public function user()
    {
        return $this->belongsTo('users')[0];
    }
}
