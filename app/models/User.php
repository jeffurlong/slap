<?php
namespace Models;

use Config;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends \Eloquent implements UserInterface, RemindableInterface {

	/**
	 * Attributes protected from mass assignment
	 * @var array
	 */
	protected $guarded = array('id', 'password');

	/**
	 * The attributes excluded from the model's JSON form.
	 * @var array
	 */
	protected $hidden = array('password');

	/**
	 * M:M Association to Role
	 * @return BelongsToMany
	 */
	public function roles()
    {
        return $this->belongsToMany('Models\Role');
    }

	/**
	 * Determines if the user has the given role
	 * @param  string 	$name 	Role name
	 * @return boolean
	 */
	public function hasRole($name)
	{
        foreach ($this->roles as $role)
        {
            if( $role->name === $name )
            {
                return true;
            }
        }

        return false;
   	}

   	public function scopeAdmin($query)
   	{
   		return $query->join('role_user', 'users.id', '=', 'role_user.user_id')
            ->where('role_user.role_id','=',Config::get('auth.roles.admin'));
   	}

	/**
	 * Get the unique identifier for the user.
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

}
