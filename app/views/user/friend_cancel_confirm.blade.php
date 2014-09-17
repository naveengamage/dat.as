@extends('layouts.master')
@section('content')
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
@stop