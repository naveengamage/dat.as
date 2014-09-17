<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="Content-Style-Type" content="text/css"/>
    <meta name="description" content="Search and download new TV shows &amp; TV series, movies, mp3, music and PC/PS2/PSP/Wii/Xbox games absolutely for free."/>
    <title>Download Torrents. Fast and Free Torrent Downloads - ThatAssLinks</title>
    <link rel="stylesheet" type="text/css" href="/all-ee4f1df.css" charset="utf-8" />
    <link rel="shortcut icon" href="/images/favicon.ico" />
    

    <link rel="apple-touch-icon" href="/images/apple-touch-icon.png" />

    <!--[if IE 8]>
    <link href="/css/ie8.css" rel="stylesheet" type="text/css"/>
    <![endif]-->

    <!--[if lt IE 9]>
    <script src="/js/html5.min-ee4f1df.js" type="text/javascript"></script>
    <![endif]-->

    <!--[if gte IE 9]>
    <link href="//kastatic.com/css/ie9-ee4f1df.css" rel="stylesheet" type="text/css"/>
    <![endif]-->
    <script>
        var dat = {
            release_id: 'ee4f1df',
            detect_lang: 0,
            spare_click: 1        };
    </script>
    <script src="/all-ee4f1df.js" type="text/javascript"></script>
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
<body>
	<div id="wrapper">
		<div id="wrapperInner">
	
	<div id="changeIE6">
		<p>&nbsp;</p>
		<div class="browserIcons">
			<a href="http://www.getfirefox.com/" target="_blank" rel="external" class="browsersIconsFirefox"></a>
			<a href="http://www.apple.com/safari/" target="_blank" rel="external" class="browsersIconsSafari"></a>
			<a href="http://www.google.com/chrome/" target="_blank" rel="external" class="browsersIconsChrome"></a>
			<a href="http://www.opera.com/" target="_blank" rel="external" class="browsersIconsOpera"></a>
		</div><!-- div class="alternativeBrowsersIcons" -->
	</div><!-- div class="changeIE6" -->
	<div id="logindiv"></div>
	<header>
		<div class="headmenu">
			<form name="logoutform" action="/auth/logout/" method="post" style="display:none"><input type="hidden" name="csrf_token" value="c1679c279baaf2a71d927bafa40a50df"/></form>
			<ul>
			@if(Auth::guest())
				<li id="loginbut" class="last"><a href="/auth/login/" class="ajaxLink">login / register</a></li>
			@else
				<li id="loginbut" class="last"><a href="/auth/logout/" onclick="return doLogout();" class="floatleft">logout</a></li>
			@endif
				<li><a href="/browse/">Browse</a></li>
				<li><a href="/new/">latest</a></li>
			</ul>
		</div>
		<div class="headmainpart">
			<div class="iebigbox">
				<a class="logo" href="/"></a>
				
				<form action="/usearch/" method="get" id="searchform" accept-charset="utf-8" onsubmit="return doSearch(this.q.value);">
					<div class="toppad10px floatright">
						<button type="submit" class="siteButton searchButton" value="" onfocus="this.blur();" onclick="this.blur();"><span>Search</span></button>
						<div class="searchGroup">
							<div class="search">
								<input id="search_box" type="text" name="q" value="" autocomplete="off" placeholder="Search query" />
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</header>
@if(!Auth::guest())
<div id="navstyle" class="clear">
	<div class="logo3"></div>
	<ul>
		<li class="last"><a class="ajaxLink" href="/settings/">settings</a></li>
		<li><a href="/user/{{Auth::user()->username}}/">profile</a></li>
		<li><a href="/upload/">upload</a></li>
		<li><a id="menu_feedback" href="/feedback/">feedback <i class="menuValue" @if(Auth::user()->totalFB() == 0) style="display:none" @endif > {{ Auth::user()->totalFB() }}</i></a></li>
		<li id="menu_messages_count"><a href="/messenger/">messages <i class="menuValue" @if(Auth::user()->message_count() == 0) style="display:none" @endif >{{ Auth::user()->message_count() }}</i></a></li>
	</ul>

</div>
@if(Auth::user()->id == 1)
<div id="navstyle" class="clear">
	<ul>
		<li class="last"><a href="/modr/re-uploads/">re-uploads</a></li>
		<li><a href="/modr/re-upload/">re-upload requests</a></li>
		<li><a href="/modr/reports/users/">reported users</a></li>
		<li><a href="/modr/reports/files/">reported files</a></li>
		<li><a href="/modr/reports/comments/">reported comments</a></li>
		<li><a href="/modr/files/new/">new files</a></li>
	</ul>
</div>
@endif
@endif
@if(Request::is('/'))
	@if(Auth::guest() || Auth::user()->show_tc)
