<?php

class Conversation extends Eloquent {

	protected $table = 'user_conversations';
	
	protected $guarded = array();
	
	public function party(){
		if($this->sender_id != Auth::user()->id){
			$other_party = $this->sender_id;
		}else{
			$other_party = $this->recipient_id;
		}
		return User::find($other_party);
	}	
	
	public function lastMessage(){
		$message = Messages::where('convo_id', $this->id)->orderBy('created_at','desc')->first();
		return $message;
	}	
	
	public function getTotal(){
		$one = Messages::where('convo_id', $this->id)->where('user_id', Auth::user()->id)->where('sender_deleted', 0)->count();
		$two = Messages::where('convo_id', $this->id)->where('user_id', '!=', Auth::user()->id)->where('rep_deleted', 0)->count();
		return $one + $two;
	}
}
