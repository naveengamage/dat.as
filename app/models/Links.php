<?php

class Links extends Eloquent {

	protected $table = 'user_links';
	
	protected $guarded = array();
	
	public function downVoted(){
		$has_vote = DB::table('links_votes')->where('link_id', '=', $this->id)->where('user_id', '=', Auth::user()->id)->where('down', '=', 1)->first();
		if(isset($has_vote->id)){ return true; }

		return false;
	}	
	
	public function upVoted(){
		$has_vote = DB::table('links_votes')->where('link_id', '=', $this->id)->where('user_id', '=', Auth::user()->id)->where('up', '=', 1)->first();
		if(isset($has_vote->id)){ return true; }
		return false;
	}
	
	public function downVotes(){
		return DB::table('links_votes')->where('link_id', '=', $this->id)->sum('down');
	}

	public function upVotes(){
		return DB::table('links_votes')->where('link_id', '=', $this->id)->sum('up');
	}

	public function reuploadRequested(){
		$has_request = DB::table('user_reupload')->where('link_id', '=', $this->id)->first();
		if(isset($has_request->id)){
			return true;
		}
		return false;
	}	
}