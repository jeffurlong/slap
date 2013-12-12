<?php namespace Slap\Repositories\Eloquent;

use Config;
use Models\User;
use Slap\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface {

    public function instance()
    {
        return new User;
    }

    public function all()
    {
        return User::orderBy('updated_at', 'desc')->get();
    }

    public function find($id)
    {
         return User::findOrFail($id);
    }

    public function update(array $input)
    {
        return User::findOrFail($input['id'])->fill($input)->save();
    }

    public function create(array $input)
    {
        return User::create($input);
    }

    public function delete($id)
    {
        return User::destroy($id);
    }

    public function destroy($id)
    {
        return User::findOrFail($id)->forceDelete();
    }

    public function admins()
    {
        return User::admin()->orderBy('last_name', 'first_name')->get();
    }

    public function createWithRole(array $input, $role)
    {
        $role = Config::get('auth.roles.'.$role);
        $model = $this->create($input);
        $model->roles()->attach($role_id);
        return $model;
    }

}
