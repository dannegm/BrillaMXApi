<?php 

class Selfie extends Eloquent {

	public function User(){
		return $this->belongsTo('User', 'user_id', 'fbid');
	}

	public function engagement(){
		return $this->hasOne('Engagement', 'id', 'engagement_id');
	}

}