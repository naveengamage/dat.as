    @extends('layouts.master')
@section('content')

<div class="margauto width900px">
    <h1>Upload File: <span>Update Details</span></h1>
    <div id="requestStatus" class="goodalertfield" style="display: none;"></div>
    <center><img src="/images/indicator.gif" id="progress" style="display: none;"></center>
    <div id="output" class="correctTorrent">

<form action="/upload/details/" method="post" enctype="multipart/form-data" class="uploadForm">
	<input type="hidden" name="ajax" value="1"/>
	<input type="hidden" name="file_id" value="{{$code}}"/>
<link rel="stylesheet" type="text/css" href="/js/markitup/skins/markitup/style.css" />
<link rel="stylesheet" type="text/css" href="/js/markitup/sets/bbcode/style.css" />
<script type="text/javascript" src="/js/markitup/jquery.markitup-4060bcf.js"></script>

<script type="text/javascript">
function loadEditor () {
	$('#bbcode').val(toBBcode($('#bbcode').val()));
	$('#bbcode').markItUp(mySettings);
}
function loadSettings () {
	var head  = document.getElementsByTagName('head')[0];
	var script= document.createElement('script');
	script.type = 'text/javascript';
	script.src  = ('https:' == document.location.protocol ? 'https:' : 'http:') + '//wowiii.com/js/markitup/sets/bbcode/set-4060bcf.js';
	head.appendChild(script);
	script.onload = loadEditor;
}
$(document).ready(function() {
	var head  = document.getElementsByTagName('head')[0];
	var script= document.createElement('script');
	script.type = 'text/javascript';
	script.src  = ('https:' == document.location.protocol ? 'https:' : 'http:') + '//wowiii.com/js/markitup/jquery.markitup-4060bcf.js';
	head.appendChild(script);
    script.onload = loadSettings;

	var style = document.createElement('link');
    style.setAttribute("rel", "stylesheet");
    style.setAttribute("type", "text/css");
    style.setAttribute("href", ('https:' == document.location.protocol ? 'https:' : 'http:') + '//wowiii.com/js/markitup/skins/markitup/style-4060bcf.css');
	head.appendChild(style);
	var style = document.createElement('link');
    style.setAttribute("rel", "stylesheet");
    style.setAttribute("type", "text/css");
    style.setAttribute("href", ('https:' == document.location.protocol ? 'https:' : 'http:') + '//wowiii.com/js/markitup/sets/bbcode/style-4060bcf.css');
    head.appendChild(style);
});
</script>
<table border="0" class="formtable correctPicture" style="width:100%; position:relative; display: block">
<tbody>
<tr>
	<td>Category</td><td>&nbsp;</td>
		<td>
			<select  name="categoryId" id="categoryId" onchange="uploadChangeCat();">
				<option value="0">Please Select Category</option>
				<?php $main_name = "Other" ?>
				@foreach($main_cats as $main_cat)
					@if($main_cat->id == $main_id)
						<?php $main_name = $main_cat->name; ?>
						<option value="{{ $main_cat->id }}" selected="selected">{{ strtolower($main_cat->name) }}</option>
					@else
						<option value="{{ $main_cat->id }}">{{ strtolower($main_cat->name) }}</option>
					@endif
				@endforeach

			</select>&nbsp;
			<span id="subcat">
				@if(count($sub_cats) != 0)
					<select class="mediuminput" name="sub_cat">
						<option value="0">Please Select Sub Category</option>
						@foreach($sub_cats as $sub_cat)
							@if($sub_cat->id == $sub_id)
								<option value="{{ $sub_cat->id }}" selected="selected">{{ $sub_cat->name }}</option>
							@else
								<option value="{{ $sub_cat->id }}">{{ $sub_cat->name }}</option>
							@endif
						@endforeach
					</select>
				@endif
			</span>
	</td>
</tr>
<tr>
	<td class="capital">file name</td><td><span class="red">*</span></td>
	<td><input class="primary textinput longinput" type="text" name="name" value=""/></td>
