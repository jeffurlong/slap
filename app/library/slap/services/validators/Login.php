<?php
namespace Slap\Services\Validators;

class Login extends Validator {

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
}
