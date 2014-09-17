<?php

class CommentsController extends BaseController {


	/**
	 * Comment Repository
	 *
	 * @var Comment
	 */
	protected $comment;

	public function __construct(Comment $comment)
	{
		$this->comment = $comment;
	}

	public static $rules_captcha =  array('captcha' => array('required', 'captcha'));
		
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function indexCC($id)
	{
		if($this->rate_limit(20)){
			return Response::json(array('html' => 'using this function has it\'s limits, please try again later', 'method'=> 'error'));
		}
		
		$page = Input::get('page');
        $comments = Comment::where('object_id', '=', $id)->where('status', '=', 1)->where('comment_parent', 0)->orderBy('created_at', 'desc')->paginate(15);

		$limit = 15 * $page;
		$page = $page + 1;
		
		$object_id = ObjectId::find($id);
		$media = Media::find($object_id->media_id);
		
		$html = View::make('general.morecomments', array('comments' => $comments, 'page' => $page, 'limit' => $limit, 'media' => $media))->render();
		return Response::json(array('html' => $html, 'method'=> 'show'));
	}	
	
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function indexUserCC($id)
	{
		if($this->rate_limit(20)){
			return Response::json(array('html' => 'using this function has it\'s limits, please try again later', 'method'=> 'error'));
		}
		
		$page = Input::get('page');
        $comments = Comment::where('object_id', '=', $id)->where('status', '=', 1)->where('comment_parent', 0)->orderBy('created_at', 'desc')->paginate(15);

		$limit = 15 * $page;
		$page = $page + 1;
		
		$object_id = ObjectId::find($id);
		$user = User::find($object_id->profile_id);
		
		$html = View::make('general.morecommentsprofile', array('comments' => $comments, 'page' => $page, 'limit' => $limit, 'user' => $user))->render();
		return Response::json(array('html' => $html, 'method'=> 'show'));
	}

	/**
	 * Creates a new comment as logged in user.
	 *
	 * @return Response
	 */
	public function makeCC()
	{
		if($this->rate_limit(10)){
			return Response::json(array('html' => 'using this function has it\'s limits, please try again later', 'method'=> 'error'));
		}
		
		if(Auth::guest()){
			return Response::json(array('html' => 'please login', 'method'=> 'error'));
		}else{
			if(Input::has("ajax") && Input::has("turing") && isset(Auth::user()->id)){
				$input = Input::all();
				$exists_object = ObjectId::find($input["objectId"]);
				if(isset($exists_object->id)){
					$newComment = new Comment;
					$newComment->object_id = $input["objectId"];
					$newComment->user_id = Auth::user()->id;
					if(Input::has('video_rate') && Input::get('video_rate') != ''){
						$video = Input::get('video_rate');
						if(in_array($video, range(1, 10))){
							$newComment->video = $video;
						}
					}				
					if(Input::has('audio_rate') && Input::get('audio_rate') != ''){
						$audio = Input::get('audio_rate');
						if(in_array($audio, range(1, 10))){
							$newComment->audio = $audio;
						}
					}
					if(Input::has('image_ids')){
						$id_array = array();
						$image_ids = Input::get('image_ids');
						$pic_total = 0;
						foreach($image_ids as $image_id){
							if($pic_total < 4){
								$pic = UserPic::where('id','=',$image_id)->where('user_id','=', Auth::user()->id)->first();
								if(isset($pic->id)){
									$id_array[] = $image_id;
									$pic_total++;
								}
							}else{
								break;
							}
						}
						if(count($id_array) != 0){
							$newComment->image_ids = json_encode($id_array);
						}
					}
					if(Input::has('pid')){
						$pid_comment = Comment::find(Input::get('pid'));
						if(isset($pid_comment->id)){
							if($pid_comment->comment_parent != 0){
								$comment_user = User::find($pid_comment->user_id);
								$newComment->comment = '[user="'. $comment_user->username .'"] '.$input["content"];
								$newComment->comment_parent = $pid_comment->comment_parent;
							}else{
								$newComment->comment = $input["content"];
								$newComment->comment_parent = $pid_comment->id;
							}
						}else{
							return Response::json(array('html' => 'comment not found', 'method'=> 'error'));
						}
					}else{
						$newComment->comment = $input["content"];
					}
					$newComment->save();
					
					$newComment->username = Auth::user()->username;
					$newComment->avatar = Auth::user()->avatar;
					$newComment->rep = Auth::user()->rep;
					
					$data = array('comment' => $newComment);
					$html = View::make('general.new_main_comment', $data)->render();
					return Response::json(array('html' => $html, 'method'=> 'show'));
				}else{
					return Response::json(array('html' => 'object not found', 'method'=> 'error'));
				}
			}else{
				return Redirect::to(URL::previous());
			}	
		}
	}

