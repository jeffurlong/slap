<?php
namespace Slap\Services\Validation;

use Input;
use Validator;
use Slap\Exceptions\ValidationException;

abstract class Validation {
    /**
     * Validator object.
     * @var object
     */
    protected $validator;

    /**
     * Array of extra data.
     * @var array
     */
    protected $data;

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
     * Array of messages.
     * @var array
     */
    public $messages = array();

    /**
     * Create a new validation service instance.
     * @param  array|null  $input
     * @return void
     */
    public function __construct($input = null)
    {
        $this->input = $input ?: Input::all();
    }

    public static function make($input = null)
    {

        return new static($input);
    }

    /**
     * Validates the input.
     * @throws ValidateException
     * @return void
     */
    public function validate()
    {
        $this->validator = Validator::make($this->input, $this->rules, $this->messages);

        if($this->validator->fails())
        {
            
            throw new ValidationException($this->validator);
        }
    }

    /**
     * Sets a data key/value on the service.
     * @param  string  $key
     * @param  mixed   $value
     * @return void
     */
    public function __set($key, $value)
    {
        $this->data[$key] = $value;
    }

    /**
     * Gets a data key from the service.
     * @param  string  $key
     * @throws Exception
     * @return mixed
     */
    public function __get($key)
    {
        if ( ! isset($this->data[$key]))
        {
            throw new Exception("Could not get [{$key}] from Services\Validation data array.");
        }

        return $this->data[$key];
    }

}
