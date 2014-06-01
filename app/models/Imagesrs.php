<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Imagesrs extends Eloquent implements UserInterface, RemindableInterface {

	protected $fillable=['srname','srdepict','auid','auicon','auname'];

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'imagesrs';


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
