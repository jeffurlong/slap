<?php
namespace Controllers\Admin;

use View;
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

        parent::__construct()
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
     * Get the forgot password view. If the request has been redirected here
     * from a post then notify and redirect. We notify on success or error for
     * security.
     * @return Redirect | View
     */
    public function getRemind()
    {
        if (Session::has('success') or Session::has('error'))
        {
            Notification::info(Lang::get('account.reminders.sent'));

            return Redirect::to('admin/login')->withInput();
        }

        return View::make('admin.login.remind');
    }

    /**
     * Get the reset view
     * @return View
     */
    public function getReset()
    {
        if( Session::has('error') )
        {
            Notification::errorInstant(Lang::get('account.'.Session::get('reason')));
        }

        return View::make('admin.login.reset')->with('token', $token);
    }

    public function postIndex()
    {
        try
        {
            $this->validator->login();
        }
        catch(ValidationException $e)
        {
            Notification::error($e->errors());

            return Redirect::back()->withInput();
        }

        if ( ! Auth::attempt(
            array(
                'email' => Input::get('email'),
                'password' => Input::get('password')
            )
        ))
        {
            Notification::error(Lang::get('account.invalid'));

            return Redirect::back()->withInput();
        }

         return Redirect::intended('admin');
    }

    /**
     * Send password reminder.
     * @return Redirect
     */
    public function postRemind()
    {
        try
        {
             $this->validator->validate();
        }
        catch(ValidationException $e)
        {
            Notification::error($e->errors());

            return Redirect::back()->withInput();
        }

        return Password::remind(array('email' => Input::get('email')),
            function ($message, $user) {
                $message->subject('Password reminder');
            }
        );
    }

    /**
     * Reset user's password, log them in and redirect to appropriate app
     * @return Redirect
     */
    public function postReset()
    {
        try
        {
            $this->validator->reset();
        }
        catch(ValidationException $e)
        {
            Notification::error($e->errors());

            return Redirect::back()->withInput();
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
