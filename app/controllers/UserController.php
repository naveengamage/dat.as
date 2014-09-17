<?php 

class UserController extends BaseController{

	/**
	 * User Repository
	 *
	 * @var User
	 */
	protected $user;

	public function __construct(User $user)
	{
		$this->user = $user;
	}

	public static $rules = array(
		'nickname' => 'required|unique:users,username',
        'email' => 'required|email|unique:users',
        'password' => 'required'
    );
	
	public static $rule_nick = array(
		'nickname' => 'required|unique:users,username'
    );	
	
	public static $rule_email = array(
        'email' => 'required|email|unique:users'
    );	
	
	public static $rule_pass = array(
        'password' => 'required'
    );

	public static $rules_captcha =  array('captcha' => array('required', 'captcha'));
	
    // *********** USER SIGNUP ********** //

	public function signup(){

		$validator = Validator::make(Input::all(), static::$rules_captcha);
        if ($validator->fails()){
			return Redirect::to('/auth/register/')->with(array('note' => Lang::get('users.captcha'), 'note_type' => 'error'));
		}else{
			$validation_nick = Validator::make( Input::all(), static::$rule_nick );

			if ($validation_nick->fails()){
				return Redirect::to('/auth/register/')->with(array('note' => Lang::get('users.signup_error_nick'), 'note_type' => 'error'));
			}		
			
			$validation_email = Validator::make( Input::all(), static::$rule_email );

			if ($validation_email->fails()){
				return Redirect::to('/auth/register/')->with(array('note' => Lang::get('users.signup_error_email'), 'note_type' => 'error'));
			}		
			
			$validation_pass = Validator::make( Input::all(), static::$rule_pass );

			if ($validation_pass->fails()){
				return Redirect::to('/auth/register/')->with(array('note' => Lang::get('users.signup_error_pass'), 'note_type' => 'error'));
			}


			$username = htmlspecialchars(stripslashes(Input::get('nickname')));

			$user = User::where('username', '=', $username)->first();

			if(!$user){

				$settings = Setting::first();

				if($settings->user_registration){

					if( count(explode(' ', $username)) == 1 ){

						if(Input::get('password') != ''){
							$user = $this->new_user( $username, Input::get('email'), Hash::make(Input::get('password')) ); 
						

							if($user){
								Auth::attempt(array('email' => Input::get('email'), 'password' => Input::get('password')));
								$this->new_user_points($user->id);
							}

							$redirect = Input::get('return_uri');

							if($redirect == '') $redirect = '/';

							return Redirect::to($redirect);

						} else {
							return Redirect::to('/auth/register/')->with(array('note' => Lang::get('users.signup_invalidpass'), 'note_type' => 'error'));
						}

					} else {
						return Redirect::to('/auth/register/')->with(array('note' => Lang::get('users.username_no_spaces'), 'note_type' => 'error'));
					}

				} else {
					return Redirect::to('/auth/register/')->with(array('note' => Lang::get('users.signup_reg_closed'), 'note_type' => 'error'));
				}

			} else {
				return Redirect::to('/auth/register/')->with(array('note' => Lang::get('users.username_in_use'), 'note_type' => 'error'));
			}
		}

	}

	// *********** CREATE A NEW USERNAME WITH USERNAME EMAIL AND PASSWORD ********** //

	private function new_user($username, $email, $password, $filename = NULL){
		$object_id = new ObjectId;
		$object_id->save();
		
		$user = new User;
	    $user->username = $username; 
		$user->object_id = $object_id->id;
	    $user->email = $email;
	    $user->password = $password;	
		$hash = Hash::make($username.time().rand());
		$user->hash = $hash;
		
		date_default_timezone_set('Pacific/Auckland');
		$user->last_online = date('Y-m-d H:i:s');

	    if($filename){
	    	$user->avatar = $filename;
	    }

	    $user->save();
		
		$object_id->profile_id = $user->id;
		$object_id->save();
		
		$this->new_user_widgets($user->id);
		
	    return $user;
	}

	// *********** WHEN USER SIGNS UP AWARD THEM WITH POINTS ********** //

	private function new_user_points($user_id){
		$point = new Point;
    	$point->user_id = $user_id;
    	$point->points = 200;
    	$point->description = Lang::get('users.registration');
    	$point->save();
	}	
	
