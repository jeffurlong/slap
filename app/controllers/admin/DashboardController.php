<?php namespace Controllers\Admin;

use View;
use Controllers\BaseController;

class DashboardController extends BaseController {

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
