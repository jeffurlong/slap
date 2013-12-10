<?php namespace Controllers\Admin;

use View;

class DashboardController extends \Controllers\BaseController {

    public function __construct()
    {


        $this->beforeFilter('auth-admin');

        parent::__construct();
    }

    public function getIndex()
    {
        return View::make('admin.dashboard.index');
    }
    
}
