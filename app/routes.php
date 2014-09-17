<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

// HOME

Route::get('/founder', function()
{
	echo "Thanks, you will be redirected to linkedin profile of the founder in 5 seconds.";
	return header("Refresh: 5;url=https://www.linkedin.com/profile/view?id=170177558");
});

Route::get('/', function()
{

	$movies =  Media::where('is_featured', '=' , 1)->where('cat_id', '=' , 14)->take(10)->get();
	$tv =  Media::where('is_featured', '=' , 1)->where('cat_id', '=' , 15)->take(10)->get();
	$music =  Media::where('is_featured', '=' , 1)->where('cat_id', '=' , 16)->take(10)->get();
	$games =  Media::where('is_featured', '=' , 1)->where('cat_id', '=' , 17)->take(10)->get();
	$mobile_apps = Media::where('is_featured', '=' , 1)->where('sub_id', '=' , 45)->orWhere('sub_id', '=' , 46)->take(10)->get();
	$pc_apps =  Media::where('is_featured', '=' , 1)->where('sub_id', '=' , 47)->orWhere('sub_id', '=' , 48)->take(10)->get();
	$books =  Media::where('is_featured', '=' , 1)->where('cat_id', '=' , 19)->take(10)->get();
	
	$data = array('movies' => $movies,
					'tvs' => $tv,
					'musics' => $music,
					'games' => $games,
					'pc_apps' => $pc_apps,
					'mobile_apps' => $mobile_apps,
					'books' => $books);
	
	return View::make('home', $data);
});

//LINKS PAGE

Route::get('/l', function()
{

	return Request::getClientIp();
});

//URL OUT CONFIRM

Route::get('/out/confirm/{code}', function($code)
{
		$link = base64_url_decode($code);
		$data = array('link' => $link);
		
		if (Request::ajax()){
			$html = View::make('ajax.confirm',$data)->render();
			return Response::json(array('html' => $html, 'method'=> 'show'));
		}
		return View::make('general.confirm',$data);
});

//LINKS OUT

Route::get('/out/{media_id}/{link_id}', function($media_id,$link_id)
{
	$link = Links::find($link_id);
	$media = Media::find($media_id);
	
	if(isset($link->id) && !rate_limit(5)){
		$link->dl_count = $link->dl_count + 1;
		$link->save();
		if(isset($media->id)){
			$media->download_count = $media->download_count + 1;
			$media->save();
		}
	}
	
	if(!Auth::guest()){
		if(isset($media->id)){
			if(!$media->hasVoted()){
				$media->addFeedback();
			}
		}
	}
	if(isset($link->id)){
		return Redirect::to($link->link);
	}else{
		return 'invalid link';
	}
});


//SEARCH

Route::get('/search/{query}', function($query)
{
	$current_url = '/search/'.$query.'/';
	$order_text = array();
	$order_text["size"] = "desc";
	$order_text["links_count"] = "desc";
	$order_text["time_add"] = "desc";
	$order_text["dl"] = "desc";
	$order_text["sm"] = "desc";
	
	Paginator::setCurrentUrl('search/'.$query);
	
	if(Input::has('field')){
		$field = Input::get('field');
		$order = 'desc';
	
		if(Input::has('sorder')){
			$sorder = Input::get('sorder');
			if($sorder == 'asc'){
				$order = 'asc';
			}
		}
		
		switch($field){
			case "size":
				$media = Media::where('deleted', '=', 0)->where('title', 'LIKE','%' . $query . '%')->orderBy('size', $order)->paginate(10);
				if($order == "desc"){
					$order_text["size"] = "asc";
				}
				break;
			case "links_count":
				$media = Media::where('deleted', '=', 0)->where('title', 'LIKE','%' . $query . '%')->orderBy('dl_links_count', $order)->orderBy('sm_links_count', $order)->paginate(10);
				if($order == "desc"){
					$order_text["links_count"] = "asc";
				}
				break;
			case "time_add":
				$media = Media::where('deleted', '=', 0)->where('title', 'LIKE','%' . $query . '%')->orderBy('created_at', $order)->paginate(10);
				if($order == "desc"){
					$order_text["time_add"] = "asc";
				}
				break;			
			case "dl":
				$media = Media::where('deleted', '=', 0)->where('title', 'LIKE','%' . $query . '%')->orderBy('dl_links_count', $order)->paginate(10);
				if($order == "desc"){
					$order_text["dl"] = "asc";
				}
				break;			
			case "sm":
				$media = Media::where('deleted', '=', 0)->where('title', 'LIKE','%' . $query . '%')->orderBy('sm_links_count', $order)->paginate(10);
				if($order == "desc"){
					$order_text["sm"] = "asc";
				}
				break;
		}
	}else{
		$media = Media::where('deleted', '=', 0)->where('title', 'LIKE','%' . $query . '%')->orderBy('created_at', 'desc')->paginate(10);
	}
	
    $data = array(
    	'media' => $media, 'query' => $query, 'order_text' => $order_text, 'current_url' => $current_url);
	return View::make('general.list-search', $data);
});

//SEARCH

Route::get('/search/{query}/{page}/', function($query,$page)
{
	$current_url = '/search/'.$query.'/'.$page.'/';
	$order_text = array();
	$order_text["size"] = "desc";
	$order_text["links_count"] = "desc";
	$order_text["time_add"] = "desc";
	$order_text["dl"] = "desc";
	$order_text["sm"] = "desc";
	
	Paginator::setCurrentPage($page);
	Paginator::setCurrentUrl('search/'.$query);
	
	if(Input::has('field')){
		$field = Input::get('field');
		$order = 'desc';
	
		if(Input::has('sorder')){
			$sorder = Input::get('sorder');
			if($sorder == 'asc'){
				$order = 'asc';
			}
		}
		
		switch($field){
			case "size":
				$media = Media::where('deleted', '=', 0)->where('title', 'LIKE','%' . $query . '%')->orderBy('size', $order)->paginate(10);
				if($order == "desc"){
					$order_text["size"] = "asc";
				}
				break;
			case "links_count":
				$media = Media::where('deleted', '=', 0)->where('title', 'LIKE','%' . $query . '%')->orderBy('dl_links_count', $order)->orderBy('sm_links_count', $order)->paginate(10);
				if($order == "desc"){
					$order_text["links_count"] = "asc";
				}
				break;
			case "time_add":
				$media = Media::where('deleted', '=', 0)->where('title', 'LIKE','%' . $query . '%')->orderBy('created_at', $order)->paginate(10);
				if($order == "desc"){
					$order_text["time_add"] = "asc";
				}
				break;			
			case "dl":
				$media = Media::where('deleted', '=', 0)->where('title', 'LIKE','%' . $query . '%')->orderBy('dl_links_count', $order)->paginate(10);
				if($order == "desc"){
					$order_text["dl"] = "asc";
				}
				break;			
			case "sm":
				$media = Media::where('deleted', '=', 0)->where('title', 'LIKE','%' . $query . '%')->orderBy('sm_links_count', $order)->paginate(10);
				if($order == "desc"){
					$order_text["sm"] = "asc";
				}
				break;
		}
	}else{
		$media = Media::where('deleted', '=', 0)->where('title', 'LIKE','%' . $query . '%')->orderBy('created_at', 'desc')->paginate(10);
	}

    $data = array(
    	'media' => $media, 'query' => $query, 'order_text' => $order_text, 'current_url' => $current_url);
	return View::make('general.list-search', $data);
});

//USER SEARCH

Route::get('/usearch/{query}', function($query)
{
	$current_url = '/usearch/'.$query.'/';
	$order_text = array();
	$order_text["size"] = "desc";
	$order_text["links_count"] = "desc";
	$order_text["time_add"] = "desc";
	$order_text["dl"] = "desc";
	$order_text["sm"] = "desc";
	
	Paginator::setCurrentUrl('usearch/'.$query);
	
	if(Input::has('field')){
		$field = Input::get('field');
		$order = 'desc';
	
		if(Input::has('sorder')){
			$sorder = Input::get('sorder');
			if($sorder == 'asc'){
				$order = 'asc';
			}
		}
		
		switch($field){
			case "size":
				$media = Media::where('deleted', '=', 0)->where('title', 'LIKE','%' . $query . '%')->orderBy('size', $order)->paginate(10);
				if($order == "desc"){
					$order_text["size"] = "asc";
				}
				break;
			case "links_count":
				$media = Media::where('deleted', '=', 0)->where('title', 'LIKE','%' . $query . '%')->orderBy('dl_links_count', $order)->orderBy('sm_links_count', $order)->paginate(10);
				if($order == "desc"){
					$order_text["links_count"] = "asc";
				}
				break;
			case "time_add":
				$media = Media::where('deleted', '=', 0)->where('title', 'LIKE','%' . $query . '%')->orderBy('created_at', $order)->paginate(10);
				if($order == "desc"){
					$order_text["time_add"] = "asc";
				}
				break;			
			case "dl":
				$media = Media::where('deleted', '=', 0)->where('title', 'LIKE','%' . $query . '%')->orderBy('dl_links_count', $order)->paginate(10);
				if($order == "desc"){
					$order_text["dl"] = "asc";
				}
				break;			
			case "sm":
				$media = Media::where('deleted', '=', 0)->where('title', 'LIKE','%' . $query . '%')->orderBy('sm_links_count', $order)->paginate(10);
				if($order == "desc"){
					$order_text["sm"] = "asc";
				}
				break;
		}
	}else{
		$media = Media::where('deleted', '=', 0)->where('title', 'LIKE','%' . $query . '%')->orderBy('created_at', 'desc')->paginate(10);
	}

    $data = array(
    	'media' => $media, 'query' => $query, 'order_text' => $order_text, 'current_url' => $current_url);
	return View::make('general.list-search', $data);
});

//USER SEARCH