	private function new_user_widgets($user_id){
	
				$user = User::find($user_id);
				if(isset($user->id)){
						$days = dateString($user->created_at);
						$data = array('days' => $days);
						//return View::make('gadgets.user_basic',$data);
					try
					{
						$pdf = PDF::loadView('gadgets.user_basic',$data);
						$pdf->setSize('5.90','94.90');
						$pdf->setOption('margin-bottom', 0);
						$pdf->setOption('margin-top', 0);
						$pdf->setOption('margin-left', 0);
						$pdf->setOption('margin-right', 0);
						$pdf->save('/var/www/datas/tmp/b-'.$user_id.'.pdf');

						//return '';
						$imagick = new Imagick(); 

						$imagick->setResolution(400, 400);
						$imagick->setBackgroundColor(new ImagickPixel('transparent')); 

						$imagick->readImage('/var/www/datas/tmp/b-'.$user_id.'.pdf'); 

						$imagick->resizeImage(350 , 19, imagick::FILTER_LANCZOS, 1 );
						$imagick->writeImages('/var/www/datas/laravel/public/widgets/user/basic/'.$user_id . '.png', false); 

						$imagick->clear();
						$imagick->destroy(); 

						unlink('/var/www/datas/tmp/b-'.$user_id.'.pdf');
						//return '<style>body {margin:0px;padding:0px;}</style><img src="http://109.201.131.56/a/converted.png" height="19" width="350">';
					}catch(HTML2PDF_exception $e) {
						echo $e;
						exit;
					}
					
					$gold = $user->achievements()->where('type','=', 3)->count();
					$silver = $user->achievements()->where('type','=', 2)->count();
					$bronze = $user->achievements()->where('type','=', 1)->count();
					$rep = $user->rep;
					$username = $user->username;
					$days = dateString($user->created_at);
					$avatar = $user->avatar;
					$data = array('gold' => $gold, 'silver' => $silver, 'bronze' => $bronze, 'rep' => $rep, 'username' => $username, 'days' => $days , 'avatar' => $avatar );
					//return View::make('gadgets.user2',$data);
					
					try
					{
						$pdf = PDF::loadView('gadgets.user_full',$data);
						$pdf->setSize('23.5','110.00');
						$pdf->setOption('margin-bottom', 0);
						$pdf->setOption('margin-top', 0);
						$pdf->setOption('margin-left', 0);
						$pdf->setOption('margin-right', 0);
						$pdf->save('/var/www/datas/tmp/f-'.$user_id.'.pdf');

						//return '';
						$imagick = new Imagick(); 

						$imagick->setResolution(400, 400);
						$imagick->setBackgroundColor(new ImagickPixel('transparent')); 

						$imagick->readImage('/var/www/datas/tmp/f-'.$user_id.'.pdf'); 

						$imagick->resizeImage(402 , 77, imagick::FILTER_LANCZOS, 1 );
						$imagick->writeImages('/var/www/datas/laravel/public/widgets/user/full/'.$user_id . '.png', false); 

						$imagick->clear();
						$imagick->destroy(); 

						unlink('/var/www/datas/tmp/f-'.$user_id.'.pdf');
						//return '<style>body {margin:0px;padding:0px;}</style><img src="http://109.201.131.56/a/converted.png" height="77" width="402">';
					}catch(HTML2PDF_exception $e) {
						echo $e;
						exit;
					}
					
				}
	}

	// *********** USER SIGNIN ********** //

	public function signin(){
	    // get login POST data
	    $email_login = array(
	        'email' => Input::get('email'),
	        'password' => Input::get('password')
	    );

	    if ( Auth::attempt($email_login) ){

	    	$this->add_user_login_point();

	    	$redirect = Input::get('return_uri');
			if($redirect == '') $redirect = '/';
			if(!Auth::guest()){
				date_default_timezone_set('Pacific/Auckland');
				Auth::user()->last_online = date('Y-m-d H:i:s');
				Auth::user()->save();
			}
	    	return Redirect::to($redirect);
	    	
	    } else {
	        // auth failure! redirect to login with errors
	        return Redirect::to('/auth/login/')->with(array('note' => Lang::get('users.signin_error'), 'note_type' => 'error'));
	    }

	}

