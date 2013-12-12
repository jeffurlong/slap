<?php namespace Slap\Repositories\Eloquent;

use Config;
use Models\User;
use Slap\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface {

    /**
     * Create a new User instance
     * @return \Models\User
     */
    public function instance()
    {
        return new User;
    }

    /**
     * Save a new User and return the instance
     * @param  array  $input
     * @return \Models\User
     */
    public function create(array $input)
    {
        return User::create($input);
    }

    /**
     * Get all models that have the admin role
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function allAdmins()
    {
        return User::orderBy('last_name', 'first_name')->admin()->get();
    }

    /**
     * Save a new User with the given role and return the instance
     * @param  array  $input
     * @param  string $role
     * @return \Models\User
     */
    public function createWithRole(array $input, $role)
    {
        $role = Config::get('auth.roles.'.$role);
        $model = $this->create($input);
        $model->roles()->attach($role_id);
        return $model;
    }


    // public function all()
    // {
    //     return User::orderBy('updated_at', 'desc')->get();
    // }

    // public function find($id)
    // {
    //      return User::findOrFail($id);
    // }

    // public function update(array $input)
    // {
    //     return User::findOrFail($input['id'])->fill($input)->save();
    // }



    // public function delete($id)
    // {
    //     return User::destroy($id);
    // }

    // public function destroy($id)
    // {
    //     return User::findOrFail($id)->forceDelete();
    // }

}
