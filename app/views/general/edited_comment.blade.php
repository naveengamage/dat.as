{{ $comment->getComment() }}
    <div class="objectAttachmentsJs overauto topmarg10px">
		@if(!empty($comment->image_ids))
			@foreach(json_decode($comment->image_ids) as $userpic)
				<?php $pic_status = UserPic::where('id', '=' , $userpic)->first(); ?>
				@if(isset($pic_status->id) && !$pic_status->deleted)
					<div class="galleryThumbSizerStills inlineblock">
						<a href="/uploads/user/{{$comment->user_id}}/or/{{$userpic}}.png" class="galleryThumb ajaxLink" rel="gallery_{{$comment->id}}">
							<img src="/uploads/user/{{$comment->user_id}}/thumb/{{$userpic}}.png" alt="" />
						</a>
					</div> 
				@endif
			@endforeach
		@endif
    </div>
@if( $comment->edited)
<p class="font11px lightgrey italic" id="edited_{{$comment->id}}">Last edited by <span class="badgeInline"><span class="@if($comment->user()->isOnline()) online @else offline @endif" title="@if($comment->user()->isOnline()) online @else offline @endif"></span> <span class="aclColor_1"><a class="plain" href="/user/{{ $comment->editor()->username }}/">{{ $comment->editor()->username }}</a></span></span>, just&nbsp;now</p>
@endif