	// *********** FACEBOOK OAUTH SIGNIN/SIGNUP ********** //

	public function facebook(){
	
		$settings = Setting::first();

		if($settings->user_registration){	

			// get data from input
		    $code = Input::get( 'code' );

		    // get fb service
		    $fb = OAuth::consumer( 'Facebook' );

		    // check if code is valid

		    // if code is provided get user data and sign in
		    if ( !empty( $code ) ) {

		        // This was a callback request from google, get the token
		        $token = $fb->requestAccessToken( $code );

		        // Send a request with it
		        $result = json_decode( $fb->request( '/me?fields=picture,email,id,username' ), true );

		        $oauth_userid = $result['id'];
		        $oauth_username = $result['username'];
		        $oauth_email = $result['email'];
		        $oauth_picture = 'http://graph.facebook.com/' . $oauth_userid . '/picture?type=large';
		        if(isset($oauth_userid) && isset($oauth_username) && isset($oauth_email) && isset($oauth_picture)){
		        	
		        	$fb_auth = OauthFacebook::where('oauth_userid', '=', $oauth_userid)->first();
			        	
			        if(isset($fb_auth->id)){
			        	$user = User::find($fb_auth->user_id);
			        } else {
			        	// Execute Add or Login Oauth User
			        	$user = User::where('email', '=', $oauth_email)->first();

			        	if(!isset($user->id)){
			        		$username = $this->create_username_if_exists($oauth_username);
			        		$email = $oauth_email;
			        		$password = Hash::make($this->rand_string(15));

			        		$user = $this->new_user($username, $email, $password, $this->uploadImageFromURL($oauth_picture, $username));

			        		$this->new_user_points($user->id);

			        		$new_oauth_user = new OauthFacebook;
			        		$new_oauth_user->user_id = $user->id;
			        		$new_oauth_user->oauth_userid = $oauth_userid;
			        		$new_oauth_user->save();

			        	} else {
			        		// Redirect and send error message that email already exists. Let them know that they can request to reset password if they do not remember
			        		return Redirect::to('signin')->with(array('errors' => 'Email is already in use.'));
			        	}
			        }

		        	// Redirect to new User Login;
		        	Auth::login($user,true);
		        
		        	return Redirect::intended('/');
		        	

		        } else {
		        	// Something went wrong, redirect and send error msg
		        	echo 'Some Oauth information was not able to get retrieved. Please try again.';
		        	echo '<br />Info retrieved:<br />';
		        	echo '<br />userid: ' . $oauth_userid;
		        	echo '<br />username: ' . $oauth_username;
		        	echo '<br />email: ' . $oauth_email;
		        	echo '<br />picture: ' . $oauth_picture;
		        }

		    }
		    // if not ask for permission first
		    else {
		        // get fb authorization
		        $url = $fb->getAuthorizationUri();

		        // return to facebook login url
		        return Response::make()->header( 'Location', (string)$url );
		    }
		} else {
			return Redirect::to('signin')->with(array('errors' => 'Sorry, Registration has been closed.'));
		}
	}

	// *********** GOOGLE OAUTH SIGNIN/SIGNUP ********** //
	public function twitter(){
	
		   $auth_url = Twitter::request();
			header('Location: ' . $auth_url);

	}	
	
