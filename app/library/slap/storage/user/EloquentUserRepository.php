<?php
namespace Slap\Storage\User;

use User;

class EloquentUserRepository implements UserRepositoryInterface {

    public function create($input)
    {
        return User::create($input);
    }

    public function login($email, $password)
    {
        return User::login($email, $password);
    }

}
