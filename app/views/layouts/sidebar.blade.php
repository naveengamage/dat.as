			@if(!Auth::guest())
				@if(Auth::guest() || Auth::user()->show_sb == 1)
					<a class="hideSidebar" id="hidesidebar" onclick="hideSidebar();"></a>
				@else
					<a class="hideSidebar" id="hidesidebar" style="display:none;" onclick="hideSidebar();"></a>
				@endif
			@endif
			
			 @if(Auth::guest() || Auth::user()->show_sb == 1)
				<div id="sidebar" class="sidebarLogged font11px">
			@else
				<div id="sidebar" style="display:none;"  class="sidebarLogged font11px">
			@endif
				<div id="_119b0a17fab5493361a252d04bf527db"></div>
					@if(isset($media) && isset($show_control) && $show_control)
						@if(!Auth::guest() && $media->user_id == Auth::user()->id)
						<div class="sliderbox">
							<h3>Post Control</h3>
							<ul>
								<li id="del_9365543">
									<a class="capital" onclick="if (confirm('Are you sure want to delete this torrent?')) " href="/moderator/torrent/deletetorrent/{{ $media->id }}/"><span class="redButton icross  icon16"><span></span></span>delete torrent</a>
								</li>
								<li><a class="capital" href="/file/edit/{{ $media->id }}/" title="Edit torrent"><span class="iedit icon16"><span></span></span>edit torrent</a></li>
		
								<li><a class="capital" href="/user/{{ $media->user()->username }}/uploads/"><span class="icon16"><span></span></span>uploads</a></li>
							</ul>
						</div>
						@endif
					@endif	
						<div class="sliderbox">
							<h3>Friends Links</h3>
							<ul>
								<li>
									<a href="http://kickass.to/" target="_blank" rel="external">
										<span class="ikat thirdPartIcons"></span>Kickass.to
									</a>
								</li>
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
			@if(!Auth::guest())
				@if(!Auth::guest() && Auth::user()->show_sb == 1)
					<a class="showSidebar" id="showsidebar" onclick="showSidebar();" style="display:none;"></a>
				@else
					<a class="showSidebar" id="showsidebar" onclick="showSidebar();"></a>			
				@endif
			@endif