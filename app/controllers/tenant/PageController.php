<?php namespace Controllers\Tenant;

use View, App;

class PageController extends \Controllers\BaseController {

    protected $page;

    public function __construct(\Slap\Repositories\Interfaces\Page $page)
    {
        $this->page = $page;
    }

    public function findBySlug($slug = null)
    {
        $page = $this->page->findBySlug($slug);

        return View::make('tenant.default', compact('page'));
    }

}
