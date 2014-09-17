<?php

class Messages extends Eloquent {

	protected $table = 'user_messages';
	
	protected $guarded = array();

	public function user()
	{	
		return User::find($this->user_id);
	}	
	
	public function other()
	{	
		return User::find($this->rep_id);
	}	
	
	public function addedon()
	{	
		$yrdata= strtotime($this->created_at);
		return date('M d, Y H:i', $yrdata);
	}	
	
	public function time_elapsed() 
	{
		$datetime = $this->created_at;
		$full = false;
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
		return $string ? implode(', ', $string) . ' ago' : 'just&nbsp;now';
	}
	
	public function message(){
		$bbtext = htmlentities ($this->message);
		$bbtext = str_replace(array("&lt;i&gt;", "&lt;b&gt;", "&lt;/i&gt;", "&lt;/b&gt;", "&quot;", ), array("<i>", "<b>", "</i>", "</b>", '"'), $bbtext);
	  $bbtags = array(
		//'[heading1]' => '<h1>','[/heading1]' => '</h1>',
		//'[heading2]' => '<h2>','[/heading2]' => '</h2>',
		//'[heading3]' => '<h3>','[/heading3]' => '</h3>',
		//'[h1]' => '<h1>','[/h1]' => '</h1>',
		//'[h2]' => '<h2>','[/h2]' => '</h2>',
		//'[h3]' => '<h3>','[/h3]' => '</h3>',

		//'[paragraph]' => '<p>','[/paragraph]' => '</p>',
		//'[para]' => '<p>','[/para]' => '</p>',
		//'[p]' => '<p>','[/p]' => '</p>',
		//'[left]' => '<p style="text-align:left;">','[/left]' => '</p>',
		//'[right]' => '<p style="text-align:right;">','[/right]' => '</p>',
		//'[center]' => '<p style="text-align:center;">','[/center]' => '</p>',
		//'[justify]' => '<p style="text-align:justify;">','[/justify]' => '</p>',

		'[bold]' => '<span style="font-weight:bold;">','[/bold]' => '</span>',
		'[italic]' => '<span style="font-weight:bold;">','[/italic]' => '</span>',
		'[underline]' => '<span style="text-decoration:underline;">','[/underline]' => '</span>',
		'[b]' => '<span style="font-weight:bold;">','[/b]' => '</span>',
		'[i]' => '<i>','[/i]' => '</i>',
		'[u]' => '<span style="text-decoration:underline;">','[/u]' => '</span>',
		'[s]' => '<span class="bbcode" style="text-decoration:line-through">','[/s]' => '</span>',
		'[break]' => '<br>',
		'[br]' => '<br>',
		'[newline]' => '<br>',
		'[nl]' => '<br>',
		
		//'[unordered_list]' => '<ul>','[/unordered_list]' => '</ul>',
		//'[list]' => '<ul>','[/list]' => '</ul>',
		//'[ul]' => '<ul>','[/ul]' => '</ul>',

		//'[ordered_list]' => '<ol>','[/ordered_list]' => '</ol>',
		//'[ol]' => '<ol>','[/ol]' => '</ol>',
		//'[list_item]' => '<li>','[/list_item]' => '</li>',
		//'[li]' => '<li>','[/li]' => '</li>',
		
		//'[*]' => '<li>','[/*]' => '</li>',
		'[code]' => '<code>','[/code]' => '</code>',
		//'[preformatted]' => '<pre>','[/preformatted]' => '</pre>',
		//'[pre]' => '<pre>','[/pre]' => '</pre>',	     
	  );

	  $bbtext = str_ireplace(array_keys($bbtags), array_values($bbtags), $bbtext);

	  $bbextended = array(
		"/\[user=\"(.*?)\"](.*?)\[\/user]/i" => function($m) {
				$user = User::where('username', '=' , $m[1])->first();
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
	  
	  $bbextended = array(
		"/\[:Qbiggrin]/i" => "<img src=\"/images/smiley/biggrin.gif\" class=\"bbedit-biggrin\" alt=\"biggrin\" title=\"Big grin\">",
		"/\[:Qcry]/i" => "<img src=\"/images/smiley/cry.gif\" class=\"bbedit-cry\" alt=\"cry\" title=\"Cry\">",
		"/\[:Qdizzy]/i" => "<img src=\"/images/smiley/dizzy.gif\" class=\"bbedit-dizzy\" alt=\"dizzy\" title=\"Dizzy\">",
		"/\[:Qfunk]/i" => "<img src=\"/images/smiley/funk.gif\" class=\"bbedit-funk\" alt=\"funk\" title=\"Funk\">",
		"/\[:Qhuffy]/i" => "<img src=\"/images/smiley/huffy.gif\" class=\"bbedit-huffy\" alt=\"huffy\" title=\"Huffy\">",
		"/\[:Qlol]/i" => "<img src=\"/images/smiley/lol.gif\" class=\"bbedit-lol\" alt=\"lol\" title=\"Laugh out Loud\">",
		"/\[:Qloveliness]/i" => "<img src=\"/images/smiley/loveliness.gif\" class=\"bbedit-loveliness\" alt=\"loveliness\" title=\"Loveliness\">",
		"/\[:Qmad]/i" => "<img src=\"/images/smiley/mad.gif\" class=\"bbedit-mad\" alt=\"mad\" title=\"Mad\">",
		"/\[:Qsad]/i" => "<img src=\"/images/smiley/sad.gif\" class=\"bbedit-sad\" alt=\"sad\" title=\"Sad\">",
		"/\[:Qshocked]/i" => "<img src=\"/images/smiley/shocked.gif\" class=\"bbedit-shocked\" alt=\"shocked\" title=\"Shocked\">",
		"/\[:Qshy]/i" => "<img src=\"/images/smiley/shy.gif\" class=\"bbedit-shy\" alt=\"shy\" title=\"Shy\">",
		"/\[:Qsleepy]/i" => "<img src=\"/images/smiley/sleepy.gif\" class=\"bbedit-sleepy\" alt=\"sleepy\" title=\"Sleepy\">",
		"/\[:Qsmile]/i" => "<img src=\"/images/smiley/smile.gif\" class=\"bbedit-smile\" alt=\"smile\" title=\"Smile\">",
		"/\[:Qsweat]/i" => "<img src=\"/images/smiley/sweat.gif\" class=\"bbedit-sweat\" alt=\"sweat\" title=\"Sweat\">",
		"/\[:Qtitter]/i" => "<img src=\"/images/smiley/titter.gif\" class=\"bbedit-titter\" alt=\"titter\" title=\"Titter\">",
		"/\[:Qtongue]/i" => "<img src=\"/images/smiley/tongue.gif\" class=\"bbedit-tongue\" alt=\"tongue\" title=\"Tongue out\">",
		"/\[:Qboo]/i" => "<img src=\"/images/smiley/boo.gif\" class=\"bbedit-boo\" alt=\"boo\" title=\"Boo\">",
		"/\[:Qwink]/i" => "<img src=\"/images/smiley/wink.gif\" class=\"bbedit-wink\" alt=\"wink\" title=\"Wink\">",
		"/\[:Qdull]/i" => "<img src=\"/images/smiley/dull.gif\" class=\"bbedit-dull\" alt=\"dull\" title=\"Dull\">",
		"/\ahref\"=(.*?)\"/i" => function($m) {
			$link = $this->base64_url_encode($m[0]);
			return 'href="/out/confirm/'.$link.'/" class="ajaxLink"';

		},
		"/\[quote=\"(.*?)\"](.*?)\[\/quote]/i" => function($m) {
			$user = User::where('username', '=' , $m[1])->first();
			if(isset($user->id)){
				return '<div class="quote"><div class="quoteAuthor plain"><a href="/user/'. $user->username .'/" class="plain">'. $user->username .'</a></div>'. $m[2] .'</div>';
			}
			
		},
		"/\[url=\"(.*?)\"](.*?)\[\/url]/i" => function($m) {
			$link = $this->base64_url_encode($m[1]);
			return '<a href="/out/confirm/'.$link.'/" class="ajaxLink" >'.$m[2].'</a>';

		},
		"/\[user=\"(.*?)\"]/i" => function($m) {
				$user = User::where('username', '=' , $m[1])->first();
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
			},		
			"/\[image=(.*?)]/i" => function($m) {
				$pic_status = UserPic::where('id', '=' , $m[1])->first();
				if(isset($pic_status->id) && !$pic_status->deleted){
					return '<a href="/uploads/user/'.$pic_status->user_id .'/or/'.$pic_status->id .'.png" rel="gallery_38165" class="ajaxLink"><img class="bbcodeImage" src="/uploads/user/'.$pic_status->user_id .'/thumb/'.$pic_status->id .'.png" alt="image"></a>';
				}else{
					return "wrong image link";
				}
			},
		//"/\[email=(.*?)\](.*?)\[\/email\]/i" => "<a href=\"mailto:$1\">$2</a>",
		//"/\[mail=(.*?)\](.*?)\[\/mail\]/i" => "<a href=\"mailto:$1\">$2</a>",
		"/\[img\]([^[]*)\[\/img\]/i" => "<img src=\"$1\" alt=\" \" />",
		//"/\[image\]([^[]*)\[\/image\]/i" => "<img src=\"$1\" alt=\" \" />",
		//"/\[image_left\]([^[]*)\[\/image_left\]/i" => "<img src=\"$1\" alt=\" \" class=\"img_left\" />",
		//"/\[image_right\]([^[]*)\[\/image_right\]/i" => "<img src=\"$1\" alt=\" \" class=\"img_right\" />",
	  );
 
	  foreach($bbextended as $match=>$replacement){
		  if( is_callable($replacement)) {
			$bbtext = preg_replace_callback($match, $replacement, $bbtext);
		  }
		  else {
			$bbtext = preg_replace($match, $replacement, $bbtext);
		}
	  }
		$bbtags = array(
		'[quote]' => '<div class="quote">','[/quote]' => '</div>',   
	  );

	  $bbtext = str_ireplace(array_keys($bbtags), array_values($bbtags), $bbtext);
	  
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
	
	public function forward()
	{

$text = '---------- Forwarded message ----------
From: [user="'. $this->user()->username.'"]'. $this->user()->username.'[/user]
Date: '.date('H:i:s m/d/Y', strtotime($this->created_at)).'
To: [user="'.$this->other()->username .'"]'.$this->other()->username .'[/user]
[quote="'. $this->user()->username.'"]'. $this->message.'[/quote]';

		return $text;
	}	
}