Route::get('/usearch/{query}/{page}/', function($query,$page)
{
	$current_url = '/usearch/'.$query.'/'.$page.'/';
	
	$order_text = array();
	$order_text["size"] = "desc";
	$order_text["links_count"] = "desc";
	$order_text["time_add"] = "desc";
	$order_text["dl"] = "desc";
	$order_text["sm"] = "desc";
	
	Paginator::setCurrentPage($page);
	Paginator::setCurrentUrl('usearch/'.$query);
	
	if(Input::has('field')){
		$field = Input::get('field');
		$order = 'desc';
	
		if(Input::has('sorder')){
			$sorder = Input::get('sorder');
			if($sorder == 'asc'){
				$order = 'asc';
			}
		}
		
		switch($field){
			case "size":
				$media = Media::where('deleted', '=', 0)->where('title', 'LIKE','%' . $query . '%')->orderBy('size', $order)->paginate(10);
				if($order == "desc"){
					$order_text["size"] = "asc";
				}
				break;
			case "links_count":
				$media = Media::where('deleted', '=', 0)->where('title', 'LIKE','%' . $query . '%')->orderBy('dl_links_count', $order)->orderBy('sm_links_count', $order)->paginate(10);
				if($order == "desc"){
					$order_text["links_count"] = "asc";
				}
				break;
			case "time_add":
				$media = Media::where('deleted', '=', 0)->where('title', 'LIKE','%' . $query . '%')->orderBy('created_at', $order)->paginate(10);
				if($order == "desc"){
					$order_text["time_add"] = "asc";
				}
				break;			
			case "dl":
				$media = Media::where('deleted', '=', 0)->where('title', 'LIKE','%' . $query . '%')->orderBy('dl_links_count', $order)->paginate(10);
				if($order == "desc"){
					$order_text["dl"] = "asc";
				}
				break;			
			case "sm":
				$media = Media::where('deleted', '=', 0)->where('title', 'LIKE','%' . $query . '%')->orderBy('sm_links_count', $order)->paginate(10);
				if($order == "desc"){
					$order_text["sm"] = "asc";
				}
				break;
		}
	}else{
		$media = Media::where('deleted', '=', 0)->where('title', 'LIKE','%' . $query . '%')->orderBy('created_at', 'desc')->paginate(10);
	}

    $data = array(
    	'media' => $media, 'query' => $query, 'order_text' => $order_text, 'current_url' => $current_url);
	return View::make('general.list-search', $data);
});

//NEW POSTS

Route::get('/new/', function()
{
	$current_url = '/new/';
	
	Paginator::setCurrentUrl('new');
	$order_text = array();
	$order_text["size"] = "desc";
	$order_text["links_count"] = "desc";
	$order_text["time_add"] = "desc";
	$order_text["dl"] = "desc";
	$order_text["sm"] = "desc";
		
	if(Input::has('field')){
		$field = Input::get('field');
		$order = 'desc';
		
		if(Input::has('sorder')){
			$sorder = Input::get('sorder');
			if($sorder == 'asc'){
				$order = 'asc';
			}
		}
		
		switch($field){
			case "size":
				$media = Media::where('deleted', '=', 0)->orderBy('size', $order)->paginate(10);
				if($order == "desc"){
					$order_text["size"] = "asc";
				}
				break;
			case "links_count":
				$media = Media::where('deleted', '=', 0)->orderBy('dl_links_count', $order)->orderBy('sm_links_count', $order)->paginate(10);
				if($order == "desc"){
					$order_text["links_count"] = "asc";
				}
				break;
			case "time_add":
				$media = Media::where('deleted', '=', 0)->orderBy('created_at', $order)->paginate(10);
				if($order == "desc"){
					$order_text["time_add"] = "asc";
				}
				break;			
			case "dl":
				$media = Media::where('deleted', '=', 0)->orderBy('dl_links_count', $order)->paginate(10);
				if($order == "desc"){
					$order_text["dl"] = "asc";
				}
				break;			
			case "sm":
				$media = Media::where('deleted', '=', 0)->orderBy('sm_links_count', $order)->paginate(10);
				if($order == "desc"){
					$order_text["sm"] = "asc";
				}
				break;
		}
	}else{
		$media = Media::where('deleted', '=', 0)->orderBy('created_at', 'desc')->paginate(10);
	}
    $data = array(
    	'media' => $media, 'order_text' => $order_text, 'current_url' => $current_url);

	return View::make('general.list-new', $data);
});

//NEW POSTS

Route::get('/new/{id}', function($id)
{
	$current_url = '/new/'.$id. '/';
		
	if($id == 'rss'){

		$media = Media::where('deleted', '=', 0)->orderBy('created_at', 'desc')->take(10)->get();
		$feed = Feed::make();
		$feed->title = 'new files RSS feed - ThatassLinks';
		$feed->description = 'new files RSS feed';
		$feed->link = URL::to('/');
		foreach ($media as $m)
		{
			// set item's title, author, url, pubdate, description and content
			$feed->add($m->title, $m->category()->name, URL::to($m->slug . '-t' .$m->id . '.html'), $m->created_at, $m->description,'');
		}
		return $feed->render('rss');
				
	}
	
	Paginator::setCurrentPage($id);
	Paginator::setCurrentUrl('new');
	
	$order_text = array();
	$order_text["size"] = "desc";
	$order_text["links_count"] = "desc";
	$order_text["time_add"] = "desc";
	$order_text["dl"] = "desc";
	$order_text["sm"] = "desc";
	
	if(Input::has('field')){
		$field = Input::get('field');
		$order = 'desc';
		
		if(Input::has('sorder')){
			$sorder = Input::get('sorder');
			if($sorder == 'asc'){
				$order = 'asc';
			}
		}
		
		switch($field){
			case "size":
				$media = Media::where('deleted', '=', 0)->orderBy('size', $order)->paginate(10);
				if($order == "desc"){
					$order_text["size"] = "asc";
				}
				break;
			case "links_count":
				$media = Media::where('deleted', '=', 0)->orderBy('dl_links_count', $order)->orderBy('sm_links_count', $order)->paginate(10);
				if($order == "desc"){
					$order_text["links_count"] = "asc";
				}
				break;
			case "time_add":
				$media = Media::where('deleted', '=', 0)->orderBy('created_at', $order)->paginate(10);
				if($order == "desc"){
					$order_text["time_add"] = "asc";
				}
				break;			
			case "dl":
				$media = Media::where('deleted', '=', 0)->orderBy('dl_links_count', $order)->paginate(10);
				if($order == "desc"){
					$order_text["dl"] = "asc";
				}
				break;			
			case "sm":
				$media = Media::where('deleted', '=', 0)->orderBy('sm_links_count', $order)->paginate(10);
				if($order == "desc"){
					$order_text["sm"] = "asc";
				}
				break;
		}
	}else{
		$media = Media::where('deleted', '=', 0)->orderBy('created_at', 'desc')->paginate(10);
	}
	
    $data = array(
    	'media' => $media, 'order_text' => $order_text, 'current_url' => $current_url);

	return View::make('general.list-new', $data);
});


//BROWSE

Route::get('/browse', function()
{
	return View::make('general.browse');
});

//BROWSE

Route::get('/get_comments', function()
{	
	if(Input::has('torrentId')){
		$torrentId = Input::get('torrentId');
		$media = Media::find($torrentId);
		$comments = Comment::where('object_id',$media->object_id)->take(5)->get();
		$data = array(
			'comments' => $comments);
		return View::make('general.get_comments',$data );
	}
});

//LOGIN 

Route::get('auth/facebook', 'UserController@facebook');
Route::get('auth/twitter', 'UserController@authTwitter');
Route::get('google', 'UserController@google');
Route::get('yahoo', 'UserController@yahoo');
Route::get('twitter', 'UserController@twitter');
Route::get('facebook', function(){
	$settings = Setting::first();

	$facebook = new Facebook(array(
	  'appId'  => $settings->fb_key,
	  'secret' => $settings->fb_secret_key,
	  'cookie' => true,
	  'oauth' => true,
	));

	$params = array(
	  'scope' => 'email, user_photos',
	  'redirect_uri' => URL::to("auth/facebook"),
	);

	$loginUrl = $facebook->getLoginUrl($params);

     //return to facebook login url
    return Response::make()->header( 'Location', (string)$loginUrl );
});


Route::get('/auth/login', function()
{
	if(Auth::guest()){
		$data = array('return' => URL::previous());
		
		if (Request::ajax()){
			$html = View::make('ajax.login',$data)->render();
			return Response::json(array('html' => $html, 'method'=> 'show'));
		}
		return View::make('login',$data);
	}
	if (Request::ajax()){
		return Response::json(array('html' => '', 'method'=> 'ok', 'url' => URL::to('/')));
	}
	return Redirect::to('/');
});

//LOGIN POST

Route::post('/auth/login', 'UserController@signin');

// REGISTER 

Route::get('/auth/register', function()
{	
	if(Auth::guest()){
		if(!Auth::guest()){
			return Redirect::to('/user/'. Auth::user()->username);
		}
		$data = array('return' => URL::previous());
		return View::make('register',$data);
	}
	if (Request::ajax()){
		return Response::json(array('html' => '', 'method'=> 'ok', 'url' => URL::to('/user/'. Auth::user()->username)));
	}
	return Redirect::to('/user/'.Auth::user()->username);
});

// REGISTER POST 

Route::post('/auth/register', 'UserController@signup');


// RESET PASSWORD 

Route::get('/auth/remind_password', function()
{	
	if (Request::ajax()){
		$html = View::make('ajax.forgot')->render();
		return Response::json(array('html' => $html, 'method'=> 'show'));
	}
	return View::make('auth.forgot');
});

// RESET PASSWORD POST

Route::post('/auth/remind_password', array(
  'uses' => 'UserController@password_request',
  'as' => 'password.request'
));

// RESET PASSWORD TOKEN

Route::get('/auth/remind_password/{token}', array(
  'uses' => 'UserController@password_reset_token',
  'as' => 'password.reset'
));

// RESET PASSWORD TOKEN POST

Route::post('/auth/change_password/{token}', array(
  'uses' => 'UserController@password_reset_post',
  'as' => 'password.update'
));

//PROFILE

Route::get('/user/{username}', function($username)
{
	$user = User::where('username','=', $username)->first();
	if(isset($user->id)){
		$joined = strtotime($user->created_at);
		$last = strtotime($user->updated_at);
		$status_last = strtotime($user->status_updated_at);
		$user->joined = time_elapsed_string('@'.$joined);
		$user->last = time_elapsed_string('@'.$last);
		$user->status_last = time_elapsed_string('@'.$status_last);
		return View::make('user.profile', array('user' => $user));
	}
	return View::make('general.404');
});

//PROFILE IMAGES

