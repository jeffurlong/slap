<?php
namespace Slap\Storage\Person;

use Models\Person;

class EloquentPersonRepository implements PersonRepositoryInterface {

    public function create($input)
    {
        $person = Person::create($input);

        try
        {
            $person->master_id = array_get($input, 'master_id') ?: $person->id;

            $person->save();
        }
        catch (\Exception $e)
        {
            $person->forceDelete();

            throw $e;
        }

        return $person;
    }

    public function forceDestroy($id)
    {
        $person = Person::find($id);

        $person->forceDelete();
    }

}
