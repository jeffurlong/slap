<?php namespace Slap\Validators;

class Page extends Validator {

    public function __construct()
    {
        $this->rules = array('title' => 'required');

        parent::__construct();
    }

}
