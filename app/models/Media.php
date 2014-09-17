<?php

class Media extends Eloquent {

	protected $table = 'media';
	
	protected $guarded = array();

	public static $rules = array(
		'user_id' => 'required',
		'title' => 'required'
	);

	public function category(){
		return Category::where('id', '=', $this->cat_id)->first();
	}	
	
	public function subcategory(){
		return Category::where('id', '=', $this->sub_id)->where('is_sub', '=', 1)->first();
	}	
	
	public function get_links(){
		return Links::where('code', '=', $this->code)->get();
	}	
	
	public function total_links(){
		return $this->dl_links_count + $this->sm_links_count;
	}

	public function user(){
		return User::where('id', '=', $this->user_id)->first();
	}

	public function totalFlags(){
		return DB::table('media_flags')->where('media_id', '=', $this->id)->count();
	}

	public function totalLikes(){
		return DB::table('media_likes')->where('media_id', '=', $this->id)->count();
	}

	public function media_likes(){
		return $this->hasMany('MediaLike');
	}	
	
	public function hasLiked(){
		$has_vote = DB::table('media_votes')->where('media_id', '=', $this->id)->where('user_id', '=', Auth::user()->id)->where('up', '=', 1)->first();
		if(isset($has_vote->id)){ return true; }
		return false;
	}	
	
	public function hasDisliked(){
		$has_vote = DB::table('media_votes')->where('media_id', '=', $this->id)->where('user_id', '=', Auth::user()->id)->where('down', '=', 1)->first();
		if(isset($has_vote->id)){ return true; }
		return false;
	}
	
	public function upVotes(){
		return DB::table('media_votes')->where('media_id', '=', $this->id)->sum('up');
	}
	
	public function upVoted(){
		return MediaVote::where('media_id', '=', $this->id)->where('up', '=', 1)->take(10)->get();
	}	
	
	public function downVoted(){
		return MediaVote::where('media_id', '=', $this->id)->where('down', '=', 1)->take(10)->get();
	}
	
	public function downVotes(){
		return DB::table('media_votes')->where('media_id', '=', $this->id)->sum('down');
	}	
	
	public function reported(){
		$has_report = DB::table('user_flags')->where('media_id', '=', $this->id)->where('solved', '=', 0)->first();
		if(isset($has_report->id)){ return true; }
		return false;
	}
	
	public function comments(){
		return Comment::where('object_id','=', $this->object_id)->where('status', '=', 1)->where('comment_parent', 0)->orderBy('created_at', 'desc')->take(15)->get();
	}	
	
	
	public function topcomments(){
		$top_comments = Comment::where('object_id','=', $this->object_id)->where('status', '=', 1)->where('votes', '>' , 2)->where('deleted', '=', 0)->where('user_id', '!=' , $this->user_id)->orderBy('votes', 'desc')->take(5)->get();

		return $top_comments;
	}	
	
	public function hasRated(){
		$has_rated = Comment::where('object_id','=', $this->object_id)->where('status', '=', 1)->where('video', '!=' , 0)->where('audio', '!=', 0)->where('user_id', '=' , Auth::user()->id)->first();

		return $has_rated;
	}	
	
	public function uploadercomments(){
		$uploader_comments = Comment::where('object_id','=', $this->object_id)->where('status', '=', 1)->where('deleted', '=', 0)->where('user_id', '=' , $this->user_id)->orderBy('votes', 'desc')->take(5)->get();

		return $uploader_comments;
	}
	
	public function totalComments(){
		return Comment::where('object_id','=', $this->object_id)->where('status', '=', 1)->where('deleted', '=', 0)->count();
	}
	
	public function hasVoted(){
		$has_vote = DB::table('media_votes')->where('media_id', '=', $this->id)->where('user_id', '=', Auth::user()->id)->where('down', '=', 1)->first();
		if(isset($has_vote->id)){ return true; }
		
		$has_vote = DB::table('media_votes')->where('media_id', '=', $this->id)->where('user_id', '=', Auth::user()->id)->where('up', '=', 1)->first();
		if(isset($has_vote->id)){ return true; }
		return false;
	}	
	
	public function addFeedback(){
		$has_fb = DB::table('media_feedback')->where('media_id', '=', $this->id)->where('user_id', '=', Auth::user()->id)->first();
		if(!isset($has_fb->id)){
			$newFeedback = new Feedback;
			$newFeedback->media_id = $this->id;
			$newFeedback->user_id = Auth::user()->id;
			$newFeedback->save();	
		}
	}
	
	public function highlight($text, $words) {
		$split_words = explode( " " , $words );
		foreach($split_words as $word)
		{
			$color = "#e5e5e5";
			$text = preg_replace("|($word)|Ui" ,
				"<strong class=\"red\">$1</strong>" , $text );
		}
		return $text;
	}	
	