</tr>
<tr>
	<td>File Size</td><td><span class="red">*</span></td>
		<td>
			<input class="primary shortinput textinput" type="text" name="size" value=""/>&nbsp;
	
				<select  name="size_suffix">
					<option value="Bytes">Bytes</option>
					<option value="KB">KB</option>
					<option value="MB">MB</option>
					<option value="GB">GB</option>
					<option value="TB">TB</option>
					<option value="PB">PB</option>
						
				</select>

	</td>
</tr>

</tbody>
@if($main_name == "Movies")
<tbody id="movie">
@else
<tbody id="movie" style="display:none">
@endif
<tr>
 
	<td>Movie Title</td><td>&nbsp;</td>
	<td><input class="primary textinput longinput" type="text" id="movie_name" name="movie_name" value=""/>&nbsp;
		<div id="movie_cover" style="display:none;z-index:1000;position: absolute;top:0;right:0;">
		</div>
	</td>
</tr>
<tr>
	<td>IMDb <a rel="nofollow" target="_blank" href="http://imdb.com/">?</a></td><td><span class="red">*</span></td>
	<td><input class="primary shortinput textinput" type="text" name="imdbid" value="" id="imdbid"/></td>
</tr>
<tr>
	<?php $qts = array("", "1080p", "720p", "Blu-Ray", "BDRip", "HDRiP", "DVD", "DVDRip", "x264", "VCD", "MPEG-4", "TVRip", "VHSRip", "Screener", "TeleSync", "Telecine", "Workprint", "Cam", "iPhone", "Unknown"); ?>

	<td>Movie Quality</td>
	<td><span class="red">*</span></td>
	<td><select name="quality" id="quality">
			@foreach($qts as $q)
				<option value="{{$q}}">{{$q}}</option>
			@endforeach
		</select>
	</td>
</tr>
</tbody>

@if($main_name == "Music")
<tbody id="music">
@else
<tbody id="music" style="display:none">
@endif
<tr>
	<td>Artist Name</td><td><span class="red">*</span></td>
	<td><input id="artist_name" class="primary textinput longinput" type="text" name="artist_name" value=""/>&nbsp;
		<div id="music_cover" style="display:none;z-index:1000;position: absolute;top:0;right:0;">
				</div>
	</td>
</tr>
<tr>
	<td>Album Title</td><td>&nbsp;</td>
		<td><input id="album_name" class="primary textinput longinput" type="text" name="album_name" value=""/>&nbsp;</td>
	</tr>
<tr>
	<td>MusicBrainz ID <a rel="nofollow" target="_blank" href="http://musicbrainz.org/">?</a></td><td>&nbsp;</td>
	<td><input id="mb_id" class="primary longinput textinput" type="text" name="mb_id" value=""/></td>
</tr>
<tr>
	<td>Audio Quality</td><td><span class="red">*</span></td>
	<td><select id="mquality" name="mquality"><option value="lossy">Lossy</option><option value="lossless">Lossless</option></select></td>
</tr>
</tbody>
@if($main_name == "Games")
<tbody id="game">
@else
<tbody id="game" style="display:none">
@endif
<tr>
 
	<td>Game Name</td><td>&nbsp;</td>
	<td><input class="primary textinput longinput" type="text" id="game_name" name="game_name" value=""/>
		<div id="game_cover" style="display:none;z-index:1000;position: absolute;top:0;right:0;">
				</div>
	</td>
</tr>
<tr>
	<td>Platform</td><td>&nbsp;</td>
	<td><select name="platform_id" id="platform_id">
			<?php $platforms = DB::table('sub_platform')->get(); ?>
				@foreach($platforms as $platform)
					<option value="{{$platform->id}}">{{$platform->name}}</option>
				@endforeach
		</select>
	</td>
</tr>
</tbody>
@if($main_name == "Books")
<tbody id="book">
@else
<tbody id="book" style="display:none">
@endif
<tr>
	<td>Book Title</td><td>&nbsp;</td>
	<td><input class="primary textinput longinput" type="text" value="" readonly/></td>
