@extends('layouts.master')
@section('content')


<div class="margauto" style="width:800px; margin: 0 auto">
		<h2>Free Registration</h2>
		<noscript><div class="alertfield">You need javascript to sign up</div></noscript>
<script type="text/javascript" charset="utf-8">
$(document).ready(function() {
	$('#password').showPassword();
});
function checkUserName(name) {
    if (!name) return;
	$('#usercheck').html('<img src="//kastatic.com/images/indicator.gif" />');
	$.post("/auth/check/"+encodeURIComponent(name)+"/", {} , function(response) {
	    if (response != '' || response != undefined || response != null || response.method == 'ok') {
	        if (response.html == 'fail') {
                return $('#usercheck').html('<span class="icon16 icross redButton" title="Username abusive or occupied."><span></span></span>');
	        } else if (response.html == 'ok') {
	            return $('#usercheck').html('<span class="icon16 icheck greenButton" title="Great username, mate!"><span></span></span>');
	        }
	    }
	    $('#usercheck').html('<span class="icon16 icross" title="Error"><span></span></span>');
	}, 'json');
}
</script>
<div id="regform">
	<form id="form_register_box" method="post" action="http://wowiii.com/auth/register/" onsubmit="proof(this);">
		<input type="hidden" name="return_uri" value="{{$return}}"/>
		<table class="formtable valignTop">
			<tr>
				<td class="width100px">E-mail <span class="asterisk">*</span></td>
				<td><input required type="email" name="email" value="ASDg@ovi.com" class="textinput "/></td>
			</tr>
			<tr>
				<td>Nickname <span class="asterisk">*</span></td>
				<td><input required type="text" name="nickname" value="ASDSA" class="textinput" onblur="checkUserName(this.value)"/><span id="usercheck" style="padding: 2px 5px 3px 5px;"></span></td>
			</tr>
			<tr>
				<td class="toppad5px">Password <span class="asterisk">*</span></td>
				<td><input required type="password" id="password" name="password" class="textinput botmarg5px"/></td>
			</tr>
            <tr>
                <td>&nbsp;</td>
                <td>
                    <img class="lazyjs captcha" src="/images/blank.gif" data-original="{{Captcha::img()}}" alt="CAPTCHA" title="Click to reload" style="width: 140px; height: 47px; cursor: pointer;" />

                    <a class="textButton itop icon16 captchareload"><span></span>Not seeing the captcha?</a>
                </td>
            </tr>
            <tr>
                <td class="toppad5px">Captcha <span class="asterisk">*</span></td>
                <td><input type="text" name="captcha" class="textinput botmarg5px" required="required" /></td>
            </tr>
			<tr>
				<td>
					<button type="submit" class="siteButton bigButton" id="butcreateaccount"><span>Create Account</span></button>
				</td>
			</tr>
            <tr>
                <td class="checkandtext" colspan=2>
                    <small class="lightgrey"> When you create an account, you agree to <a href="/tos.html" target="_blank">the terms of service</a></small>
                </td>
            </tr>
		</table>
	</form>
</div>

	</div>
	
	@stop