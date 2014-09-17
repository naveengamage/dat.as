<center><h2>Confirm your action</h2></center>

<div id="requestStatus" class="goodalertfield" style="display:none;"></div>
<form action="{{$link}}" onsubmit="window.location = '{{$link}}';return false;">
    <center><span class="red">Attention! Right now you are leaving ThatassLinks and we are not responsible for anything that might happen on this page:</span></center><br>
    <center><a rel="nofollow" href="{{$link}}">{{$link}}</a></center><br>
    <center><label><input type="checkbox" name="dont_ask" value="1" onchange="confirm_url(this);"> Check this if you don't want to be asked again.</label></center>
<center style="margin-top: 15px">
    <div class="buttonsline">
        <a href="#" class="siteButton bigButton" onclick="$.fancybox.close();return false;"><span>cancel</span></a>
    	<button type="submit" id="butconfirm" class="siteButton bigButton"><span>confirm</span></button>
    </div>
</center>
</form>