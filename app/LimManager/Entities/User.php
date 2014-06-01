<?php namespace LimManager\Entities;

use Illuminate\Auth\UserInterface;

class User extends \Eloquent implements UserInterface {

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password'];

	protected $fillable = ['username', 'password', 'first_name', 'last_name'];

	protected $appends = ['full_name'];

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
	 * Get the token value for the "remember me" session.
	 *
	 * @return string
	 */
	public function getRememberToken()
	{
		return $this->remember_token;
	}

	/**
	 * Set the token value for the "remember me" session.
	 *
	 * @param  string  $value
	 * @return void
	 */
	public function setRememberToken($value)
	{
		$this->remember_token = $value;
	}

	/**
	 * Get the column name for the "remember me" token.
	 *
	 * @return string
	 */
	public function getRememberTokenName()
	{
		return 'remember_token';
	}

	public function setPasswordAttribute($password)
	{
		$this->attributes['password'] = \Hash::make($password);
	}

	public function getFullNameAttribute()
	{
		if($this->group == 'admin') return 'Amministratore';
		
		return ucwords(substr($this->first_name, 0, 1).'. '.$this->last_name);
	}

}
