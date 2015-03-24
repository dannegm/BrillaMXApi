<?php

class Fieldaction extends Eloquent {

	public function User(){
		return $this->belongsTo('User', 'fieldaction_id', 'id');
	}

}