Route::get('/user/{username}/recentimages/', function($username)
{
	$user = User::where('username','=', $username)->first();
	if(isset($user->id)){
		return View::make('user.images', array('user' => $user));
	}
	return View::make('general.404');
});

//PROFILE COMMENTS

Route::get('/user/{username}/comments/', function($username)
{
	$user = User::where('username','=', $username)->first();
	if(isset($user->id)){
		$comments = Comment::where('user_id', $user->id)->orderBy('created_at', 'desc')->take(10)->get();
		return View::make('user.comments', array('comments' => $comments, 'user' => $user));
	}
	return View::make('general.404');
});

//COMMENTS SHOW

Route::get('/comments/show/{id}', function($id)
{
	$comment = Comment::where('id', $id)->first();
	if(isset($comment->id)){
		if($comment->type() == 'profile'){
			return Redirect::to(URL::to('/user/' . $comment->get_profile()->username . '#comment' . $comment->id ));
		}elseif($comment->type() == 'file'){
			return Redirect::to(URL::to('/'.$comment->get_media()->slug . '-t' . $comment->get_media()->id . '.html#comment' . $comment->id));
		}
	}
});

//PROFILE FRIENDS

Route::get('/user/{username}/friends/', function($username)
{
	$user = User::where('username','=', $username)->first();
	if(isset($user->id)){
		return View::make('user.friends', array('user' => $user));
	}
	return View::make('general.404');
});

//CREATE COMMENT

Route::post('/comments/create/user/', 'CommentsController@makeCC');	
Route::post('/comments/create/post/', 'CommentsController@makeCC');	
		
