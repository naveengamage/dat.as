<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="Content-Style-Type" content="text/css"/>
    <meta http-equiv="cache-control" content="no-cache, must-revalidate">
    <meta http-equiv="expires" content="0">
    <meta http-equiv="pragma" content="no-cache" />
    <meta http-equiv="X-UA-Compatible" content="IE=Edge"/>
    <script src="//kastatic.com/js/xhr-ee4f1df.js" type="text/javascript"></script>
</head>
<body>


<h1>Password Reminder</h1>

    <div id="requestStatus" class="goodalertfield" style="display:none;"></div>
	<form action="/auth/remind_password/" method="post" class="ajaxForm">
		E-mail or Nickname&nbsp;<input type="text" required name="login" value="" class="textinput" autofocus />
		<div class="buttonsline">
            <a href="#" class="siteButton bigButton" onclick="$.fancybox.close();return false;"><span>cancel</span></a>
    		<button type="submit" class="siteButton bigButton"><span>submit</span></button>
    	</div>
	</form>
</body>
</html>