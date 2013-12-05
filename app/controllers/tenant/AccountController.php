<?php
namespace Controllers\Tenant;

use View, Notification, Redirect, Auth, Input, Session, Lang, Password, Hash, Exception, Mail;

use Controllers\BaseController;
use Models\Account;
use Slap\Exceptions\ValidationException;
use Slap\Exceptions\AuthException;
use Slap\Services\Validation\Account as Validator;

class AccountController extends BaseController
{
    /**
     * Model
     * @var Account
     */
    protected $model;

    /**
     * Create a new controller instance and injects the repository interface
     * @param UserRepositoryInterface $users
     * @return UserRepositoryInterface
     */
    public function __construct(Account $model)
    {
        $this->model = $model;
    }

    /**
     * Get the login view
     * @return View
     */
    public function getLogin()
    {
        return View::make('tenant.login');
    }

    /**
     * Validate login credentials. Success redirects based on user role.
     * @return Redirect
     */
    public function postLogin()
    {
        try
        {
            $user = $this->model->login(Input::get('email'), Input::get('password'));   
        }
        catch(ValidationException $e)
        {
            Notification::error($e->errors());

            return Redirect::back()->withInput();
        }
        catch(AuthException $e)
        {
            Notification::error(Lang::get($e->getMessage()));            

            return Redirect::back()->withInput();
        }
        
         return $this->redirectByRole($user);
    }

     /**
     * Get the forgot password view. If the request has been redirected here
     * from a post, notify. We notify on success or error for security.
     * @return Redirect | View
     */
    public function getForgot()
    {
        if (Session::has('success') or Session::has('error'))
        {
            Notification::info(Lang::get('account.reminders.sent'));

            return Redirect::to('account/login')->withInput();
        }

        return View::make('tenant.forgot');
    }

    /**
     * Send password reminder. Password:remind redirects back to forgot view.
     * @return Redirect
     */
    public function postForgot()
    {
        try
        {
            $response = $this->model->forgot(Input::get('email'));
        }
        catch(ValidationException $e)
        {
            Notification::error($e->errors());
            
            return Redirect::back()->withInput();
        }

        return $response;
    }

    /**
     * Get Reset Password view
     * @param  string $token Token from email generated by forgot password post
     * @return View
     */
    public function getReset($token = null)
    {
        if( Session::has('error') )
        {
            Notification::errorInstant(Lang::get('account.'.Session::get('reason')));
        }

        return View::make('tenant.reset')->with('token', $token);
    }

    /**
     * Reset user's password and log them in to appropriate app
     * @param  string $token
     * @return Redirect
     */
    public function postReset()
    {
        try
        {
            $this->model->validate('reset');
        }
        catch(ValidationException $e)
        {
            return Redirect::back()->withInput();
        }

        return Password::reset(array('email' => Input::get('email')), function($user, $password)
        {
            $user->password = Hash::make($password);

            $user->save();

            Auth::login($user);

            return $this->redirectByRole(Auth::user());
        });
    }

    /**
     * Get the sign up view
     * @return View
     */
    public function getSignup()
    {
        return View::make('tenant.signup');
    }

    /**
     * Create the new user and log them in
     * @return Redirect
     */
    public function postSignup()
    {
        try
        {
           $this->model->validate('signup');
        }
        catch(ValidationException $e)
        {

            return Redirect::back()->withInput();
        }

        try
        {
            // $person = $this->person->create(Input::except(array('password', 'confirm_password', '_token')));

            // $user = $this->user->create(array(
            //     'person_id' => $person->id,
            //     'email' => $person->email,
            //     'password' => Hash::make(Input::get('password')),
            // ));

            // $user->roles()->attach(3);

            // $this->sendSignupEmail($person);
        }
        catch(Exception $e)
        {
            // if (isset($person))
            // {
            //     $person->forceDelete();
            // }

            // if (isset($user))
            // {
            //     $user->roles()->detach();

            //     $user->forceDelete();
            // }

            throw $e;
        }

        // Auth::login($user);

        return $this->redirectByRole(Auth::user());
    }

    /**
     * Log the user out and return the logout view.
     * @return View
     */
    public function getLogout()
    {
        Auth::logout();

        return View::make('tenant.logout');
    }

    private function redirectByRole($user)
    {
        if ($user->hasRole('admin'))
        {
            die('redirect to admin');
            return Redirect::intended('admin');
        }
        die('redirect to member');
        return Redirect::intended('member');
    }

    private function sendSignupEmail($person)
    {
        Mail::send(
            'emails.auth.signup',
            array('email' => $person->email),
            function($m) use ($person, $params)
            {
                $m->to($person->email, $person->first_name.' '.$person->last_name)->subject(Session::get('tenant.name').' Account');
            }
        );
    }

}