</tr>
<tr>
	<td>Book Author</td><td>&nbsp;</td>
	<td><input class="primary textinput longinput" type="text" value="" readonly/></td>
</tr>
<tr>
	<td>ISBN</td><td>&nbsp;</td>
	<td><input class="primary textinput mediuminput" type="text" name="isbn" value=""/></td>
</tr>
</tbody>
@if($main_name == "Anime")
<tbody id="anime">
@else
<tbody id="anime" style="display:none">
@endif
<tr>
	<td>Anime Title</td><td>&nbsp;</td>
	<td><input class="primary textinput longinput" type="text" id="anime_name" name="anime_name" value=""/>&nbsp;
		<div id="anime_cover" style="z-index:1000;position: absolute;top:0;right:0;">
		</div>
	</td>
</tr>
<tr>
	<td>AniDB ID <a rel="nofollow" target="_blank" href="http://anidb.net/">?</a></td><td><span class="red">*</span></td>
	<td><input class="primary shortinput textinput" type="text" name="anidbid" value="" id="anidbid"/></td>
</tr>
<tr>
	<td>Rip Quality</td>
	<td><span class="red">*</span></td>
	<td>
		<select name="aquality" id="aquality">
			@foreach($qts as $q)
				<option value="{{$q}}">{{$q}}</option>
			@endforeach
		</select>
	</td>
</tr>
<tr>
	<td>Episode No</td><td>&nbsp;</td>
	<td><input class="textinput extrashortinput" type="text" name="aepisode" id="aepisode" value=""/></td>
</tr>
</tbody>
@if($main_name == "TV")
<tbody id="tvshow">
@else
<tbody id="tvshow" style="display:none">
@endif
<tr>
					<td>TV Show</td><td>&nbsp;</td>
	<td>
		<input class="textinput longinput" type="text" id="tv_name" name="tv_name" value=""/>
		<div id="tv_cover" style="display:none;z-index:1000; float:right; position: absolute; top:0; right: -26px;">
			<a class="movieCover" href="/-tv"><img src="/images/nocover.png" width="120"></a>
		</div>
	</td>
	<tr>
    	<td>TVRage ID <a rel="nofollow" target="_blank" href="http://www.tvrage.com/">?</a></td><td><span class="red">*</span></td>
		<td><input class="primary shortinput textinput" type="text" name="tvrage_id" value="" id="tvrage_id"/></td>
    </tr>
</tr>
<tr>
	<td>Season and Episode</td><td>&nbsp;</td>
	<td><span class="valignMiddle">S:&nbsp;</span><input class="textinput extrashortinput" type="text" name="season" id="season" value=""/>&nbsp;<span class="valignMiddle">E:&nbsp;</span><input class="textinput extrashortinput" type="text" name="episode" id="episode" value=""/></td>
</tr>
</tbody>

@if($main_name != "Music" && $main_name != "Applications" && $main_name != "XXX" && $main_name != "Other" && $main_name != "Books")
<tbody id="langs">
@else
<tbody id="langs" style="display:none">
@endif
	<tr>
		<td>Audio Language</td><td>&nbsp;</td>
		<td><select name="languages" id="languages" multiple>
			<?php $langs = DB::table('sub_lang')->get(); ?>
				@foreach($langs as $lang)
					<option value="{{$lang->id}}">{{$lang->name}}</option>
				@endforeach
			</select>
		</td>
	</tr>
</tbody>

@if($main_name != "Music" && $main_name != "Games" && $main_name != "Applications" && $main_name != "XXX" && $main_name != "Other" && $main_name != "Books")
<tbody id="subs">
@else
<tbody id="subs" style="display:none">
@endif
	<tr>
		<td>Subtitle Language</td><td>&nbsp;</td>
		<td><select name="subtitles" id="subtitles">
				<?php $langs = DB::table('sub_lang')->get(); ?>
				@foreach($langs as $lang)
					<option value="{{$lang->id}}">{{$lang->name}}</option>
				@endforeach
			</select>
		</td>
	</tr>
