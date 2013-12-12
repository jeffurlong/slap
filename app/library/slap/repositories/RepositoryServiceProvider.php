<?php namespace Slap\Repositories;

class RepositoryServiceProvider extends \Illuminate\Support\ServiceProvider {

    public function register()
    {
       $this->app->bind(
            'Slap\Repositories\Interfaces\PageRepositoryInterface',
            'Slap\Repositories\Eloquent\PageRepository'
        );

        $this->app->bind(
            'Slap\Repositories\Interfaces\SettingRepositoryInterface',
            'Slap\Repositories\Eloquent\SettingRepository'
        );

        $this->app->bind(
            'Slap\Repositories\Interfaces\UserRepositoryInterface',
            'Slap\Repositories\Eloquent\UserRepository'
        );
    }

}
