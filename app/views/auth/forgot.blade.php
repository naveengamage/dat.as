@extends('layouts.master')
@section('content')
<h1>Password Reminder</h1>

    <div id="requestStatus" class="goodalertfield" style="display:none;"></div>
	<form action="/auth/remind_password/" method="post">
		E-mail or Nickname&nbsp;<input type="text" required name="login" value="" class="textinput" autofocus />
		<div class="buttonsline">
            <a href="#" class="siteButton bigButton" onclick="$.fancybox.close();return false;"><span>cancel</span></a>
    		<button type="submit" class="siteButton bigButton"><span>submit</span></button>
    	</div>
	</form>
 
</div>
@stop