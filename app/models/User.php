<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

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
	protected $hidden = array('password', 'remember_token');

	public function selfies(){
		return $this->hasMany('Selfie', 'user_id', 'fbid');
	}

	public function achievement(){
		return $this->belongsToMany('Achievement', 'achievement_user', 'user_id', 'achievement_id');
	}

	public function fieldaction(){
		return $this->hasOne('Fieldaction', 'id', 'fieldaction_id');
	}

}