<div id="tagcloud" class="tagcloud folded">	<a href="/search/1080p/" class="tag7">1080p</a>
	<a href="/search/2013/" class="tag2">2013</a>
	<a href="/search/2014/" class="tag10">2014</a>
	<a href="/search/22%20jump%20street/" class="tag1">22 jump street</a>
	<a href="/search/3d/" class="tag4">3d</a>
	<a href="/search/720p/" class="tag2">720p</a>
	<a href="/search/android/" class="tag2">android</a>
	<a href="/search/apk/" class="tag2">apk</a>
	<a href="/search/batman/" class="tag2">batman</a>
	<a href="/search/dawn%20of%20the%20planet%20of%20the%20apes/" class="tag2">dawn of the planet of the apes</a>
	<a href="/search/discography/" class="tag3">discography</a>
	<a href="/search/doctor%20who/" class="tag2">doctor who</a>
	<a href="/search/dutchreleaseteam/" class="tag2">dutchreleaseteam</a>
	<a href="/search/dvdrip/" class="tag3">dvdrip</a>
	<a href="/search/edge%20of%20tomorrow/" class="tag2">edge of tomorrow</a>
	<a href="/search/french/" class="tag6">french</a>
	<a href="/search/game%20of%20thrones/" class="tag1">game of thrones</a>
	<a href="/search/godzilla/" class="tag2">godzilla</a>
	<a href="/search/guardians%20of%20the%20galaxy/" class="tag4">guardians of the galaxy</a>
	<a href="/search/hannibal%20s01e03%20.avi/" class="tag10">hannibal s01e03 .avi</a>
	<a href="/search/hercules/" class="tag2">hercules</a>
	<a href="/search/hindi/" class="tag7">hindi</a>
	<a href="/search/hindi%202014/" class="tag3">hindi 2014</a>
	<a href="/search/how%20to%20train%20your%20dragon%202/" class="tag3">how to train your dragon 2</a>
	<a href="/search/ita/" class="tag3">ita</a>
	<a href="/search/lucy/" class="tag3">lucy</a>
	<a href="/search/lynda/" class="tag2">lynda</a>
	<a href="/search/malayalam/" class="tag2">malayalam</a>
	<a href="/search/maleficent/" class="tag2">maleficent</a>
	<a href="/search/movies/" class="tag3">movies</a>
	<a href="/search/nl/" class="tag2">nl</a>
	<a href="/search/nosteam/" class="tag2">nosteam</a>
	<a href="/search/pc%20games/" class="tag2">pc games</a>
	<a href="/search/tamil/" class="tag3">tamil</a>
	<a href="/search/teenage%20mutant%20ninja%20turtles/" class="tag2">teenage mutant ninja turtles</a>
	<a href="/search/telugu/" class="tag3">telugu</a>
	<a href="/search/the%20fault%20in%20our%20stars/" class="tag2">The fault in our stars</a>
	<a href="/search/the%20strain/" class="tag2">the strain</a>
	<a href="/search/the%20walking%20dead/" class="tag2">the walking dead</a>
	<a href="/search/transformers%3A%20age%20of%20extinction/" class="tag3">Transformers: Age Of Extinction</a>
	<a href="/search/true%20blood/" class="tag2">true blood</a>
	<a href="/search/under%20the%20dome/" class="tag2">under the dome</a>
	<a href="/search/under%20the%20dome%20s02e09/" class="tag2">under the dome s02e09</a>
	<a href="/search/wwe/" class="tag1">wwe</a>
	<a href="/search/x%20art/" class="tag2">x art</a>
	<a href="/search/yify/" class="tag10">yify</a>
	<a href="/search/yify%201080p/" class="tag5">yify 1080p</a>
	<a href="/search/yify%20720p/" class="tag6">yify 720p</a>
</div>
		@else
			<div id="tagcloud" class="tagcloud folded" style="display:none"></div>
		@endif

		@if(Auth::guest())
			<a class="line50perc showmore botmarg0 ajaxLink" href="/auth/login/" title="hide tagcloud"><span class="font80perc">&#x25B2;</span></a>
		@else
			@if(Auth::user()->show_tc)
				<a class="line50perc showmore botmarg0" onclick="toggleTags(this);" title="Hide tagcloud"><span class="font80perc">▲</span></a>
			@else
				<a class="line50perc showmore botmarg0" onclick="toggleTags(this, 1);" title="show tagcloud"><span class="font80perc">▼</span></a>
			@endif
		@endif
@endif
			<div class="mainpart">
				@if(!Auth::guest())
					@if(Auth::user()->achievements()->where('seen','=',0)->count() != 0)
						<div id="achievements">
							@foreach(Auth::user()->achievements()->where('seen','=',0)->get() as $arch)
							<div style="display: none;">
								<div class="achievement" style="width: 300px" data-achievement-id="{{$arch->id}}">
									<h2>Achievement Unlocked!</h2>
									@if($arch->type == 0)
										<img title="{{$arch->name}}" src="/images/achMedal_simple.jpg" />
									@elseif($arch->type == 1)
										<img title="{{$arch->name}}" src="/images/achMedal_bronze.jpg" />
									@elseif($arch->type == 2)
										<img title="{{$arch->name}}" src="/images/achMedal_silver.jpg" />
									@elseif($arch->type == 3)
										<img title="{{$arch->name}}" src="/images/achMedal_gold.jpg" />
									@elseif($arch->type == 4)
										<img title="{{$arch->name}}" src="/images/achMedal_special.jpg" />
									@endif
									<h1><a href="/achievements/{{$arch->name}}/">{{$arch->name}}</a></h1>
									<div>Congratulations! You&#039;ve downloaded your first torrent.</div>
								</div>
							</div>
							@endforeach
						</div>
					@endif
				@endif
			 @if(Session::get('note') != '' && Session::get('note_type') != '')
				@if(Session::get('note_type') == 'error')
					<table border="0" align="center" style="margin: 0 auto" id="alerttable">
						<tbody>
							<tr>
								<td><div class="alertfield">{{ Session::get("note") }}</div></td>
							</tr>
						</tbody>
					</table>
				@else
					<div class="goodalertfield">{{ Session::get("note") }}</div>
				@endif
				        <?php Session::forget('note'); Session::forget('note_type'); ?>
			@endif
 @yield('content')
			</div>


	</div><!--id="main"-->
</div><!--id="wrap"-->

<footer class="lightgrey">

    <ul>
		<li>This site's template is designed by Kickass Torrents ( kickass.to ) team</li>
	</ul>
	<ul>
        <li>BitCoin: 19CWNopXCHSwWtWQ89NHC471LMn2Gy5j5G</li>
    </ul>   
</footer>

</body>
</html>
 
