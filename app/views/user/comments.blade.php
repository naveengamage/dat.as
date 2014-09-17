@extends('layouts.master')
@section('content')
<table width="100%" cellspacing="0" cellpadding="0" class="doublecelltable">
	<tbody><tr>
		<td width="100%"> 			           
			<h1 class="nickname">{{ $user->username }}<span title="Reputation" class="repValue @if($user->rep < 0) negative @else positive @endif">{{$user->rep}}</span> </h1>
			<div class="lightgrey font12px"><span class="aclColor_1">{{$user->levelName()}}</span></div>
				
			<div class="tabs">
				<ul class="tabNavigation">
					<li><a href="/user/{{ $user->username }}/" class="darkButton"><span>profile</span></a></li>
					@if(!Auth::guest() && $user->id == Auth::user()->id) <li><a href="/user/{{ $user->username }}/recentimages/" class="darkButton "><span>images</span></a></li> @endif
					@if($user->allFriends()->count() != 0) <li><a href="/user/{{ $user->username }}/friends/" class="darkButton"><span>Friends <i class="menuValue">{{$user->allFriends()->count() }}</i></span></a></li>   @endif   
					<li><a href="/user/{{ $user->username }}/comments/" class="darkButton selectedTab"><span>Comments <i class="menuValue">1</i></span></a></li>           
				</ul>
				<hr class="tabsSeparator">
			</div>

			<h2>Latest {{$user->username}} comments</h2>
			<table cellpadding="0" cellspacing="0" class="data clear">
				<tbody>
					<tr class="firstr">
						<th class="left width50perc nobr">comment</th>
						<th class="left width50perc">left on</th>
						<th class="lasttd right">age</th>
					</tr>
					@foreach($comments as $comment)
					<tr class="odd" id="comment{{$comment->id}}">
						<td><div class="iaconbox floatright">
								<a rel="nofollow" title="Go to that comment" href="/comments/show/{{$comment->id}}/" class="icomment icon16"><span></span></a>
							</div>
										{{$comment->comment}}
							</td>
						@if($comment->type() == 'file')
							<td>
								<div class="iaconbox floatright">	
										@if($comment->get_media()->totalComments() != 0)
											<a rel="{{$comment->get_media()->id}},0" class="icomment icommentjs icon16" href="/{{$comment->get_media()->slug}}-t{{$comment->get_media()->id}}.html#comment"> <em class="iconvalue">{{$comment->get_media()->totalComments()}}</em><span></span> </a>		
										@endif									
									@if($comment->get_media()->is_verified)<a class="iverify icon16" href="/{{$comment->get_media()->slug}}-t{{$comment->get_media()->id}}.html" title="Verified Torrent"><span></span></a>	 @endif			<a title="Download torrent file" href="/{{$comment->get_media()->slug}}-t{{$comment->get_media()->id}}.html" class="idownload icon16"><span></span></a>
								</div>
								<div class="markeredBlock torType {{$comment->get_media()->type()}}">
								<a class="normalgrey font12px plain item" href="/{{$comment->get_media()->slug}}-t{{$comment->get_media()->id}}.html#comment"><span class="fn">{{$comment->get_media()->title}}</span></a>
								</div>
							</td>
						@elseif($comment->type() == 'profile')
							<td><a class="plain" href="/user/{{$comment->get_profile()->username}}/">{{$comment->get_profile()->username}}</a></td>
						@endif
						
						<td class="right">{{$comment->time_elapsed_string_short($comment->created_at) }}</td>
					</tr>
					@endforeach
				</tbody>
			</table>

		</td>
		<td class="sidebarCell">
			@include('layouts.sidebar', array('show_control'=> true))
		</td>
	</tr>
</tbody></table>
 @stop