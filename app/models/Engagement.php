<?php

class Engagement extends Eloquent {

	public function User(){
		return $this->belongsToMany('User');
	}

	public function selfie(){
		return $this->belongsTo('Selfie', 'id');
	}

}