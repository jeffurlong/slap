<?php
namespace Slap\Services\Validation;

class User extends Validator {

    public static $rules = array(
        'save' => array(
            'email' => 'required|email',
            'password' => 'min:8|required|confirmed',
            'password_confirmation' => 'min:8|required',
        ),
        'create' => array(
            'email' => 'required|email|unique:users',
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
