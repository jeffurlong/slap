<?php
namespace Slap\Storage\Person;

use Models\Person;

class EloquentPersonRepository implements PersonRepositoryInterface {

    public function create($input)
    {
        return Person::create($input);
    }

}
