<?php

class CommentVote extends Eloquent {

	protected $table = 'comment_votes';
	protected $guarded = array();

	public static $rules = array();
	
	public function user(){
		return User::where('id','=', $this->user_id)->first();
	}	
}
