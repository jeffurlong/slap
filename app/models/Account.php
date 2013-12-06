<?php
namespace Models;

use Auth, Password, Hash, Mail, Session, Config;
use Slap\Storage\Person\PersonRepositoryInterface as Person;
use Slap\Storage\User\UserRepositoryInterface as User;
use Slap\Services\Validation\Account as Validator;
use Slap\Exceptions\ValidationExcception;
use Slap\Exceptions\AuthException;

class Account {

    use \Slap\Traits\Validatable;

    /**
     * Create new Account model instance
     * @param User      $user      [description]
     * @param Person    $person    [description]
     * @param Validator $validator [description]
     */
    public function __construct(User $users, Person $people, Validator $validator)
    {
        $this->users = $users;

        $this->people = $people;

        $this->validator = $validator;
    }

    /**
     * Log a user in
     * @param  string $email
     * @param  string $password
     * @throws ValidationException  If form validation fails
     * @throws AuthException        If email is not found or password does not match
     * @return Models\User          The authenticated user
     */
    public function login($email, $password)
    {
        try
        {
            $this->validate('login');
        }
        catch(ValidationException $e)
        {
            throw $e;
        }

        if ( ! Auth::attempt(array('email' => $email, 'password' => $password)))
        {
            throw new AuthException('account.invalid');
        }

        return Auth::user();
    }

    /**
     * Send a reminder email for forgotten password
     * @param  string $email
     * @throws ValidationException  If form validation fails
     * @return RedirectResponse     Redirect back with session flash (succes or failure)
     */
    public function forgot($email)
    {
        try
        {
            $this->validate();
        }
        catch(ValidationException $e)
        {
            throw $e;
        }

        return Password::remind(

            array('email' => $email),

            function ($message, $user)
            {
                $message->subject('Password reminder');
            }
        );
    }

    /**
     * Reset a users password and log them in
     * @param  string $email
     * @throws ValidationException  If form validation fails
     * @throws AuthException        If email or token is not found or passwords are invalid
     * @return Models\User          The user whose password was reset
     */
    public function reset($email)
    {
        try
        {
            $this->validate('reset');
        }
        catch(ValidationException $e)
        {
            throw $e;
        }

        $user = Password::reset(array('email' => $email), function($user, $password)
        {
            $user->password = Hash::make($password);

            $user->save();

            Auth::login($user);

            return $user;
        });

        if (! $user instanceof \Illuminate\Auth\UserInterface)
        {
            throw new AuthException();
        }

        return $user;
    }

    /**
     * Log the user out
     * @return void
     */
    public function logout()
    {
        Auth::logout();
    }

    /**
     * Create a new user and person record with a member role
     * @param  array $input
     * @return [type]        [description]
     */
    public function signup(array $input)
    {
        try
        {
            $this->validate('signup');
        }
        catch(ValidationException $e)
        {
            throw $e;
        }

        try
        {
            $person = $this->people->create(
                array(
                    'first_name'    => $input['first_name'],
                    'last_name'    => $input['last_name'],
                    'email'         => $input['email'],
                    'phone'         => $input['phone'],
                )
            );

            $user = $this->users->createWithRole(
                array(
                    'person_id' => $person->id,
                    'email'     => $person->email,
                    'password'  => $input['password'],
                ),
                Config::get('auth.roles.member')
            );

            $this->sendSignupEmail($person);
        }
        catch(\Exception $e)
        {
            throw $e;
            if (isset($user))
            {
                $this->users->forceDestroy($user->id);
            }

            if (isset($person))
            {
                $this->people->forceDestroy($person->id);
            }


            throw $e;

            throw new AuthException('notification.error');
        }

        Auth::login($user);

        return $user;
    }

    private function sendSignupEmail($person)
    {
        $data = array(
            'email' => $person->email,
            'name' => $person->first_name.' '.$person->last_name,
            'tenant' => Session::get('tenant.name'),
            'login' => \URL::to('account/login'),
            'forgot' => \URL::to('account/forgot'),
        );

        Mail::queue(
            'emails.auth.signup',
            $data,
            function($m) use ($data)
            {
                $m->to($email, $name)->subject($tenant.' Account');
            }
        );
    }

}
