<?php namespace Controllers\Admin;

use View, Notification, Redirect, Auth, Input, Lang, Session, Password, Hash;
use Controllers\BaseController;
use Slap\Validators\SessionValidator;

class SessionController extends BaseController {

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
    public function __construct(SessionValidator $validator)
    {
        $this->validator = $validator;

        parent::__construct();
    }

     /**
     * Get the login view
     * @return View
     */
    public function login()
    {
        return View::make('admin.session.login');
    }

     /**
     * Log the admin in
     * @return Redirect
     */
    public function attempt()
    {
        if ( ! $this->validator->login())
        {
            return Redirect::back()->withInput()->withErrors($this->validator->errors());
        }

        if ( ! Auth::attempt(array(
            'email' => Input::get('email'),
            'password' => Input::get('password')
        )))
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
    public function forgot()
    {
        if (Session::has('success') or Session::has('error'))
        {
            return Redirect::to('admin/login')
                ->withInput()
                ->with('alert', Lang::get('account.reminders.sent'));
        }

        return View::make('admin.session.remind');
    }

    /**
     * Send password reminder.
     * @return Redirect
     */
    public function remind()
    {
        if ( ! $this->validator->validate())
        {
            return Redirect::back()->withInput()->withErrors($this->validator->errors());
        }

        return Password::remind(array('email' => Input::get('email')),
            function ($message, $user) {
                $user->url = 'admin/recover';
                $message->subject('Password reminder');
            }
        );
    }

    /**
     * Get the reset view
     * @return View
     */
    public function recover($token)
    {
        if( Session::has('error') )
        {
            return Redirect::back()->withErrors(Lang::get('account.'.Session::get('reason')));
        }

        return View::make('admin.session.reset')->with('token', $token);
    }

    /**
     * Reset user's password, log them in and redirect to appropriate app
     * @return Redirect
     */
    public function reset()
    {
        if ( ! $this->validator->reset())
        {
            return Redirect::back()->withInput()->withErrors($this->validator->errors());
        }

        return Password::reset(array('email' => Input::get('email')), function($user, $password)
        {
            $user->password = Hash::make($password);

            $user->save();

            Auth::login($user);

            return Redirect::intended('admin');
        });
    }

    /**
     * Log the user out and return the logout view.
     * @return View
     */
    public function logout()
    {
        Auth::logout();

        return View::make('admin.session.logout');
    }
}
