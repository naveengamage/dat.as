@extends('layouts.master')
@section('content')
	<table width="100%" cellspacing="0" cellpadding="0" class="doublecelltable">
		<tbody>
			<tr>
				<td width="100%">
					<div class="errorpage">
						<h2>404</h2>
						<p><strong>Page not found</strong></p>
						<p>Page you are looking for is not found on the server. Make sure that you've entered the right URL or use the search function to find the page you're looking for.</p>
						<p><a href="/">Back to the KickassTorrents homepage</a></p>
					</div>
				</td>
				<td class="sidebarCell">      
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
		</tbody>

	</table>

@stop