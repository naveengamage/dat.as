@extends('layouts.master')
@section('content')

	<table width="750" border="0">
		<tr>
			<td class="novertpad" colspan="2"><div class="alertHeightContainer"><div id="requestStatus" class="goodalertfield" style="display:none;"></div></div></td>
		</tr>
		<tr>
    		<td style="border-right: 1px solid #CCC" class="valignTop">
				<h2>Free Registration</h2>
				<noscript><div class="alertfield">You need javascript to sign up</div></noscript>
<script type="text/javascript" charset="utf-8">
$(document).ready(function() {
	$('#password').showPassword();
});
function checkUserName(name) {
    if (!name) return;
	$('#usercheck').html('<img src="//dat.as/images/indicator.gif" />');
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
	<form id="form_register_box" method="post" action="/auth/register/" onsubmit="proof(this);">
		<input type="hidden" name="return_uri" value="{{$return}}"/>
		<table class="formtable valignTop">
			<tr>
				<td class="width100px">E-mail <span class="asterisk">*</span></td>
				<td><input required type="email" name="email" value="" class="textinput "/></td>
			</tr>
			<tr>
				<td>Nickname <span class="asterisk">*</span></td>
				<td><input required type="text" name="nickname" value="" class="textinput" onblur="checkUserName(this.value)"/><span id="usercheck" style="padding: 2px 5px 3px 5px;"></span></td>
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

			</td>
    		<td style="padding-left:30px;"  class="valignTop">
				<h2>Login</h2>
<div id="loginform">
<form method="post" action="/auth/login/" >
	<input type="hidden" name="return_uri" id="return_uri" value="{{$return}}"/>
	<div id="errordiv" style="display:none; color: red;"></div>
	<table class="formtable" border="0">
	<tr>
		<td>E-mail</td>
		<td><input required type="email" name="email" id="field_email" class="textinput" value="" autofocus /></td>
	</tr>
	<tr>
		<td class="valignTop width100px">Password</td>
		<td><input required type="password" name="password" id="field_password" class="textinput botmarg5px" value=""/>
		<label class="block font11px lightgrey"><a href="/auth/remind_password/" class="ajaxLink">Forgot your password?</a></label>
		</td>
    </tr>
	<tr>
		<td colspan="2"><br /><div class="buttonsline">
			<div id="setself" class="floatright"><table id="authBox_306975_table" class="authBoxTable" style="margin:0px;padding:0px;border:0px;" cellpadding="0" cellspacing="1" border="0"><tbody><tr id="authBox_306975_tr" class="authBoxTr"><td id="authBox_306975_td" class="authBoxTd authBox_306975_td" provider="facebook" style="width:32px;height:32px;" onmouseover="this.style.opacity=0.75;this.style.filter='alpha(opacity=75)'" onmouseout="this.style.opacity=1;this.style.filter='';1"><div id="authBox_306975_block" class="authBoxBlock authBox_306975_block" style="width:32px;height:32px;"> <a href="/auth/login/facebook"><img src="//setself.com/content/images/authbox/facebook-32x32.png"></a></div></td><td id="authBox_306975_td" class="authBoxTd authBox_306975_td" provider="google" style="width: 32px; height: 32px; opacity: 1;" onmouseover="this.style.opacity=0.75;this.style.filter='alpha(opacity=75)'" onmouseout="this.style.opacity=1;this.style.filter='';1"><div id="authBox_306975_block" class="authBoxBlock authBox_306975_block" style="width:32px;height:32px;"> <a href="/auth/login/google"><img src="//setself.com/content/images/authbox/google-32x32.png"></a></div></td><td id="authBox_306975_td" class="authBoxTd authBox_306975_td" provider="yahoo" style="width:32px;height:32px;" onmouseover="this.style.opacity=0.75;this.style.filter='alpha(opacity=75)'" onmouseout="this.style.opacity=1;this.style.filter='';1"><div id="authBox_306975_block" class="authBoxBlock authBox_306975_block" style="width:32px;height:32px;"><a href="/auth/login/yahoo"><img src="//setself.com/content/images/authbox/yahoo-32x32.png"></a></div></td><td id="authBox_306975_td" class="authBoxTd authBox_306975_td" provider="twitter" style="width:32px;height:32px;" onmouseover="this.style.opacity=0.75;this.style.filter='alpha(opacity=75)'" onmouseout="this.style.opacity=1;this.style.filter='';1"><div id="authBox_306975_block" class="authBoxBlock authBox_306975_block" style="width:32px;height:32px;"><a href="/auth/login/twitter"><img src="//setself.com/content/images/authbox/twitter-32x32.png"></a></div></td></tr></tbody></table></div>	<button type="submit" id="butlogin" class="siteButton bigButton floatleft"><span>login</span></button>
		</div>
		</td>
    </tr>
	</table>
</form>
</div>

			</td>
  		</tr>
	</table>
@stop