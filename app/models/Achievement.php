<?php

class Achievement extends Eloquent {

	public function User(){
		return $this->belongsToMany('User', 'achievement_user', 'user_id', 'achievement_id');
	}

}