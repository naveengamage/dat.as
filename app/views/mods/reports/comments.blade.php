@extends('layouts.master')
@section('content')
<table width="100%" cellspacing="0" cellpadding="0" class="doublecelltable">
	<tbody>
		<tr>
			<td width="100%">
				@if(count($reports) == 0)
					<center><h2>No comments awaiting review</h2></center>
				@else
				<h1>Reported comments</h1>
				<div class="buttonsline">
					
				</div>
				<table cellpadding="0" cellspacing="0" class="data">
					<tbody>
						<tr class="firstr">
							<th class="center">id</th>
							<th class="width50perc">comment</th>
							<th class="center red">comment owner</th>
							<th class="width50perc center">left on file</th>
							<th class="center">reported by</th> 
							<th class="lasttd nobr"><span class="leech">action</span></th>
						</tr>
						<?php $counter = 0; ?>
						@foreach($reports as $r)
						<tr class="@if($counter % 2 == 0)even @else odd @endif" id="torrent_{{$r->id}}">
							<td class="center">{{ $counter }} </td>
							<td class="nobr">
								@if($r->comment()->type() == 'file')
									<a href="/{{ $r->media()->slug }}-t{{ $r->media()->id }}.html" class="cellMainLink">{{ $r->comment()->getComment() }}</a>
								@elseif($r->comment()->type() == 'profile')
									<a href="/user/{{$r->comment()->get_profile()->username}}/" class="cellMainLink">{{ $r->comment()->getComment() }}</a>
								@endif
							</td>							
							<td class="nobr center">
								{{ $r->comment()->get_owner() }}
							</td>
							<td>
								@if($r->comment()->type() == 'file')
								<div class="torrentname">
									<a href="/{{ $r->media()->slug }}-t{{ $r->media()->id }}.html" class="torType {{$r->media()->type()}}"></a>
									<a href="/{{ $r->media()->slug }}-t{{ $r->media()->id }}.html" class="normalgrey font12px plain bold"></a>
									<div class="markeredBlock torType {{$r->media()->type()}}">
										<a href="/{{ $r->media()->slug }}-t{{ $r->media()->id }}.html" class="cellMainLink">{{ $r->media()->title }}</a>
										<span class="font11px lightgrey block">Posted by <a class="plain" href="/user/{{$r->media()->user()->username}}/">{{$r->media()->user()->username}}</a>@if($r->media()->is_verified)&nbsp;<img src="/images/verifup.png" alt="verified"> @endif in <span id="cat_{{$r->media()->category()->id}}"><strong><a href="/{{$r->media()->category()->url}}/">{{$r->media()->category()->name}}</a> @if($r->media()->sub_id != 0) &gt; <a href="/{{$r->media()->subcategory()->url}}/">{{$r->media()->subcategory()->name}}</a> @endif</strong></span> </span>
									</div> 
								</div>
								@elseif($r->comment()->type() == 'profile')
									<a class="plain" href="/user/{{$r->comment()->get_profile()->username}}/">{{$r->comment()->get_profile()->username}}</a>
								@endif
							</td>
							<td class="center"> {{ $r->get_owner() }} </td>				
							<td class="center"> 
								<a onclick="requestReupload('37', this);" class="icon16 textButton width100perc irefresh"><span></span>Ignore & Warn</a><br><br>
								<a onclick="requestReupload('37', this);" class="icon16 textButton width100perc irefresh"><span></span>ban user</a><br><br> 
								<a onclick="requestReupload('37', this);" class="icon16 textButton width100perc irefresh"><span></span>ban user and ip</a>
							</td>

						</tr>
						<?php $counter++; ?>
						@endforeach
					</tbody>
				</table>
					<?php echo $reports->links(); ?>
				@endif
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

</script>
@stop