Route::group(array('before' => 'auth'), function()
{

		// LOGOUT

		Route::post('/auth/logout', function(){
			Auth::logout();
			return Redirect::to(URL::previous());
		});


		// TAG CLOUD HIDE

		Route::post('/account/toggletagcloud/hide/', function(){
			if(rate_limit(5)){
				return Response::json(array('html' => 'using this function has it\'s limits, please try again later', 'method'=> 'error'));
			}
			
			if(!Auth::guest()){
				if(Auth::user()->show_tc == 1){
					Auth::user()->show_tc = 0;
					Auth::user()->save();
				}
			}
		});

		// TAG CLOUD SHOW

		Route::post('/account/toggletagcloud/show/', function(){
			if(rate_limit(5)){
				return Response::json(array('html' => 'using this function has it\'s limits, please try again later', 'method'=> 'error'));
			}
			
			if(!Auth::guest()){
				if(Auth::user()->show_tc == 0){
					Auth::user()->show_tc = 1;
					Auth::user()->save();
					$html = View::make('widgets.tagcloud')->render();
					return Response::json(array('html' => $html, 'method'=> 'show'));
				}
			}
		});				
		
		// TAG CLOUD SHOW

		Route::post('/account/hidesidebar/', function(){
			if(rate_limit(5)){
				return Response::json(array('html' => 'using this function has it\'s limits, please try again later', 'method'=> 'error'));
			}
			
			if(!Auth::guest()){
				if(Input::has('hide')){
					$hide = Input::get('hide');
					if(Auth::user()->show_sb){
						Auth::user()->show_sb = false;
						Auth::user()->save();
					}else{
						Auth::user()->show_sb = true;
						Auth::user()->save();
					}
					return Response::json(array('html' => '', 'method'=> 'ok', 'url' => URL::to('/')));
				}
				return Response::json(array('html' => 'input error', 'method'=> 'error'));
			}
		});		
		

		// UPLOAD

		Route::get('/upload', function(){
			if(!Auth::guest()){
				return View::make('general.upload');
			}
			return Redirect::to('/auth/login/?return_uri=/upload');
		});
		
		// UPLOAD PREVIEW

		Route::post('/preview', function(){
			if(rate_limit(10)){
				return Response::json(array('html' => 'using this function has it\'s limits, please try again later', 'method'=> 'error'));
			}
			
			if(!Auth::guest()){
				if(Input::has('data')){
					$desc = Input::get('data');
					return get_desc($desc);
				}
			}
		});

		// UPLOAD CATEGORY

		Route::get('/upload/{category}', function($category){
			if(!Auth::guest()){
				return View::make('general.upload_cat');
			}
		});
		
		// UPLOAD CATEGORY HTML POST

		Route::post('/upload/details', 'MediaController@create');		
		
		// UPLOAD EDIT POST

		Route::post('/file/edit/{id}', 'MediaController@editPost');

		// UPLOAD CATEGORY POST

		Route::post('/upload/{category}', function($category){
			if(Input::has('dl_links') || Input::has('sm_links')){
				$dl_links = Input::get('dl_links');				
				$sm_links = Input::get('sm_links');
				$flag = 0;
				$count = 0;
				if (is_array($dl_links))
				{
					foreach($dl_links as $keys)
					{
						$count++;
						if(empty($keys)) {
							$flag++;
						}
					}
				}
				if (is_array($sm_links))
				{
					foreach($sm_links as $keys)
					{
						$count++;
						if(empty($keys)) {
							$flag++;
						}
					}
				}
				if($flag == 0 && $count != 0 && $count < 10)
				{
					$code = substr(md5(uniqid(mt_rand(), true)) , 0, 8) . Auth::user()->id;
					if (is_array($dl_links))
					{
						foreach($dl_links as $link){
							$newlink = new Links;
							$newlink->user_id = Auth::user()->id;
							$newlink->link = $link;					
							$newlink->code = $code;
							$newlink->save();
						}	
					}
					
					if (is_array($sm_links))
					{
						foreach($sm_links as $link){
							$newlink = new Links;
							$newlink->user_id = Auth::user()->id;						
							$newlink->dl = false;
							$newlink->link = $link;					
							$newlink->code = $code;
							$newlink->save();
						}
					}
				}else{
					return Redirect::to('/upload/' . $category . '/')->with(array('note' => 'Empty links or No links found', 'note_type' => 'error'));
				}
			}else{
				return Redirect::to('/upload/' . $category . '/')->with(array('note' => 'input error', 'note_type' => 'error'));
			}
			$cat = Category::where('url','=', $category)->first();
			if(isset($cat->id)){
				$main_id = 0;
				$sub_id = 0;
				
				if(!$cat->is_sub){
					$main_id = $cat->id;
				}else{
					$main = Category::where('id','=', $cat->cat_id)->first();
					$main_id = $main->id;
					$sub_id = $cat->id;
				}

				$main_cats = Category::where('is_sub', '=', 0)->get();
				$sub_cats = Category::where('cat_id', '=' , $main_id)->where('is_sub', '=', 1)->get();
				
				return View::make('general.upload.detail', array('code' => $code, 'main_id' => $main_id, 'sub_id' => $sub_id, 'main_cats' => $main_cats, 'sub_cats' => $sub_cats));
			}
			
			$main_cats = Category::where('is_sub', '=', 0)->get();
			
			$sub_cats = array();
			$main_id = 21;
			$sub_id = 0;
			
			return View::make('general.upload.detail', array('code' => $code, 'main_id' => $main_id, 'sub_id' => $sub_id, 'main_cats' => $main_cats, 'sub_cats' => $sub_cats));
		});	

		// EDIT POST

		Route::get('/file/edit/{id}/', function($id){
			$media = Media::where('id','=', $id)->first();
			if(isset($media->id)){
				$main_id = $media->cat_id;
				$sub_id = $media->sub_id;
				
				$main_cats = Category::where('is_sub', '=', 0)->get();
				$sub_cats = Category::where('cat_id', '=' , $main_id)->where('is_sub', '=', 1)->get();
				
				return View::make('general.upload.edit', array('main_id' => $main_id, 'sub_id' => $sub_id, 'main_cats' => $main_cats, 'sub_cats' => $sub_cats, 'media' => $media));
			}
			return View::make('general.404');
		});		
		
		// UPLOAD MEDIA SEARCH TV

		Route::get('/media/searchtvshow/', function(){
					if(rate_limit(20)){
						return Response::json(array('html' => 'using this function has it\'s limits, please try again later', 'method'=> 'error'));
					}
					$request = curl_init();
					curl_setopt($request, CURLOPT_ENCODING, "gzip");
					curl_setopt($request, CURLOPT_HEADER, 0);
					curl_setopt($request, CURLOPT_RETURNTRANSFER, 1);
					curl_setopt($request, CURLOPT_URL, 'http://www.tvrage.com/search.php?search='.urlencode(Input::get('term')).'&searchin=2&button=Go');
					curl_setopt($request, CURLOPT_FOLLOWLOCATION, 1);
					$data = curl_exec($request);
					curl_close($request);
								
					$doc = new DOMDocument();
					libxml_use_internal_errors(true);
					$doc->loadHTML($data);
					libxml_use_internal_errors(false);
					
					$xpath = new DOMXPath($doc);
					$results = $xpath->query('//*[@id="show_search"]');

					$shows = array();
					
					foreach($results as $r){
					
						$name = $r->getElementsByTagName('dl')->item(0)->getElementsByTagName('dt')->item(0)->getElementsByTagName('h2')->item(0)->nodeValue; 
						$href = $r->getElementsByTagName('dl')->item(0)->getElementsByTagName('dt')->item(0)->getElementsByTagName('h2')->item(0)->getElementsByTagName('a')->item(0)->getAttribute('href'); 
						$tvrage_id = str_replace('/shows/id-','',$href);
						$tvrage_id = (int)$tvrage_id;
						
						if($tvrage_id == 0){
							$get_id_element = $xpath->query('.//*[@class="img"]', $r);
							$get_id =  $get_id_element->item(0)->getElementsByTagName('img')->item(0)->getAttribute('src');
							
							$parts = explode('/', $get_id);
							$last = end($parts);
							$rel6 = '{(?<=-).*(?=\.jpg)}';
							
							preg_match($rel6,$last, $matches_id);

							$tvrage_id = $matches_id[0];
						}
						
						$tvshow_exists = TvShows::where('tvrage_id','=',$tvrage_id)->first();
						
						if(isset($tvshow_exists->id)){
						
							$image = URL::TO('/images/nocover.png');
							
							if($tvshow_exists->image){
								$image = URL::TO('/uploads/tv/'. $tvshow_exists->tvrage_id .'/' . $tvshow_exists->tvrage_id . '.jpg');
							}
							
							$a = array('id'=> $tvrage_id ,'label' => $tvshow_exists->name , 'value' => $tvshow_exists->name , 'cover' => $image);
							$shows[] = $a;
						
						}else{
						
							$newTv = new TvShows;
							$newTv->tvrage_id = $tvrage_id;
							$newTv->image = false;
							
							$image = URL::TO('/images/nocover.png');
							
							$get_image = $xpath->query('.//*[@class="img"]', $r);
							
							if ($get_image->length > 0) {
								if (strpos($doc->saveHTML( $get_image->item(0)),'src=') !== false) {
									$image =  $get_image->item(0)->getElementsByTagName('img')->item(0)->getAttribute('src');

									$parts = explode('/', $image);
									$last = end($parts);
									$image = str_replace($last,'',$image);

									try {
										$file = file_get_contents($image . $tvrage_id . '.jpg');
									}catch(Exception $e) {
										try {
											$file = file_get_contents($image . $tvrage_id . '.png');
										}catch(Exception $e) {
											$file = file_get_contents($image . $tvrage_id . '.gif');
										}
									}
									
									$extension = '.jpg';
									$upload_folder = '/var/www/datas/laravel/public/uploads/tv/';
									
									if (!file_exists($upload_folder . $tvrage_id .'/')) {
										mkdir($upload_folder . $tvrage_id .'/', 0775, true);
									}
									
									$filename = $tvrage_id . $extension;
									
									if(file_exists ($upload_folder. $tvrage_id .'/'.$filename)){
										unlink($upload_folder. $tvrage_id .'/'.$filename);
									}
								
									file_put_contents($upload_folder. $tvrage_id .'/'.$filename, $file);
									$image = URL::TO('/uploads/tv/'. $tvrage_id .'/' . $filename);
									$newTv->image = true;
								}
							}
							
							$newTv->name = $name;
							$newTv->save();
							
							$a = array('id'=> $tvrage_id ,'label' => $name , 'value' => $name , 'cover' => $image);
							$shows[] = $a;
						}
						unset($a);
						unset($image);unset($tvrage_id);unset($name);unset($parts);unset($get_image); unset($r); 
					}
					return $shows;
		});		
		
		
		//Feedback

		Route::get('/feedback', function()
		{
			Paginator::setCurrentUrl('feedback');
			$feedback = Feedback::where('user_id', Auth::user()->id)->paginate(10);
			$uma = array();
			foreach($feedback as $fb){
				array_push($uma, $fb->media_id);
			}
			if(count($uma) == 0){
				return View::make('general.feedback', array('empty' => true));
			}
			
			$media =  Media::whereIn('id', $uma)->get();
			return View::make('general.feedback', array('mediafb' => $media));
		});			
		
		//DISCARD Feedback

		Route::post('/account/discardfeedbacks/', function()
		{
			if($this->rate_limit(5)){
				return Response::json(array('html' => 'using this function has it\'s limits, please try again later', 'method'=> 'error'));
			}
		
			$feedback = Feedback::where('user_id', Auth::user()->id)->delete();
		});		
		
		//Feedback

		Route::get('/feedback/{page}', function($page)
		{
			Paginator::setCurrentPage($page);
			Paginator::setCurrentUrl('feedback/'.$page);
			$feedback = Feedback::where('user_id', Auth::user()->id)->paginate(10);
			$uma = array();
			foreach($feedback as $fb){
				array_push($uma, $fb->media_id);
			}
			$media =  Media::whereIn('id', $uma)->get();
			return View::make('general.feedback', array('mediafb' => $media));
		});
	
		// UPLOAD MEDIA SEARCH GAMES

		Route::get('/media/searchgame/', function(){
			if(rate_limit(20)){
				return Response::json(array('html' => 'using this function has it\'s limits, please try again later', 'method'=> 'error'));
			}
			
			//return Input::all();
			include('/var/www/datas/laravel/vendor/giantbomb/GiantBomb.php');
			return GiantBombs::search(Input::get('term'));
		});			
		
		// UPLOAD MEDIA SEARCH MOVIES

		Route::get('/media/searchmovie/', function(){
			if(rate_limit(20)){
				return Response::json(array('html' => 'using this function has it\'s limits, please try again later', 'method'=> 'error'));
			}
			
			//return Input::all();
			include('/var/www/datas/laravel/vendor/omdbapi/OmdbApi.php');
			return OmdbApis::search(Input::get('term'));
		});				
		
		// UPLOAD MEDIA SEARCH ARTISTS

		Route::get('/media/searchartist/', function(){
			if(rate_limit(20)){
				return Response::json(array('html' => 'using this function has it\'s limits, please try again later', 'method'=> 'error'));
			}
			
			//return Input::all();
			include('/var/www/datas/laravel/vendor/lastfmapi/LastfmApi.php');
			return LastfmApis::search(Input::get('term'));
		});		
		
		// UPLOAD CATEGORY HTML POST

		Route::post('/torrents/getcategory/{id}/', function($id){
			if(rate_limit(10)){
				return Response::json(array('html' => 'using this function has it\'s limits, please try again later', 'method'=> 'error'));
			}
			
			//return Input::all();
			$cats = Category::where('cat_id', '=' , $id)->where('is_sub', '=', 1)->get();
			if(count($cats) == 0){
				return Response::json(array('html' => '', 'method'=> 'show'));
			}
			$html = View::make('general.upload.sub', array('cats' => $cats))->render();
			return Response::json(array('html' => $html, 'method'=> 'show'));
		});		
		


		// USER SETTINGS

		Route::get('/settings', function(){
			if(rate_limit(10)){
				return Response::json(array('html' => 'using this function has it\'s limits, please try again later', 'method'=> 'error'));
			}
			
			if(!Auth::guest()){
				if (Request::ajax()){
					$html = View::make('ajax.settings')->render();
					return Response::json(array('html' => $html, 'method'=> 'show'));
				}
				return View::make('user.settings');
			}
		});

		Route::post('/settings/general', function(){
			if(!Auth::guest()){

			}
		});


		// USER UPDATE STATUS

		Route::post('/account/updatestatus', function()
		{
			if(rate_limit(5)){
				return Response::json(array('html' => 'using this function has it\'s limits, please try again later', 'method'=> 'error'));
			}
			
			$status = Input::get('message');
			Auth::user()->status = $status;
			Auth::user()->status_updated_at = date('Y-m-d H:i:s');
			Auth::user()->save();
			
			return Response::json(array('html' => $status, 'method'=> 'show'));
		});
		
		// CHANGE USER PROFILE PICTURE

		Route::post('/account/setuserpic/', function(){
			if(rate_limit(5)){
				return Response::json(array('html' => 'using this function has it\'s limits, please try again later', 'method'=> 'error'));
			}
			
			if(!Auth::guest()){
				if(Input::has('image_id')){
					$image_id = Input::get('image_id');
					$pic = UserPic::where('id','=',$image_id)->where('user_id','=', Auth::user()->id)->first();
					if(isset($pic->id)){
						Auth::user()->avatar = $image_id;
						Auth::user()->save();
						$path = '/var/www/datas/laravel/public/uploads/user/'. $pic->user_id . '/thumb/'.  $pic->id .'.png';
						$data = file_get_contents($path);
						$thumb_link = 'data:image/png;base64,' . base64_encode($data);	
						return Response::json(array('html' => $thumb_link, 'method'=> 'show'));
					}
					return Response::json(array('html' => 'access denied', 'method'=> 'error'));
				}
				return Response::json(array('html' => 'input cannot be empty', 'method'=> 'error'));
			}
			return Response::json(array('html' => 'must be logged in', 'method'=> 'error'));
		});		
		
		// DELETE USER PROFILE PICTURE

		Route::post('/account/deluserpic/', function(){
			if(rate_limit(5)){
				return Response::json(array('html' => 'using this function has it\'s limits, please try again later', 'method'=> 'error'));
			}
			
			if(!Auth::guest()){
				Auth::user()->avatar = '';
				Auth::user()->save();
				return Response::json(array('html' => 1, 'method'=> 'show'));
			}
			return Response::json(array('html' => 'must be logged in', 'method'=> 'error'));
		});

		// USER FRIENDS REQUESTS

		Route::match(array('GET', 'POST') , '/friend/request/{username}', 'UserController@friendRequestUC');
		Route::get('/friend/cancel/{username}', 'UserController@getFrienCancelUC');	
		Route::post('/friend/cancel/{username}', 'UserController@postFrienCancelUC');	
		Route::match(array('GET', 'POST') , '/friend/approve/{username}', 'UserController@freindAcceptUC');
				
		Route::get('/account/report/{hash}', function($hash)
		{
			if(rate_limit(5)){
				return Response::json(array('html' => 'using this function has it\'s limits, please try again later', 'method'=> 'error'));
			}
			$user = User::where('hash', $hash)->first();
			
			if(isset($user->id)){
				$has_report = Reports::where('type', 'user')->where('user_id', $user->id)->first();
				if(isset($has_report->id)){
					return Response::json(array('html' => 'already reported', 'method'=> 'error'));
				}else{
					$data = array('user' => $user);
					$html = View::make('user.report', $data)->render();
					return Response::json(array('html' => $html, 'method'=> 'show'));
				}
			}
			return Response::json(array('html' => 'user not found', 'method'=> 'error'));
		});			
		
		Route::post('/account/report/{hash}', function($hash)
		{
			if(rate_limit(5)){
				return Response::json(array('html' => 'using this function has it\'s limits, please try again later', 'method'=> 'error'));
			}
			$user = User::where('hash', $hash)->first();
			
			if(isset($user->id)){
				$has_report = Reports::where('type', 'user')->where('user_id', $user->id)->first();
				if(isset($has_report->id)){
					return Response::json(array('html' => 'already reported', 'method'=> 'error'));
				}else{
					$reason = Input::get('reason');
					if($reason != ''){
						$flag = new Reports;
						$flag->user_flagged_id = Auth::user()->id;
						$flag->user_id = $user->id;				
						$flag->object_id = $user->object_id;
						$flag->type = 'user';
						$flag->res = $reason;
						$flag->save();
						return Redirect::to( URL::previous());
					}else{
						return Response::json(array('html' => 'reason cannot be empty', 'method'=> 'error'));
					}
				}
			}
			return Response::json(array('html' => 'user not found', 'method'=> 'error'));
		});		
				
		// **********	COMMENTS ROUTES || WITH RATE LIMITED **********//	
	
		Route::post('/comments/index/file/{id}/', 'CommentsController@indexCC');
		Route::post('/comments/index/user/{id}/', 'CommentsController@indexUserCC');		
		Route::get('/comments/edit/{objectid}/', 'CommentsController@getEditCC');
		Route::post('/comments/edit/{objectid}/', 'CommentsController@postEditCC');
		Route::post('/comments/delete/', 'CommentsController@deleteCC');		
		Route::post('/comments/rate/like/{id}/', 'CommentsController@likeCC');	
		Route::post('/comments/rate/dislike/{id}/', 'CommentsController@dislikeCC');			
		Route::post('/comments/report/{id}/', 'CommentsController@reportCC');	
		
		
		
		Route::post('/image/select/recent/', function()
		{
			$html = View::make('general.recent_images')->render();
			return Response::json(array('html' => $html, 'method'=> 'show'));
		});	
		
		Route::get('/image/select/recent/', function()
		{
			$html = View::make('general.recent_images')->render();
			return Response::json(array('html' => $html, 'method'=> 'show'));
		});	
		
		// **********	IMAGE ROUTES || WITH RATE LIMITED **********//	
		
		Route::post('/image/upload/', 'MediaController@storeImage');		
		Route::post('/image/delete/{id}', 'MediaController@deleteImage');

		// **********	POST ROUTES || WITH RATE LIMITED **********//	
		
		Route::post('/posts/vote/like/{id}/', 'MediaController@likeMC');	
		Route::post('/posts/vote/unlike/{id}/', 'MediaController@unlikeMC');	
		Route::post('/posts/vote/dislike/{id}/', 'MediaController@dislikeMC');
		Route::post('/posts/vote/undislike/{id}/', 'MediaController@undislikeMC');
		Route::post('/posts/report/{id}/', 'MediaController@add_flag');
		
		Route::post('/links/vote/like/{id}', function($id)
		{
			if(rate_limit(5)){
				return Response::json(array('html' => 'using this function has it\'s limits, please try again later', 'method'=> 'error'));
			}
			
			$link = Links::find($id);
			if(isset($link->id)){
				$link_vote = LinkVote::where('user_id', '=', Auth::user()->id)->where('link_id', '=', $id)->first();

				if(isset($link_vote->id)){ 
						return Response::json(array('html' => 'already voted', 'method'=> 'error'));
				} else { 

					$link = new LinkVote;
					$link->user_id = Auth::user()->id;
					$link->link_id = $id;
					$link->up = 1;
					$link->save();
				}
			}
			$upVotes = DB::table('links_votes')->where('link_id', '=', $id)->sum('up');
			$downVotes = DB::table('links_votes')->where('link_id', '=', $id)->sum('down');
			return Response::json(array('method'=> 'ok', 'dislike_count' => $downVotes, 'like_count' => $upVotes));
		});			
		
		Route::post('/links/vote/dislike/{id}', function($id)
		{
			if(rate_limit(5)){
				return Response::json(array('html' => 'using this function has it\'s limits, please try again later', 'method'=> 'error'));
			}
			
			$link = Links::find($id);
			if(isset($link->id)){
				$link_vote = LinkVote::where('user_id', '=', Auth::user()->id)->where('link_id', '=', $id)->first();

				if(isset($link_vote->id)){ 
						return Response::json(array('html' => 'already voted', 'method'=> 'error'));
				} else { 

					$link = new LinkVote;
					$link->user_id = Auth::user()->id;
					$link->link_id = $id;
					$link->down = 1;
					$link->save();
				}
			}
			$upVotes = DB::table('links_votes')->where('link_id', '=', $id)->sum('up');
			$downVotes = DB::table('links_votes')->where('link_id', '=', $id)->sum('down');
			return Response::json(array('method'=> 'ok', 'dislike_count' => $downVotes, 'like_count' => $upVotes));
		});	
		
		Route::get('/posts/report/{id}/', function($id)
		{			
			$html = View::make('posts.report', array('id' => $id))->render();
			return Response::json(array('html' => $html, 'method'=> 'show'));
		});	
		

		//LINKS RE-UPLOAD

		Route::post('/links/requestreupload/{id}', function($id)
		{
			if(rate_limit(5)){
				return Response::json(array('html' => 'using this function has it\'s limits, please try again later', 'method'=> 'error'));
			}
			
			$has_request = Reupload::where('link_id',$id)->where('checked',1)->first();
			if(!isset($has_request->id)){
				$link = Links::where('id',$id)->where('checked',1)->first();
				if(isset($link->id)){
					$request = new Reupload;
					$request->link_id = $id;
					$request->user_id = Auth::user()->id;
					$request->owner_id = $link->user_id;
					$request->save();
				}
			}
		});		
		
		Route::get('/messenger/create/', function()
		{
			return View::make('user.messenger.new');
		});			
		
		Route::get('/account/search/', function()
		{
			return Response::json('');
		});		
		
		Route::get('/messenger/', function()
		{
			if(Auth::user()->totalConvo() == 0){
					return Redirect::to('/messenger/create/');
			}
			$convos = Conversation::where('sender_id', Auth::user()->id)->where('sender_deleted', 0)->Orwhere('recipient_id', Auth::user()->id)->where('rep_deleted', 0)->orderBy('updated_at','desc')->get();

			return View::make('user.messenger.dialogs', array('convos' => $convos));
		});		
		
		Route::get('/messenger/create/{username}/', function($username)
		{
			$user_exists = User::where('username', $username)->first();
			if(isset($user_exists->id)){
				$has_convo = Conversation::where('sender_id', Auth::user()->id)->where('recipient_id', $user_exists->id)->where('sender_deleted',0)->Orwhere('sender_id',$user_exists->id)->where('recipient_id', Auth::user()->id)->where('rep_deleted',0)->first();
				if(isset($has_convo->id)){
					if (Request::ajax()){
						return Response::json(array('url' => URL::to('/messenger/dialog/'.$username), 'method'=> 'ok'));
					}
					return Redirect::to('/messenger/dialog/'.$username);
				}
				
				if (Request::ajax()){
					$html = View::make('user.messenger.createAJAX',array('user' => $user_exists))->render();
					return Response::json(array('html' => $html, 'method'=> 'show'));
				} 
				
				return View::make('user.messenger.new',array('user' => $user_exists));
				
			}

		});			
		
		Route::get('/messenger/forward/{id}/', function($id)
		{
			$msg_exists = Messages::where('id', $id)->where('sender_deleted',0)->where('rep_deleted',0)->first();
			if(isset($msg_exists->id)){
				if($msg_exists->user_id != Auth::user()->id && $msg_exists->rep_id != Auth::user()->id){
					if (Request::ajax()){
						return Response::json(array('html' => 'Access Denied', 'method'=> 'error'));
					}
					return Redirect::to('/messenger/forward/'. $id)->with(array('note' => 'Access Denied', 'note_type' => 'error'));
				}
				
				if (Request::ajax()){
					$html = View::make('user.messenger.forwardAJAX',array('message' => $msg_exists))->render();
					return Response::json(array('html' => $html, 'method'=> 'show'));
				} 
				return View::make('user.messenger.forward',array('message' => $msg_exists));
			}
		});			
		
		Route::get('/messenger/search/', function()
		{
			if(rate_limit(10)){
				if (Request::ajax()){
					return Response::json(array('html' => 'using this function has it\'s limits, please try again later', 'method'=> 'error'));
				}
				
				return Redirect::to('/messenger/create/')->with(array('note' => 'using this function has it\'s limits, please try again later', 'note_type' => 'error'));
			}
			
			if(Input::has('s')){
				$query = Input::get('s');
				
				if(strlen($query) > 3){
					return Redirect::to('/messenger/search/?s='.$query)->with(array('note' => 'Not enough characters to search', 'note_type' => 'error'));
				}
				
				$search = Messages::where('user_id', Auth::user()->id)->where('sender_deleted', 0)->where('message','LIKE', '%'. $query .'%')->Orwhere('rep_id', Auth::user()->id)->where('rep_deleted', 0)->where('message','LIKE', '%'. $query .'%')->orderBy('created_at','desc')->paginate(10);

				return View::make('user.messenger.search',array('messages' => $search, 'query' => $query));
			}
		});			
		
		Route::post('/messenger/deletemessages/', function()
		{
			if(rate_limit(10)){
				if (Request::ajax()){
					return Response::json(array('html' => 'using this function has it\'s limits, please try again later', 'method'=> 'error'));
				}
				
				return Redirect::to('/messenger/create/')->with(array('note' => 'using this function has it\'s limits, please try again later', 'note_type' => 'error'));
			}
			
			if(Input::has('message_ids')){
				$message_ids = Input::get('message_ids'); 
				if(count($message_ids) != 0 && count($message_ids) < 11){
					foreach($message_ids as $mid){
						$message = Messages::where('id',$mid)->first();
						if(isset($message->id)){
							$convo = Conversation::find($message->convo_id);
							if($message->user_id == Auth::user()->id){
								$message->sender_deleted = 1;
								$message->save();
							}elseif($message->rep_id == Auth::user()->id){
								$message->rep_deleted = 1;
								$message->save();
							}
							if($convo->getTotal() == 0){
								if($convo->sender_id == Auth::user()->id){
									$convo->sender_deleted = 1;
									$convo->save();
								}elseif($convo->recipient_id == Auth::user()->id){
									$convo->rep_deleted = 1;
									$convo->save();
								}
							}
						}
					}
				}
			}
			return Response::json(array('html' => '', 'method'=> 'ok', 'url' => URL::previous()));
		});			
		
		Route::post('/messenger/deletedialogs/', function()
		{
			if(rate_limit(10)){
				if (Request::ajax()){
					return Response::json(array('html' => 'using this function has it\'s limits, please try again later', 'method'=> 'error'));
				}
				
				return Redirect::to('/messenger/create/')->with(array('note' => 'using this function has it\'s limits, please try again later', 'note_type' => 'error'));
			}
			
			if(Input::has('target_ids')){
				$message_ids = Input::get('target_ids'); 
				if(count($message_ids) != 0 && count($message_ids) < 11){
					foreach($message_ids as $mid){
						$convo = Conversation::find($mid);
						if(isset($convo->id)){
							if($convo->sender_id == Auth::user()->id || $convo->recipient_id == Auth::user()->id){
								if($convo->getTotal() != 0){
									$convo_msg = Messages::where('convo_id', $mid)->get();
									foreach($convo_msg as $msg){
										if($msg->user_id == Auth::user()->id){
											$msg->sender_deleted = 1;
											$msg->save();
										}elseif($msg->rep_id == Auth::user()->id){
											$msg->rep_deleted = 1;
											$msg->save();
										}
									}
								}
								
								if($convo->sender_id == Auth::user()->id){
									$convo->sender_deleted = 1;
									$convo->save();
								}elseif($convo->recipient_id == Auth::user()->id){
									$convo->rep_deleted = 1;
									$convo->save();
								}
							}
						}
					}
				}
			}
			return Response::json(array('html' => '', 'method'=> 'ok', 'url' => URL::previous()));
		});			
		
		Route::post('/messenger/deletedialogs/{id}', function($id)
		{
			if(rate_limit(10)){
				if (Request::ajax()){
					return Response::json(array('html' => 'using this function has it\'s limits, please try again later', 'method'=> 'error'));
				}
				
				return Redirect::to('/messenger/create/')->with(array('note' => 'using this function has it\'s limits, please try again later', 'note_type' => 'error'));
			}
			
			$user_exists = User::where('username', $id)->first();
			if(isset($user_exists->id)){
				$convo = Conversation::where('sender_id', Auth::user()->id)->where('recipient_id', $user_exists->id)->Orwhere('sender_id',$user_exists->id)->where('recipient_id', Auth::user()->id)->first();

				if(isset($convo->id)){
					if($convo->sender_id == Auth::user()->id || $convo->recipient_id == Auth::user()->id){
						if($convo->getTotal() != 0){
							$convo_msg = Messages::where('convo_id', $convo->id)->get();
							foreach($convo_msg as $msg){
								if($msg->user_id == Auth::user()->id){
									$msg->sender_deleted = 1;
									$msg->save();
								}elseif($msg->rep_id == Auth::user()->id){
									$msg->rep_deleted = 1;
									$msg->save();
								}
							}
						}
						
						if($convo->sender_id == Auth::user()->id){
							$convo->sender_deleted = 1;
							$convo->save();
						}elseif($convo->recipient_id == Auth::user()->id){
							$convo->rep_deleted = 1;
							$convo->save();
						}
					}
				}
			}
			return Response::json(array('html' => '', 'method'=> 'ok', 'url' => URL::previous()));
		});			
		
		Route::post('/messenger/markdialogs/', function()
		{
			if(rate_limit(10)){
				if (Request::ajax()){
					return Response::json(array('html' => 'using this function has it\'s limits, please try again later', 'method'=> 'error'));
				}
				
				return Redirect::to('/messenger/create/')->with(array('note' => 'using this function has it\'s limits, please try again later', 'note_type' => 'error'));
			}
			
			if(Input::has('target_ids')){
				$message_ids = Input::get('target_ids'); 
				if(count($message_ids) != 0 && count($message_ids) < 11){
					foreach($message_ids as $mid){
						$convo = Conversation::find($mid);
						if(isset($convo->id)){
							if($convo->sender_id == Auth::user()->id || $convo->recipient_id == Auth::user()->id){
								
								if($convo->sender_id == Auth::user()->id && $convo->sender_new == 1){
									$convo->sender_new = 0;
									$convo->save();
								}elseif($convo->recipient_id == Auth::user()->id && $convo->rep_new == 1){
									$convo->rep_new = 0;
									$convo->save();
								}
							}
						}
					}
				}
			}
			return Response::json(array('html' => '', 'method'=> 'ok', 'url' => URL::previous()));
		});			
		
		Route::post('/messenger/deletemessages/{id}/', function($id)
		{
			if(rate_limit(10)){
				if (Request::ajax()){
					return Response::json(array('html' => 'using this function has it\'s limits, please try again later', 'method'=> 'error'));
				}
				
				return Redirect::to('/messenger/create/')->with(array('note' => 'using this function has it\'s limits, please try again later', 'note_type' => 'error'));
			}
			
			$message = Messages::where('id',$id)->first();
			if(isset($message->id)){
				$convo = Conversation::find($message->convo_id);
				if($message->user_id == Auth::user()->id){
					$message->sender_deleted = 1;
					$message->save();
				}elseif($message->rep_id == Auth::user()->id){
						$message->rep_deleted = 1;
						$message->save();
				}
				
				if($convo->getTotal() == 0){
					if($convo->sender_id == Auth::user()->id){
						$convo->sender_deleted = 1;
						$convo->save();
					}elseif($convo->recipient_id == Auth::user()->id){
						$convo->rep_deleted = 1;
						$convo->save();
					}
				}
			}

			return Response::json(array('html' => '', 'method'=> 'ok', 'url' => URL::previous()));
		});	
		
		//CREATE NEW MESSAGE

		Route::post('/messenger/create/', function()
		{
			if(rate_limit(10)){
				if (Request::ajax()){
					return Response::json(array('html' => 'using this function has it\'s limits, please try again later', 'method'=> 'error'));
				}
				
				return Redirect::to('/messenger/create/')->with(array('note' => 'using this function has it\'s limits, please try again later', 'note_type' => 'error'));
			}
			
			if(!Input::has('targets')){
				if (Request::ajax()){
					return Response::json(array('html' => 'Recipient\'s cannot be empty', 'method'=> 'error'));
				}
				
				return Redirect::to('/messenger/create/')->with(array('note' => 'Recipient\'s cannot be empty', 'note_type' => 'error'));
			}			
			
			if(!Input::has('text') || Input::get('text') == ''){
				if (Request::ajax()){
					return Response::json(array('html' => 'Message cannot be empty', 'method'=> 'error'));
				}
				
				return Redirect::to(URL::previous())->with(array('note' => 'Message cannot be empty', 'note_type' => 'error'));
			}
			
			$targets = Input::get('targets');
			$message = Input::get('text');
			$counter = 0;
			$last_target = '';
			foreach($targets as $target){
				if($target != '' && $target != Auth::user()->username){
					$user_exists = User::where('username', $target)->first();
					if(isset($user_exists->id)){
						$has_convo = Conversation::where('sender_id', Auth::user()->id)->where('recipient_id', $user_exists->id)->Orwhere('sender_id',$user_exists->id)->where('recipient_id', Auth::user()->id)->first();

						if(!isset($has_convo->id)){
							$new_convo = new Conversation;
							$new_convo->sender_id = Auth::user()->id;
							$new_convo->rep_new = 1;
							$new_convo->recipient_id = $user_exists->id;
							$new_convo->save();
							$convo_id = $new_convo->id;
						}else{
							$convo_id = $has_convo->id;
							if($has_convo->sender_id == Auth::user()->id){
								$has_convo->rep_new = 1;
							}elseif($has_convo->recipient_id == Auth::user()->id){
								$has_convo->sender_new = 1;
							}
							$has_convo->updated_at = date("Y-m-d H:i:s");
							$has_convo->sender_deleted = 0;
							$has_convo->rep_deleted = 0;
							$has_convo->save();
							
						}
						
						$new_message = new Messages;
						$new_message->convo_id = $convo_id;
						$new_message->user_id = Auth::user()->id;
						$new_message->rep_id = $user_exists->id;
						$new_message->message = $message;
						$new_message->save();
						
						$last_target = $user_exists->username;
						$counter++;
					}
				}
			}
			if($counter == 1){
			
					if (Request::ajax()){
						return Response::json(array('html' => '', 'method'=> 'ok'));
					}
				return Redirect::to('/messenger/dialog/'. $last_target .'/');
			}
			
					if (Request::ajax()){
						return Response::json(array('html' => '', 'method'=> 'ok'));
					}
					
			return Redirect::to('/messenger/');
			
		});		
		
		//VIEW MESSAGES

		Route::get('/messenger/dialog/{username}/', function($username)
		{
			$user_exists = User::where('username', $username)->first();
			if(!isset($user_exists->id)){
				return View::make('general.404');
			}
			
			$has_convo = Conversation::where('sender_id', Auth::user()->id)->where('recipient_id', $user_exists->id)->where('sender_deleted', 0)->Orwhere('sender_id',$user_exists->id)->where('recipient_id', Auth::user()->id)->where('rep_deleted', 0)->first();
			
			if(isset($has_convo->id)){
				if($has_convo->sender_id == Auth::user()->id && $has_convo->sender_new == 1){
					$has_convo->sender_new = 0;
					$has_convo->save();
				}elseif($has_convo->recipient_id == Auth::user()->id && $has_convo->rep_new == 1){
					$has_convo->rep_new = 0;
					$has_convo->save();
				}
				
				Paginator::setCurrentUrl('messenger/dialog/'.$username);
				$messages = Messages::where('convo_id',$has_convo->id)->orderBy('created_at','desc')->paginate(10);
				
				return View::make('user.messenger.view', array('messages' => $messages, 'user' => $user_exists));
			}
			return View::make('user.messenger.view',array('user' => $user_exists));
			
		});		
		
		Route::get('/messenger/dialog/{username}/{page}', function($username,$page)
		{
			$user_exists = User::where('username', $username)->first();
			if(!isset($user_exists->id)){
				return View::make('general.404');
			}
			
			$has_convo = Conversation::where('sender_id', Auth::user()->id)->where('recipient_id', $user_exists->id)->where('sender_deleted', 0)->Orwhere('sender_id',$user_exists->id)->where('recipient_id', Auth::user()->id)->where('rep_deleted', 0)->first();
			
			if(isset($has_convo->id)){
				if($has_convo->sender_id != Auth::user()->id && $has_convo->rep_new == 1){
					$has_convo->rep_new = 0;
					$has_convo->save();
				}elseif($has_convo->rep_id != Auth::user()->id && $has_convo->sender_new == 1){
					$has_convo->sender_new = 0;
					$has_convo->save();
				}
				
				Paginator::setCurrentPage($page);
				Paginator::setCurrentUrl('messenger/dialog/'.$username);
				$messages = Messages::where('convo_id',$has_convo->id)->orderBy('created_at','desc')->paginate(10);
				return View::make('user.messenger.view', array('messages' => $messages, 'user' => $user_exists));
			}
			return View::make('user.messenger.view',array('user' => $user_exists));
			
		});
});

