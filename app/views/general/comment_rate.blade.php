
<div class="rate rated" id="ratediv_{{$comment_id}}">
            <a class="icon16 @if($count < 0) iminus @else iplus @endif disabledButton"><span></span></a>
        <a href="/comments/votes/{{$comment_id}}/" title="Votes for this comment" class="ajaxLink ratemark @if($count < 0) minus @else plus @endif" id="commrate_{{$comment_id}}">{{$count}}</a>
</div><!-- div class="rate"-->
