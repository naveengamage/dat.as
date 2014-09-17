<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="Content-Style-Type" content="text/css"/>
    <meta http-equiv="cache-control" content="no-cache, must-revalidate">
    <meta http-equiv="expires" content="0">
    <meta http-equiv="pragma" content="no-cache" />
    <meta http-equiv="X-UA-Compatible" content="IE=Edge"/>
    <script src="/js/xhr-e4d9fd3.js" type="text/javascript"></script>
</head>
<body>

<div class="novertpad"><div class="alertHeightContainer"><div id="requestStatus" class="goodalertfield" style="display:none;"></div></div></div>
	<h3>The reason to REPORT this torrent?</h3>
	<h5>This feature is for reporting Fake torrents only if:</h5>
	<ul class="textcontent font11px">
		<li>Torrents that are not released yet</li>
		<li>Torrents that ask you to d/l codecs from different sites</li>
		<li>Torrents that are password protected and the password is not in a text file with the torrent</li>
		<li>Torrents that have no trackers listed</li>
	</ul><br />
	<h5>Please do not use this button for:</h5>
	<ul class="textcontent font11px">
		<li>Reporting torrents that are dead</li>
		<li>Reporting torrents with no seeds</li>
		<li>Reporting software torrents that give false readings when using a/v scans</li>
		<li>Reporting torrents that you cant get to work, ie games that wont run or software that wont load properly,<br />
			movies that have sound but no picture or vice versa</li>
		<li>Reporting torrent that have trackers listed even if they are dead</li>
	</ul><br />
	<form action="/posts/report/{{$id}}/" method="post" accept-charset="utf-8" class="ajaxFormReload">
		<textarea class="botmarg5px" name="reason" id="report_reason" rows="3"></textarea>
		<div class="buttonsline"> <a href="#" class="siteButton bigButton" onclick="$.fancybox.close();return false;"><span>cancel</span></a>
			<button type="submit" class="siteButton bigButton"><span>submit</span></button>
		</div>
	</form>
</body>
</html>