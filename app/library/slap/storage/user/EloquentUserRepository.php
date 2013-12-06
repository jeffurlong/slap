<?php
namespace Slap\Storage\User;

use Models\User;

class EloquentUserRepository implements UserRepositoryInterface {

    public function create($input)
    {
        $user = new User;

        $user->person_id    = $input['person_id'];
        $user->email        = $input['email'];
        $user->password     = \Hash::make($input['password']);

        $user->save();

        return $user;
    }

    public function createWithRole($input, $roleId)
    {
        $user = $this->create($input);

        $user->roles()->attach($roleId);
    }

    public function forceDestroy($id)
    {
        $user = User::find($id);

        $user->roles()->detach();

        $user->forceDelete();
    }


}
