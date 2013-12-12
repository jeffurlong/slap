<?php namespace Slap\Validators;

class UserValidator extends Validator {

    public function __construct()
    {
        $this->rules = array(
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email'
        );

        parent::__construct();
    }

}
