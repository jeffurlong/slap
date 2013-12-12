<?php namespace Controllers\Admin;

use View, Input, Redirect;
use Controllers\BaseController;
use Slap\Repositories\Interfaces\UserRepositoryInterface;
use \Slap\Validators\UserValidator;

class StaffController extends BaseController {

    /**
     * Repository
     * @var User
     */
    private $users;

    /**
     * Validator
     * @var Validator
     */
    private $validator;

    public function __construct(UserRepositoryInterface $users, UserValidator $validator)
    {
        $this->beforeFilter('auth-admin');
        $this->users = $users;
        $this->validator = $validator;
        parent::__construct();
    }

    public function getIndex()
    {
        return View::make('admin.settings.staff.index', array('admins' => $this->users->admins()));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function getCreate()
    {
        return View::make('admin.settings.staff.form', array('admin' => $this->users->instance()));
    }

    /**
     * Store a newly created resource in storage.
     * @return Response
     */
    public function postCreate()
    {
        if ( ! $this->validator->validate())
        {
            return Redirect::back()->withInput()->withErrors($this->validator->errors());
        }

        $this->users->createWithRole(Input::all(), 'admin');

        return Redirect::to('/admin/settings/staff')->with('alert', 'The staff member has been saved');
    }

}
