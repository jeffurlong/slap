<?php
namespace Slap\Services\Validators;

use Input, Validator;
use Slap\Exceptions\ValidationException;

abstract class Validator {

    /**
     * Array of validating input.
     * @var array
     */
    protected $input;

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
        $this->input = $input ?: Input::all();
    }

    /**
     * Validates the input.
     * @throws ValidateException
     * @return void
     */
    public function validate()
    {
        $this->validator = Validator::make($this->input, $this->rules);

        if($this->validator->fails())
        {
            throw new ValidationException($this->validator);
        }
    }

}