Route::group(array('before' => 'modr'), function()
{
		// MODERATOR VIEW REPORTED COMMENTS

		Route::get('/modr/reports/comments/', function()
		{
			Paginator::setCurrentUrl('/modr/reports/comments/');
			
			$reports = Reports::where('type','=','comment')->where('solved','=',0)->paginate(10);
			$data = array(
				'reports' => $reports);

			return View::make('mods.reports.comments', $data);
		});		
		
		// MODERATOR VIEW REPORTED COMMENTS

		Route::get('/modr/reports/comments/{page}', function($page)
		{
			Paginator::setCurrentPage($page);
			Paginator::setCurrentUrl('/modr/reports/comments/'.$page);
			
			$reports = Reports::where('type', '=', 'comment')->where('solved','=',0)->paginate(10);
			$data = array(
				'reports' => $reports);

			return View::make('mods.reports.comments', $data);
		});		
		
		// MODERATOR VIEW REPORTED COMMENTS

		Route::get('/modr/reports/files/', function()
		{
			Paginator::setCurrentUrl('/modr/reports/files/');
			
			$reports = Reports::where('type','=','file')->where('solved','=',0)->paginate(10);
			$data = array(
				'reports' => $reports);

			return View::make('mods.reports.files', $data);
		});		
		
		// MODERATOR VIEW REPORTED COMMENTS

		Route::get('/modr/reports/files/{page}', function($page)
		{
			Paginator::setCurrentPage($page);
			Paginator::setCurrentUrl('/modr/reports/files/'.$page);
			
			$reports = Reports::where('type', '=', 'file')->where('solved','=',0)->paginate(10);
			$data = array(
				'reports' => $reports);

			return View::make('mods.reports.files', $data);
		});
		
		// MODERATOR VIEW REPORTED USERS

		Route::get('/modr/reports/users/', function()
		{
			Paginator::setCurrentUrl('/modr/reports/users/');
			
			$reports = Reports::where('type','=','user')->where('solved','=',0)->paginate(10);
			$data = array(
				'reports' => $reports);

			return View::make('mods.reports.users', $data);
		});		
		
		// MODERATOR VIEW REPORTED USERS

		Route::get('/modr/reports/users/{page}', function($page)
		{
			Paginator::setCurrentPage($page);
			Paginator::setCurrentUrl('/modr/reports/users/'.$page);
			
			$reports = Reports::where('type','=','user')->where('solved','=',0)->paginate(10);
			$data = array(
				'reports' => $reports);

			return View::make('mods.reports.users', $data);
		});
		
		// MODERATOR VIEW RE UPLOAD REQUESTS

		Route::get('/modr/re-upload/', function()
		{
			Paginator::setCurrentUrl('/modr/re-upload/');
			
			$reports = Reupload::where('checked','=',0)->paginate(10);
			$data = array(
				'reports' => $reports);

			return View::make('mods.reports.reupload', $data);
		});	
		
		// MODERATOR VIEW RE UPLOAD REQUESTS

		Route::get('/modr/re-upload/{page}', function($page)
		{
			Paginator::setCurrentPage($page);
			Paginator::setCurrentUrl('/modr/re-upload/'.$page);
			
			$reports = Reupload::where('checked','=',0)->paginate(10);
			$data = array(
				'reports' => $reports);

			return View::make('mods.reports.reupload', $data);
		});
		
});


		Route::get('/test', function()
		{
					$gold = Auth::user()->achievements()->where('type','=', 3)->count();
					$silver = Auth::user()->achievements()->where('type','=', 2)->count();
					$bronze = Auth::user()->achievements()->where('type','=', 1)->count();
					$rep = Auth::user()->rep;
					$username = Auth::user()->username;
					$days = dateString(Auth::user()->created_at);
					$avatar = Auth::user()->avatar;
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
					$pdf->save('/var/www/datas/tmp/myfile.pdf');

					//return '';
					$imagick = new Imagick(); 

					$imagick->setResolution(400, 400);
					$imagick->setBackgroundColor(new ImagickPixel('transparent')); 

					$imagick->readImage('/var/www/datas/tmp/myfile.pdf'); 

					$imagick->resizeImage(402 , 77, imagick::FILTER_LANCZOS, 1 );
					$imagick->writeImages('/var/www/datas/laravel/public/a/converted.png', false); 

					$imagick->clear();
					$imagick->destroy(); 

					unlink('/var/www/datas/tmp/myfile.pdf');
					return '<style>body {margin:0px;padding:0px;}</style><img src="http://109.201.131.56/a/converted.png" height="77" width="402">';
				}catch(HTML2PDF_exception $e) {
					echo $e;
					exit;
				}
		});		
		
		Route::get('/test2', function()
		{
					$days = dateString(Auth::user()->created_at);
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
					$pdf->save('/var/www/datas/tmp/myfile.pdf');

					//return '';
					$imagick = new Imagick(); 

					$imagick->setResolution(400, 400);
					$imagick->setBackgroundColor(new ImagickPixel('transparent')); 

					$imagick->readImage('/var/www/datas/tmp/myfile.pdf'); 

					$imagick->resizeImage(350 , 19, imagick::FILTER_LANCZOS, 1 );
					$imagick->writeImages('/var/www/datas/laravel/public/a/converted.png', false); 

					$imagick->clear();
					$imagick->destroy(); 

					unlink('/var/www/datas/tmp/myfile.pdf');
					return '<style>body {margin:0px;padding:0px;}</style><img src="http://109.201.131.56/a/converted.png" height="19" width="350">';
				}catch(HTML2PDF_exception $e) {
					echo $e;
					exit;
				}
		});
		
		Route::get('/test1', function()
		{
				try
				{
					$pdf = PDF::loadView('test');
					$pdf->setSize('15','143.00');
					$pdf->setOption('margin-bottom', 0);
					$pdf->setOption('margin-top', 0);
					$pdf->setOption('margin-left', 0);
					$pdf->setOption('margin-right', 0);
					$pdf->save('/var/www/datas/tmp/myfile.pdf');


					$imagick = new Imagick(); 

					$imagick->setResolution(400, 400);
					$imagick->setBackgroundColor(new ImagickPixel('transparent')); 

					$imagick->readImage('/var/www/datas/tmp/myfile.pdf'); 

					$imagick->resizeImage(532 , 52, imagick::FILTER_LANCZOS, 1 );
					$imagick->writeImages('/var/www/datas/laravel/public/a/converted.png', false); 

					$imagick->clear();
					$imagick->destroy(); 

					unlink('/var/www/datas/tmp/myfile.pdf');
					return '<style>body {margin:0px;padding:0px;}</style><img src="http://109.201.131.56/a/converted.png" height="52" width=532">';
				}
				catch(HTML2PDF_exception $e) {
					echo $e;
					exit;
				}
		});		
		
		Route::get('/test3', function()
		{
			return UserAchievements::where('user_id','=', Auth::user()->id)->where('seen','=',0)->count();
		});
		
		Route::get('/{name}/{page}', function($name,$page)
		{
			$current_url = '/'.$name. '/' . $page . '/';
						
			$order_text = array();
			$order_text["size"] = "desc";
			$order_text["links_count"] = "desc";
			$order_text["time_add"] = "desc";
			$order_text["dl"] = "desc";
			$order_text["sm"] = "desc";
			
			$category = Category::where('url','=', $name)->first();
			if(isset($category->id)){
				Paginator::setCurrentPage($page);
				Paginator::setCurrentUrl($name);
				
				if(Input::has('field')){
					$field = Input::get('field');
					$order = 'desc';
				
					if(Input::has('sorder')){
						$sorder = Input::get('sorder');
						if($sorder == 'asc'){
							$order = 'asc';
						}
					}
					
					switch($field){
						case "size":
							$media = Media::where('deleted', '=', 0)->where('cat_id', '=', $category->id)->orWhere('sub_id', '=', $category->id)->orderBy('size', $order)->paginate(10);
							if($order == "desc"){
								$order_text["size"] = "asc";
							}
							break;
						case "links_count":
							$media = Media::where('deleted', '=', 0)->where('cat_id', '=', $category->id)->orWhere('sub_id', '=', $category->id)->orderBy('dl_links_count', $order)->orderBy('sm_links_count', $order)->paginate(10);
							if($order == "desc"){
								$order_text["links_count"] = "asc";
							}
							break;
						case "time_add":
							$media = Media::where('deleted', '=', 0)->where('cat_id', '=', $category->id)->orWhere('sub_id', '=', $category->id)->orderBy('created_at', $order)->paginate(10);
							if($order == "desc"){
								$order_text["time_add"] = "asc";
							}
							break;			
						case "dl":
							$media = Media::where('deleted', '=', 0)->where('cat_id', '=', $category->id)->orWhere('sub_id', '=', $category->id)->orderBy('dl_links_count', $order)->paginate(10);
							if($order == "desc"){
								$order_text["dl"] = "asc";
							}
							break;			
						case "sm":
							$media = Media::where('deleted', '=', 0)->where('cat_id', '=', $category->id)->orWhere('sub_id', '=', $category->id)->orderBy('sm_links_count', $order)->paginate(10);
							if($order == "desc"){
								$order_text["sm"] = "asc";
							}
							break;
					}
				}else{
					$media = Media::where('deleted', '=', 0)->where('cat_id', '=', $category->id)->orWhere('sub_id', '=', $category->id)->orderBy('created_at', 'desc')->paginate(10);
				}
				
				$data = array(
					'media' => $media, 'category' => $category, 'order_text' => $order_text, 'current_url' => $current_url);

				return View::make('general.list-cat', $data);
			}
			return View::make('general.404');
		});
		
		//MEDIA
		Route::get('/{name}', function($name)
		{
			$current_url = '/'.$name. '/';
			
			$order_text = array();
			$order_text["size"] = "desc";
			$order_text["links_count"] = "desc";
			$order_text["time_add"] = "desc";
			$order_text["dl"] = "desc";
			$order_text["sm"] = "desc";
			
			
			$category = Category::where('url','=', $name)->first();
			if(isset($category->id)){
				if(Input::has('rss')){
						$media = Media::where('deleted', '=', 0)->where('cat_id', '=', $category->id)->orWhere('sub_id', '=', $category->id)->orderBy('created_at', 'desc')->take(10)->get();
						$feed = Feed::make();
					    $feed->title = $name .' files RSS feed - ThatassLinks';
						$feed->description = $name .' files RSS feed';
						$feed->link = URL::to('/');
						foreach ($media as $m)
						{
							// set item's title, author, url, pubdate, description and content
							$feed->add($m->title, $m->category()->name, URL::to($m->slug . '-t' .$m->id . '.html'), $m->created_at, $m->description,'');
						}
						return $feed->render('rss');
				}
				
				Paginator::setCurrentUrl($name);
				
				if(Input::has('field')){
					$field = Input::get('field');
					$order = 'desc';
				
					if(Input::has('sorder')){
						$sorder = Input::get('sorder');
						if($sorder == 'asc'){
							$order = 'asc';
						}
					}
					
					switch($field){
						case "size":
							$media = Media::where('deleted', '=', 0)->where('cat_id', '=', $category->id)->orWhere('sub_id', '=', $category->id)->orderBy('size', $order)->paginate(10);
							if($order == "desc"){
								$order_text["size"] = "asc";
							}
							break;
						case "links_count":
							$media = Media::where('deleted', '=', 0)->where('cat_id', '=', $category->id)->orWhere('sub_id', '=', $category->id)->orderBy('dl_links_count', $order)->orderBy('sm_links_count', $order)->paginate(10);
							if($order == "desc"){
								$order_text["links_count"] = "asc";
							}
							break;
						case "time_add":
							$media = Media::where('deleted', '=', 0)->where('cat_id', '=', $category->id)->orWhere('sub_id', '=', $category->id)->orderBy('created_at', $order)->paginate(10);
							if($order == "desc"){
								$order_text["time_add"] = "asc";
							}
							break;			
						case "dl":
							$media = Media::where('deleted', '=', 0)->where('cat_id', '=', $category->id)->orWhere('sub_id', '=', $category->id)->orderBy('dl_links_count', $order)->paginate(10);
							if($order == "desc"){
								$order_text["dl"] = "asc";
							}
							break;			
						case "sm":
							$media = Media::where('deleted', '=', 0)->where('cat_id', '=', $category->id)->orWhere('sub_id', '=', $category->id)->orderBy('sm_links_count', $order)->paginate(10);
							if($order == "desc"){
								$order_text["sm"] = "asc";
							}
							break;
					}
				}else{
					$media = Media::where('deleted', '=', 0)->where('cat_id', '=', $category->id)->orWhere('sub_id', '=', $category->id)->orderBy('created_at', 'desc')->paginate(10);
				}
				$data = array(
					'media' => $media, 'category' => $category, 'order_text' => $order_text, 'current_url' => $current_url);

				return View::make('general.list-cat', $data);
			}
			
			$rel6 = '{-t\K\d+(?=\.html)}';
			preg_match($rel6,$name, $matches_user);
			if(isset($matches_user[0])){
				$media = Media::where('id' , '=' , $matches_user[0])->first();
				
				if(isset($media->id)){
					$yrdata= strtotime($media->created_at);
					$added_on = date('M d, Y', $yrdata);
					return View::make('torrent', array('media' => $media, 'added_on' => $added_on));
				}
			}
			
			return View::make('general.404');
		});



