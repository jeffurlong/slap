<?php namespace Slap\Repositories\Eloquent;

use Models\Setting;
use Slap\Repositories\Interfaces\SettingRepositoryInterface;

class SettingRepositoryInterface implements SettingRepositoryInterface {

     /**
     * Session key value pairs
     * @return array
     */
    public function getSessionData()
    {
        return Setting::whereIn('id', Setting::$sessionKeys)->lists('value', 'id');
    }

}
