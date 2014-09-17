@extends('layouts.master')
@section('content')

<table width="100%" cellspacing="0" cellpadding="0" class="doublecelltable">
    <tbody><tr>
        <td width="100%">
            <div class="floatright buttonsLine">
    <form action="/messenger/search/" method="get" accept-charset="utf-8">
        <input class="textinput" type="text" name="s" value="" required="required">
        <button type="submit" class="siteButton bigButton"><span>Search Messages</span></button>
    </form>
</div>
<h1>Private Messages</h1>
<div class="tabs clear">
    <ul class="tabNavigation">
		<li><a href="/messenger/" class="darkButton selectedTab"><span>Dialogs</span></a></li>
        <li><a href="/messenger/create/" class="darkButton "><span>Create new</span></a></li>
    </ul>
    <hr class="tabsSeparator">
</div>

<form action="#">
    <table class="data" cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th class="nopad"><input class="checkboxchecker" data-selector=".dialogboxes" type="checkbox"></th>
                <th>user</th>
                <th class="width100perc lasttd">last message</th>
                <th class="lasttd nopad"></th>
            </tr>
        </thead>
        <tbody>
			<?php $counter = 0; ?>
			@foreach($convos as $convo)
				<tr class="@if($counter % 2 == 0)even @else odd @endif" style="cursor:pointer;">
					<td class="nopad"><input class="dialogboxes" type="checkbox" name="target_ids[]" value="{{$convo->id}}"></td>
					<td>
						<div class="badge">
							<div class="userPic">
						 
								<div class="userPicHeight relative">
	
								@if($convo->party()->isDeleted())	<div class="userStatus" title="deleted"></div> @endif
									<a href="/user/{{$convo->party()->username}}/">
									@if(!empty($convo->party()->avatar))
										<img src="/uploads/user/{{$convo->party()->id}}/thumb/{{$convo->party()->avatar}}.png">
									@else
										<img src="/images/commentlogo.png"></a>	
									@endif
								</div>
								<div class="badgeSiteStatus">
									<a href="/messenger/create/{{$convo->party()->username}}/" title="send private message" class="imessage ajaxLink icon16"><span></span></a>
									<span class="{{$convo->party()->onlineStatus()}}" title="{{$convo->party()->onlineStatus()}}"></span>
								</div>
							</div><!-- div class="userPic" -->
							<div class="badgeInfo">
								<span class="badgeUsernamejs font12px overhidden nobr @if($convo->party()->isDeleted()) linethrough @endif">
										<a class="plain" href="/user/{{$convo->party()->username}}/">{{$convo->party()->username}}</a><span title="Reputation" class="repValue {{$convo->party()->repStatus()}}">{{$convo->party()->rep}}</span></span>
								<span class="font10px lightgrey aclColor_1">{{$convo->party()->levelName()}}</span>    

							</div>
						</div><!-- div class="badge" -->
					</td>
					<td class="lasttd">
						<div style="padding:5px;background:#F4F1E7">
						{{$convo->lastMessage()->message()}}
						<hr>
						<span class="badgeInline"><span class="{{$convo->lastMessage()->user()->onlineStatus()}}" title="{{$convo->lastMessage()->user()->onlineStatus()}}"></span> <span class="aclColor_1"><a class="plain" href="/user/{{$convo->lastMessage()->user()->username}}/">{{$convo->lastMessage()->user()->username}}</a></span><span title="Reputation" class="repValue {{$convo->lastMessage()->user()->repStatus()}}">{{$convo->lastMessage()->user()->rep}}</span></span> {{$convo->lastMessage()->time_elapsed()}}
						</div>
					</td>
					<td class="lasttd blank nowrap">
						<a href="/messenger/dialog/{{$convo->party()->username}}/" title="view dialog" class="ireply icon16"><span></span></a>
						<a href="/messenger/deletedialogs/{{$convo->party()->username}}/" title="delete" class="redButton icross icon16"><span></span></a>
					</td>
				</tr>
				<?php $counter++; ?>
			@endforeach

		</tbody>
    </table>
    <div class="buttonsline">
        <div style="float:right"></div>
                <button type="button" name="mark" class="disabledButton siteButton bigButton"><span>mark as read</span></button>
                <button type="button" name="delete" class="disabledButton siteButton bigButton"><span>delete</span></button>
    </div>
</form>
<script type="text/javascript">
$(function() {
    var context = $('.data'), form = context.parent('form');
    $('tbody tr', form).click(function() {
        document.location.href = $('a.ireply', this).prop('href');
    });
    $('.checkboxchecker,.dialogboxes', form).click(function() {
        var btn = $('button', form);
        if ($('.dialogboxes:checked', form).size()) {
            btn.removeClass('disabledButton');
        } else {
            btn.addClass('disabledButton');
        }
    });
            $('button[name=delete]', form).click(function() {
            var btn = $(this), data = form.serializeArray();
            if (!data.length) return;
            if (!confirm('Are you sure you want to delete selected dialogs?')) return;
            $.post('/messenger/deletedialogs/', form.serialize(), function() {
                btn.addClass('disabledButton');
                $('.dialogboxes:checked', form).each(function() {
                    $(this).parents('tr:eq(0)').remove();
                });
                if (!$('.dialogboxes', form).size()) {
                    form.remove();
                }
            });
            return false;
        });
        $('button[name=mark]', form).click(function() {
            var data = form.serializeArray();
            if (!data.length) return;
            if (!confirm('Are you sure you want to mark as read selected dialogs?')) return;
            $.post('/messenger/markdialogs/', form.serialize(), function() {
                $('.dialogboxes:checked', form).each(function() {
                    $(this).click().parents('tr:eq(0)').find('.lasttd div').css('background', 'none');
                });
            });
            return false;
        });
        $('a.icross', form).click(function() {
            if (confirm('Are you sure you want to remove this dialog?')) {
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
</tbody>
</table>
@stop