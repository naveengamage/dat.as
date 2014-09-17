<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';
	//protected $with   = array('posts');
	
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	 
	protected $hidden = array('password');
	protected $fillable = array('username', 'email', 'password', 'avatar');

	public static $update_rules = array(
    	'username' => 'required|alpha_dash|min:3',
        'email' => 'required|email'
	);	

	public function achievements()
    {
        return $this->hasMany('UserAchievements', 'user_id');
    }	
	
	public function userpics()
    {
        return UserPic::where('user_id','=', $this->id)->where('deleted','=', 0)->orderBy('created_at', 'desc')->take(10)->get();
    }
	
	public function comments(){
		return Comment::where('object_id','=', $this->object_id)->where('status', '=', 1)->where('comment_parent', 0)->orderBy('created_at', 'desc')->take(15)->get();
	}	
	
	public function totalComments(){
		return Comment::where('object_id','=', $this->object_id)->where('status', '=', 1)->where('comment_parent', 0)->orderBy('created_at', 'desc')->count();
	}
	
	public function totalQuestions(){
		return DB::table('media')->where('user_id', '=', $this->id)->count();
	}

	public function totalPoints(){
		return DB::table('points')->where('user_id', '=', $this->id)->sum('points');
	}

	public function totalAnswers(){
		return DB::table('comments')->where('user_id', '=', $this->id)->count();
	}

	public function totalVotes(){
		return DB::table('user_flags')->where('user_flagged_id', '=', $this->id)->count();
	}

	public function totalFlagged(){
		return DB::table('media_flags')->where('user_id', '=', $this->id)->count();
	}

	public function totalLikes(){
		return DB::table('media_likes')->where('user_id', '=', $this->id)->count();
	}

	public function totalFlags(){
		return DB::table('user_flags')->where('user_flagged_id', '=', $this->id)->count();
	}	
	
	public function totalConvo(){
		return Conversation::where('sender_id', Auth::user()->id)->where('sender_deleted', 0)->Orwhere('recipient_id', Auth::user()->id)->where('rep_deleted', 0)->count();
	}	
	
	public function message_count(){
		$one = Conversation::where('sender_id', Auth::user()->id)->where('sender_deleted', 0)->where('sender_new', 1)->count();
		$two = Conversation::where('recipient_id', Auth::user()->id)->where('rep_deleted', 0)->where('rep_new', 1)->count();
		return $one + $two;
	}	
	
	public function totalFB(){
		return DB::table('media_feedback')->where('user_id', '=', $this->id)->count();
	}

	public function getFbID(){
		return DB::table('oauth_facebook')->where('user_id', '=', $this->id)->first()->oauth_userid;
	}

	/**
	 *	Gets the friends for the user
	 *
	 *	@return Users
	 */
	  public function friends()
	  {
		return $this->belongsToMany('User', 'friend_user', 'user_id', 'friend_id');
	  }		
	  
	  /**
	 *	Gets the friends for the user
	 *
	 *	@return Users
	 */
	  public function allFriends()
	  {
		return Friend::where('accept', '=', 1)->where('friend_id', '=', $this->id)->Orwhere('user_id', '=', $this->id)->where('accept', '=', 1);
	  }	
	  
	/**
	 *	Gets the friends for the user
	 *
	 *	@return Users
	 */
	  public function friendsAccepted()
	  {
		return $this->belongsToMany('User', 'friend_user', 'user_id', 'friend_id')->where('accept','=',1);
	  }	
	  
	/**
	 *	Gets the friends for the user
	 *
	 *	@return Users
	 */
	  public function friendsPending()
	  {
		return $this->belongsToMany('User', 'friend_user', 'user_id', 'friend_id')->where('accept','=',0);
	  }	
	  
	/**
	 *	Gets the friends for the user
	 *
	 *	@return Users
	 */
	  public function friendsAccept()
	  {
		return $this->belongsToMany('User', 'friend_user', 'friend_id', 'user_id')->where('accept','=',0);
	  }

	/**
	 *	Gets the friends for the user
	 *
	 *	@return Users
	 */
	  public function isOnline()
	  {		date_default_timezone_set('Pacific/Auckland');
			$to_time = strtotime(date('Y-m-d H:i:s'));
			$from_time = strtotime($this->last_online);
			if( round(abs($to_time - $from_time) / 60,2) < 10){
				return true;
			}
			return false;
	  }	
	  
	  /**
	 *	Gets the friends for the user
	 *
	 *	@return Users
	 */
	  public function onlineStatus()
	  {	
		if($this->isOnline()){
			return 'online';
		}
		return 'offline';
	  }	 

	  /**
	 *	Gets the friends for the user
	 *
	 *	@return Users
	 */
	  public function repStatus()
	  {	
		if($this->rep < 0){
			$rep_status = 'negative';
		}else{
			$rep_status = 'positive';
		}
		return $rep_status;
	  }	  
	  
	/**
	 *	Gets the friends for the user
	 *
	 *	@return Users
	 */
	  public function isDeleted()
	  {	
		if($this->deleted){
			return true;
		}
		return false;
	  }

	  
	  
	  /**
	   *	Checks if friend or not
	   *
	   *	@return bool
	   */
	  public function friendStatus($user)
	  {
		if (!$this->friends()->where('friend_id', '=', $user->id)->where('accept', '=', 1)->get()->count() == 0 ||  !Friend::where('friend_id', '=', $this->id)->where('user_id', '=', $user->id)->where('accept', '=', 1)->get()->count() == 0){
			//friends
			return 1;
		}elseif(!Friend::where('friend_id', '=', $this->id)->where('user_id', '=', $user->id)->where('accept', '=', 0)->get()->count() == 0){
			//accept
			return 2;
		}elseif(!$this->friends()->where('friend_id', '=', $user->id)->where('accept', '=', 0)->get()->count() == 0){
			//pending
			return 3;
		}else{
			//none
			return 0;
		}

	  }

	  
	public function levelName(){
		switch($this->level){
			case 0:
				return "User";
			case 1:
				return "Uploader";
			case 2:
				return "Verified Uploader";
			case 3:
				return "Suprt User";
			case 4:
				return "Staff";
			case 5:
				return "Administrator";
			default:
				return "User";
		}
	}

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}
	
	public function getRememberToken()
	{
		return $this->remember_token;
	}

	public function setRememberToken($value)
	{
		$this->remember_token = $value;
	}

	public function getRememberTokenName()
	{
		return 'remember_token';
	}
}