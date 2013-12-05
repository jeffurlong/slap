<?php
namespace Models;

class Setting extends \Eloquent {

    /**
     * Keys included in the session
     * @var array
     */
    public $sessionKeys = array('name', 'slug', 'theme', 'active');

    /**
     * Session key value pairs
     * @return array
     */
    public function getSessionData()
    {
        return $this->whereIn('id', $this->sessionKeys)->lists('value', 'id');
    }

}
