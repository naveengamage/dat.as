@extends('layouts.master')
@section('content')

<table width="100%" cellspacing="0" cellpadding="0" class="doublecelltable">
	<tr>
		<td width="100%"> 	
		
			<h1 class="nickname">{{ $user->username }}<span title="Reputation" class="repValue @if($user->rep < 0) negative @else positive @endif">{{$user->rep}}</span> </h1>
			<div class="lightgrey font12px"><span class="aclColor_1">{{$user->levelName()}}</span></div>
			<div class="tabs">
				<ul class="tabNavigation">
					<li><a href="/user/{{ $user->username }}/" class="darkButton "><span>profile</span></a></li>
					@if(!Auth::guest() && $user->id == Auth::user()->id)<li><a href="/user/{{ $user->username }}/recentimages/" class="darkButton"><span>images</span></a></li>@endif
					@if($user->allFriends()->count() != 0) <li><a href="/user/{{ $user->username }}/friends/" class="darkButton selectedTab"><span>Friends <i class="menuValue">{{$user->allFriends()->count() }}</i></span></a></li>   @endif        
					<li><a href="/user/{{ $user->username }}/comments/" class="darkButton "><span>Comments <i class="menuValue">2</i></span></a></li>             		 
													
				</ul>
				<hr class="tabsSeparator" />
			</div>

			<h2>Friends</h2>
			<div class="botmarg10px overauto clear">
				@foreach($user->allFriends()->get() as $friend)
					<div class="badge">
						<div class="userPic">
							<div class="userPicHeight relative">
								<a href="/user/{{$friend->user($user->id)->username}}/">
									@if(!empty($friend->user($user->id)->avatar))
										<img src="/uploads/user/{{$friend->user($user->id)->id}}/thumb/{{$friend->user($user->id)->avatar}}.png">
									@else
										<img src="/images/user/commentlogo.png">
									@endif
								</a>		
							</div>
							<div class="badgeSiteStatus">
								<span class="@if($friend->user($user->id)->isOnline()) online @else offline @endif" title="@if($friend->user($user->id)->isOnline()) online @else offline @endif"></span>
							</div>
						</div><!-- div class="userPic" -->
						<div class="badgeInfo">
							<span class="badgeUsernamejs font12px overhidden nobr">
									<a class="plain" href="/user/{{$friend->user($user->id)->username}}/">{{$friend->user($user->id)->username}}</a><span title="Reputation" class="repValue @if($friend->user($user->id)->rep < 0) negative @else positive @endif">{{$friend->user($user->id)->rep}}</span>
							</span>
							<span class="font10px lightgrey aclColor_1">{{$friend->user($user->id)->levelName()}}</span>    

						</div>
					</div><!-- div class="badge" -->  
				@endforeach	
			</div>
			
		</td>
		<td class="sidebarCell">
			<a class="hideSidebar" id="hidesidebar" onclick="hideSidebar();"></a>
			<div id="sidebar" class="sidebarLogged font11px">
					<div id="_119b0a17fab5493361a252d04bf527db"></div>



				<div class="sliderbox">
					<h3>Friends Links</h3>
					<ul>
						
						<li>
							<a href="http://torrents.to/" target="_blank" rel="external">
								<span class="itorrentsto thirdPartIcons"></span>Torrents.to
							</a>
						</li>
						<li>
							<a href="http://www.torrentdownloads.net/" target="_blank" rel="external">
								<span class="itorrentdownloads thirdPartIcons"></span>Torrent Downloads
							</a>
						</li>
						
						<li>
							<a href="http://www.torrentreactor.net/" target="_blank" rel="external">
								<span class="itorreact thirdPartIcons"></span>TorrentReactor
							</a>
						</li>
						

						<li>
							<a href="http://torrent-finder.info/" target="_blank" rel="external">
								<span class="itorrentfinder thirdPartIcons"></span>Torrent Finder
							</a>
						</li>
					</ul>
				</div><!-- div class="sliderbox" -->
					
			</div>
			<a class="showSidebar" id="showsidebar" onclick="showSidebar();" style="display:none;"></a>

        </td>
	</tr>
</table>
@stop