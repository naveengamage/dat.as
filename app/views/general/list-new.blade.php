@extends('layouts.master')
@section('content')


<table width="100%" cellspacing="0" cellpadding="0" class="doublecelltable" id="mainSearchTable">
	<tbody><tr>
		<td width="100%">
									            								    
			
	        
			<div><h2>All posts<span>  results 1-25 from 10000</span>  <a class="rsssign" target="_blank" href="/new/rss/" title="rss"></a></h2>


	<table cellpadding="0" cellspacing="0" class="data" style="width: 100%">
		<tbody><tr class="firstr">
				<th class="width100perc nopad">file name</th>
				<th class="center"><a href="{{$current_url}}?field=size&amp;sorder={{$order_text["size"]}}" rel="nofollow">size</a></th>
				<th class="center"><span class="files"><a href="{{$current_url}}?field=links_count&amp;sorder={{$order_text["links_count"]}}" rel="nofollow">links</a></span></th>
				<th class="center"><span><a href="{{$current_url}}?field=time_add&amp;sorder={{$order_text["time_add"]}}" rel="nofollow">age</a></span></th>
				<th class="center"><span class="seed"><a href="{{$current_url}}?field=sm&amp;sorder={{$order_text["sm"]}}" rel="nofollow">watch links</a></span></th>
				<th class="lasttd nobr center"><a href="{{$current_url}}?field=dl&amp;sorder={{$order_text["dl"]}}" rel="nofollow">download links</a></th>
				</tr>
				<?php $counter = 0; ?>
				@foreach($media as $m)
				<tr class="@if($counter % 2 == 0)even @else odd @endif" id="torrent_all_torrents{{$m->id}}"> 
					<td>
						<div class="iaconbox floatright">
							@if($m->totalComments() != 0)
								<a rel="{{$m->id}},0" class="icomment icommentjs icon16" href="/{{$m->slug}}-t{{$m->id}}.html#comment"> <em class="iconvalue">{{$m->totalComments()}}</em><span></span> </a>
							@endif
							@if($m->is_verified)
								<a class="iverify icon16" href="/{{$m->slug}}-t{{$m->id}}.html" title="Verified File"><span></span></a>
							@endif
							<a title="Download file" href="/{{ $m->slug }}-t{{ $m->id }}.html" class="idownload icon16 askFeedbackjs"><span></span></a>
						</div>
						<div class="torrentname">
							<a href="/{{ $m->slug }}-t{{ $m->id }}.html" class="torType {{$m->type()}}"></a>
							<a href="/{{ $m->slug }}-t{{ $m->id }}.html" class="normalgrey font12px plain bold"></a>
							<div class="markeredBlock torType {{$m->type()}}">
								<a href="/{{ $m->slug }}-t{{ $m->id }}.html" class="cellMainLink">{{ $m->title }}</a>
								<span class="font11px lightgrey block">Posted by <a class="plain" href="/user/{{$m->user()->username}}/">{{$m->user()->username}}</a>@if($m->is_verified)&nbsp;<img src="/images/verifup.png" alt="verified"> @endif in <span id="cat_{{$m->category()->id}}"><strong><a href="/{{$m->category()->url}}/">{{$m->category()->name}}</a> @if($m->sub_id != 0) &gt; <a href="/{{$m->subcategory()->url}}/">{{$m->subcategory()->name}}</a> @endif</strong></span> </span>
							</div>
						</div>
					</td>
					<td class="nobr center">{{ $m->size }} <span>{{$m->size_suffix }}</span></td>
					<td class="center">{{$m->total_links()}}</td>
					<td class="center">{{ $m->time_elapsed_string($m->created_at) }}</td>
					<td class="green center">{{$m->sm_links_count}}</td>
					<td class="green lasttd center">{{$m->dl_links_count}}</td>
				</tr>
				<?php $counter++; ?>
				@endforeach

			</tbody></table>
			@if(isset($url))
			<?php echo $media->appends(array('url' => $url))->links(); ?>
			@else
			<?php echo $media->links(); ?>
			@endif
</div>
		</td>
		<td class="sidebarCell">
			@include('layouts.sidebar')
		</td>
	</tr>
</tbody></table>
<div class="rightcell">
</div><!-- div class="rightcell" -->
<div class="leftcell">
</div>
 

@stop