	public function getEditCC($objectid)
	{
		if($this->rate_limit(20)){
			return Response::json(array('html' => 'using this function has it\'s limits, please try again later', 'method'=> 'error'));
		}
		
		$comment = Comment::find($objectid);
		if(isset($comment->id)){
			if($comment->user_id = Auth::user()->id){
				$html = View::make('general.edit_comment', array('comment' => $comment))->render();
				return Response::json(array('html' => $html, 'method'=> 'show'));
			}else{
				return Response::json(array('html' => 'permission denied', 'method'=> 'error'));
			}
		}else{
			return Response::json(array('html' => 'comment not found', 'method'=> 'error'));
		}
	}
	
	public function postEditCC($comment_id)
	{
		if($this->rate_limit(10)){
			return Response::json(array('html' => 'using this function has it\'s limits, please try again later', 'method'=> 'error'));
		}
		
		$comment = Comment::find($comment_id);
		if(isset($comment->id)){
			if($comment->user_id = Auth::user()->id){
				$comment->comment = Input::get('content');
				$comment->edited = true;
				$comment->edited_by = Auth::user()->id;
				if(Input::has('image_ids')){
					$id_array = array();
					$image_ids = Input::get('image_ids');
					$pic_total = 0;
					foreach($image_ids as $image_id){
						if($pic_total < 4){
							$pic = UserPic::where('id','=',$image_id)->where('user_id','=', Auth::user()->id)->first();
							if(isset($pic->id)){
								$id_array[] = $image_id;
								$pic_total++;
							}
						}else{
							break;
						}
					}
					if(count($id_array) != 0){
						$comment->image_ids = json_encode($id_array);
					}
				}else{
					if(!empty($comment->image_ids)){
						$comment->image_ids = '';
					}
				}
				$comment->save();
				
				$html = View::make('general.edited_comment', array('comment' => $comment))->render();
				return Response::json(array('html' => $html, 'method'=> 'show'));
			}else{
				return Response::json(array('html' => 'permission denied', 'method'=> 'error'));
			}
		}else{
			return Response::json(array('html' => 'comment not found', 'method'=> 'error'));
		}
	}
	
	public function deleteCC()
	{
		if($this->rate_limit(10)){
			return Response::json(array('html' => 'using this function has it\'s limits, please try again later', 'method'=> 'error'));
		}
		
		if(Input::has('cid')){
			$comment_id = Input::get('cid');
			$comment = Comment::find($comment_id);
			if(isset($comment->id)){
				if($comment->user_id = Auth::user()->id){
					if(!$comment->deleted){
						$comment_votes = CommentVote::where('comment_id', '=', $comment->id)->get();
						foreach($comment_votes as $votes){
							$votes->delete();
						}

						$comment_flags = CommentFlag::where('comment_id', '=', $comment->id)->get();
						foreach($comment_flags as $flag){
							$flag->delete();
						}
						$comment->deleted = true;
						$comment->save();
						return Response::json(array('html' => '', 'method'=> 'ok', 'url' => URL::previous()));
					}else{
							return Response::json(array('html' => 'already deleted', 'method'=> 'error'));
					}
				}else{
					return Response::json(array('html' => 'permission denied', 'method'=> 'error'));
				}
			}else{
				return Response::json(array('html' => 'comment not found', 'method'=> 'error'));
			}
		}else{
			return Response::json(array('html' => 'comment not found', 'method'=> 'error'));
		}
	}
	
