 
 <div class="commentbody" id="comment{{$comment->id}}" style="background-color:#f8f7f5;">
        <div id="cpic_{{$comment->id}}" class="userPic">
            <div class="height50px userPicHeight relative">
				<a  href="/user/{{$comment->username}}/">
					@if(!empty($comment->user()->avatar))
						<img src="{{URL::asset('/uploads/user/' . $comment->user()->id . '/thumb/' . $comment->user()->avatar . '.png')}}">
					@else
						<img src="{{URL::asset('/images/commentlogo.png')}}">
					@endif
                </a>
            </div>
        </div>
        <div class="commentcontent">
					<a name="comment_{{$comment->id}}"></a>
					<div class="commentowner">
						<div class="rate rated" id="ratediv_{{$comment->id}}">
							<a  title="Votes for this comment" class=" ratemark " id="commrate_{{$comment->id}}">0</a>
						</div><!-- div class="rate"-->

						<div class="commentTopControlLine">
							 <a class="icon16 iedit greyButton" onClick="editComment({{$comment->id}});" title="Edit"><span></span></a>                                                    
							 <a class="icross greyButton icon16" title="Delete comment" href="javascript: DeleteComment({{$comment->id}});"><span></span></a>
						</div>
						<div class="commentownerLeft">
						<span class="badgeInline">
							<span class="@if($comment->user()->isOnline()) online @else offline @endif" title="@if($comment->user()->isOnline()) online @else offline @endif"></span> 
							<span class="aclColor_1"><a class="plain" href="/user/{{$comment->username}}/">{{$comment->username}}</a></span>
							<span title="Reputation" class="repValue positive">{{$comment->rep}}</span>
						</span>
						<span id="cdate_{{$comment->id}}" class="lightgrey font11px"> &bull; just&nbsp;now</span>
						<a class="siteButton smallButton reject showComment" id="cshow_{{$comment->id}}" href="javascript:showComment({{$comment->id}})"><span>Show comment</span></a>
						</div><!-- div class="commentownerLeft" -->
					</div><!--commentowner-->
					@if($comment->video != 0 && $comment->audio != 0)
						<div class="commentAVRate bold font11px">
							<span>audio: {{$comment->audio}}</span><span>video: {{$comment->video}}</span>   
						</div>
					@endif
					<div id="ctext_{{$comment->id}}" class="commentText botmarg5px topmarg5px">
						{{$comment->getComment()}}
						<div class="objectAttachmentsJs overauto topmarg10px">
							@if(!empty($comment->image_ids))
								@foreach(json_decode($comment->image_ids) as $userpic)
								<div class="galleryThumbSizerStills inlineblock">
									<a href="/uploads/user/{{$comment->user_id}}/or/{{$userpic}}.png" class="galleryThumb ajaxLink" rel="gallery_{{$comment->id}}">
										<img src="/uploads/user/{{$comment->user_id}}/thumb/{{$userpic}}.png" alt="" />
									</a>
								</div> 
								@endforeach
							@endif
						</div>
					</div>
					<div id="rep_link{{$comment->id}}" class="replyLink">
						<a class="siteButton smallButton" href="javascript: showReply('{{$comment->id}}');"><span>reply</span></a>
					</div>
			<div style="display:none" id="close_link{{$comment->id}}"><a class="siteButton smallButton" href="javascript: Hide('rep{{$comment->id}}');Show('rep_{{$comment->id}}');Hide('close_link{{$comment->id}}')"><span>close</span></a></div>
			<div class="commentform" id="rep{{$comment->id}}" style="display:none;"></div>
		</div><!-- div class="commentcontent" -->
    </div><!-- div class="commentbody" --> 

	
	
	