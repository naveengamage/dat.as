<?php

class MediaController extends BaseController {

	/**
	 * Media Repository
	 *
	 * @var Meda
	 */
	protected $media;

	public function __construct(Media $media)
	{
		$this->media = $media;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$media = $this->media->all();

		return View::make('media.index', compact('media'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$category_id = Input::get('categoryId');
		$sub_id = Input::get('sub_cat');
		$name = Input::get('name');
		$size = Input::get('size');		
		$code = Input::get('file_id');
		$size_suffix = Input::get('size_suffix');
		$suffixes = array("Bytes", "KB", "MB", "GB", "TB", "PB");		
		$qts = array("", " ", "1080p", "720p", "Blu-Ray", "BDRip", "HDRiP", "DVD", "DVDRip", "x264", "VCD", "MPEG-4", "TVRip", "VHSRip", "Screener", "TeleSync", "Telecine", "Workprint", "Cam", "iPhone", "Unknown");
		
		$languages = Input::get('languages');
		$subtitles = Input::get('subtitles');
		
		//movie
		$movie_name = Input::get('movie_name');
		$imdb_id = Input::get('imdbid');			
		$quality = Input::get('quality');			
		//music	
		$album_name = Input::get('album_name');			
		$mb_id = Input::get('mb_id');
		$audio_quality = Input::get('mquality');			
		//game
		$game_name = Input::get('game_name');			
		$platform_id = Input::get('platform_id');			
		//books
		$isbn = Input::get('isbn');			
		//anime
		$anime_name = Input::get('anime_name');			
		$anidbid = Input::get('anidbid');			
		$aquality = Input::get('aquality');			
		$aepisode = Input::get('aepisode');			
		//tv
		$tv_name = Input::get('tv_name');			
		$tvrage_id = Input::get('tvrage_id');			
		$season = Input::get('season');			
		$episode = Input::get('episode');			
		
		$desc = Input::get('desc');
		
		$screencaps = Input::get('screencap_image_ids');
		$screenshots = Input::get('screenshot_image_ids');
		
		$cat_exists = Category::where('id','=', $category_id)->where('is_sub','=', 0)->first();
		
		if(empty($category_id) || !isset($cat_exists->id)){
			return Response::json(array('html' => 'Category id is required', 'method'=> 'error'));
		}	

		if(empty($sub_id)){
			$sub_id = 0;
		}			

		if(empty($name)){
			return Response::json(array('html' => 'File Name filed is required', 'method'=> 'error'));
		}			
		
		if(empty($size)){
			return Response::json(array('html' => 'File Size filed is required', 'method'=> 'error'));
		}			
		
		if(empty($size_suffix)){
			return Response::json(array('html' => 'File size suffix filed is required', 'method'=> 'error'));
		}			
		
		if(!in_array($size_suffix, $suffixes)){
			return Response::json(array('html' => 'Suffix not supported', 'method'=> 'error'));
		}
		
		$newMedia = new Media;
		$newMedia->title = $name;
		$newMedia->size = $size;		
		$newMedia->code = $code;		
		$newMedia->dl_links_count = Links::where('code', '=', $code)->where('dl', '=', 1)->count();		
		$newMedia->sm_links_count = Links::where('code', '=', $code)->where('dl', '=', 0)->count();
		$newMedia->size_suffix = $size_suffix;
		$newMedia->cat_id = $category_id;
		$newMedia->user_id = Auth::user()->id;
		$newMedia->sub_id = $sub_id;
		$newMedia->description = $desc;
		
		if($category_id == 14){
			if(!in_array($quality, $qts)){
				return Response::json(array('html' => 'Quality not supported', 'method'=> 'error'));
			}
			if($quality == "" || $quality == " "){
				$quality = "Other";
			}
			if(!empty($imdb_id)){
				$newMedia->imdb_id = $imdb_id;
			}
			if(!empty($quality)){
				$newMedia->movie_qt = $quality;
			}
			if(count($languages) != 0){
				$language_array = array();
				foreach($languages as $language){
					$language_array[] = $language;
				}
				if(count($language_array) != 0){
					$newMedia->audio_lang = json_encode($language_array);
				}
			}
			if(count($subtitles) != 0){
				$subtitle_array = array();
				foreach($subtitles as $subtitle){
					$subtitle_array[] = $subtitle;
				}
				if(count($subtitle_array) != 0){
					$newMedia->sub_lang = json_encode($subtitle_array);
				}
			}
		}elseif($category_id == 15){
			if(!empty($imdb_id)){
				$newMedia->imdb_id = $imdb_id;
			}
			if(!empty($quality)){
				$newMedia->movie_qt = $quality;
			}
			if(count($languages) != 0){
				$language_array = array();
				foreach($languages as $language){
					$language_array[] = $language;
				}
				if(count($language_array) != 0){
					$newMedia->audio_lang = json_encode($language_array);
				}
			}
			if(count($subtitles) != 0){
				$subtitle_array = array();
				foreach($subtitles as $subtitle){
					$subtitle_array[] = $subtitle;
				}
				if(count($subtitle_array) != 0){
					$newMedia->sub_lang = json_encode($subtitle_array);
				}
			}
		}elseif($category_id == 16){
			if(!empty($album_name)){
				$newMedia->album_name = $album_name;
			}
			if(!empty($mb_id)){
				$newMedia->mb_id = $mb_id;
			}				
			if(!empty($audio_quality)){
				$newMedia->audio_qt = $audio_quality;
			}
		}elseif($category_id == 17){
			if(!empty($game_name)){
				$newMedia->game_name = $game_name;
			}
			if(!empty($platform_id)){
				$newMedia->platform_id = $platform_id;
			}
			if(count($languages) != 0){
				$language_array = array();
				foreach($languages as $language){
					$language_array[] = $language;
				}
				if(count($language_array) != 0){
					$newMedia->audio_lang = json_encode($language_array);
				}
			}
		}elseif($category_id == 19){
			if(!empty($isbn)){
				$newMedia->isbn = $isbn;
			}
		}elseif($category_id == 20){
			if(!empty($anime_name)){
				$newMedia->anime_name = $anime_name;
			}
			if(!empty($anidbid)){
				$newMedia->anidbid = $anidbid;
			}
			if(!empty($aquality)){
				$newMedia->aquality = $aquality;
			}
			if(!empty($aepisode)){
				$newMedia->aepisode = $aepisode;
			}
			if(count($languages) != 0){
				$language_array = array();
				foreach($languages as $language){
					$language_array[] = $language;
				}
				if(count($language_array) != 0){
					$newMedia->audio_lang = json_encode($language_array);
				}
			}
			if(count($subtitles) != 0){
				$subtitle_array = array();
				foreach($subtitles as $subtitle){
					$subtitle_array[] = $subtitle;
				}
				if(count($subtitle_array) != 0){
					$newMedia->sub_lang = json_encode($subtitle_array);
				}
			}
		}
			if(count($screencaps) != 0){
				$screencap_array = array();
				foreach($screencaps as $screencap){
					$screencap_array[] = $screencap;
				}
				if(count($screencap_array) != 0){
					$newMedia->screen_caps = json_encode($screencap_array);
				}
			}
			if(count($screenshots) != 0){
				$screenshot_array = array();
				foreach($screenshots as $screenshot){
					$screenshot_array[] = $screenshot;
				}
				if(count($screenshot_array) != 0){
					$newMedia->screen_shots = json_encode($screenshot_array);
				}
			}


		$slug = Helper::slugify($name);
		$newMedia->slug = $slug;
		
		$newMedia->save();	
		
		$object_id = new ObjectId;
		$object_id->media_id = $newMedia->id;
		$object_id->save();
		
		$newMedia->object_id = $object_id->id;
		$newMedia->save();
		
		$url = "/". $slug . "-t" . $newMedia->id . ".html";
		return array("html" => "", "method" => "ok", "url" => $url);
	}	
	
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function editPost($id)
	{
		$media = Media::where('id',$id)->first();
		if(isset($media->id)){
			if($media->user_id == Auth::user()->id){
				$category_id = Input::get('categoryId');
				$sub_id = Input::get('sub_cat');
				$name = Input::get('name');
				$size = Input::get('size');		
				$size_suffix = Input::get('size_suffix');
				$suffixes = array("Bytes", "KB", "MB", "GB", "TB", "PB");		
				$qts = array("", " ", "1080p", "720p", "Blu-Ray", "BDRip", "HDRiP", "DVD", "DVDRip", "x264", "VCD", "MPEG-4", "TVRip", "VHSRip", "Screener", "TeleSync", "Telecine", "Workprint", "Cam", "iPhone", "Unknown");
				
				$languages = Input::get('languages');
				$subtitles = Input::get('subtitles');
				
				//movie
				$movie_name = Input::get('movie_name');
				$imdb_id = Input::get('imdbid');			
				$quality = Input::get('quality');			
				//music	
				$album_name = Input::get('album_name');			
				$mb_id = Input::get('mb_id');
				$audio_quality = Input::get('mquality');			
				//game
				$game_name = Input::get('game_name');			
				$platform_id = Input::get('platform_id');			
				//books
				$isbn = Input::get('isbn');			
				//anime
				$anime_name = Input::get('anime_name');			
				$anidbid = Input::get('anidbid');			
				$aquality = Input::get('aquality');			
				$aepisode = Input::get('aepisode');			
				//tv
				$tv_name = Input::get('tv_name');			
				$tvrage_id = Input::get('tvrage_id');			
				$season = Input::get('season');			
				$episode = Input::get('episode');			
				
				$desc = Input::get('desc');
				
				$screencaps = Input::get('screencap_image_ids');
				$screenshots = Input::get('screenshot_image_ids');
				
				$cat_exists = Category::where('id','=', $category_id)->where('is_sub','=', 0)->first();
				
				if(empty($category_id) || !isset($cat_exists->id)){
					return Response::json(array('html' => 'Category id is required', 'method'=> 'error'));
				}	

				if(empty($sub_id)){
					$sub_id = 0;
				}			

				if(empty($name)){
					return Response::json(array('html' => 'File Name filed is required', 'method'=> 'error'));
				}			
				
				if(empty($size)){
					return Response::json(array('html' => 'File Size filed is required', 'method'=> 'error'));
				}			
				
				if(empty($size_suffix)){
					return Response::json(array('html' => 'File size suffix filed is required', 'method'=> 'error'));
				}			
				
				if(!in_array($size_suffix, $suffixes)){
					return Response::json(array('html' => 'Suffix not supported', 'method'=> 'error'));
				}
				

				$media->title = $name;
				$media->size = $size;				
				$media->size_suffix = $size_suffix;
				$media->cat_id = $category_id;
				$media->user_id = Auth::user()->id;
				$media->sub_id = $sub_id;
				$media->description = $desc;
				
				if($category_id == 14){
					if(!in_array($quality, $qts)){
						return Response::json(array('html' => 'Quality not supported', 'method'=> 'error'));
					}
					if($quality == "" || $quality == " "){
						$quality = "Other";
					}
					if(!empty($imdb_id)){
						$media->imdb_id = $imdb_id;
					}
					if(!empty($quality)){
						$media->movie_qt = $quality;
					}
					if(count($languages) != 0){
						$language_array = array();
						foreach($languages as $language){
							$language_array[] = $language;
						}
						if(count($language_array) != 0){
							$media->audio_lang = json_encode($language_array);
						}
					}
					if(count($subtitles) != 0){
						$subtitle_array = array();
						foreach($subtitles as $subtitle){
							$subtitle_array[] = $subtitle;
						}
						if(count($subtitle_array) != 0){
							$media->sub_lang = json_encode($subtitle_array);
						}
					}
				}elseif($category_id == 15){
					if(!empty($imdb_id)){
						$media->imdb_id = $imdb_id;
					}
					if(!empty($quality)){
						$media->movie_qt = $quality;
					}
					if(count($languages) != 0){
						$language_array = array();
						foreach($languages as $language){
							$language_array[] = $language;
						}
						if(count($language_array) != 0){
							$media->audio_lang = json_encode($language_array);
						}
					}
					if(count($subtitles) != 0){
						$subtitle_array = array();
						foreach($subtitles as $subtitle){
							$subtitle_array[] = $subtitle;
						}
						if(count($subtitle_array) != 0){
							$media->sub_lang = json_encode($subtitle_array);
						}
					}
				}elseif($category_id == 16){
					if(!empty($album_name)){
						$media->album_name = $album_name;
					}
					if(!empty($mb_id)){
						$media->mb_id = $mb_id;
					}				
					if(!empty($audio_quality)){
						$media->audio_qt = $audio_quality;
					}
				}elseif($category_id == 17){
					if(!empty($game_name)){
						$media->game_name = $game_name;
					}
					if(!empty($platform_id)){
						$media->platform_id = $platform_id;
					}
					if(count($languages) != 0){
						$language_array = array();
						foreach($languages as $language){
							$language_array[] = $language;
						}
						if(count($language_array) != 0){
							$media->audio_lang = json_encode($language_array);
						}
					}
				}elseif($category_id == 19){
					if(!empty($isbn)){
						$media->isbn = $isbn;
					}
				}elseif($category_id == 20){
					if(!empty($anime_name)){
						$media->anime_name = $anime_name;
					}
					if(!empty($anidbid)){
						$media->anidbid = $anidbid;
					}
					if(!empty($aquality)){
						$media->aquality = $aquality;
					}
					if(!empty($aepisode)){
						$media->aepisode = $aepisode;
					}
					if(count($languages) != 0){
						$language_array = array();
						foreach($languages as $language){
							$language_array[] = $language;
						}
						if(count($language_array) != 0){
							$media->audio_lang = json_encode($language_array);
						}
					}
					if(count($subtitles) != 0){
						$subtitle_array = array();
						foreach($subtitles as $subtitle){
							$subtitle_array[] = $subtitle;
						}
						if(count($subtitle_array) != 0){
							$media->sub_lang = json_encode($subtitle_array);
						}
					}
				}
					if(count($screencaps) != 0){
						$screencap_array = array();
						foreach($screencaps as $screencap){
							$screencap_array[] = $screencap;
						}
						if(count($screencap_array) != 0){
							$media->screen_caps = json_encode($screencap_array);
						}
					}
					if(count($screenshots) != 0){
						$screenshot_array = array();
						foreach($screenshots as $screenshot){
							$screenshot_array[] = $screenshot;
						}
						if(count($screenshot_array) != 0){
							$media->screen_shots = json_encode($screenshot_array);
						}
					}


				$slug = Helper::slugify($name);
				$media->slug = $slug;
				
				$media->save();	

				
				$url = "/". $slug . "-t" . $media->id . ".html";
				return array("html" => "", "method" => "ok", "url" => $url);
			}
			return array("html" => "Access denied", "method" => "error");
		}
		return array("html" => "Mdia not found", "method" => "error");
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function storeImage()
	{
		if($this->rate_limit(5)){
			return Response::json(array('html' => 'using this function has it\'s limits, please try again later', 'method'=> 'error'));
		}
		
		if(!Auth::guest()){

			$input = Input::all();

			$valid_media = false;
			
			if(isset($input['url']) && !empty($input['url'])){
				$valid_media = true;
			} else if(count(Input::file('files') != 0)){
				$valid_media = true;
			} 

			
			if ($valid_media)
			{

				if(isset($input['url']) && !empty($input['url'])){
						$newImage = new UserPic;
						$newImage->user_id = Auth::user()->id;
						$newImage->save();
						
						list ($status,$error) = Helper::uploadImage($input['url'], 'url' , $newImage->id ,Auth::user()->id);
						
						if(!$status){
							$newImage->delete();
							return Response::json(array('html' => $error, 'method'=> 'error'));
						}
						$path = '/var/www/datas/laravel/public/uploads/user/'. $newImage->user_id . '/thumb/'.  $newImage->id .'.png';
						$data = file_get_contents($path);
						$thumb_link = 'data:image/png;base64,' . base64_encode($data);				
						
						$path = '/var/www/datas/laravel/public/uploads/user/'. $newImage->user_id . '/or/'.  $newImage->id .'.png';
						$data = file_get_contents($path);
						$link = 'data:image/png;base64,' . base64_encode($data);
						$array_data = json_encode (array('id' => $newImage->id , 'name' => $newImage->id , 'link'=> $link , 'thumb_link' =>  $thumb_link));
						return Response::json( array( 'html' => '[' .$array_data .']', 'method' => 'show' ));
					
				} else if (Input::hasFile('files')){
					$files = Input::file('files');
					$pic_total = 0;
					foreach($files as $file){
					    $rules = array(
							'image' => 'image|mimes:jpeg,bmp,png,gif'
						);
						$input = array('image' => $file);
						$validator = Validator::make($input, $rules);
						if ($validator->fails())
						{
							return Response::json(array('html' => 'Wrong file provided (either too big or not valid image)', 'method'=> 'error'));
						}else{
							if($pic_total < 3){
								$newImage = new UserPic;
								$newImage->user_id = Auth::user()->id;
								$newImage->save();
								if(!Helper::uploadImage($file, 'upload' , $newImage->id ,Auth::user()->id)){
									$newImage->delete();
								}
								$path = '/var/www/datas/laravel/public/uploads/user/'. $newImage->user_id . '/thumb/'.  $newImage->id .'.png';
								$data = file_get_contents($path);
								$thumb_link = 'data:image/png;base64,' . base64_encode($data);				
								
								$path = '/var/www/datas/laravel/public/uploads/user/'. $newImage->user_id . '/or/'.  $newImage->id .'.png';
								$data = file_get_contents($path);
								$link = 'data:image/png;base64,' . base64_encode($data);
								$array_data[] = array('id' => $newImage->id , 'name' => $newImage->id , 'link'=> $link , 'thumb_link' =>  $thumb_link);
								$pic_total++;
								unset($newImage);
							}else{
								break;
							}
						}
					}
						return Response::json( array( 'html' => json_encode ($array_data), 'method' => 'show' ));
				}
				return Response::json(array('html' => 'check input', 'method'=> 'error'));
			}

			return Response::json(array('html' => 'check the input', 'method'=> 'error'));

		} else {
			return Response::json(array('html' => 'you must be logged in', 'method'=> 'error'));
		}
	}

	public function deleteImage($id)
	{
		if($this->rate_limit(10)){
			return Response::json(array('html' => 'using this function has it\'s limits, please try again later', 'method'=> 'error'));
		}
		
		$image = UserPic::find($id);
		if(isset($image->id)){
			if($image->user_id == Auth::user()->id){
				$or_image = '/var/www/datas/laravel/public/uploads/user/'. Auth::user()->id .'/or/'.$image->id.'.png';
				$thumb_image = '/var/www/datas/laravel/public/uploads/user/'. Auth::user()->id .'/thumb/'.$image->id.'.png';
				
				if(file_exists($or_image)){
					unlink($or_image);
				}
				if(file_exists($thumb_image)){
					unlink($thumb_image);
				}
				$image->deleted = true;
				$image->save();
			}
		}
	}
	
	public function random()
	{
		$random = Media::where('active', '=', 1)->orderBy(DB::raw('RAND()'))->first();
		return Redirect::to('/media/' . $random->slug);
	}	
	
	// When user submits media award them 1 point, max 5 per day

	private function add_daily_media_points(){
		$user_id = Auth::user()->id;

		$LastQuestionPoints = Point::where('user_id', '=', $user_id)->where('description', '=', Lang::get('media.daily_upload'))->orderBy('created_at', 'desc')->take(5)->get();
		
		$total_daily_questions = 0;
		foreach($LastQuestionPoints as $QuestionPoint){
			if( date('Ymd') ==  date('Ymd', strtotime($QuestionPoint->created_at)) ){
				$total_daily_questions += 1;
			}
		}

		if($total_daily_questions < 5){
			$point = new Point;
			$point->user_id = $user_id;
			$point->description = Lang::get('media.daily_upload');
			$point->points = 1;
			$point->save();
			return true;
		} else {
			return false;
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */

	public function show($slug)
	{
		$media = $this->media->where('slug', '=', $slug)->first();

		$view_increment = $this->handleViewCount($media->id);
		
		$next = Media::where('active', '=', 1)->where('created_at', '>', date("Y-m-d H:i:s", strtotime($media->created_at)) )->first();
		$previous = Media::where('active', '=', 1)->where('created_at', '<', date("Y-m-d H:i:s", strtotime($media->created_at)) )->orderBy('created_at', 'desc')->first();
		$media_next = Media::where('active', '=', 1)->where('created_at', '>=', date("Y-m-d H:i:s", strtotime($media->created_at)) )->take(6)->get();

		$next_media_count = $media_next->count();

		if($next_media_count < 6){
			$get_prev_results = 6 - $next_media_count;
			$media_prev = Media::where('active', '=', 1)->where('created_at', '<', date("Y-m-d H:i:s", strtotime($media->created_at)) )->orderBy('created_at', 'DESC')->take($get_prev_results)->get();
		} else{
			$media_prev = array();
		}

		$data = array(
			'media' => $media,
			'media_next' => $media_next,
			'next' => $next,
			'previous' => $previous,
			'media_prev' => $media_prev,
			'view' => 'single',
			'view_increment' => $view_increment,
			);

		return View::make('media.show', $data);
	}

	public function handleViewCount($id){

		// check if this key already exists in the view_media session
		$blank_array = array();
		if (! array_key_exists($id, Session::get('viewed_media', $blank_array) ) ) {
            
            try{
	            // increment view
				$media = Media::find($id);
				$media->views = $media->views + 1;
				$media->save();

	            // Add key to the view_media session
	        	Session::put('viewed_media.'.$id, time());
	        	return true;

	        } catch (Exception $e){
	        	return false;
	        }
        } else {
        	return false;
        }

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$media = $this->media->find($id);

		if (is_null($media))
		{
			return Redirect::route('media.index');
		}

		return View::make('media.edit', compact('media'));
	}

	// Add Media Flag

	public function add_flag($id){
	
		if($this->rate_limit(5)){
			return Response::json(array('html' => 'using this function has it\'s limits, please try again later', 'method'=> 'error'));
		}
		
		$media = Media::find($id);
		
		if(isset($media->id)){
			$media_flag = Reports::where('media_id', '=', $id)->first();
			
			if(isset($media_flag->id)){
				return Response::json(array('html' => 'already reported', 'method'=> 'error'));
			}
			
			$reason = Input::get('reason');
			if($reason != ''){
				$flag = new Reports;
				$flag->user_flagged_id = Auth::user()->id;
				$flag->type = 'file';
				$flag->object_id = $media->object_id;
				$flag->media_id = $id;		
				$flag->res = $reason;
				$flag->save();
				return Response::json(array('html' => '', 'method'=> 'ok', 'url' => URL::to(URL::previous())));
			}else{
				return Response::json(array('html' => 'reason cannot be empty', 'method'=> 'error'));
			}
		}
		
		return Response::json(array('html' => 'object not found', 'method'=> 'error'));
	}


	public function likeMC($id)
	{
		if($this->rate_limit(10)){
			return Response::json(array('html' => 'using this function has it\'s limits, please try again later', 'method'=> 'error'));
		}
		
		$media = Media::find($id);
		if(isset($media->id)){
			$comment_vote = MediaVote::where('user_id', '=', Auth::user()->id)->where('media_id', '=', $id)->first();

			if(isset($comment_vote->id)){ 
					return Response::json(array('html' => 'already voted', 'method'=> 'error'));
			} else { 
				$feedback = Feedback::where('user_id', Auth::user()->id)->where('media_id', $media->id)->first();
				if(isset($feedback->id)){
					$feedback->delete();
				}
				$vote = new MediaVote;
				$vote->user_id = Auth::user()->id;
				$vote->media_id = $id;
				$vote->up = 1;
				$vote->save();
			}
		}
		
		$upVotes = DB::table('media_votes')->where('media_id', '=', $id)->sum('up');
		$downVotes = DB::table('media_votes')->where('media_id', '=', $id)->sum('down');
		return Response::json(array('method'=> 'ok', 'fakes_count' => $downVotes, 'thanks_count' => $upVotes));
	}	
	
	public function unlikeMC($id)
	{
		if($this->rate_limit(10)){
			return Response::json(array('html' => 'using this function has it\'s limits, please try again later', 'method'=> 'error'));
		}
		
		$comment_vote = MediaVote::where('user_id', '=', Auth::user()->id)->where('media_id', '=', $id)->where('up', '=', 1)->first();

		if(isset($comment_vote->id)){ 
			$comment_vote->delete();
		}
		
		$upVotes = DB::table('media_votes')->where('media_id', '=', $id)->sum('up');
		$downVotes = DB::table('media_votes')->where('media_id', '=', $id)->sum('down');
		return Response::json(array('method'=> 'ok', 'fakes_count' => $downVotes, 'thanks_count' => $upVotes));
	}
		
	public function dislikeMC($id)
	{
		if($this->rate_limit(10)){
			return Response::json(array('html' => 'using this function has it\'s limits, please try again later', 'method'=> 'error'));
		}
		
		$media = Media::find($id);
		if(isset($media->id)){
		
			$comment_vote = MediaVote::where('user_id', '=', Auth::user()->id)->where('media_id', '=', $id)->first();

			if(isset($comment_vote->id)){ 
					return Response::json(array('html' => 'already voted', 'method'=> 'error'));
			} else { 
				$feedback = Feedback::where('user_id', Auth::user()->id)->where('media_id', $media->id)->first();
				if(isset($feedback->id)){
					$feedback->delete();
				}
				
				$vote = new MediaVote;
				$vote->user_id = Auth::user()->id;
				$vote->media_id = $id;
				$vote->down = 1;
				$vote->save();
			}
		}
		
		$upVotes = DB::table('media_votes')->where('media_id', '=', $id)->sum('up');
		$downVotes = DB::table('media_votes')->where('media_id', '=', $id)->sum('down');
		return Response::json(array('method'=> 'ok', 'fakes_count' => $downVotes, 'thanks_count' => $upVotes));
	}	
	
	public function undislikeMC($id)
	{
		if($this->rate_limit(10)){
			return Response::json(array('html' => 'using this function has it\'s limits, please try again later', 'method'=> 'error'));
		}
		
		$comment_vote = MediaVote::where('user_id', '=', Auth::user()->id)->where('media_id', '=', $id)->where('down', '=', 1)->first();

		if(isset($comment_vote->id)){ 
			$comment_vote->delete();
		}
				
		$upVotes = DB::table('media_votes')->where('media_id', '=', $id)->sum('up');
		$downVotes = DB::table('media_votes')->where('media_id', '=', $id)->sum('down');
		return Response::json(array('method'=> 'ok', 'fakes_count' => $downVotes, 'thanks_count' => $upVotes));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$media = Media::find($id);
		if(Auth::user()->admin == 1 || Auth::user()->id == $media->user_id){
			
			$settings = Setting::first();

			try{
				$input = Input::all();

				if($settings->media_description){
					$media->description = htmlspecialchars($input['description']);
				}

				if(Auth::user()->admin == 1){
					$media->slug = htmlspecialchars($input['slug']);
				}

				if(isset($input['nsfw'])){
					$input['nsfw'] = 1;
				} else {
					$input['nsfw'] = 0;
				}

				$media->nsfw = $input['nsfw'];

				$media->title = htmlspecialchars($input['title']);
				$media->category_id = $input['category'];
				$media->link_url = htmlspecialchars($input['source']);
				$media->tags = htmlspecialchars($input['tags']);
				$media->save();
				return Redirect::to($input['redirect'])->with(array('note' => Lang::get('media.update_success'), 'note_type' => 'success') );
			} catch(Exception $e){
				return Redirect::to($input['redirect'])->with(array('note' => Lang::get('media.update_error') . ': ' . $e->getMessage(), 'note_type' => 'error') );
			}

		} else {
			return Redirect::to('/');
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function delete($id)
	{
		$media = Media::find($id);

		if($media->user_id == Auth::user()->id || Auth::user()->admin == 1){

			$media_flags = MediaFlag::where('media_id', '=', $id)->get();
			foreach($media_flags as $media_flag){
				$media_flag->delete();
			}

			$media_likes = MediaLike::where('media_id', '=', $id)->get();
			foreach($media_likes as $media_like){
				$media_like->delete();
			}

			$comments = Comment::where('media_id', '=', $id)->get();
			foreach($comments as $comment){
				$comment_votes = CommentVote::where('comment_id', '=', $comment->id)->get();
				foreach($comment_votes as $comment_vote){
					$comment_vote->delete();
				}

				$comment_flags = CommentFlag::where('comment_id', '=', $comment->id)->get();
				foreach($comment_flags as $comment_flag){
					$comment_flag->delete();
				}

				$comment->delete();
			}

			// if the media type is a gif we need to remove the animation file too.
			if(strpos($media->pic_url, '.gif') > 0){
				unlink('./uploads/images/' . str_replace(".gif", "-animation.gif", $media->pic_url));
			}

			// remove the image
			unlink('./uploads/images/' . $media->pic_url);


			$media->delete();

		}

		return Redirect::to('admin?section=media')->with(array('note' => Lang::get('media.delete_success'), 'note_type' => 'success') );
	}


	// Sanitize Image URL's

	private function sanitize($string, $force_lowercase = true, $anal = false) {
	    $strip = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "_", "=", "+", "[", "{", "]",
	                   "}", "\\", "|", ";", ":", "\"", "'", "&#8216;", "&#8217;", "&#8220;", "&#8221;", "&#8211;", "&#8212;",
	                   "â€”", "â€“", ",", "<", ".", ">", "/", "?");
	    $clean = trim(str_replace($strip, "", strip_tags($string)));
	    $clean = preg_replace('/\s+/', "-", $clean);
	    $clean = ($anal) ? preg_replace("/[^a-zA-Z0-9]/", "", $clean) : $clean ;
	    return ($force_lowercase) ?
	        (function_exists('mb_strtolower')) ?
	            mb_strtolower($clean, 'UTF-8') :
	            strtolower($clean) :
	        $clean;
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
