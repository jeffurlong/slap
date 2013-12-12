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

    /**
     * Display a listing of all admins
     * @return Response
     */
    public function getIndex()
    {
        return View::make('admin.settings.staff.index', array('admins' => $this->users->allAdmins()));
    }

    /**
     * Show the form for creating a new admin
     * @return Response
     */
    public function getCreate()
    {
        return View::make('admin.settings.staff.form', array('admin' => $this->users->instance()));
    }

    /**
     * Store a newly created admin in storage.
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
