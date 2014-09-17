<?php
	$rep = $user->rep;
	$username = $user->username;
	if($user->rep < 0){
		$rep_status = 'negative';
	}else{
		$rep_status = 'positive';
	}
	if($user->isOnline()){
		$online = "online";
	}else{
		$online = "offline";
	}
?>

<h3>The reason to REPORT this user? (<span class="badgeInline"><span class="{{$online}}" title="{{$online}}"></span> <span class="aclColor_2"><a class="plain" href="/user/{{$username}}/">{{$username}}</a></span><span title="Reputation" class="repValue {{$rep_status}}">{{$rep}}</span> <a href="/messenger/create/{{$username}}/" title="send private message" class="imessage ajaxLink icon16"><span></span></a></span>)</h3>
<div><strong>Please add a reason and a good explanation on why do you think the user is violating the rules.<br />
You can also provide links to files, screenshots, etc...</strong></div>
<div class="novertpad"><div class="alertHeightContainer"><div id="requestStatus" class="goodalertfield" style="display:none;"></div></div></div>
<form action="/account/report/{{$user->hash}}/" method="post" accept-charset="utf-8" class="ajaxFormReload">
	<textarea class="botmarg5px" name="reason" rows="10" style="width: 99%" required></textarea>
	<div class="buttonsline">
	    <a href="#" class="siteButton bigButton" onclick="$.fancybox.close();return false;"><span>cancel</span></a>
		<button type="submit" class="siteButton bigButton"><span>submit</span></button>
	</div>
</form>
