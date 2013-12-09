<?php namespace Controllers\Admin;

use View, Notification, Redirect, Auth, Input, Lang;
use Illuminate\Support\MessageBag;
use Slap\Services\Validators\Login as Validator;

class LoginController extends \Controllers\BaseController {

    /**
     * Validator
     * @var Validator
     */
    private $validator;

    /**
     * Create a new controller instance and inject validator
     * @param Validator $validator
     * @return void
     */
    public function __construct(Validator $validator)
    {
        $this->validator = $validator;

        parent::__construct();
    }

    /**
     * Get the login view
     * @return View
     */
    public function getIndex()
    {
        return View::make('admin.login.login');
    }

    /**
     * Log the admin in
     * @return Redirect
     */
    public function postIndex()
    {
        if ( ! $this->validator->login())
        {
            return Redirect::back()->withInput()->withErrors($this->validator->errors());
        }

        if ( ! Auth::attempt(
            array(
                'email'     => Input::get('email'),
                'password'  => Input::get('password')
            )
        ))
        {
            return Redirect::back()->withInput()->withErrors(Lang::get('account.invalid'));
        }

         return Redirect::intended('admin');
    }


    /**
     * Get the forgot password view. If the request has been redirected here
     * from a post then notify and redirect. We notify on success or error for
     * security.
     * @return Redirect | View
     */
    public function getRemind()
    {
        if (Session::has('success') or Session::has('error'))
        {
            return Redirect::to('admin/login')->withInput()->with('message', Lang::get('account.reminders.sent'));
        }

        return View::make('admin.login.remind');
    }

    /**
     * Send password reminder.
     * @return Redirect
     */
    public function postRemind()
    {
        if ( ! $this->validator->validate())
        {
            return Redirect::back()->withInput()->withErrors($this->validator->errors());
        }

        return Password::remind(array('email' => Input::get('email')),
            function ($message, $user) {
                $message->subject('Password reminder');
            }
        );
    }

    /**
     * Get the reset view
     * @return View
     */
    public function getReset()
    {
        if( Session::has('error') )
        {
            return Redirect::back()->withErrors(Lang::get('account.'.Session::get('reason')));
        }

        return View::make('admin.login.reset')->with('token', $token);
    }

    /**
     * Reset user's password, log them in and redirect to appropriate app
     * @return Redirect
     */
    public function postReset()
    {
        if ( ! $this->validator->reset())
        {
            return Redirect::back()->withInput()->withErrors($this->validator->errors());
        }

        Password::reset(array('email' => $email), function($user, $password)
        {
            $user->password = Hash::make($password);

            $user->save();

            Auth::login($user);

            return Redirect::intended('admin');
        });

    }

}
