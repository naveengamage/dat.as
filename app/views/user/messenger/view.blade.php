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
        <li><a href="" class="darkButton selectedTab"><span>View Dialog</span></a></li>                                        <li><a href="/messenger/" class="darkButton "><span>Dialogs</span></a></li>
        <li><a href="/messenger/create/" class="darkButton "><span>Create new</span></a></li>
    </ul>
    <hr class="tabsSeparator" />
</div>

            <h2>{{$user->username}}</h2>
			<form action="/messenger/create/" method="post">
                <p>
                    <textarea rows="10" cols="40" name="text" id="message_content" class="quicksubmit"></textarea>
                </p>
                <div class="buttonsline">
                    <input type="hidden" name="targets[]" value="{{$user->username}}" />
                    <input type="hidden" name="csrf_token" value="395c020a272a5436cbb83a4677d73568" />
                    <button type="submit" class="siteButton bigButton"><span>send</span></button>
                </div>
            </form>
			@if(isset($messages) && count($messages) != 0)
				<form action="#">
					<table class="data" cellpadding="0" cellspacing="0">
						<tr>
							<th class="nopad"><input class="checkboxchecker" data-selector=".messageboxes" type="checkbox" /></th>
							<th>from</th>
							<th class="width100perc">message</th>
							<th>time</th>
							<th class="lasttd nopad"></th>
						</tr>
						<?php $counter = 0; ?>
						@foreach($messages as $mes)
							@if($mes->user_id == Auth::user()->id && $mes->sender_deleted)
							
							@elseif($mes->user_id != Auth::user()->id && $mes->rep_deleted)
							
							@else
						<tr class="@if($counter % 2 == 0)even @else odd @endif" style="background:">
								<td class="nopad"><input class="messageboxes" type="checkbox" name="message_ids[]" value="{{$mes->id}}" /></td>
								<td>
									<div class="badge">
										<div class="userPic">
									 
											<div class="userPicHeight relative">
												@if(!empty($mes->user()->avatar))
													<img src="/uploads/user/{{$mes->user()->id}}/thumb/{{$mes->user()->avatar}}.png">
												@else
													<img src="/images/commentlogo.png"></a>	
												@endif
											</div>
											<div class="badgeSiteStatus">
															<span class="{{$mes->user()->onlineStatus()}}" title="{{$mes->user()->onlineStatus()}}"></span>
											</div>
										</div><!-- div class="userPic" -->
										<div class="badgeInfo">
											<span class="badgeUsernamejs font12px overhidden nobr">
													<a class="plain" href="/user/{{$mes->user()->username}}/">{{$mes->user()->username}}</a><span title="Reputation" class="repValue {{$mes->user()->repStatus()}}">{{$mes->user()->rep}}</span></span>
											<span class="font10px lightgrey aclColor_1">{{$mes->user()->levelName()}}</span>    

										</div>
									</div><!-- div class="badge" -->
								</td>
								
								<td>
									{{$mes->message()}}
								</td>
								<td class="nowrap">{{$mes->addedon()}} ( {{$mes->time_elapsed() }} )</td>
								<td class="lasttd blank nowrap">
									<a href="/messenger/forward/{{$mes->id}}/" title="forward" class="imove icon16 ajaxLink"><span></span></a>
									<a href="/messenger/deletemessages/{{$mes->id}}/" title="delete" class="redButton icross icon16"><span></span></a>
								</td>
						</tr>
							@endif
						<?php $counter++; ?>
						@endforeach
					</table>
					<div class="buttonsline">
						<div style="float:right"></div>
								<button type="button" name="delete" class="siteButton bigButton disabledButton"><span>delete</span></button>
					</div>
				</form>
			@endif
<script type="text/javascript">
$(function() {
    var context = $('.data'), form = context.parent('form');
    $('.checkboxchecker,.messageboxes', form).click(function() {
        var btn = $('button', form);
        if ($('.messageboxes:checked', form).size()) {
            btn.removeClass('disabledButton');
        } else {
            btn.addClass('disabledButton');
        }
    });
            $('button[name=delete]', form).click(function() {
            var btn = $(this), data = form.serializeArray();
            if (!data.length) return;
            if (!confirm('Are you sure you want to delete selected messages?')) return;
            $.post('/messenger/deletemessages/', form.serialize(), function() {
                btn.addClass('disabledButton');
                $('.messageboxes:checked', form).each(function() {
                    $(this).parents('tr:eq(0)').remove();
                });
                if (!$('.messageboxes', form).size()) {
                    form.remove();
                }
            });
            return false;
        });
        $('a.icross', form).click(function() {
            if (confirm('Are you sure you want to delete this message?')) {
                var me = $(this);
                $.post(me.prop('href'), function() {
                    me.parents('tr:eq(0)').remove();
                });
            }
            return false;
        });
    });
</script>
                    </td>
        <td class="sidebarCell">
				@include('layouts.sidebar', array('show_control'=> true))
        </td>
    </tr>
</table>
<script type="text/javascript">
$(document).ready(function() {
    $("#message_content").bbedit({ attachImage: false });
});
</script>

@stop