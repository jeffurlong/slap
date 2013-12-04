<?php
namespace Slap\Services\Validation;

class Auth extends Validation {

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

    // public static $rules = array(

    //     'save' => array(
    //         'first_name' => 'required',
    //         'last_name' => 'required',
    //         'email' => 'required|email|unique:users',
    //         'phone' => 'required',
    //         'password' => 'min:8|required|confirmed',
    //         'password_confirmation' => 'min:8|required',
    //     ),

    //     'reset' => array(
    //         'email' => 'required|email',
    //         'password' => 'min:8|required|confirmed',
    //         'password_confirmation' => 'min:8|required',
    //     ),

    //     'login' => array(
    //         'email' => 'required|email',
    //         'password' => 'required',
    //     ),

    //     'forgot' => array(
    //         'email' => 'required|email',
    //     ),

    // );

}
