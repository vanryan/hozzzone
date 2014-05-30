<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	protected $fillable=['email','username','password','uicon','ugender','ucity','udepict','urepost','ureposted','uhoard','ubehoard','ufollowppl','ufollowers','ufollowcates','uvalid'];

	public static $rules = [
		'email' => 'required|email|unique:users,email|max:64|min:6',
		'username' => 'required|unique:users,username|min:2',
		'password'=>'required|max:24|min:6',
		'password_confirmation'=>'same:password'
		];

	public $messages;

	public $reg_messages=array(
			'password_confirmation.same'=>'两次密码输入不一致'
		);

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

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

	public function isValid($data)
	{
		$validation = Validator::make($data, static::$rules, $this->reg_messages);

		if($validation->passes())
		{
		 	return true;
		}

		$this->messages = $validation->messages();

		return false;

	}

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