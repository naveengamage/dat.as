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
					@if(!Auth::guest() && $user->id == Auth::user()->id)<li><a href="/user/{{ $user->username }}/recentimages/" class="darkButton selectedTab"><span>images</span></a></li>@endif
					@if($user->allFriends()->count() != 0) <li><a href="/user/{{ $user->username }}/friends/" class="darkButton"><span>Friends <i class="menuValue">{{$user->allFriends()->count() }}</i></span></a></li>   @endif   
					<li><a href="/user/{{ $user->username }}/comments/" class="darkButton "><span>Comments <i class="menuValue">2</i></span></a></li>            		        
				</ul>
				<hr class="tabsSeparator" />
			</div>
		@if($user->id == Auth::user()->id)
			<div>
				<div class="pages marg0 floatright">   
					<a href="/user/{{ $user->username }}/recentimages/" class="turnoverButton siteButton bigButton active">Recent</a>
				</div>
				<h2 style="clear: none;">Recent Uploads</h2>
				<div style="padding: 20px 5px;" class="ui-selectable">
					@foreach(Auth::user()->userpics() as $userpic)
					<div class="galleryThumbSizerStills inlineblock">
								<a href="/image/delete/{{$userpic->id}}/" data-id="{{$userpic->id}}" class="deleteImageJs icross icon16 redButton topmarg2px leftmarg2px absolute"><span></span></a>
								<a href="/uploads/user/{{Auth::user()->id}}/or/{{$userpic->id}}.png" class="galleryThumb ajaxLink" rel="recentimages">
							<img class="lazyjs" data-original="/uploads/user/{{Auth::user()->id}}/thumb/{{$userpic->id}}.png" src="/images/blank.gif" />
						</a>
					</div>
					@endforeach
					<div class="clear"></div>
				</div>

				<script type="text/javascript">
				$(document).on('click', '.deleteImageJs', function() {
					if (confirm('Are you sure you want delete this image?')) {
						var a = $(this);
						$.post(a.attr('href'), function() {
							a.parent().slideUp(function() {
								$(this).remove();
							});
						}, 'json');
					}
					return false;
				});
				$('.ui-selectable').selectable({
					cancel: '.deleteImageJs',
					filter: '.galleryThumbSizerStills',
					distance: 5,
					stop: function() {
						var $this = $(this), elem = $this.find('.ui-selected .deleteImageJs'), size = elem.size();
						$this.next('button').remove();
						if (size > 1) {
							$this.after($('<button type="submit" class="siteButton smallButton"><span>Delete ' + size + ' image(s)</span></button>').click(function() {
								if (confirm('Are you sure you want delete ' + size + ' image(s)?')) {
									var btn = $(this), ids = [];
									elem.each(function() {
										ids.push($(this).data('id'));
									});
									$.post("/image/delete/'", { ids: ids }, function() {
										btn.remove();
										elem.parent().slideUp(function() {
											$(this).remove();
										});
									}, 'json');
								}
							}));
						}
					}
				});
				</script>


            </div>
			@endif
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