	public function yahoo(){
	
		require '/var/www/datas/laravel/vendor/openid.php';
		$openid = new LightOpenID($_SERVER['HTTP_HOST']);
     
			//Not already logged in
			if(!$openid->mode)
			{
				 

					//The google openid url
					$openid->identity = 'https://me.yahoo.com';
					 
					//Get additional google account information about the user , name , email , country
				   $openid->required = array('namePerson', 'namePerson/friendly', 'contact/email');
					
					$openid->realm = 'http://wowiii.com';
					$openid->returnUrl = 'http://wowiii.com/yahoo';
					 
					//start discovery
					header('Location: ' . $openid->authUrl());
				
			}
			else
			{
				if($openid->validate())
				{
					//User logged in
					$yahoo_id = $openid->identity;
					$attributes = $openid->getAttributes();

					
					$yahoo_id = explode('#', $yahoo_id);
					$yahoo_id = $yahoo_id[0];
					
					$email = $attributes["contact/email"];
					$username_n = explode('@', $email);
					
					$oauth_email = $email;			
					$oauth_username  = $username_n[0];					
					$oauth_userid  = $yahoo_id;
					
					if(isset($oauth_userid) && isset($oauth_username) && isset($oauth_email)){
		        	
						$yahoo_auth = OauthYahoo::where('oauth_userid', '=', $oauth_userid)->first();
							
						if(isset($yahoo_auth->id)){
							$user = User::find($yahoo_auth->user_id);
						} else {
							// Execute Add or Login Oauth User
							$user = User::where('email', '=', $oauth_email)->first();

							if(!isset($user->id)){
								$username = $this->create_username_if_exists($oauth_username);
								$email = $oauth_email;
								$password = Hash::make($this->rand_string(15));
								$oauth_picture = null;
								$avatar = ($oauth_picture != NULL) ? $this->uploadImageFromURL($oauth_picture, $username) : NULL;

								$user = $this->new_user($username, $email, $password, $avatar);

								//$this->new_user_points($user->id);

								$new_oauth_user = new OauthYahoo;
								$new_oauth_user->user_id = $user->id;
								$new_oauth_user->oauth_userid = $oauth_userid;
								$new_oauth_user->save();

							} else {
								// Redirect and send error message that email already exists. Let them know that they can request to reset password if they do not remember
								return Redirect::to('signin')->with('errors', 'Email is already in use.');
							}
						}


						// Redirect to new User Login;
						Auth::login($user,true);
						//$this->add_user_login_point();

						return Redirect::intended('/');
						

					} else {
						// Something went wrong, redirect and send error msg
						echo 'Some Oauth information was not able to get retrieved. Please try again.';
						echo '<br />Info retrieved:<br />';
						echo '<br />userid: ' . $oauth_userid;
						echo '<br />username: ' . $oauth_username;
						echo '<br />email: ' . $oauth_email;
						echo '<br />picture: ' . $oauth_picture;
					}
				
				}
				else
				{
					return Redirect::to('signin')->with('errors', 'Please try again.');
				}
			}
	}	
	
	public function authTwitter(){	
	
		$oauth_userid = Twitter::id();
		$oauth_username = Twitter::username();
		$oauth_email = $oauth_userid;
					if(isset($oauth_userid) && isset($oauth_username)){
		        	
						$twitter_auth = OauthTwitter::where('oauth_userid', '=', $oauth_userid)->first();
							
						if(isset($twitter_auth->id)){
							$user = User::find($twitter_auth->user_id);
						} else {
							// Execute Add or Login Oauth User
							$user = User::where('email', '=', $oauth_email)->first();

							if(!isset($user->id)){
								$username = $this->create_username_if_exists($oauth_username);
								$email = $oauth_email;
								$password = Hash::make($this->rand_string(15));
								$oauth_picture = null;
								$avatar = ($oauth_picture != NULL) ? $this->uploadImageFromURL($oauth_picture, $username) : NULL;

								$user = $this->new_user($username, $email, $password, $avatar);

								//$this->new_user_points($user->id);

								$new_oauth_user = new OauthTwitter;
								$new_oauth_user->user_id = $user->id;
								$new_oauth_user->oauth_userid = $oauth_userid;
								$new_oauth_user->save();

							} else {
								// Redirect and send error message that email already exists. Let them know that they can request to reset password if they do not remember
								return Redirect::to('signin')->with('errors', 'This email is already in use.');
							}
						}


						// Redirect to new User Login;
						Auth::login($user,true);
						//$this->add_user_login_point();

						return Redirect::intended('/');
						

					} else {
						// Something went wrong, redirect and send error msg
						echo 'Some Oauth information was not able to get retrieved. Please try again.';
						echo '<br />Info retrieved:<br />';
						echo '<br />userid: ' . $oauth_userid;
						echo '<br />username: ' . $oauth_username;
						echo '<br />email: ' . $oauth_email;
						echo '<br />picture: ' . $oauth_picture;
					}
		 
	}
	