	public function type() {
		$type = $this->category()->name;
		switch($type){
			case 'Movies':
				$text = "filmType";
				break;
			case "TV":
				$text = "filmType";
				break;
			case "Music":
				$text = "musicType";
				break;			
			case "Games":
				$text = "exeType";
				break;			
			case "Applications":
				$text = "exeType";
				break;			
			case "Books":
				$text = "pdfType";
				break;			
			case "Anime":
				$text = "filmType";
				break;		
			case "Other":
				$text = "Type";
				break;			
			case "XXX":
				$text = "filmType";
				break;
		}
		return $text;
	}
	
	public function time_elapsed_string($datetime, $full = false) 
	{
		$now = new DateTime;
		$ago = new DateTime($datetime);
		$diff = $now->diff($ago);

		$diff->w = floor($diff->d / 7);
		$diff->d -= $diff->w * 7;

		$string = array(
			'y' => 'year',
			'm' => 'month',
			'w' => 'week',
			'd' => 'day',
			'h' => 'hour',
			'i' => 'min',
			's' => 'sec',
		);
		foreach ($string as $k => &$v) {
			if ($diff->$k) {
				$v = $diff->$k . '&nbsp;' . $v . ($diff->$k > 1 ? 's' : '');
			} else {
				unset($string[$k]);
			}
		}

		if (!$full) $string = array_slice($string, 0, 1);
		return $string ? implode(', ', $string) . '' : 'just&nbsp;now';
	}
	public function get_desc(){
		$bbtext = htmlentities ($this->description);
		$bbtext = str_replace(array("&lt;i&gt;", "&lt;b&gt;", "&lt;/i&gt;", "&lt;/b&gt;", "&quot;", ), array("<i>", "<b>", "</i>", "</b>", '"'), $bbtext);
	  $bbtags = array(
		'[bold]' => '<span style="font-weight:bold;">','[/bold]' => '</span>',
		'[italic]' => '<span style="font-weight:bold;">','[/italic]' => '</span>',
		'[underline]' => '<span style="text-decoration:underline;">','[/underline]' => '</span>',
		'[b]' => '<b>','[/b]' => '</b>',
		'[i]' => '<i>','[/i]' => '</i>',
		'[u]' => '<span style="text-decoration:underline;">','[/u]' => '</span>',
		'[s]' => '<span class="bbcode" style="text-decoration:line-through">','[/s]' => '</span>',
		'[break]' => '<br>',
		'[br]' => '<br>',
		'[newline]' => '<br>',
		'[nl]' => '<br>',
		'[code]' => '<code>','[/code]' => '</code>',
		'[quote]' => '<div class="quote">','[/quote]' => '</div>',		
		'[left]' => '<div class="left">','[/left]' => '</div>',		
		'[center]' => '<div class="center">','[/center]' => '</div>',	
		'[right]' => '<div class="right">','[/right]' => '</div>',		
		'[justify]' => '<div class="justify">','[/justify]' => '</div>',		
		'\r\n' => '<br>','\r' => '<br>','\n' => '<br>',	
	  );

	  $bbtext = str_ireplace(array_keys($bbtags), array_values($bbtags), $bbtext);
	  
	  
	  $bbextended = array(
		"/\ahref\"=(.*?)\"/i" => function($m) {
			$link = $this->base64_url_encode($m[0]);
			return 'href="/out/confirm/'.$link.'/" class="ajaxLink"';

		},
		"/\[url=\"(.*?)\"](.*?)\[\/url]/i" => function($m) {
			$link = $this->base64_url_encode($m[1]);
			return '<a href="/out/confirm/'.$link.'/" class="ajaxLink" >'.$m[2].'</a>';

		},
		"/\[color=(.*?)](.*?)\[\/color]/i" => "<span style=\"color:$1\">$2</span>",		
		"/\[size=(.*?)](.*?)\[\/size]/i" => "<span style=\"font-size:$1%\">$2</span>",
		"/\[img\]([^[]*)\[\/img\]/i" => "<img src=\"$1\" alt=\" \" />",
		"/\[image=(.*?)]/i" => function($m) {
			$pic_status = UserPic::where('id', '=' , $m[1])->first();
			if(isset($pic_status->id) && !$pic_status->deleted){
				return '<a href="/uploads/user/'.$pic_status->user_id .'/or/'.$pic_status->id .'.png" rel="gallery_38165" class="ajaxLink"><img class="bbcodeImage" src="/uploads/user/'.$pic_status->user_id .'/thumb/'.$pic_status->id .'.png" alt="image"></a>';
			}else{
				return "wrong image link";
			}
		},
	  );

	  foreach($bbextended as $match=>$replacement){
		  if( is_callable($replacement)) {
			$bbtext = preg_replace_callback($match, $replacement, $bbtext);
		  }
		  else {
			$bbtext = preg_replace($match, $replacement, $bbtext);
		}
	  }
	  return nl2br($bbtext);
	}
	
	public function base64_url_encode($input)
	{
		return strtr(base64_encode($input), '+/=', '-_,');
	}
	 
	public function base64_url_decode($input)
	{
		return base64_decode(strtr($input, '-_,', '+/='));
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
