<?php namespace Slap\Repositories\Eloquent;

use Models\Setting as Model;

class Setting implements \Slap\Repositories\Interfaces\Setting {

     /**
     * Session key value pairs
     * @return array
     */
    public function getSessionData()
    {
        return Model::whereIn('id', Model::$sessionKeys)->lists('value', 'id');
    }

}
