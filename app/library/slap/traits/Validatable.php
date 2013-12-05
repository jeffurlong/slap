<?php 
namespace Slap\Traits;

use Slap\Exceptions\ValidationException;

trait Validatable {
    
    public $validator;

    public function setValidator($validator)
    {
        $this->validator = $validator;
    }

    public function validate($method = 'validate')
    {
        try
        {
           $this->validator->$method();
        }
        catch(ValidationException $e)
        {
            throw $e;
        }
    }
}
