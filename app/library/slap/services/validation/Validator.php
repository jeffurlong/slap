<?php
namespace Slap\Services\Validation;

abstract class Validator {

    protected $input;

    protected $errors;

    public function __construct($input = null)
    {
        $this->input = $input ?: \Input::all();
    }

    public function passes($key = null)
    {
        $rules = ($key and array_key_exists($key, static::$rules)) ? static::$rules[$key] : static::$rules['save'];

        $validation = \Validator::make($this->input, $rules);

        if($validation->passes())
        {
            return true;
        }

        $this->errors = $validation->messages();

        return false;
    }

    public function getErrors()
    {
        return $this->errors;
    }


}
