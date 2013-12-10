<?php namespace Slap\Repositories;

class RepositoryServiceProvider extends \Illuminate\Support\ServiceProvider {

    public function register()
    {
        $this->app->bind(
            'Slap\Repositories\Interfaces\Setting',
            'Slap\Repositories\Eloquent\Setting'
        );

        $this->app->bind(
            'Slap\Repositories\Interfaces\Page',
            'Slap\Repositories\Eloquent\Page'
        );

        $this->app->bind(
            'Slap\Repositories\Interfaces\User',
            'Slap\Repositories\Eloquent\User'
        );
    }

}