</tbody>

@if($main_name != "Music" && $main_name != "Games" && $main_name != "Applications" && $main_name != "Other" && $main_name != "Books")
<tbody id="scrcp">
@else
<tbody id="scrcp" style="display:none">
@endif
	<tr>
		<td class="toppad5px">Screencap</td><td>&nbsp;</td>
		<td>
            <div class="overauto relative">
                        </div>
            <a href="#" class="imageSelectorJs siteButton smallButton botmarg10px" rel="screencap"><span>add screencap</span></a>
		</td>
	</tr>
</tbody>


@if($main_name != "Music" && $main_name != "Applications" && $main_name != "Other" && $main_name != "Books")
<tbody id="scrns">
@else
<tbody id="scrns" style="display:none">
@endif
	<tr>
		<td class="toppad5px">Screenshots</td><td>&nbsp;</td>
		<td>
            <div class="overauto relative">
                        </div>
            <a href="#" class="imageSelectorJs siteButton smallButton botmarg10px" rel="screenshot"><span>add screenshot</span></a>
		</td>
	</tr>
</tbody>


<tbody>
<tr>
	<td class="toppad5px">Description</td><td>&nbsp;</td>
		<td><textarea class="botmarg5px" name="desc"  rows="24" id="bbcode"></textarea></td>
</tr>
</tbody>
@if($main_name != "Other" && $main_name != "Applications" && $main_name != "Anime" && $main_name != "Books")
<tbody id="completeness">
@else
<tbody id="completeness" style="display:none">
@endif
<tr>
    <td>Completeness</td><td>&nbsp;</td>
    <td>
            <div class="indicator" style="float: none; width: 534px;">
    <span class="indicatorHackValue">5%</span>
    <div class="min" style="width: 5%;">
        <span class="blank">5%</span>
    </div>
</div>

    </td>
</tr>
</tbody>


<tbody>
<tr>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>
        <div class="buttonsline">
            <button type="submit" class="siteButton bigButton" id="butupload"><span>save</span></button>
        </div>
    </td>
