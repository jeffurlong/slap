<?php
namespace Models;

use Auth, Password;
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
    public function __construct(User $user, Person $person, Validator $validator)
    {
        $this->user = $user;

        $this->person = $person;

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

}