	public function google() {

		$settings = Setting::first();

		if($settings->user_registration){	
		    // get data from input
		    $code = Input::get( 'code' );

		    // get google service
		    $googleService = OAuth::consumer( 'Google' );

		    // check if code is valid

		    // if code is provided get user data and sign in
		    if ( !empty( $code ) ) {

		        // This was a callback request from google, get the token
		        $token = $googleService->requestAccessToken( $code );

		        // Send a request with it
		        $result = json_decode( $googleService->request( 'https://www.googleapis.com/oauth2/v1/userinfo' ), true );
		        // $message = 'Your unique Google user id is: ' . $result['id'] . ' and your name is ' . $result['name'];
		        // dd($result);

		        $oauth_userid = $result['id'];
		        $oauth_username = slugify($result['name']);
		        $oauth_email = $result['email'];
		        if(!isset($result['picture'])){
		        	$oauth_picture = NULL;
		        } else {
		        	$oauth_picture = $result['picture'];
		        }

		        if(isset($oauth_userid) && isset($oauth_username) && isset($oauth_email)){
		        	
		        	$google_auth = OauthGoogle::where('oauth_userid', '=', $oauth_userid)->first();
			        	
			        if(isset($google_auth->id)){
			        	$user = User::find($google_auth->user_id);
			        } else {
			        	// Execute Add or Login Oauth User
			        	$user = User::where('email', '=', $oauth_email)->first();

			        	if(!isset($user->id)){
			        		$username = $this->create_username_if_exists($oauth_username);
			        		$email = $oauth_email;
			        		$password = Hash::make($this->rand_string(15));

			        		$avatar = ($oauth_picture != NULL) ? $this->uploadImageFromURL($oauth_picture, $username) : NULL;

			        		$user = $this->new_user($username, $email, $password, $avatar);

			        		$this->new_user_points($user->id);

			        		$new_oauth_user = new OauthGoogle;
			        		$new_oauth_user->user_id = $user->id;
			        		$new_oauth_user->oauth_userid = $oauth_userid;
			        		$new_oauth_user->save();

			        	} else {
			        		// Redirect and send error message that email already exists. Let them know that they can request to reset password if they do not remember
			        		return Redirect::to('signin')->with('errors', 'This email is already in use.');
			        	}
			        }


		        	// Redirect to new User Login;
		        	Auth::login($user,true);


		        	return Redirect::intended('/');
		        	

		        } else {
		        	// Something went wrong, redirect and send error msg
		        	echo 'Some Oauth information was not able to get retrieved. Please try again.';
		        	echo '<br />Info retrieved:<br />';
		        	echo '<br />userid: ' . $oauth_userid;
		        	echo '<br />username: ' . $oauth_username;
		        	echo '<br />email: ' . $oauth_email;
		        	echo '<br />picture: ' . $oauth_picture;
		        }



		    }
		    // if not ask for permission first
		    else {
		        // get googleService authorization
		        $url = $googleService->getAuthorizationUri();

		        // return to facebook login url
		        return Response::make()->header( 'Location', (string)$url );
		    }
		} else {
			return Redirect::to('signin')->with(array('errors' => 'Sorry, Registration has been closed.'));
		}
	}

	// *********** LOOP THROUGH USERNAMES TO RETURN ONE THAT DOESN'T EXIST ********** //

	private function create_username_if_exists($username){
		$user = User::where('username', '=', $username)->first();

		while (isset($user->id)) {
			$username = $username . uniqid();
			$user = User::where('username', '=', $username)->first();
		}

		return $username;
	}

	// *********** RANDOM STRIN GENERATOR ********** //

	private function rand_string( $length ) {

	    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
	    return substr(str_shuffle($chars),0,$length);

	}

	// *********** ADD USER LOGIN POINT, ONE PER DAY ********** //

	private function add_user_login_point(){
		$user_id = Auth::user()->id;

		$LastLoginPoints = Point::where('user_id', '=', $user_id)->where('description', '=', Lang::get('auth.daily_login'))->orderBy('created_at', 'desc')->first();
		if(!isset($LastLoginPoints) || date('Ymd') !=  date('Ymd', strtotime($LastLoginPoints->created_at)) ){
			$point = new Point;
			$point->user_id = $user_id;
			$point->description = Lang::get('auth.daily_login');
			$point->points = 5;
			$point->save();
			return true;
		} else {
			return false;
		}
	}



