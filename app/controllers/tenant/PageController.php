<?php
namespace Controllers\Tenant;

use View;

class PageController extends \Controllers\BaseController {

    protected $page;

    public function __construct(\Slap\Storage\Page\PageRepositoryInterface $page)
    {
        $this->page = $page;
    }

    public function findBySlug($slug = null)
    {
        if ( ! $page = $this->page->findBySlug($slug))
        {
            \App::abort('404');
        }

        return View::make('tenant.default', compact('page'));
    }

}
