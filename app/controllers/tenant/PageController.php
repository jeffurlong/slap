<?php namespace Controllers\Tenant;

use View, App;
Use Controllers\BaseController;
use Slap\Repositories\Interfaces\PageRepositoryInterface;

class PageController extends BaseController {

    protected $pages;

    /**
     * Constructor
     * @param PageRepositoryInterface $pages
     */
    public function __construct(PageRepositoryInterface $pages)
    {
        $this->pages = $pages;

        parent::__construct();
    }

    /**
     * Display the Page identified by the given slug
     * @param  string $slug
     * @return Response
     */
    public function findBySlug($slug = null)
    {
        $page = $this->pages->findBySlug($slug);

        return View::make('tenant.default', compact('page'));
    }

}
