<?php 
namespace Slap\Storage;

class StorageServiceProvider extends \Illuminate\Support\ServiceProvider {

    public function register()
    {
        $this->app->bind(
            'Slap\Storage\Page\PageRepositoryInterface',
            'Slap\Storage\Page\EloquentPageRepository'
        );

        $this->app->bind(
            'Slap\Storage\User\UserRepositoryInterface',
            'Slap\Storage\User\EloquentUserRepository'
        );

        $this->app->bind(
            'Slap\Storage\Person\PersonRepositoryInterface',
            'Slap\Storage\Person\EloquentPersonRepository'
        );

    }

}
