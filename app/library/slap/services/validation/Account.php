<?php
namespace Slap\Services\Validation;

class Account extends Validation {

    public function __construct()
    {

        $this->rules = array('email' => 'required|email');

        parent::__construct();

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

    public function signup()
    {
        $this->rules['first_name']              = 'required';
        $this->rules['last_name']               = 'required';
        $this->rules['email']                   = 'required|email|unique:users';
        $this->rules['phone']                   = 'required';
        $this->rules['password']                = 'min:8|required|confirmed';
        $this->rules['password_confirmation']   = 'min:8|required';

        $this->validate();
    }

}