function getComment($bbtext){

		
	  $bbtags = array(
		'[heading1]' => '<h1>','[/heading1]' => '</h1>',
		'[heading2]' => '<h2>','[/heading2]' => '</h2>',
		'[heading3]' => '<h3>','[/heading3]' => '</h3>',
		'[h1]' => '<h1>','[/h1]' => '</h1>',
		'[h2]' => '<h2>','[/h2]' => '</h2>',
		'[h3]' => '<h3>','[/h3]' => '</h3>',

		'[paragraph]' => '<p>','[/paragraph]' => '</p>',
		'[para]' => '<p>','[/para]' => '</p>',
		'[p]' => '<p>','[/p]' => '</p>',
		'[left]' => '<p style="text-align:left;">','[/left]' => '</p>',
		'[right]' => '<p style="text-align:right;">','[/right]' => '</p>',
		'[center]' => '<p style="text-align:center;">','[/center]' => '</p>',
		'[justify]' => '<p style="text-align:justify;">','[/justify]' => '</p>',

		'[bold]' => '<span style="font-weight:bold;">','[/bold]' => '</span>',
		'[italic]' => '<span style="font-weight:bold;">','[/italic]' => '</span>',
		'[underline]' => '<span style="text-decoration:underline;">','[/underline]' => '</span>',
		'[b]' => '<span style="font-weight:bold;">','[/b]' => '</span>',
		'[i]' => '<span style="font-weight:bold;">','[/i]' => '</span>',
		'[u]' => '<span style="text-decoration:underline;">','[/u]' => '</span>',
		'[break]' => '<br>',
		'[br]' => '<br>',
		'[newline]' => '<br>',
		'[nl]' => '<br>',
		
		'[unordered_list]' => '<ul>','[/unordered_list]' => '</ul>',
		'[list]' => '<ul>','[/list]' => '</ul>',
		'[ul]' => '<ul>','[/ul]' => '</ul>',

		'[ordered_list]' => '<ol>','[/ordered_list]' => '</ol>',
		'[ol]' => '<ol>','[/ol]' => '</ol>',
		'[list_item]' => '<li>','[/list_item]' => '</li>',
		'[li]' => '<li>','[/li]' => '</li>',
		
		'[*]' => '<li>','[/*]' => '</li>',
		'[code]' => '<code>','[/code]' => '</code>',
		'[preformatted]' => '<pre>','[/preformatted]' => '</pre>',
		'[pre]' => '<pre>','[/pre]' => '</pre>',	     
	  );

	  $bbtext = str_ireplace(array_keys($bbtags), array_values($bbtags), $bbtext);

	  $bbextended = array(
		"/\[url](.*?)\[\/url]/i" => "<a href=\"http://$1\" title=\"$1\">$1</a>",
		"/\[user='(.*?)\']/i" => function($m) {
				$user = User::where('username', '=' , $m[1])->first();
				if(isset($user->id)){
					$rep = $user->rep;
					$username = $user->username;
					//return "<div class=\"user\" <a href=\"/user/".$m[1]."\" title=\"".$m[1]."\">" .$m[1]."</a><span> ".$rep." </span></div>";
					return '<span class="badgeInline"> <span class="offline" title="offline"></span> <span class="aclColor_1"><a class="plain" href="/user/'.$username.'/">'.$username.'</a></span> <span title="Reputation" class="repValue negative">'.$rep.'</span> <a href="/messenger/create/'.$username.'/" title="send private message" class="imessage ajaxLink icon16"><span>		</span></a></span>';
				}else{
					return "wrong user link";
				}
			},
		"/\[email=(.*?)\](.*?)\[\/email\]/i" => "<a href=\"mailto:$1\">$2</a>",
		"/\[mail=(.*?)\](.*?)\[\/mail\]/i" => "<a href=\"mailto:$1\">$2</a>",
		"/\[img\]([^[]*)\[\/img\]/i" => "<img src=\"$1\" alt=\" \" />",
		"/\[image\]([^[]*)\[\/image\]/i" => "<img src=\"$1\" alt=\" \" />",
		"/\[image_left\]([^[]*)\[\/image_left\]/i" => "<img src=\"$1\" alt=\" \" class=\"img_left\" />",
		"/\[image_right\]([^[]*)\[\/image_right\]/i" => "<img src=\"$1\" alt=\" \" class=\"img_right\" />",
	  );

	  foreach($bbextended as $match=>$replacement){
		  if( is_callable($replacement)) {
			$bbtext = preg_replace_callback($match, $replacement, $bbtext);
		  }
		  else {
			$bbtext = preg_replace($match, $replacement, $bbtext);
		}
	  }
	  return $bbtext;
	}