</tr>
</tbody>
</table>
</form>
<script type="text/javascript" charset="utf-8">
$(document).ready(function() {
        function get_completeness() {
        var category = parseInt($('#categoryId').val()), form = $('.uploadForm'), max = score = 0;
        switch (category) {
            case 14: max = 22; break;
            case 17: max = 20; break;
            case 22: max = 8; break;
            case 15: max = 21; break;
            case 20: max = 22; break;
            case 19: max = 8; break;
            case 16: max = 13; break;
            default: max = 3; break;
        }
        if ($('input[name=name]', form).val()) score += 1;
		if ($('input[name=size]', form).val()) score += 1;
        if ($('textarea[name=desc]', form).val()) score += 1;
        if (category == 14) {
            if ($('input[name=movie_name]', form).val()) score += 2;
            if ($('input[name=imdbid]', form).val()) score += 5;
            if ($('select[name=quality]', form).val()) score += 3;
        } else if (category == 17) {
            if ($('input[name=game_name]', form).val()) score += 5;
            if ($('select[name=platform_id]', form).val()) score += 3;
        } else if (category == 15) {
            if ($('input[name=tv_name]', form).val()) score += 5;
            if ($('input[name=season]', form).val()) score += 2;
            if ($('input[name=episode]', form).val()) score += 2;
        } else if (category == 20) {
            if ($('input[name=anime_name]', form).val()) score += 5;
            if ($('input[name=aepisode]', form).val()) score += 2;
            if ($('select[name=aquality]', form).val()) score += 3;
        } else if (category == 19) {
            if ($('input[name=isbn]', form).val()) score += 5;
        } else if (category == 16) {
            if ($('input[name=artist_name]', form).val()) score += 5;
            if ($('input[name=album_name]', form).val()) score += 5;
            if ($('input[name=episode]', form).val()) score += 2;
        }
        if (category == 14 || category == 17 || category == 15 || category == 20) {
            if ($('#languages').next('.holder').find('li:not(#languages_annoninput)').size()) score += 4;
        }
        if (category == 14 || category == 17 || category == 15 || category == 22) {
            if ($('#scrcp,#scrns').find('a.deleteImageJs').size()) score += 5;
        }
        return Math.round(score * 100 / max);
    }
    setInterval(function() {
        if ($('#completeness:visible').size()) {
            var i = $('#completeness .indicator'), c = get_completeness(), v = c + '%';
            if (i.find('.blank').text() != v) {
                var cl = '';
                if (c >= 80) cl = 'max';
                else if (c >= 30 && c < 80) cl = 'mid';
                else if (c > 30 && c < 30) cl = '';
                else cl = 'min';
                i.find('span').text(v);
                i.find('div').attr('class', cl).animate({ width: v });
            }
        }
    }, 1000);
        $('.imageSelectorJs').imageSelector({
        select: function(images) {
            var a = $(this),
                type = a.prop('rel'),
                target = $(this).prev();
            for (var i in images) {
                target.append(
                    $('<div/>')
                        .attr('class', 'galleryThumbSizerStills inlineblock')
                        .append($('<input/>')
                            .attr('type', 'hidden')
                            .attr('name', type + '_image_ids[]')
                            .val(images[i].id))
                        .append($('<a/>')
                            .attr('class', 'deleteImageJs icross icon16 topmarg2px leftmarg2px absolute')
                            .append('<span/>'))
                        .append($('<a/>')
                            .attr('class', 'galleryThumb')
                            .attr('href', images[i].link)
                            .fancybox()
                            .append($('<img/>')
                                .attr('src', images[i].thumb_link))));
            }
        }
    });
    $(document).on('click', '.deleteImageJs', function() {
        $(this).parent().fadeOut(function() {
            $(this).remove();
        });
        return false;
    });
	$("#movie_name").autocomplete({
		source: "/media/searchmovie/",
		minLength: 2,
		method: "POST",
		zIndex: 2000,
		select: function( event, ui ) {
			var imdbid = ("0000000" + ui.item.id).slice(-7);
			$("#imdbid").val(imdbid);
			$("#movie_cover").html('<a class="movieCover" href="/'+ui.item.value+'-i'+imdbid+'/"><img src="'+ui.item.cover+'" width="120"></a>').show();
		}
	});
	$("#game_name").autocomplete({
		source: "/media/searchgame/",
		minLength: 2,
		method: "POST",
		zIndex: 2000,
		select: function( event, ui ) {
			$("#game_cover").html('<a class="movieCover" href="/'+ui.item.value+'-g'+ui.item.id+'/"><img src="'+ui.item.cover+'" width="120"></a>').show();
		}
	});
	$("#tv_name").autocomplete({
		source: "/media/searchtvshow/",
		minLength: 2,
		method: "POST",
		zIndex: 2000,
		select: function( event, ui ) {
			$("#tvrage_id").val(ui.item.id);
			$("#tv_cover").html('<a class="movieCover" href="'+ui.item.link+'"><img src="'+ui.item.cover+'" width="120"></a>').show();
		}
	});
	$("#artist_name").autocomplete({
		source: "/media/searchartist/",
		minLength: 2,
		method: "POST",
		zIndex: 2000,
		select: function( event, ui ) {
			$("#mb_id").val(ui.item.id);
			$("#music_cover").html('<a class="movieCover" href="'+ui.item.link+'"><img src="'+ui.item.cover+'" width="120"></a>').show();
		}
	});
	$("#languages").fcbkcomplete({ cache: false, addontab: true, height: 10, filter_selected: true, firstselected: true, input_min_size: 1 });
	$("#subtitles").fcbkcomplete({ cache: false, addontab: true, height: 10, filter_selected: true, firstselected: true, input_min_size: 1 });
	$('.uploadForm').ajaxForm(uploadFormOptions);
	$('.inputfile').customFileInput();
});
</script>

</div>
</div>
<script src="/js/upload-4060bcf.js" type="text/javascript" charset="utf-8"></script>
 
@stop