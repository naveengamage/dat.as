@extends('layouts.master')
@section('content')
<table width="100%" cellspacing="0" cellpadding="0" class="doublecelltable">
	<tbody>
		<tr>
			<td width="100%">
				@if(isset($empty))
					<center><h2>No files awaiting feedback</h2></center>
				@else
				<h1>Torrents awaiting feedback</h1>
				<div class="buttonsline">
					<button type="submit" class="siteButton bigButton" onclick="discardSelected();"><span>discard selected</span></button>
				</div>
				<table cellpadding="0" cellspacing="0" class="data">
					<tbody>
						<tr class="firstr">
							<th class="lasttd"><input class="checkboxchecker" data-selector=".torrentboxes" type="checkbox"></th>
							<th class="width100perc">torrent name</th>
							<th class="center">size</th>
							<th class="center">downloaded</th> 
							<th class="lasttd nobr"><span class="leech">comment</span></th>
						</tr>
						<?php $counter = 0; ?>
						@foreach($mediafb as $m)
						<tr class="@if($counter % 2 == 0)even @else odd @endif" id="torrent_{{$m->id}}">
							<td class="lasttd"><input class="torrentboxes" type="checkbox" name="torrent[]" value="{{$m->id}}"></td> 
							<td>
							<div class="iaconbox floatright">
								@if($m->totalComments() != 0)<a rel="{{$m->id}},0" class="icomment icommentjs icon16" href="/{{$m->slug}}-t{{$m->id}}.html#comment"><em class="iconvalue">{{$m->totalComments()}}</em><span></span></a> @endif
								@if($m->is_verified) <a href="/{{$m->slug}}-t{{$m->id}}.html" title="Verified File" class="iverify icon16"><span></span></a>@endif
								<a title="Download file" href="/{{$m->slug}}-t{{$m->id}}.html" class="idownload icon16"><span></span></a>
							</div>
							<div class="markeredBlock torType {{$m->type()}}">
								<a href="/{{ $m->slug }}-t{{ $m->id }}.html" class="cellMainLink">{{ $m->title }}</a>
								<span class="font11px lightgrey block">Posted by <a class="plain" href="/user/{{$m->user()->username}}/">{{$m->user()->username}}</a>@if($m->is_verified)&nbsp;<img src="/images/verifup.png" alt="verified"> @endif in <span id="cat_{{$m->category()->id}}"><strong><a href="/{{$m->category()->url}}/">{{$m->category()->name}}</a> @if($m->sub_id != 0) &gt; <a href="/{{$m->subcategory()->url}}/">{{$m->subcategory()->name}}</a> @endif</strong></span> </span>
							</div>
							<td class="nobr center">{{ $m->size }} <span>{{$m->size_suffix }}</span></td>
							<td class="center">{{ $m->time_elapsed_string($m->created_at) }}</td>
							<td class="lasttd nobr valignTop right">
								<div class="commentformwidth feedbackpage withqrate">
									<form action="" id="form_{{$m->id}}" onsubmit="submitFeedback(this, {{$m->id}});return false;">
										<input type="hidden" name="objectId" value="{{$m->id}}">
										<div class="likeOrNotBox floatleft" id="feedback_{{$m->id}}">
											<a onclick="submitGood({{$m->id}}, '{{$m->id}}');" class="siteButton likeButton" title="Good"><span><label></label>{{$m->upVotes()}}</span></a><a onclick="submitBad({{$m->id}}, '{{$m->id}}');" class="siteButton dislikeButton" title="Bad"><span><label></label>{{$m->downVotes()}}</span></a>
										</div>
										<a class="plain leaveComment" onclick="$('#comment_{{$m->id}}').toggle();"><span class="circleButton">?</span> leave comment</a>
										<div style="display:none" id="comment_{{$m->id}}">
											<textarea class="botmarg5px feedbacktextarea" name="content" rows="6" cols="30"></textarea>
												<div class="qrateContainer feedback loggedCondition">
								<div class="qrate">
									<span>audio</span>
									<select name="audio_rate" id="audio_rate">
										<option value="" class="vote">vote </option>
										<option value="1">1 awful</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
										<option value="6">6</option>
										<option value="7">7</option>
										<option value="8">8</option>
										<option value="9">9</option>
										<option value="10">10 best</option>
									</select>
								</div>
								<span id="audioRating" class="torrentRating">8<span>/10</span></span>
							<!-- /div>
							<div class="qrateContainer feedback" -->
								<div class="qrate">
									<span>video </span>
									<select name="video_rate" id="video_rate">
										<option value="" class="vote">vote </option>
										<option value="1">1 awful</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
										<option value="6">6</option>
										<option value="7">7</option>
										<option value="8">8</option>
										<option value="9">9</option>
										<option value="10">10 best</option>
									</select>
								</div>
								<span id="videoRating" class="torrentRating">9<span>/10</span></span>
						</div><!-- div class="qrateContainer" -->

											<div class="buttonsline floatleft"><button type="submit" class="siteButton bigButton"><span>submit</span></button></div>
										</div>
									</form>
								</div>
							</td>
						</tr>
						<?php $counter++; ?>
						@endforeach
					</tbody>
				</table>
				@endif
			</td>
			<td class="sidebarCell">
			@include('layouts.sidebar', array('show_control'=> true))
			</td>
		</tr>
	</tbody>
</table>
<script type="text/javascript">
function submitGood (t_id, hash) {
	$.post('/posts/vote/like/'+hash+'/', { },
		function (data) {
            updateFeedback(-1);
	        $('#torrent_'+t_id).fadeOut(500, function() { $('#torrent_'+t_id).remove(); });
		});
}

function submitBad(t_id, hash) {
	$.post('/posts/vote/dislike/'+hash+'/', { },
		function (data) {
            updateFeedback(-1);
	        $('#torrent_'+t_id).fadeOut(500, function() { $('#torrent_'+t_id).remove(); });
		});
}
function submitFeedback(form, t_id) {
	if ((form.content.value != '') || ((form.audio_rate != undefined && form.audio_rate.value) && form.video_rate.value)) {
		var formData = $(form).serialize();
		formData = formData + '&ajax=1&turing=iamhuman';
		$.post('/comments/create/torrent/', formData);
        updateFeedback(-1);
        $("#comment_"+t_id).hide();
	}
	return false;
}

function discardSelected() {
	var result = "";
	var cnt = 0;
	$(".torrentboxes").each( function () {
		if ($(this).is(':checked')) {
			var id = $(this).val();
			$('#torrent_'+id).fadeOut(500, function() { $('#torrent_'+id).remove(); });
			result = result + id + ',';
			cnt++;
		}
	});
	result = result.substr(0, result.length-1);
	if (!cnt) return false;
    updateFeedback(-cnt);
	$.post('/account/discardfeedbacks/', { ids: result });
}
</script>
@stop