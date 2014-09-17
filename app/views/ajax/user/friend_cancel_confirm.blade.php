<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="Content-Style-Type" content="text/css"/>
    <meta http-equiv="cache-control" content="no-cache, must-revalidate">
    <meta http-equiv="expires" content="0">
    <meta http-equiv="pragma" content="no-cache" />
    <meta http-equiv="X-UA-Compatible" content="IE=Edge"/>
    <script src="//kastatic.com/js/xhr-4060bcf.js" type="text/javascript"></script>
</head>
<body>


<center><h2>Confirm your action</h2></center>

<div id="requestStatus" class="goodalertfield" style="display:none;"></div>
<form action="/friend/cancel/{{$username}}/" method="post" class="ajaxFormReload">
    <input type="hidden" name="return_uri" value="{{$return}}"/>
<center style="margin-top: 15px">
    <div class="buttonsline">
        <a href="#" class="siteButton bigButton" onclick="$.fancybox.close();return false;"><span>cancel</span></a>
    	<button type="submit" id="butconfirm" class="siteButton bigButton"><span>confirm</span></button>
    </div>
</center>
</form>
</body>
</html>