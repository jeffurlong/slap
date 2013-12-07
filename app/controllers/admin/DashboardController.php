<?php
namespace Controllers\Admin;

class DashboardController extends \Controllers\BaseController {

    public function __construct()
    {
        $this->beforeFilter('auth-admin');
    }

    public function getIndex()
    {
        dd(__method__);
    }
}
