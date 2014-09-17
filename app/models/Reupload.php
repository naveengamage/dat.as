<?php

class Reupload extends Eloquent {

	protected $table = 'user_reupload';
	
	protected $guarded = array();
	
	public function rep_owner()
	{	
		$link = Links::find($this->link_id);
		
		$user = User::where('id', '=' , $link->user_id)->first();
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
	
	public function get_link()
	{	
		return Links::find($this->link_id);
	}
	
	public function get_owner()
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
