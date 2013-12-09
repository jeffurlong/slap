<?php
namespace Slap\Services\Validators;

abstract class Validator {

    /**
     * Array of validating input.
     * @var array
     */
    protected $input;

    protected $errors;

    /**
     * Array of rules.
     * @var array
     */
    public $rules = array();

    /**
     * Create a new validation service instance.
     * @param  array|null  $input
     * @return void
     */
    public function __construct($input = null)
    {
        $this->input = $input ?: \Input::all();
    }

    /**
     * Validates the input.
     * @throws ValidateException
     * @return void
     */
    public function validate()
    {
        $v = \Validator::make($this->input, $this->rules);

        if($v->fails())
        {
            $this->errors = $v->messages();

            return false;
        }

        return true;
    }

    public function errors()
    {
        return $this->errors->toArray();
    }

}
