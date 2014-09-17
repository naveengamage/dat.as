@extends('layouts.master')
@section('content')


<table width="100%" cellspacing="0" cellpadding="0" class="doublecelltable" id="mainSearchTable">
	<tbody><tr>
		<td width="100%">
									            								    
			
	        
			<div><h2>All posts<span>  results 1-25 from 10000</span>  <a class="rsssign" target="_blank" href="http://kickass.to/new/rss/" title="rss"></a></h2>


	<table cellpadding="0" cellspacing="0" class="data" style="width: 100%">
		<tbody><tr class="firstr">
				<th class="width100perc nopad">file name</th>
				<th class="center"><a href="/new/?field=size&amp;sorder=desc" rel="nofollow">size</a></th>
				<th class="center"><span class="files"><a href="/new/?field=files_count&amp;sorder=desc" rel="nofollow">links</a></span></th>
				<th class="center"><span><a href="/new/?field=time_add&amp;sorder=desc" rel="nofollow">age</a></span></th>
				<th class="center"><span class="seed"><a href="/new/?field=seeders&amp;sorder=desc" rel="nofollow">watch links</a></span></th>
				<th class="lasttd nobr center"><a href="/new/?field=leechers&amp;sorder=desc" rel="nofollow">download links</a></th>
				</tr>
				<?php $counter = 0; ?>
				@foreach($media as $m)
				<tr class="@if($counter % 2 == 0)even @else odd @endif" id="torrent_all_torrents{{$m->id}}"> 
					<td>
						<div class="iaconbox floatright">
							<a title="Download torrent file" href="/{{ $m->slug }}-t{{ $m->id }}.html" class="idownload icon16 askFeedbackjs"><span></span></a>
						</div>
						<div class="torrentname">
							<a href="/{{ $m->slug }}-t{{ $m->id }}.html" class="torType pdfType"></a>
							<a href="/{{ $m->slug }}-t{{ $m->id }}.html" class="normalgrey font12px plain bold"></a>
							<div class="markeredBlock torType pdfType">
								<a href="/{{ $m->slug }}-t{{ $m->id }}.html" class="cellMainLink">{{ $m->title }}</a>
								<span class="font11px lightgrey block">Posted by <a class="plain" href="/user/{{$m->user()->username}}/">{{$m->user()->username}}</a> @if($m->is_verified) &nbsp;  <img src="/images/verifup.png" alt="verified"> @endif in <span id="cat_{{$m->category()->id}}"><strong><a href="/{{$m->category()->url}}/">{{$m->category()->name}}</a> @if($m->sub_id != 0) &gt; <a href="/{{$m->subcategory()->url}}/">{{$m->subcategory()->name}}</a> @endif</strong></span> </span>
							</div>
						</div>
					</td>
					<td class="nobr center">{{ $m->size }} <span>{{$m->size_suffix }}</span></td>
					<td class="center">1</td>
					<td class="center">39&nbsp;sec.</td>
					<td class="green center">0</td>
					<td class="red lasttd center">0</td>
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