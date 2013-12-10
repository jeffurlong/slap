<?php
namespace Models;

class Setting extends \Eloquent {

    /**
     * Keys included in the session
     * @var array
     */
    public static $sessionKeys = array('name', 'slug', 'theme', 'active');

}
