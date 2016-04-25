<?php

namespace Nero\App\Models;


class UserModel extends Model
{

    public function getAllUsers()
    {
        return $this->db->query('SELECT * FROM users');
    }


    public function getUserWithEmail($email)
    {
        return $this->db->query('SELECT * FROM users WHERE email = ?', [$email]);
    }


    public function getUserWithID($id)
    {
        return $this->db->query('SELECT * FROM users WHERE id = ?', [$id]);
    }

}