	// *********** UPDATE USER ********** //

	public function update($id)
	{
		$input = array_except(Input::all(), '_method');
		$input['username'] = str_replace('.', '-', $input['username']);
		$validation = Validator::make($input, User::$update_rules);

		if ($validation->passes())
		{
			$user = $this->user->find($id);

			if(file_exists($input['avatar'])){
            	$input['avatar'] = Helper::uploadImage(Input::file('avatar'), 'avatars');
            } else { $input['avatar'] = $user->avatar; }

            if($input['password'] == ''){
            	$input['password'] = $user->password;
            } else{ $input['password'] = Hash::make($input['password']); }

            if($user->username != $input['username']){
            	$username_exist = User::where('username', '=', $input['username'])->first();
            	if($username_exist){
            		return Redirect::to('user/' .$user->username)->with(array('note' => Lang::get('users.username_in_use'), 'note_type' => 'error') );
            	}
            }

			$user->update($input);

			return Redirect::to('user/' .$user->username)->with(array('note' => Lang::get('users.update_user'), 'note_type' => 'success') );
		}

		return Redirect::to('user/' . Auth::user()->username)->with(array('note' => Lang::get('common.validation_errors'), 'note_type' => 'error') );
		
	}


	// *********** SHOW USER PROFILE ********** //

	public function profile($username){

		$user = User::where('username', '=', $username)->first();
		$medias = Media::where('user_id', '=', $user->id)->orderBy('created_at', 'desc')->paginate(Config::get('site.num_results_per_page'));

		$data = array(
				'user' => $user,
				'media' => $medias,
				);

		return View::make('user.index', $data);
	}

	// *********** SHOW USER PROFILE LIKES ********** //

	public function profile_likes($username){

		$user = User::where('username', '=', $username)->first();
		$medias = MediaLike::where('user_id', '=', $user->id)->orderBy('created_at', 'desc')->paginate(Config::get('site.num_results_per_page'));

		$data = array(
				'user' => $user,
				'media' => $medias,
				'likes' => true,
				);

		return View::make('user.index', $data);
	}

	// ********** USER POINTS PAGE **********  //

	public function points($username){

		$user = User::where('username', '=', $username)->first();

		$data = array(
			'user' => $user,
			'points' => Point::where('user_id', '=', $user->id)->get(),
			);

		return View::make('user.points', $data);
	}

	// ********** RESET PASSWORD ********** //

	public function password_reset()
	{
		return View::make('auth.password_reset');
	}

	// ********** RESET REQUEST ********** //

	public function password_request()
	{
		if($this->rate_limit(10)){
			return Response::json(array('html' => 'using this function has it\'s limits, please try again later', 'method'=> 'error'));
		}
		
	  $credentials = array('email' => Input::get('login'));
	  switch ($response = Password::remind($credentials, function($message){ $message->sender('support@dat.as'); $message->subject('ThatassLinks Password Reminder'); }) )
		{
			case Password::INVALID_USER:
				if (Request::ajax()){
					 return Response::json(array('html' => 'No user could be found with such login details.', 'method'=> 'error'));
				}
				return Redirect::to('/auth/remind_password')->with(array('note' => 'No user could be found with such login details', 'note_type' => 'error'));
				
			case Password::REMINDER_SENT:
				if($this->rate_limit(5)){
					return Response::json(array('html' => 'using this function has it\'s limits, please try again later', 'method'=> 'error'));
				}
				
				if (Request::ajax()){
				
					$html = View::make('ajax.sent')->render();
					return Response::json(array('html' => $html, 'method'=> 'show'));
				}
				return Redirect::to('/auth/remind_password')->with(array('note' => 'Password was sent to your e-mail.', 'note_type' => 'success'));
		}
	}

	// ********** RESET PASSWORD TOKEN ********** //

	public function password_reset_token($token)
	{
		if (is_null($token)) App::abort(404);
		$rem = Rem::where('token', '=', $token)->count();
		if($rem == 0){
			return View::make('auth.forgot');
		}
	  return View::make('auth.reset')->with('token', $token);
	}

	// ********** RESET PASSWORD POST ********** //

