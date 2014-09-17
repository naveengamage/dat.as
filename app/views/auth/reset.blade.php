@extends('layouts.master')
@section('content')
<h1>Create a new password</h1>

	<form action="/auth/change_password/{{$token}}/" method="post">
		New Password&nbsp;<input id="password" type="password" name="password" value="" class="textinput" autofocus />
		<div class="buttonsline">
    		<button type="submit" class="siteButton bigButton"><span>submit</span></button>
    	</div>
	</form>
<script type="text/javascript">
$(document).ready(function() {
    $('#password').showPassword();
});
</script>
 


@stop