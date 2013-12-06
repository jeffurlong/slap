<?php
namespace Models;

class Person extends \Eloquent {

    protected $guarded = array('id', 'master_id');

    public function user()
    {
        return $this->hasOne('Models\User');
    }

}
