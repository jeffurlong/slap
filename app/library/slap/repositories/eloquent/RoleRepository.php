<?php namespace Slap\Repositories\Eloquent;

use Models\Role;
use Slap\Repositories\Interfaces\RoleRepositoryInterface;
class RoleRepository implements RoleRepositoryInterface {

    public function findByName($name)
    {
        return Role::whereName($name)->firstOrFail();
    }

}
