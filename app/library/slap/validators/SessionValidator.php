<?php namespace Slap\Validators;

class SessionValidator extends Validator {

    public function __construct()
    {
        $this->rules = array('email' => 'required|email');

        parent::__construct();
    }

    public function login()
    {
        $this->rules['password'] = 'required';

        return $this->validate();
    }

    public function reset()
    {
        $this->rules['password'] = 'min:8|required|confirmed';
        $this->rules['password_confirmation'] = 'min:8|required';

        return $this->validate();
    }
}
