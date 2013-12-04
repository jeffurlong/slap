<?php
namespace Slap\Storage\Person;

use Person;

class EloquentPersonRepository implements PersonRepositoryInterface {

    public function create($input)
    {
        return Person::create($input);
    }

}
