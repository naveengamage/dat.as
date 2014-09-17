@extends('layouts.master')
@section('content')
				<table width="100%" cellspacing="0" cellpadding="0" class="doublecelltable">
					<tr>
						<td width="100%">
							<h2><a class="plain" href="/movies/">Movies Links</a> <a class="rsssign" target="_blank" href="/movies/?rss=1" title="category feed"></a></h2>

							<div>
							<table cellpadding="0" cellspacing="0" class="data" style="width: 100%">
								<tr class="firstr">
									<th class="width100perc nopad">file name</th>
									<th class="center">size</th>
									<th class="center">links</th>
									<th class="center">age</th>
									<th class="center">watch links</th>
									<th class="lasttd nobr center">download links</th>
								</tr>
								<?php $counter = 0; ?>
								@foreach($movies as $movie)
								<tr class="@if($counter % 2 == 0)even @else odd @endif">
									<td>
										@if($movie->totalComments() != 0)
											<div class="iaconbox floatright">  <a rel="{{$movie->id}},0" class="icomment icommentjs icon16" href="/{{$movie->slug}}-t{{$movie->id}}.html#comment"> <em class="iconvalue">{{$movie->totalComments()}}</em><span></span> </a> </div>				
										@endif
										
										<div class="markeredBlock torType filmType">
											<a href="/{{$movie->slug}}-t{{$movie->id}}.html" class="cellMainLink">{{$movie->title}}</a></div>
									</td>
									<td class="nobr center">{{$movie->size}} <span>{{$movie->size_suffix}}</span></td>
									<td class="center">{{$movie->total_links()}}</td>
									<td class="center">{{$movie->time_elapsed_string($movie->created_at)}}</td>
									<td class="green center">{{$movie->sm_links_count}}</td>
									<td class="green lasttd center">{{$movie->dl_links_count}}</td>
								</tr>
								<?php $counter++; ?>
								@endforeach
							</table>

							<h2><a class="plain" href="/tv/">TV Shows Links</a> <a class="rsssign" target="_blank" href="/tv/?rss=1" title="category feed"></a></h2>
							<div>
							<table cellpadding="0" cellspacing="0" class="data" style="width: 100%">
								<tr class="firstr">
									<th class="width100perc nopad">file name</th>
									<th class="center">size</th>
									<th class="center">links</th>
									<th class="center">age</th>
									<th class="center">watch links</th>
									<th class="lasttd nobr center">download links</th>
								</tr>
								<?php $counter = 0; ?>
								@foreach($tvs as $tv)
								<tr class="@if($counter % 2 == 0)even @else odd @endif">
									<td>
										@if($tv->totalComments() != 0)
											<div class="iaconbox floatright">  <a rel="{{$tv->id}},0" class="icomment icommentjs icon16" href="/{{$tv->slug}}-t{{$tv->id}}.html#comment"> <em class="iconvalue">{{$tv->totalComments()}}</em><span></span> </a> </div>					
										@endif
										
										<div class="markeredBlock torType filmType">
											<a href="/{{$tv->slug}}-t{{$tv->id}}.html" class="cellMainLink">{{$tv->title}}</a></div>
									</td>
									<td class="nobr center">{{$tv->size}} <span>{{$tv->size_suffix}}</span></td>
									<td class="center">{{$tv->total_links()}}</td>
									<td class="center">{{$tv->time_elapsed_string($tv->created_at)}}</td>
									<td class="green center">{{$tv->sm_links_count}}</td>
									<td class="green lasttd center">{{$tv->dl_links_count}}</td>
								</tr>
								<?php $counter++; ?>
								@endforeach
							</table>

							<h2><a class="plain" href="/music/">Music Links</a> <a class="rsssign" target="_blank" href="/music/?rss=1" title="category feed"></a></h2>
							<div>
							<table cellpadding="0" cellspacing="0" class="data" style="width: 100%">
								<tr class="firstr">
									<th class="width100perc nopad">file name</th>
									<th class="center">size</th>
									<th class="center">links</th>
									<th class="center">age</th>
									<th class="center">watch links</th>
									<th class="lasttd nobr center">download links</th>
								</tr>
								<?php $counter = 0; ?>
								@foreach($musics as $music)
								<tr class="@if($counter % 2 == 0)even @else odd @endif">
									<td>
										@if($music->totalComments() != 0)
											<div class="iaconbox floatright">  <a rel="{{$music->id}},0" class="icomment icommentjs icon16" href="/{{$music->slug}}-t{{$music->id}}.html#comment"> <em class="iconvalue">{{$music->totalComments()}}</em><span></span> </a> </div>					
										@endif
										
										<div class="markeredBlock torType musicType">
											<a href="/{{$music->slug}}-t{{$music->id}}.html" class="cellMainLink">{{$music->title}}</a></div>
									</td>
									<td class="nobr center">{{$music->size}} <span>{{$music->size_suffix}}</span></td>
									<td class="center">{{$music->total_links()}}</td>
									<td class="center">{{$music->time_elapsed_string($music->created_at)}}</td>
									<td class="green center">{{$music->sm_links_count}}</td>
									<td class="green lasttd center">{{$music->dl_links_count}}</td>
								</tr>
								<?php $counter++; ?>
								@endforeach
							</table>

							<h2><a class="plain" href="/games/">Games Links</a> <a class="rsssign" target="_blank" href="/games/?rss=1" title="category feed"></a></h2>
							<div>
							<table cellpadding="0" cellspacing="0" class="data" style="width: 100%">
								<tr class="firstr">
									<th class="width100perc nopad">file name</th>
									<th class="center">size</th>
									<th class="center">links</th>
									<th class="center">age</th>
									<th class="center">watch links</th>
									<th class="lasttd nobr center">download links</th>
								</tr>
								<?php $counter = 0; ?>
								@foreach($games as $game)
								<tr class="@if($counter % 2 == 0)even @else odd @endif">
									<td>
										@if($game->totalComments() != 0)
											<div class="iaconbox floatright">  <a rel="{{$game->id}},0" class="icomment icommentjs icon16" href="/{{$game->slug}}-t{{$game->id}}.html#comment"> <em class="iconvalue">{{$game->totalComments()}}</em><span></span> </a></div> 					
										@endif
										
										<div class="markeredBlock torType zipType">
											<a href="/{{$game->slug}}-t{{$game->id}}.html" class="cellMainLink">{{$game->title}}</a></div>
									</td>
									<td class="nobr center">{{$game->size}} <span>{{$game->size_suffix}}</span></td>
									<td class="center">{{$game->total_links()}}</td>
									<td class="center">{{$game->time_elapsed_string($game->created_at)}}</td>
									<td class="green center">{{$game->sm_links_count}}</td>
									<td class="green lasttd center">{{$game->dl_links_count}}</td>
								</tr>
								<?php $counter++; ?>
								@endforeach
							</table>

							<h2><a class="plain" href="/applications/">PC Applications Links</a> <a class="rsssign" target="_blank" href="/applications/?rss=1" title="category feed"></a></h2>
							<div>
							<table cellpadding="0" cellspacing="0" class="data" style="width: 100%">
								<tr class="firstr">
									<th class="width100perc nopad">file name</th>
									<th class="center">size</th>
									<th class="center">links</th>
									<th class="center">age</th>
									<th class="center">watch links</th>
									<th class="lasttd nobr center">download links</th>
								</tr>
								<?php $counter = 0; ?>
								@foreach($pc_apps as $pc_app)
								<tr class="@if($counter % 2 == 0)even @else odd @endif">
									<td>
										@if($pc_app->totalComments() != 0)
											<div class="iaconbox floatright">  <a rel="{{$pc_app->id}},0" class="icomment icommentjs icon16" href="/{{$pc_app->slug}}-t{{$pc_app->id}}.html#comment"> <em class="iconvalue">{{$pc_app->totalComments()}}</em><span></span> </a> 	</div>				
										@endif
										
										<div class="markeredBlock torType zipType">
											<a href="/{{$pc_app->slug}}-t{{$pc_app->id}}.html" class="cellMainLink">{{$pc_app->title}}</a></div>
									</td>
									<td class="nobr center">{{$pc_app->size}} <span>{{$pc_app->size_suffix}}</span></td>
									<td class="center">{{$pc_app->total_links()}}</td>
									<td class="center">{{$pc_app->time_elapsed_string($pc_app->created_at)}}</td>
									<td class="green center">{{$pc_app->sm_links_count}}</td>
									<td class="green lasttd center">{{$pc_app->dl_links_count}}</td>
								</tr>
								<?php $counter++; ?>
								@endforeach
							</table>

							<h2><a class="plain" href="/anime/">Mobile Applications Links</a> <a class="rsssign" target="_blank" href="/anime/?rss=1" title="category feed"></a></h2>
							<div>
							<table cellpadding="0" cellspacing="0" class="data" style="width: 100%">
								<tr class="firstr">
									<th class="width100perc nopad">file name</th>
									<th class="center">size</th>
									<th class="center">links</th>
									<th class="center">age</th>
									<th class="center">watch links</th>
									<th class="lasttd nobr center">download links</th>
								</tr>
								<?php $counter = 0; ?>
								@foreach($mobile_apps as $mobile_app)
								<tr class="@if($counter % 2 == 0)even @else odd @endif">
									<td>
										@if($mobile_app->totalComments() != 0)
											<div class="iaconbox floatright">  <a rel="{{$mobile_app->id}},0" class="icomment icommentjs icon16" href="/{{$mobile_app->slug}}-t{{$mobile_app->id}}.html#comment"> <em class="iconvalue">{{$mobile_app->totalComments()}}</em><span></span> </a> 	</div>				
										@endif
										
										<div class="markeredBlock torType filmType">
											<a href="/{{$mobile_app->slug}}-t{{$mobile_app->id}}.html" class="cellMainLink">{{$mobile_app->title}}</a></div>
									</td>
									<td class="nobr center">{{$mobile_app->size}} <span>{{$mobile_app->size_suffix}}</span></td>
									<td class="center">{{$mobile_app->total_links()}}</td>
									<td class="center">{{$mobile_app->time_elapsed_string($mobile_app->created_at)}}</td>
									<td class="green center">{{$mobile_app->sm_links_count}}</td>
									<td class="green lasttd center">{{$mobile_app->dl_links_count}}</td>
								</tr>
								<?php $counter++; ?>
								@endforeach
							</table>

							<h2><a class="plain" href="/books/">Books Links</a> <a class="rsssign" target="_blank" href="/books/?rss=1" title="category feed"></a></h2>
							<div>
							<table cellpadding="0" cellspacing="0" class="data" style="width: 100%">
								<tr class="firstr">
									<th class="width100perc nopad">file name</th>
									<th class="center">size</th>
									<th class="center">links</th>
									<th class="center">age</th>
									<th class="center">watch links</th>
									<th class="lasttd nobr center">download links</th>
								</tr>
								<?php $counter = 0; ?>
								@foreach($books as $book)
								<tr class="@if($counter % 2 == 0)even @else odd @endif">
									<td>
										@if($book->totalComments() != 0)
											<div class="iaconbox floatright">  <a rel="{{$book->id}},0" class="icomment icommentjs icon16" href="/{{$book->slug}}-t{{$book->id}}.html#comment"> <em class="iconvalue">{{$book->totalComments()}}</em><span></span> </a> </div>					
										@endif
										
										<div class="markeredBlock torType pdfType">
											<a href="/{{$book->slug}}-t{{$book->id}}.html" class="cellMainLink">{{$book->title}}</a></div>
									</td>
									<td class="nobr center">{{$book->size}} <span>{{$book->size_suffix}}</span></td>
									<td class="center">{{$book->total_links()}}</td>
									<td class="center">{{$book->time_elapsed_string($book->created_at)}}</td>
									<td class="green center">{{$book->sm_links_count}}</td>
									<td class="green lasttd center">{{$book->dl_links_count}}</td>
								</tr>
								<?php $counter++; ?>
								@endforeach
							</table>
						</td>
						
						
						<td class="sidebarCell">
							@include('layouts.sidebar')
						</td>
					</tr>
				</table>
@stop