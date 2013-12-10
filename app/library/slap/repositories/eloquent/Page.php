<?php namespace Slap\Repositories\Eloquent;

use Models\Page as Model;

class Page implements \Slap\Repositories\Interfaces\Page  {

    public function findBySlug($slug)
    {
        $slug = $slug ?: 'home';

        return Model::where('slug', $slug)->first();
    }

}
