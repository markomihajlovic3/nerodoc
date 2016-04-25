<?php

namespace Nero\App\Models;

use Nero\Core\Database\DB;

/********************************************************
 * Simple Model base class, has a db connection handle.
 * Users will extend this base Model class and implement
 * their own methods for interfacing with the database.  
 ********************************************************/
class Model
{
    protected $db = null;

    /**
     * Constructor, init the db handle
     *
     * @return void
     */
    public function __construct()
    {
        $this->db = DB::getInstance();
    }
}
