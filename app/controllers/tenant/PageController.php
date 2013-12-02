<?php 
namespace tenant;

use View;

class PageController extends \BaseController {

    protected $page;

    public function __construct(\Slap\Storage\Page\PageRepositoryInterface $page)
    {
        $this->page = $page;
    }

    public function findBySlug($slug = null)
    {
        $page = $this->page->findBySlug($slug);
        
        return View::make('tenant.default', compact('page'));
    }
    
}
