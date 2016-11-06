<?php

namespace Nero\App\Models;

use Nero\App\Models\Topic;


class User extends Model
{
    /*
    protected $fillable = [
	'username',
	'name',
	'email',
	'city',
	'password'
    ];
    */

    public function topics()
    {
	return $this->hasMany('topics', Topic::class);
    }
}
