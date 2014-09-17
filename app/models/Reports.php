<?php

class Reports extends Eloquent {

	protected $table = 'user_flags';
	
	protected $guarded = array();

	public function comment(){
		return Comment::where('id','=', $this->comment_id)->first();
	}		
	
	public function media(){
		return Media::where('object_id','=', $this->object_id)->first();
	}	
		
	public function user(){
		return User::where('id', '=', $this->user_flagged_id)->first();
	}
	
	public function get_owner()
	{
		$user = User::where('id', '=' , $this->user_flagged_id)->first();
		if(isset($user->id)){
			$rep = $user->rep;
			$username = $user->username;
			if($user->rep < 0){
				$rep_status = 'negative';
			}else{
				$rep_status = 'positive';
			}
			if($user->isOnline()){
				$online = "online";
			}else{
				$online = "offline";
			}
			$return = '<span class="badgeInline"> <span class="'.$online.'" title="'.$online.'"></span> <span class="aclColor_1"><a class="plain" href="/user/'.$username.'/">'.$username.'</a></span> <span title="Reputation" class="repValue '. $rep_status .'">'.$rep.'</span>';
			$return .= '<a href="/messenger/create/'.$username.'/" title="send private message" class="imessage ajaxLink icon16"><span></span></a></span>';
			return $return;
		}else{
			return "wrong user link";
		}
	}	
	
	public function rep_owner()
	{
		$user = User::where('id', '=' , $this->user_id)->first();
		if(isset($user->id)){
			$rep = $user->rep;
			$username = $user->username;
			if($user->rep < 0){
				$rep_status = 'negative';
			}else{
				$rep_status = 'positive';
			}
			if($user->isOnline()){
				$online = "online";
			}else{
				$online = "offline";
			}
			$return = '<span class="badgeInline"> <span class="'.$online.'" title="'.$online.'"></span> <span class="aclColor_1"><a class="plain" href="/user/'.$username.'/">'.$username.'</a></span> <span title="Reputation" class="repValue '. $rep_status .'">'.$rep.'</span>';
			$return .= '<a href="/messenger/create/'.$username.'/" title="send private message" class="imessage ajaxLink icon16"><span></span></a></span>';
			return $return;
		}else{
			return "wrong user link";
		}
	}
}
