<form action="/comments/edit/{{$comment->id}}/" method="post" onsubmit="return saveComment(this, {{$comment->id}});">
	<input type="hidden" name="objectId" value="{{$comment->object_id}}"/>
	<input type="hidden" name="pid" value="0"/>
	<textarea class="botmarg5px" id="comment" name="content" rows=5 style="width:99%;height:100%">{{$comment->comment}}</textarea>
    <div class="objectAttachmentsJs overauto topmarg10px">
		@if(!empty($comment->image_ids))
			@foreach(json_decode($comment->image_ids) as $userpic)
				<?php $pic_status = UserPic::where('id', '=' , $userpic)->first(); ?>
				@if(isset($pic_status->id) && !$pic_status->deleted)
					<div class="galleryThumbSizerStills inlineblock">
						<input type="hidden" name="image_ids[]" value="{{$userpic}}" />
						<a href="#" class="deleteAttachmentJs icross icon16 topmarg2px leftmarg2px absolute"><span></span></a>
						<a href="/uploads/user/{{$comment->user_id}}/or/{{$userpic}}.png" class="galleryThumb ajaxLink" rel="gallery_{{$comment->id}}">
							<img src="/uploads/user/{{$comment->user_id}}/thumb/{{$userpic}}.png" alt="" />
						</a>
					</div>
				@endif
			@endforeach
		@endif
    </div>
<script>
$(function() {
    $('.deleteAttachmentJs').click(function() {
        $(this).parents('.galleryThumbSizerStills').eq(0).slideUp(function() {
            $(this).remove();
        });
        return false;
    });
});
</script>

	<div class="buttonsline">
		<a href="#" class="siteButton bigButton" onclick="return cancelEditComment({{$comment->id}});"><span>cancel</span></a>
		<button type="submit" class="siteButton bigButton"><span>save</span></button>
    </div>
</form>
<script type="text/javascript">
$(document).ready(function() { $("#comment").bbedit(); });
</script>

