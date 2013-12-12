<?php namespace Slap\Repositories\Interfaces;

interface UserRepositoryInterface {

    public function instance();
    public function create(array $input);

    public function allAdmins();
    public function createWithRole(array $input, $role);

    // public function all();
    // public function find($id);
    // public function update(array $input);

    // public function delete($id);
    // public function destroy($id);
}
