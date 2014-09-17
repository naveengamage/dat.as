<?php

class Friend extends Eloquent {
	protected $table = 'friend_user';
	
	protected $guarded = array();

	public static $rules = array();

	public function user($id){
		if($id == $this->user_id){
			return User::where('id','=', $this->friend_id)->first();
		}
		return User::where('id','=', $this->user_id)->first();
	}	

}