	public function password_reset_post($token)
	{
	   $password = Input::get('password');
	   if($password  != ''){
				$rem = Rem::where('token', '=', $token)->first();
				if(isset($rem->email)){
					$user = User::where('email','=', $rem->email)->first();
					$user->password = Hash::make($password);
					$user->save();
					Rem::where('email', $user->email)->delete();
					return Redirect::to('/')->with(array('note' => 'Password has been changed, please login.', 'note_type' => 'success'));;
				}else{
					return Redirect::to('/auth/remind_password')->with(array('note' => 'Invalid token.', 'note_type' => 'error'));
				}
		}else{
			return Redirect::to('/auth/remind_password/'.$token)->with(array('note' => 'Password cannot be empty.', 'note_type' => 'error'));
		}
	}
	
	public function freindAcceptUC($username)
	{
		if($this->rate_limit(10)){
			return Response::json(array('html' => 'using this function has it\'s limits, please try again later', 'method'=> 'error'));
		}
		
		$user = User::where('username','=', $username)->first();
		
		if(isset($user->id) && Auth::user()->friendStatus($user) == 2 ){
			if(Auth::user()->id != $user->id){
					$accept_request = Friend::where('friend_id', '=', Auth::user()->id)->where('user_id','=', $user->id)->first();
					$accept_request->accept = 1;
					$accept_request->save();
			}
		}
		if (Request::ajax()){
			return Response::json(array('html' => '', 'method'=> 'ok', 'url' => URL::to('/user/'. $username)));
		}
		return Redirect::to('/user/'. $username);
	}
	
	public function getFrienCancelUC($username)
	{
		$data = array('username'=> $username, 'return' => URL::previous());
		if (Request::ajax()){
			$html = View::make('ajax.user.friend_cancel_confirm', $data)->render();
			return Response::json(array('html' => $html, 'method'=> 'show'));
		}
		return View::make('user.friend_cancel_confirm', $data);
	}
		
	public function postFrienCancelUC($username)
	{
		if($this->rate_limit(10)){
			return Response::json(array('html' => 'using this function has it\'s limits, please try again later', 'method'=> 'error'));
		}
		
		$user = User::where('username','=', $username)->first();
		
		if(isset($user->id) && Auth::user()->friendStatus($user) != 0){
			if(Auth::user()->id != $user->id){
				if(Auth::user()->friendStatus($user) == 2){
					Friend::where('friend_id', '=', Auth::user()->id)->where('user_id','=', $user->id)->delete();
				}else{
					Auth::user()->friends()->detach( $user->id );
					if(Auth::user()->friendStatus($user) == 1){
						Friend::where('friend_id', '=', Auth::user()->id)->where('user_id','=', $user->id)->delete();
					}
				}
			}
		}
		
		if (Request::ajax()){
			return Response::json(array('html' => '', 'method'=> 'ok', 'url' => URL::to('/user/'. $username)));
		}
		return Redirect::to('/user/'. $username);
	}
	
	public function friendRequestUC($username)
	{
		if($this->rate_limit(10)){
			return Response::json(array('html' => 'using this function has it\'s limits, please try again later', 'method'=> 'error'));
		}
		
		$user = User::where('username','=', $username)->first();
		
		if(isset($user->id) && Auth::user()->friendStatus($user) == 0){
			if(Auth::user()->id != $user->id){
				Auth::user()->friends()->attach( $user->id );
			}
		}
		if (Request::ajax()){
			return Response::json(array('html' => '', 'method'=> 'ok', 'url' => URL::to('/user/'. $username)));
		}
		return Redirect::to('/user/'. $username);
	}
		
	public 	function rate_limit($limit)
	{
		$requestsLimit = $limit;
		if(Auth::guest()){
			$key = sprintf('api:%s',  Request::getClientIp());
		}else{
			$key = sprintf('api:%s', Auth::user()->id);
		}
		if (Cache::has($key))
		{
			$count = Cache::get($key);
			if( $count > $requestsLimit )
			{
				return true;
			}
			$count++;
			Cache::forget($key);
			Cache::add($key, $count, 1);
		}else{
			$count = 0;
			Cache::add($key, $count, 1);
		}
		
		if( $count > $requestsLimit )
        {
            return true;
        }
		
		return false;
	}

}