<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {
    

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
	
	protected $fillable = ['username', 'email', 'fullname', 'password'];
	
	static private $_roleName = [
		'admin' => 0,
		'user' => 1,
		'moderator' => 2,
	];
	
	static private $_status = [
		'delete' => -1,
		'pending' => 0,
		'active' => 1,
	];
	
	
	
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
	
	
	public function is($role) {
		return self::$_roleName[$role] == $this->role;
	}
	
	static public function getRoleIdByName($name) {
		return isset (self::$_roleName[$name]) ? self::$_roleName[$name] : null;
	}
	
	static public function getRoleNameById($id) {
		return array_search($id, self::$_roleName);
	}
	
	static public function getStatusIdByName($name) {
		return isset (self::$_status[$name]) ? self::$_status[$name] : null;
	}
	
	static public function getStatusNameById($id) {
		return array_search($id, self::$_status);
	}
	
	static public function getAllStatus() {
		return self::$_status;
	}
	
	static public function getAllRole() {
		return self::$_roleName;
	}
	
	static public function getAll() {
		return static::orderBy('created_at', 'desc')->get();
	}
	
	public function setStatus($status) {
		$id = self::getStatusIdByName($status);
		if ($id !== null) {
			$this->status = $id;
		}
	}
	
	public function setRole($role) {
		$id = self::getRoleIdByName($role);
		if ($id !== null) {
			$this->role = $id;
		}
	}
	
	public function getStatus() {
		return self::getStatusNameById($this->status);
	}
	public function getRole() {
		return self::getRoleNameById($this->role);
	}
	
}