function getfilesize($bytes) {
   if ($bytes >= 1099511627776) {
       $return = round($bytes / 1024 / 1024 / 1024 / 1024, 2);
       $suffix = "TB";
   } elseif ($bytes >= 1073741824) {
       $return = round($bytes / 1024 / 1024 / 1024, 2);
       $suffix = "GB";
   } elseif ($bytes >= 1048576) {
       $return = round($bytes / 1024 / 1024, 2);
       $suffix = "MB";
   } elseif ($bytes >= 1024) {
       $return = round($bytes / 1024, 2);
       $suffix = "KB";
   } else {
       $return = $bytes;
       $suffix = "Byte";
   }
    $return .= " " . $suffix;

   return $return;
}

function time_elapsed_string($datetime, $full = false) {
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
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . '&nbsp;ago' : 'just&nbsp;now';
}

function humanTiming ($time)
{

    $time = time() - $time; // to get the time since that moment

    $tokens = array (
        31536000 => 'year',
        2592000 => 'month',
        604800 => 'week',
        86400 => 'day',
        3600 => 'hour',
        60 => 'min.',
        1 => 'sec.'
    );

    foreach ($tokens as $unit => $text) {
        if ($time < $unit) continue;
        $numberOfUnits = floor($time / $unit);
        return $numberOfUnits.'&nbsp;'.$text.(($numberOfUnits>1 && $text != 'min.' && $text != 'sec.')?'s':'');
    }

}

	function dateString($date, $type = "days"){
		$now = new DateTime();
		$today = $now->format('Y-m-d H:i:s');

		switch($type){
			case "days":
				$dStart = new DateTime($date);
				$dEnd  = new DateTime($today);
				$dDiff = $dStart->diff($dEnd);
				return $dDiff->days;
			default:
				$dStart = new DateTime($date);
				$dEnd  = new DateTime($today);
				$dDiff = $dStart->diff($dEnd);
				return $dDiff->days;
		}

	}

	function get_desc($desc){
		$bbtext = htmlentities ($desc);
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
		"/\[url=\"(.*?)\"](.*?)\[\/url]/i" => "<a href=\"$1\" title=\"$2\">$2</a>",		
		"/\[color=(.*?)](.*?)\[\/color]/i" => "<span style=\"color:$1\">$2</span>",		
		"/\[size=(.*?)](.*?)\[\/size]/i" => "<span style=\"font-size:$1%\">$2</span>",
		"/\[img\]([^[]*)\[\/img\]/i" => "<img src=\"$1\" alt=\" \" />",
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
	
	function base64_url_encode($input)
	{
		return strtr(base64_encode($input), '+/=', '-_,');
	}
	 
	function base64_url_decode($input)
	{
		return base64_decode(strtr($input, '-_,', '+/='));
	}	
	
	function rate_limit($limit)
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