	public function likeCC($id)
	{ 
		if($this->rate_limit(20)){
			return Response::json(array('html' => 'using this function has it\'s limits, please try again later', 'method'=> 'error'));
		}
		
		$comment = Comment::where('id', '=', $id)->first();
		if(isset($comment->id)){
			$comment_vote = CommentVote::where('user_id', '=', Auth::user()->id)->where('comment_id', '=', $id)->first();

			if(isset($comment_vote->id)){ 
					return Response::json(array('html' => 'already voted', 'method'=> 'error'));
			} else { 
				if($comment->votes >= 0){
					$comment->votes = $comment->votes + 1;
					$comment->save();
				}
				$vote = new CommentVote;
				$vote->user_id = Auth::user()->id;
				$vote->comment_id = $id;
				$vote->up = 1;
				$vote->save();
				$upVotes = DB::table('comment_votes')->where('comment_id', '=', $id)->sum('up');
				$downVotes = DB::table('comment_votes')->where('comment_id', '=', $id)->sum('down');
				$totalVotes = $upVotes - $downVotes;
				$html = View::make('general.comment_rate', array('comment_id' => $id, 'count' => $totalVotes))->render();
				return Response::json(array('method'=> 'show', 'html' => $html));
			}
		}
		return Response::json(array('method'=> 'error', 'html' => 'permission denied'));
	}
		
	public function dislikeCC($id)
	{
		if($this->rate_limit(20)){
			return Response::json(array('html' => 'using this function has it\'s limits, please try again later', 'method'=> 'error'));
		}
		
		$comment = Comment::where('id', '=', $id)->first();
		if(isset($comment->id)){
			$comment_vote = CommentVote::where('user_id', '=', Auth::user()->id)->where('comment_id', '=', $id)->first();

			if(isset($comment_vote->id)){ 
					return Response::json(array('html' => 'already voted', 'method'=> 'error'));
			} else {
				if($comment->votes >= 0){
					$comment->votes = $comment->votes - 1;
					$comment->save();
				}
				$vote = new CommentVote;
				$vote->user_id = Auth::user()->id;
				$vote->comment_id = $id;
				$vote->down = 1;
				$vote->save();
				$upVotes = DB::table('comment_votes')->where('comment_id', '=', $id)->sum('up');
				$downVotes = DB::table('comment_votes')->where('comment_id', '=', $id)->sum('down');
				$totalVotes = $upVotes - $downVotes;
				$html = View::make('general.comment_rate', array('comment_id' => $id, 'count' => $totalVotes))->render();
				return Response::json(array('html' => $html, 'method'=> 'show'));
			}
		}
		return Response::json(array('method'=> 'error', 'html' => 'permission denied'));
	}
	
	public function reportCC($id)
	{
		if($this->rate_limit(10)){
			return Response::json(array('html' => 'using this function has it\'s limits, please try again later', 'method'=> 'error'));
		}
		
		
		$comment = Comment::where('id',$id)->first();
		
		if(isset($comment->id)){
			$comment_flag = Reports::where('comment_id', '=', $id)->first();
			if(isset($comment_flag->id)){ 
				return Response::json(array('html' => 'already reported', 'method'=> 'error'));
			} 
			
			$flag = new Reports;
			$flag->user_flagged_id = Auth::user()->id;
			$flag->comment_id = $id;				
			$flag->object_id = $comment->object_id;
			$flag->type = 'comment';
			$flag->save();
			return Response::json(array('html' => '', 'method'=> 'ok', 'url' => URL::previous()));
			
		}else{
			return Response::json(array('html' => 'comment not found', 'method'=> 'error'));
		}
	}
		
	// ADD Daily Points for commenting max 5 per day //

	private function add_daily_comment_points(){
		$user_id = Auth::user()->id;

		$LastCommentPoints = Point::where('user_id', '=', $user_id)->where('description', '=', Lang::get('comments.daily_comment'))->orderBy('created_at', 'desc')->take(5)->get();
		
		$total_daily_comments = 0;
		foreach($LastCommentPoints as $CommentPoint){
			if( date('Ymd') ==  date('Ymd', strtotime($CommentPoint->created_at)) ){
				$total_daily_comments += 1;
			}
		}

		if($total_daily_comments < 5){
			$point = new Point;
			$point->user_id = $user_id;
			$point->description = Lang::get('comments.daily_comment');
			$point->points = 1;
			$point->save();
			return true;
		} else {
			return false;
		}
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
