<?php
namespace Models;

class Account {

    public function __construct(User $user, Person $person)
    {
        $this->user = $user;

        $this->person = $person;
    }

}
