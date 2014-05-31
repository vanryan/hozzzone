<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Imageind extends Eloquent implements UserInterface, RemindableInterface {

	protected $fillable=['filename','upuid','upuicon','upuname','grpid','srsid','hits'];

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'imageinds';


	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}
   
  	/**
	 * Validation
 	 *
  	 */


	/*
	 Laravel Upgrade

	 >According to:
	 http://laravel.com/docs/upgrade
	*/
	public function getRememberToken()
	{
	    return $this->remember_token;
	}

	public function setRememberToken($value)
	{
	    $this->remember_token = $value;
	}

	public function getRememberTokenName()
	{
	    return 'remember_token';
	}

}
