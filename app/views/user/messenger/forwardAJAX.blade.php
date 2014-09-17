<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="Content-Style-Type" content="text/css"/>
    <meta http-equiv="cache-control" content="no-cache, must-revalidate">
    <meta http-equiv="expires" content="0">
    <meta http-equiv="pragma" content="no-cache" />
    <meta http-equiv="X-UA-Compatible" content="IE=Edge"/>
    <script src="/js/xhr-8a3eddb.js" type="text/javascript"></script>
</head>
<body>



            <h2>Create Message</h2>            <form action="/messenger/create/" method="post" class="ajaxForm">
                <div class="alertHeightContainer"><div id="requestStatus" class="goodalertfield" style="display:none;"></div></div>
                <p>
                    <select placeholder="Recipient" name="targets[]" title="Recipient" multiple="multiple" id="message_recipient_{{Auth::user()->id}}">
                                        </select>
                </p>
                <p>
                    <textarea rows="10" cols="40" name="text" required="required" id="message_content_{{Auth::user()->id}}" class="quicksubmit" autofocus="autofocus">

{{$message->forward()}}</textarea>
                </p>
                <div class="buttonsline">
                    <input type="hidden" name="target" value="" />
                    <input type="hidden" name="csrf_token" value="9611faae2dc2496eac11ed275d6f5817" />
                    <button type="submit" class="siteButton bigButton"><span>send</span></button>
                </div>
            </form>
<script type="text/javascript">
$(document).ready(function() {
    $("#message_recipient_{{Auth::user()->id}}").fcbkcomplete({ json_url: "/account/search/", cache: false,	addontab: true,	height: 10,	filter_selected: true, complete_text: "Enter Recipient Name", firstselected: true, char_limit: 1, newel: true });
    $("#message_content_{{Auth::user()->id}}").bbedit({ attachImage: false });
});
</script>
</body>
</html>