<html>

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"/></head>

<body>

	<?php $count = 0 ?>
	@foreach($comments as $comment)
		@if($count == 0)
			<p id="first" class="previewcomment">{{$comment->comment}}</p>
		@elseif($count == count($comments))
			<p id="last" class="previewcomment">{{$comment->comment}}</p>
		@else
			<p class="previewcomment">{{$comment->comment}}</p>
		@endif
		<?php $count++; ?>
	@endforeach
	
<a id="c9366162"></a>

<span class="ratestring" style="display:none">
	
	<div class="prevRating">
		<span class="statusIcon israting"></span>
		<strong>10<span class="opac5 font10px">/ 10</span></strong>
	</div>

	<span class="statusIcon isaudio"></span> 

	<strong class="white">9<span class="opac5 font10px">/ 10</span>

	</strong>&nbsp;&nbsp;&nbsp;

	<span class="statusIcon isvideo"></span> 

	<strong class="white">9<span class="opac5 font10px">/ 10</span>

	</strong>

</span>