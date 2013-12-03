<?php
namespace Slap\Services\Validation;

class User extends Validator {

    public static $rules = array(
        'save' => array(
            'email' => 'required|email',
            'password' => 'required|min:8',
            'password_confirmation' => 'min:8',
        ),
        'create' => array(
            'email' => 'required|email|unique:users',
            'password' => 'min:8|required|confirmed',
            'password_confirmation' => 'min:8|required',  
        ),
        'update' => array()
    );


}
