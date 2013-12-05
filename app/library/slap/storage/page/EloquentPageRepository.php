<?php 
namespace Slap\Storage\Page;

use Models\Page;

class EloquentPageRepository implements PageRepositoryInterface {

    public function findBySlug($slug)
    {
        $slug = $slug ?: 'home';

        return Page::where('slug', $slug)->firstOrFail();
    }

}
