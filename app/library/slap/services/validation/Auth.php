<?php
namespace Slap\Services\Validation;

class Auth extends Validator {

    public static $rules = array(

        'save' => array(
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required',
            'password' => 'min:8|required|confirmed',
            'password_confirmation' => 'min:8|required',
        ),

        'reset' => array(
            'email' => 'required|email',
            'password' => 'min:8|required|confirmed',
            'password_confirmation' => 'min:8|required',
        ),

        'login' => array(
            'email' => 'required|email',
            'password' => 'required',
        ),

        'forgot' => array(
            'email' => 'required|email',
        ),

    );

}
