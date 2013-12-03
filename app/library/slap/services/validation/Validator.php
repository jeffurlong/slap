<?php
namespace Slap\Services\Validation;

abstract class Validator {

    protected $input;

    protected $errors;

    public function __construct($input = null)
    {
        $this->input = $input ?: \Input::all();
    }

    public function passes($new = false)
    {
        $merge = $new ? static::$rules['create'] : static::$rules['update'];

        $validation = \Validator::make($this->input, array_merge(static::$rules['save'], $merge));           

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
