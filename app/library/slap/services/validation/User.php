<?php
namespace Slap\Services\Validation;

class User extends Validation {

    public function _construct()
    {
        $this->rules = array('email' => 'required|email');

        parent::_construct();
    }

    public function login()
    {
        $this->rules['password'] = 'required';

        $this->validate();
    }

    public function reset()
    {
        $this->rules['password'] = 'min:8|required|confirmed';
        $this->rules['password_confirmation'] = 'min:8|required';

        $this->validate();
    }

}
