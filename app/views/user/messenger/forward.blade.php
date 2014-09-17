@extends('layouts.master')
@section('content')


<table width="100%" cellspacing="0" cellpadding="0" class="doublecelltable">
    <tr>
        <td width="100%">
            <div class="floatright buttonsLine">
				<form action="/messenger/search/" method="get" accept-charset="utf-8">
					<input class="textinput" type="text" name="s" value="" required="required" />
					<button type="submit" class="siteButton bigButton"><span>Search Messages</span></button>
				</form>
			</div>
			<h1>Private Messages</h1>
			<div class="tabs clear">
				<ul class="tabNavigation">
															<li><a href="/messenger/" class="darkButton "><span>Dialogs</span></a></li>
					<li><a href="/messenger/create/" class="darkButton "><span>Create new</span></a></li>
				</ul>
				<hr class="tabsSeparator" />
			</div>

			<form action="/messenger/create/" method="post">
                <div class="alertHeightContainer"><div id="requestStatus" class="goodalertfield" style="display:none;"></div></div>
                <p>
                    <select placeholder="Recipient" name="targets[]" title="Recipient" multiple="multiple" id="message_recipient_{{Auth::user()->id}}">
                                        </select>
                </p>
                <p>
                    <textarea rows="10" cols="40" name="text" required="required" id="message_content_6777" class="quicksubmit" autofocus="autofocus">

{{$message->forward()}}</textarea>
                </p>
                <div class="buttonsline">
                    <input type="hidden" name="target" value="" />
                    <input type="hidden" name="csrf_token" value="177f8fe0b2cfd3a39f20188e401b0eaa" />
                    <button type="submit" class="siteButton bigButton"><span>send</span></button>
                </div>
            </form>
        </td>
        <td class="sidebarCell">
  
        </td>
    </tr>
</table>
<script type="text/javascript">
$(document).ready(function() {
    $("#message_recipient_{{Auth::user()->id}}").fcbkcomplete({ json_url: "/account/search/", cache: false,	addontab: true,	height: 10,	filter_selected: true, complete_text: "Enter Recipient Name", firstselected: true, char_limit: 1, newel: true });
    $("#message_content_{{Auth::user()->id}}").bbedit({ attachImage: false });
});
</script>

@stop