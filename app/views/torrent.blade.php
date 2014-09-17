@extends('layouts.master')
@section('content')
   
 
<script type="text/javascript" charset="utf-8">
$(function() {
    $('#desc img').each(function() {
        if ($(this).attr('width') > '620')  {
            $(this).attr('width','620');
        }
        $(this).removeAttr('height');
    });
});
</script> 
<table cellspacing="0" cellpadding="0" class="doublecelltable width100perc" id="mainDetailsTable">
	<tr>
		<td width="100%" itemscope itemtype="http://schema.org/Product">
						<div class="goodFake" itemscope itemtype="http://schema.org/AggregateRating">
							<meta itemprop="ratingValue" content="10" />
							<meta itemprop="bestRating" content="10" />
							<meta itemprop="ratingCount" content="712" />

							<div class="floatLeft inlineblock">
							@if(Auth::guest())
								<a title="Good" id="thnxLink" data-hash="{{$media->id}}" class="ajaxLink" href="/auth/login/">
							@else
								@if($media->hasDisliked())
									<a title="Good" id="thnxLink" data-hash="{{$media->id}}" class="gfunchecked" href="#">
								@elseif($media->hasLiked())
									<a title="Good" id="thnxLink" data-hash="{{$media->id}}" class="jsunlike" href="#">
								@else
									<a title="Good" id="thnxLink" data-hash="{{$media->id}}" class="jslike" href="#">
								@endif
							@endif
									<span class="block relative"><span class="thnx"></span><span class="siteButton torrentfingers"></span></span>
									@if($media->upVotes() == 0)
										<span class="siteButton smallButton" id="thnxCount"><span>{{$media->upVotes()}}</span></span>
									@else
										<span class="siteButton smallButton" id="thnxCount"><span>+{{$media->upVotes()}}</span></span>
									@endif
								</a>
							</div>
							<div class="floatRight inlineblock">
							@if(Auth::guest())
								<a title="Good" id="thnxLink" data-hash="{{$media->id}}" class="ajaxLink" href="/auth/login/">
							@else
								@if($media->hasLiked())
									<a title="Bad" id="fakeLink" data-hash="{{$media->id}}" class="gfunchecked" href="#">							
								@elseif($media->hasDisliked())
									<a title="Bad" id="fakeLink" data-hash="{{$media->id}}" class="jsundislike" href="#">
								@else
									<a title="Bad" id="fakeLink" data-hash="{{$media->id}}" class="jsdislike" href="#">
								@endif
							@endif
									<span class="block relative"><span class="fake"></span><span class="siteButton redButton torrentfingers"></span></span>
									@if($media->downVotes() == 0)
										<span class="siteButton smallButton redButton" id="fakeCount"><span>{{$media->downVotes()}}</span></span>
									@else
										<span class="siteButton smallButton redButton" id="fakeCount"><span>-{{$media->downVotes()}}</span></span>
									@endif
								</a>
							</div>

							<br />
							@if(Auth::guest())
								<a id="report_button" href="/auth/login/" class="ireport icon16 textButton redButton ajaxLink center" style="min-width: 108px; float: left"><span></span>report fake</a>
							@else
								@if($media->reported())
									<span id="reported" class="reportedMessage font11px block center clear widthauto" title="Torrents that are not released yet">reported</span>
								@else
									<a id="report_button" href="/posts/report/{{$media->id}}/" class="ireport icon16 textButton redButton ajaxLink center" style="min-width: 108px; float: left"><span></span>report fake</a>
								@endif
							@endif
						</div>
						<h1 class="novertmarg"><a href="/{{ $media->slug }}-t{{ $media->id }}.html"><span itemprop="name">{{ $media->title }}</span></a></h1>
						<div class="seedLeachContainer">
							<div class="seedBlock"><span class="seedLeachIcon"></span>watch links: <strong itemprop="seeders">{{$media->sm_links_count}}</strong></div>
							<div class="leechBlock"><span class="seedLeachIcon"></span>download links: <strong itemprop="leechers">{{$media->dl_links_count}}</strong></div>
						</div>
						
						<div class="buttonsline downloadButtonGroup clearleft novertpad">
	



							<a rel="nofollow" title="Get Download links" class="siteButton giantButton @if($media->is_verified)verifTorrentButton @endif" onclick="document.getElementById('links-but').click();" ><span> @if($media->is_verified) <em class="buttonPic"></em> @endif
									Get Download Links</span>
							</a>
						</div>
						<div id="_ad4d917f2e764fab63b916b5e0655d2e" class="block botmarg5px"></div>
						<div id="_151f50b61bb9a7633562d3f308691182"></div>
						<div class="font11px lightgrey line160perc">
						Added on {{ $added_on }} by <span class="badgeInline"><span class="@if($media->user()->isOnline()) online @else offline @endif" title="@if($media->user()->isOnline()) online @else offline @endif"></span> <span class="aclColor_verified"><a class="plain" href="/user/{{$media->user()->username}}/">{{$media->user()->username}}</a></span><span title="Reputation" class="repValue @if($media->user()->rep < 0) negative @else positive @endif">{{$media->user()->rep}}</span> <a href="/messenger/create/{{$media->user()->username}}/" title="send private message" class="imessage ajaxLink icon16"><span></span></a></span> in <span id="cat_{{$media->category()->id}}"><strong><a href="/{{$media->category()->url}}/">{{$media->category()->name}}</a>@if($media->sub_id != 0) > <a href="/{{$media->subcategory()->url}}/">{{$media->subcategory()->name}}</a> @endif</strong></span>	 <br>
							@if($media->is_verified) File verified. @endif	Downloaded {{$media->download_count}} times.
						</div>
        
            <div class="tabs tabSwitcher">
					<ul class="tabNavigation">
						<li><a href="#main" rel="main" class="darkButton"><span>Main</span></a></li>
						<li><a href="#links" rel="links" id="links-but" class="darkButton"><span>Links</span></a></li>
						@if(!empty($media->trailer))<li class="hideInOpera"><a href="#trailer" id="trailer_link" rel="trailer" class="darkButton"><span>Trailer</span></a></li>@endif
						<li><a href="#comment" rel="comment" class="darkButton"><span>Comments <i class="menuValue">{{$media->totalComments()}}</i></span></a></li>
					</ul>
					<hr class="tabsSeparator" />
                <div id="tab-main" class="contentTabContainer">
                                                    
									<div class="data">	
											<div id="trackerBox">
												<h2>Download Links</h2>
												<div class="botmarg10px">
													<table cellpadding="0" cellspacing="0" class="data">
														<tr class="firstr">
															<th class="lasttd"></th>
															<th class="width100perc">link</th>
															<th class="center">size</th>
															<th class="center">downloaded</th>											
															<th class="center">dead links</th> 
															<th class="lasttd nobr"><span class="leech">rate</span></th>
														</tr>

														<?php $counter = 0; ?>
														@foreach($media->get_links() as $link)
														<tr class="@if($counter % 2 == 0)even @else odd @endif" id="torrent_{{$link->id}}">
															<td class="lasttd"></td> 
															<td>
																<div class="markeredBlock torType @if($link->dl) downloadType @else filmType @endif">
																	<a href="/out/{{$media->id}}/{{$link->id}}" target="_blank" class="cellMainLink askFeedbackjs">{{$link->link}}</a>

																</div>
															</td>
															<td class="nobr center">{{$media->size}} {{$media->size_suffix}}</td>
															<td class="center">{{$link->dl_count}}</td>																
															<td class="center">
																@if($link->reuploadRequested())
																	<a class="icon16 textButton icheck"><span></span> Re-upload requested</a>
																@else
																	<a onclick="requestReupload('{{$link->id}}', this);" class="icon16 textButton irefresh"><span></span>request re-upload</a>
																@endif
															</td>
															
															<td class="lasttd nobr valignTop right">
																<div class="commentformwidth feedbackpage withqrate">
																	<form action="" id="form_{{$media->id}}" onsubmit="submitFeedback(this, {{$media->id}});return false;">
																			<input type="hidden" name="objectId" value="{{$media->id}}"/>
																			<div class="likeOrNotBox floatleft" id="link_{{$link->id}}">
																				@if(Auth::guest())
																				<a class="siteButton likeButton ajaxLink" href="/auth/login/" title="Good Link"><span><label></label>{{$link->up_count}}</span></a><a class="siteButton dislikeButton ajaxLink" href="/auth/login/" title="Bad Link"><span><label></label>{{$link->down_count}}</span></a>
																				@else
																					@if($link->upVoted() || $link->downVoted())
																						<a class="siteButton likeButton @if($link->upVoted()) checked @endif" title="Good"><span><label></label>{{$link->upVotes()}}</span></a><a class="siteButton dislikeButton @if($link->downVoted()) checked @endif" title="Bad"><span><label></label>{{$link->downVotes()}}</span></a>
																					@else
																						<a onClick="submitGood('{{$link->id}}');" class="siteButton likeButton" title="Good"><span><label></label>{{$link->upVotes()}}</span></a><a onClick="submitBad('{{$link->id}}');" class="siteButton dislikeButton" title="Bad"><span><label></label>{{$link->downVotes()}}</span></a>
																					@endif
																				@endif
																			</div>
																	</form>
																</div>
															</td>
															
														</tr>
														<?php $counter++; ?>
														@endforeach
													</table>
												</div>

											</div>
									</div>
                					<div class="data">
										<h2>Description</h2>
											<div class="textcontent" id="desc">
													{{ $media->get_desc()}}
											</div>
									</div>

									<h2>Sharing Widget</h2>
									<br />
									<div class="sharingWidgetBox">
										<div class="sharingWidget borderrad3px floatleft">
										<a class="siteButton giantButton askFeedbackjs" href="/{{ $media->slug }}-t{{ $media->id }}.html"><span>Get Download Links</span></a>
											<div class="widgetSize"><span class="torType filmType"></span> <strong>{{$media->size}} <span>{{$media->size_suffix}}</span></strong></div>
											<div class="widgetSeed"><span class="seedLeachIcon"></span>watch links:<strong>{{$media->sm_links_count}}</strong></div>
											<div class="widgetLeech"><span class="seedLeachIcon"></span>download links:<strong>{{$media->dl_links_count}}</strong></div>
										</div>
											<div class="widgetName">{{$media->title}}</div>
									</div><!-- div class="sharingWidgetBox" -->

								</div>
								
								<div id="tab-links" class="contentTabContainer">
											<div id="trackerBox">
												<h2>Download Links</h2>
												<div class="botmarg10px">
													<table cellpadding="0" cellspacing="0" class="data">
														<tr class="firstr">
															<th class="lasttd"></th>
															<th class="width100perc">link</th>
															<th class="center">size</th>
															<th class="center">downloaded</th> 
															<th class="center">dead links</th> 
															<th class="lasttd nobr"><span class="leech">rate</span></th>
														</tr>
														<?php $counter = 0; ?>
														@foreach($media->get_links() as $link)
														<tr class="@if($counter % 2 == 0)even @else odd @endif" id="torrent_{{$link->id}}">
															<td class="lasttd"></td> 
															<td>
																<div class="markeredBlock torType @if($link->dl) downloadType @else filmType @endif">
																	<a href="/out/{{$media->id}}/{{$link->id}}" target="_blank" class="cellMainLink askFeedbackjs">{{$link->link}}</a>

																</div>
															</td>
															<td class="nobr center">{{$media->size}} {{$media->size_suffix}}</td>
															<td class="center">{{$link->dl_count}}</td>
															<td class="center">
																@if($link->reuploadRequested())
																	<a class="icon16 textButton icheck"><span></span> Re-upload requested</a>
																@else
																	<a onclick="requestReupload('{{$link->id}}', this);" class="icon16 textButton irefresh"><span></span>request re-upload</a>
																@endif
															</td>
																														
															<td class="lasttd nobr valignTop right">
																<div class="commentformwidth feedbackpage withqrate">
																	<form action="" id="form_{{$media->id}}" onsubmit="submitFeedback(this, {{$media->id}});return false;">
																			<input type="hidden" name="objectId" value="{{$media->id}}"/>
																			<div class="likeOrNotBox floatleft" id="link_{{$link->id}}">
																				@if(Auth::guest())
																				<a class="siteButton likeButton ajaxLink" href="/auth/login/" title="Good Link"><span><label></label>{{$link->up_count}}</span></a><a class="siteButton dislikeButton ajaxLink" href="/auth/login/" title="Bad Link"><span><label></label>{{$link->down_count}}</span></a>
																				@else
																					@if($link->upVoted() || $link->downVoted())
																						<a class="siteButton likeButton @if($link->upVoted()) checked @endif" title="Good"><span><label></label>{{$link->upVotes()}}</span></a><a class="siteButton dislikeButton @if($link->downVoted()) checked @endif" title="Bad"><span><label></label>{{$link->downVotes()}}</span></a>
																					@else
																						<a onClick="submitGood('{{$link->id}}');" class="siteButton likeButton" title="Good"><span><label></label>{{$link->upVotes()}}</span></a><a onClick="submitBad('{{$link->id}}');" class="siteButton dislikeButton" title="Bad"><span><label></label>{{$link->downVotes()}}</span></a>
																					@endif
																				@endif
																			</div>
																	</form>
																</div>
															</td>
															
														</tr>
														<?php $counter++; ?>
														@endforeach
													</table>
												</div>

											</div>
								</div>
								@if(!empty($media->trailer))
    			                <div id="tab-trailer" class="contentTabContainer">
                
									<div class="center">
										<iframe width="640" height="480" src="//www.youtube.com/embed/{{$media->trailer}}" frameborder="0" allowfullscreen></iframe>
									</div>
								</div>
								@endif
								
								<div id="tab-comment" class="contentTabContainer commentTab">
									<div class="commentsLeftModule">
										@if(count($media->uploadercomments()) != 0)
										<div class="comments topComments">
											<h2>Uploader Comments</h2>
													@foreach($media->uploadercomments() as $comment)
														@if($comment->deleted && $comment->replies()->count() == 0)
														
														@else
															@if($comment->user_id == $media->user_id && $comment->comment_parent != 0)
															<?php $reply = $comment; $comment = Comment::where('id','=', $comment->comment_parent)->first(); ?>
															@endif
															@if(!$comment->deleted)
															<div class="commentThread">
																<div class="commentbody @if($comment->deleted) deletedComment @elseif($comment->isHidden()) hiddenComment @endif" id="comment{{$comment->id}}" style="background-color:#f8f7f5;">
																	<div id="cpic_{{$comment->id}}" class="userPic">
																		<div class="height50px userPicHeight relative">
																			<a  href="/user/{{$comment->user()->username}}/">
																				@if(!empty($comment->user()->avatar))
																					<img class="lazyjs" data-original="{{URL::asset('/uploads/user/' . $comment->user()->id . '/thumb/' . $comment->user()->avatar . '.png' )}}" src="{{URL::asset('/images/blank.gif')}}">
																				@else
																					<img class="lazyjs" data-original="{{URL::asset('/images/user/commentlogo.png')}}" src="{{URL::asset('/images/blank.gif')}}">
																				@endif
																			</a>
																		</div>
																	</div>
																	<div class="commentcontent">
																			<a name="comment_{{$comment->id}}"></a>
																			<div class="commentowner">
																				<div class="rate rated" id="topratediv_{{$comment->id}}">
																						@if(!Auth::guest() && $comment->hasVoted())	
																							<a class="icon16 @if($comment->totalVotes() < 0) iminus @else iplus @endif disabledButton"><span></span></a>
																							<a href="/comments/votes/{{$comment->id}}/" title="Votes for this comment" class="ajaxLink ratemark @if($comment->totalVotes() < 0) minus @else plus @endif" id="commrate_{{$comment->id}}">{{$comment->totalVotes()}}</a>
																						@else
																							@if(Auth::guest())
																								<a href="/auth/login/" class="icon16 iminus redButton ajaxLink"><span></span></a>
																								<a href="/auth/login/" class="icon16 iplus ajaxLink"><span></span></a>
																							@elseif(Auth::user()->id != $comment->user_id)
																								<a href="javascript:rateMinus({{$comment->id}})" class="icon16 iminus redButton"><span></span></a> 
																								<a href="javascript:ratePlus({{$comment->id}})" class="icon16 iplus"><span></span></a>
																							@endif
																							<a  title="Votes for this comment" class=" ratemark " id="topcommrate_{{$comment->id}}">{{$comment->totalVotes()}}</a>
																						@endif
																						
																				</div><!-- div class="rate"-->

																				<div class="commentTopControlLine">
																					@if(!Auth::guest())
																						@if(Auth::user()->id != $comment->user_id)
																							<a id="report_comment_{{$comment->id}}" class="ireport redButton icon16" onclick="reportComment({{$comment->id}});" title="Report comment"><span></span></a>
																						@else
																							<a class="icon16 iedit greyButton" onClick="editComment({{$comment->id}}, true);" title="Edit"><span></span></a>  
																							@if(!$comment->deleted)<a class="icross greyButton icon16" title="Delete comment" href="javascript: DeleteComment({{$comment->id}});"><span></span></a>@endif
																						@endif
																					@endif
																				</div>
																				<div class="commentownerLeft">
																					<span class="badgeInline">
																						<span class="@if($comment->user()->isOnline()) online @else offline @endif" title="@if($comment->user()->isOnline()) online @else offline @endif"></span> 
																						<span class="aclColor_1"><a class="plain" href="/user/{{$comment->user()->username}}/">{{$comment->user()->username}}</a></span>
																						<span title="Reputation" class="repValue @if($comment->user()->rep < 0) negative @else positive @endif">{{$comment->user()->rep}}</span>
																					</span>
																					<span id="cdate_{{$comment->id}}" class="lightgrey font11px"> &bull; {{$comment->create_time()}}              </span>
																					@if($comment->user_id == $media->user_id)<div class="uploader"><span class="rank_uploader" alt="uploader"></span></div>@endif
																					<a class="siteButton smallButton reject showComment" id="cshow_{{$comment->id}}" href="javascript:showComment({{$comment->id}})"><span>Show comment</span></a>
																				</div><!-- div class="commentownerLeft" -->
																			</div><!--commentowner-->
																			@if($comment->video != 0 && $comment->audio != 0)
																				<div class="commentAVRate bold font11px">
																					<span>audio: {{$comment->audio}}</span><span>video: {{$comment->video}}</span>   
																				</div>
																			@endif
																			<div id="topctext_{{$comment->id}}" class="commentText botmarg5px topmarg5px">
																			@if(!$comment->deleted)
																				{{$comment->getComment()}}
																			@else
																				<i>Comment is deleted</i>
																			@endif
																					<div class="objectAttachmentsJs overauto topmarg10px">
																					@if(!$comment->deleted)
																						@if(!empty($comment->image_ids))
																							@foreach(json_decode($comment->image_ids) as $userpic)
																								<?php $pic_status = UserPic::where('id', '=' , $userpic)->first(); ?>
																								@if(isset($pic_status->id) && !$pic_status->deleted)
																								<div class="galleryThumbSizerStills inlineblock">
																									<a href="/uploads/user/{{$comment->user_id}}/or/{{$userpic}}.png" class="galleryThumb ajaxLink" rel="gallery_{{$comment->id}}">
																										<img src="/uploads/user/{{$comment->user_id}}/thumb/{{$userpic}}.png" alt="" />
																									</a>
																								</div> 
																								@endif
																							@endforeach
																						@endif
																					@endif
																					</div>
																					@if( $comment->edited)
																						<p class="font11px lightgrey italic" id="edited_{{$comment->id}}">Last edited by <span class="badgeInline"><span class="@if($comment->editor()->isOnline()) online @else offline @endif" title="@if($comment->editor()->isOnline()) online @else offline @endif"></span> <span class="aclColor_1"><a class="plain" href="/user/{{ $comment->editor()->username }}/">{{ $comment->editor()->username }}</a></span></span>, {{$comment->edit_time()}}</p>
																					@endif
																			</div>
																	</div><!-- div class="commentcontent" -->
																</div><!-- div class="commentbody" --> 
												
																@if(isset($reply) && $reply->user_id == $media->user_id && $reply->comment_parent != 0)
																<div class="commentThread">
																	<div class="reply">   
																		<div class="commentbody @if($reply->deleted) deletedComment @elseif($reply->isHidden()) hiddenComment @endif" id="comment{{$reply->id}}" style="background-color:#f8f7f5;">
																			<div id="cpic_{{$reply->id}}" class="userPic">
																				<div class="height50px userPicHeight relative">
																					<a  href="/user/{{$reply->user()->username}}/">
																						@if(!empty($reply->user()->avatar))
																							<img class="lazyjs" data-original="{{URL::asset('/uploads/user/' . $reply->user()->id . '/thumb/' . $reply->user()->avatar . '.png' )}}" src="{{URL::asset('/images/blank.gif')}}">
																						@else
																							<img class="lazyjs" data-original="{{URL::asset('/images/user/commentlogo.png')}}" src="{{URL::asset('/images/blank.gif')}}">
																						@endif
																					</a>
																				</div>
																			</div>
																			<div class="commentcontent">
																				<a name="comment_{{$reply->id}}"></a>
																													
																				<div class="commentowner">
																					<div class="rate rated" id="topratediv_{{$reply->id}}">
																							@if(!Auth::guest() && $reply->hasVoted())	
																								<a class="icon16 @if($reply->totalVotes() < 0) iminus @else iplus @endif disabledButton"><span></span></a>
																								<a href="/comments/votes/{{$reply->id}}/" title="Votes for this comment" class="ajaxLink ratemark @if($reply->totalVotes() < 0) minus @else plus @endif" id="commrate_{{$reply->id}}">{{$reply->totalVotes()}}</a>
																							@else
																								@if(Auth::guest())
																									<a href="/auth/login/" class="icon16 iminus redButton ajaxLink"><span></span></a>
																									<a href="/auth/login/" class="icon16 iplus ajaxLink"><span></span></a>
																								@elseif(Auth::user()->id != $reply->user_id)
																									<a href="javascript:rateMinus({{$reply->id}})" class="icon16 iminus redButton"><span></span></a> 
																									<a href="javascript:ratePlus({{$reply->id}})" class="icon16 iplus"><span></span></a>
																								@endif
																								<a  title="Votes for this comment" class=" ratemark " id="topcommrate_{{$reply->id}}">{{$reply->totalVotes()}}</a>
																							@endif
																					</div><!-- div class="rate"-->

																					<div class="commentTopControlLine">
																					@if(!Auth::guest())
																						@if(Auth::user()->id != $reply->user_id)
																							<a id="report_comment_{{$reply->id}}" class="ireport redButton icon16" onclick="reportComment({{$reply->id}});" title="Report comment"><span></span></a>
																						@else
																							<a class="icon16 iedit greyButton" onClick="editComment({{$reply->id}}, true);" title="Edit"><span></span></a>                                                    
																							@if(!$reply->deleted)<a class="icross greyButton icon16" title="Delete comment" href="javascript: DeleteComment({{$reply->id}});"><span></span></a>@endif
																						@endif
																					 @endif
																					 </div>
																					<div class="commentownerLeft">
																						<span class="badgeInline">
																							<span class="@if($reply->user()->isOnline()) online @else offline @endif" title="@if($reply->user()->isOnline()) online @else offline @endif"></span> 
																							<span class="aclColor_1"><a class="plain" href="/user/{{$reply->user()->username}}/">{{$reply->user()->username}}</a></span>
																							<span title="Reputation" class="repValue @if($comment->user()->rep < 0) negative @else positive @endif">{{$comment->user()->rep}}</span>
																						</span>
																									<span id="cdate_{{$reply->id}}" class="lightgrey font11px"> &bull; {{$reply->create_time()}}                  </span>
																									@if($reply->user_id == $media->user_id)<div class="uploader"><span class="rank_uploader" alt="uploader"></span></div>@endif
																									<a class="siteButton smallButton reject showComment" id="cshow_{{$reply->id}}" href="javascript:showComment({{$reply->id}})"><span>Show comment</span></a>
																					</div><!-- div class="commentownerLeft" -->
																				</div><!--commentowner-->
																				<div id="topctext_{{$reply->id}}" class="commentText botmarg5px topmarg5px">
																				@if(!$reply->deleted)
																					{{$reply->getComment()}}
																				@else
																					<i>Comment is deleted</i>
																				@endif
																						<div class="objectAttachmentsJs overauto topmarg10px">
																							@if(!$reply->deleted)
																								@if(!empty($reply->image_ids))
																									@foreach(json_decode($reply->image_ids) as $userpic)
																										<?php $pic_status = UserPic::where('id', '=' , $userpic)->first(); ?>
																										@if(isset($pic_status->id) && !$pic_status->deleted)
																										<div class="galleryThumbSizerStills inlineblock">
																											<a href="/uploads/user/{{$reply->user_id}}/or/{{$userpic}}.png" class="galleryThumb ajaxLink" rel="gallery_{{$reply->id}}">
																												<img src="/uploads/user/{{$reply->user_id}}/thumb/{{$userpic}}.png" alt="" />
																											</a>
																										</div> 
																										@endif
																									@endforeach
																								@endif
																							@endif
																						</div>
																					@if( $reply->edited)
																						<p class="font11px lightgrey italic" id="edited_{{$comment->id}}">Last edited by <span class="badgeInline"><span class="@if($reply->editor()->isOnline()) online @else offline @endif" title="@if($reply->editor()->isOnline()) online @else offline @endif"></span> <span class="aclColor_1"><a class="plain" href="/user/{{ $reply->editor()->username }}/">{{ $reply->editor()->username }}</a></span></span>, {{$reply->edit_time()}}</p>
																					@endif
																				</div>
																			</div><!-- div class="commentcontent" -->
																		</div><!-- div class="commentbody" --> 
																	</div>
																</div><!-- div class="commentThread" -->
																@endif
															</div><!-- div class="commentThread" -->
															@endif
														@endif
													@endforeach

										</div>
										@endif
										@if(count($media->topcomments()) != 0)
										<div class="comments topComments">
											<h2>Top Comments</h2>
													@foreach($media->topcomments() as $comment)
														@if($comment->deleted && $comment->replies()->count() == 0)
														
														@else
															<div class="commentThread">
																<div class="commentbody @if($comment->deleted) deletedComment @elseif($comment->isHidden()) hiddenComment @endif" id="comment{{$comment->id}}" style="background-color:#f8f7f5;">
																	<div id="cpic_{{$comment->id}}" class="userPic">
																		<div class="height50px userPicHeight relative">
																			<a  href="/user/{{$comment->user()->username}}/">
																				@if(!empty($comment->user()->avatar))
																					<img class="lazyjs" data-original="{{URL::asset('/uploads/user/' . $comment->user()->id . '/thumb/' . $comment->user()->avatar . '.png' )}}" src="{{URL::asset('/images/blank.gif')}}">
																				@else
																					<img class="lazyjs" data-original="{{URL::asset('/images/user/commentlogo.png')}}" src="{{URL::asset('/images/blank.gif')}}">
																				@endif
																			</a>
																		</div>
																	</div>
																	<div class="commentcontent">
																			<a name="comment_{{$comment->id}}"></a>
																			<div class="commentowner">
																				<div class="rate rated" id="topratediv_{{$comment->id}}">
																						@if(!Auth::guest() && $comment->hasVoted())	
																							<a class="icon16 @if($comment->totalVotes() < 0) iminus @else iplus @endif disabledButton"><span></span></a>
																							<a href="/comments/votes/{{$comment->id}}/" title="Votes for this comment" class="ajaxLink ratemark @if($comment->totalVotes() < 0) minus @else plus @endif" id="commrate_{{$comment->id}}">{{$comment->totalVotes()}}</a>
																						@else
																							@if(Auth::guest())
																								<a href="/auth/login/" class="icon16 iminus redButton ajaxLink"><span></span></a>
																								<a href="/auth/login/" class="icon16 iplus ajaxLink"><span></span></a>
																							@elseif(Auth::user()->id != $comment->user_id)
																								<a href="javascript:rateMinus({{$comment->id}})" class="icon16 iminus redButton"><span></span></a> 
																								<a href="javascript:ratePlus({{$comment->id}})" class="icon16 iplus"><span></span></a>
																							@endif
																							<a  title="Votes for this comment" class=" ratemark " id="topcommrate_{{$comment->id}}">{{$comment->totalVotes()}}</a>
																						@endif
																						
																				</div><!-- div class="rate"-->

																				<div class="commentTopControlLine">
																					@if(!Auth::guest())
																						@if(Auth::user()->id != $comment->user_id)
																							<a id="report_comment_{{$comment->id}}" class="ireport redButton icon16" onclick="reportComment({{$comment->id}});" title="Report comment"><span></span></a>
																						@else
																							<a class="icon16 iedit greyButton" onClick="editComment({{$comment->id}}, true);" title="Edit"><span></span></a>  
																							@if(!$comment->deleted)<a class="icross greyButton icon16" title="Delete comment" href="javascript: DeleteComment({{$comment->id}});"><span></span></a>@endif
																						@endif
																					@endif
																				</div>
																				<div class="commentownerLeft">
																					<span class="badgeInline">
																						<span class="@if($comment->user()->isOnline()) online @else offline @endif" title="@if($comment->user()->isOnline()) online @else offline @endif"></span> 
																						<span class="aclColor_1"><a class="plain" href="/user/{{$comment->user()->username}}/">{{$comment->user()->username}}</a></span>
																						<span title="Reputation" class="repValue @if($comment->user()->rep < 0) negative @else positive @endif">{{$comment->user()->rep}}</span>
																					</span>
																					<span id="cdate_{{$comment->id}}" class="lightgrey font11px"> &bull; {{$comment->create_time()}}              </span>
																					@if($comment->user_id == $media->user_id)<div class="uploader"><span class="rank_uploader" alt="uploader"></span></div>@endif
																					<a class="siteButton smallButton reject showComment" id="cshow_{{$comment->id}}" href="javascript:showComment({{$comment->id}})"><span>Show comment</span></a>
																				</div><!-- div class="commentownerLeft" -->
																			</div><!--commentowner-->
																			@if($comment->video != 0 && $comment->audio != 0)
																			<div class="commentAVRate bold font11px">
																				<span>audio: {{$comment->audio}}</span><span>video: {{$comment->video}}</span>   
																			</div>
																			@endif
																			<div id="topctext_{{$comment->id}}" class="commentText botmarg5px topmarg5px">
																			@if(!$comment->deleted)
																				{{$comment->getComment()}}
																			@else
																				<i>Comment is deleted</i>
																			@endif
																					<div class="objectAttachmentsJs overauto topmarg10px">
																					@if(!$comment->deleted)
																						@if(!empty($comment->image_ids))
																							@foreach(json_decode($comment->image_ids) as $userpic)
																								<?php $pic_status = UserPic::where('id', '=' , $userpic)->first(); ?>
																								@if(isset($pic_status->id) && !$pic_status->deleted)
																								<div class="galleryThumbSizerStills inlineblock">
																									<a href="/uploads/user/{{$comment->user_id}}/or/{{$userpic}}.png" class="galleryThumb ajaxLink" rel="gallery_{{$comment->id}}">
																										<img src="/uploads/user/{{$comment->user_id}}/thumb/{{$userpic}}.png" alt="" />
																									</a>
																								</div> 
																								@endif
																							@endforeach
																						@endif
																					@endif
																					</div>
																					@if( $comment->edited)
																						<p class="font11px lightgrey italic" id="edited_{{$comment->id}}">Last edited by <span class="badgeInline"><span class="@if($comment->editor()->isOnline()) online @else offline @endif" title="@if($comment->editor()->isOnline()) online @else offline @endif"></span> <span class="aclColor_1"><a class="plain" href="/user/{{ $comment->editor()->username }}/">{{ $comment->editor()->username }}</a></span></span>, {{$comment->edit_time()}}</p>
																					@endif
																			</div>
																	</div><!-- div class="commentcontent" -->
																</div><!-- div class="commentbody" --> 
															</div><!-- div class="commentThread" -->														
														@endif
													@endforeach

										</div>
										@endif
									<h2>All Comments<a name="comments_start"></a></h2>
									
										<div class="comments">
										
											<div class="floatleft">
												<div class="commentform torrentPage" id="main">
												@if($media->cat_id == 14 || $media->cat_id == 15)
													

															<form action="/comments/create/post/" method="post" onsubmit="return addComment(this, 'post');">
																<input type="hidden" name="turing"/>
																<input type="hidden" name="objectId" value="{{$media->object_id}}"/>

																<textarea name="content" class="comareajs botmarg5px quicksubmit"></textarea>
																<div class="qrateContainer loggedCondition">
																			
																			<div class="qrate">
																				@if(!Auth::guest() && isset($media->hasRated()->id))

																					<span>audio</span>
																					{{$media->hasRated()->audio}}

																				@else
																					<span>audio</span>
																					<select name="audio_rate" id="audio_rate">
																						<option value="" class="vote">vote </option>
																						<option value="1">1 awful</option>
																						<option value="2">2</option>
																						<option value="3">3</option>
																						<option value="4">4</option>
																						<option value="5">5</option>
																						<option value="6">6</option>
																						<option value="7">7</option>
																						<option value="8">8</option>
																						<option value="9">9</option>
																						<option value="10">10 best</option>
																					</select>
																				@endif
																			</div>
																			<span id="audioRating" class="torrentRating">9<span>/10</span></span>
																		<!-- /div>
																		<div class="qrateContainer" -->
																			<div class="qrate">
																			@if(!Auth::guest() && isset($media->hasRated()->id))
																					<span>audio</span>
																					{{$media->hasRated()->video}}
																			@else
																				<span>video </span>
																				<select name="video_rate" id="video_rate">
																					<option value="" class="vote">vote </option>
																					<option value="1">1 awful</option>
																					<option value="2">2</option>
																					<option value="3">3</option>
																					<option value="4">4</option>
																					<option value="5">5</option>
																					<option value="6">6</option>
																					<option value="7">7</option>
																					<option value="8">8</option>
																					<option value="9">9</option>
																					<option value="10">10 best</option>
																				</select>
																			@endif
																			</div>
																			<span id="videoRating" class="torrentRating">9<span>/10</span></span>
																		 </div><!-- div class="qrateContainer" -->
																		<div class="textareaRecommendation font11px">please, leave only comments related to that file</div>
																		<div class="objectAttachmentsJs overauto botmarg5px" style="clear: both;"></div>
																		<div class="buttonsline">
																						<button type="submit" class="siteButton bigButton"><span>post comment</span></button>
																		</div>
															</form>
																</div>
													
												@else


													<form action="/comments/create/post/" method="post" onsubmit="return addComment(this, 'post');">
														<input type="hidden" name="turing"/>
														<input type="hidden" name="objectId" value="{{$media->object_id}}"/>

															<textarea name="content" class="comareajs botmarg5px quicksubmit"></textarea>
																<div class="textareaRecommendation font11px">please, leave only comments related to that torrent</div>
														<div class="objectAttachmentsJs overauto botmarg5px" style="clear: both;"></div>
														<div class="buttonsline">
																		<button type="submit" class="siteButton bigButton"><span>post comment</span></button>
																</div>
													</form>
													
												@endif
												</div>
												<div id="comments">
												
													@foreach($media->comments() as $comment)
														@if($comment->deleted && $comment->replies()->count() == 0)
														
														@else
														<div class="commentThread">
															<div class="commentbody @if($comment->deleted) deletedComment @elseif($comment->isHidden()) hiddenComment @endif" id="comment{{$comment->id}}" style="background-color:#f8f7f5;">
																<div id="cpic_{{$comment->id}}" class="userPic">
																	<div class="height50px userPicHeight relative">
																		<a  href="/user/{{$comment->user()->username}}/">
																			@if(!empty($comment->user()->avatar))
																				<img class="lazyjs" data-original="{{URL::asset('/uploads/user/' . $comment->user()->id . '/thumb/' . $comment->user()->avatar . '.png' )}}" src="{{URL::asset('/images/blank.gif')}}">
																			@else
																				<img class="lazyjs" data-original="{{URL::asset('/images/user/commentlogo.png')}}" src="{{URL::asset('/images/blank.gif')}}">
																			@endif
																		</a>
																	</div>
																</div>
																<div class="commentcontent">
																		<a name="comment_{{$comment->id}}"></a>
																		<div class="commentowner">
																			<div class="rate rated" id="ratediv_{{$comment->id}}">
																					@if(!Auth::guest() && $comment->hasVoted())	
																						<a class="icon16 @if($comment->totalVotes() < 0) iminus @else iplus @endif disabledButton"><span></span></a>
																						<a href="/comments/votes/{{$comment->id}}/" title="Votes for this comment" class="ajaxLink ratemark @if($comment->totalVotes() < 0) minus @else plus @endif" id="commrate_{{$comment->id}}">{{$comment->totalVotes()}}</a>
																					@else
																						@if(Auth::guest())
																							<a href="/auth/login/" class="icon16 iminus redButton ajaxLink"><span></span></a>
																							<a href="/auth/login/" class="icon16 iplus ajaxLink"><span></span></a>
																						@elseif(Auth::user()->id != $comment->user_id)
																							<a href="javascript:rateMinus({{$comment->id}})" class="icon16 iminus redButton"><span></span></a> 
																							<a href="javascript:ratePlus({{$comment->id}})" class="icon16 iplus"><span></span></a>
																						@endif
																						<a  title="Votes for this comment" class=" ratemark " id="commrate_{{$comment->id}}">{{$comment->totalVotes()}}</a>
																					@endif
																					
																			</div><!-- div class="rate"-->

																			<div class="commentTopControlLine">
																				@if(!Auth::guest())
																					@if(Auth::user()->id != $comment->user_id)
																						<a id="report_comment_{{$comment->id}}" class="ireport redButton icon16" onclick="reportComment({{$comment->id}});" title="Report comment"><span></span></a>
																					@else
																						<a class="icon16 iedit greyButton" onClick="editComment({{$comment->id}});" title="Edit"><span></span></a>  
																						@if(!$comment->deleted)<a class="icross greyButton icon16" title="Delete comment" href="javascript: DeleteComment({{$comment->id}});"><span></span></a>@endif
																					@endif
																				@endif
																			</div>
																			<div class="commentownerLeft">
																				<span class="badgeInline">
																					<span class="@if($comment->user()->isOnline()) online @else offline @endif" title="@if($comment->user()->isOnline()) online @else offline @endif"></span> 
																					<span class="aclColor_1"><a class="plain" href="/user/{{$comment->user()->username}}/">{{$comment->user()->username}}</a></span>
																					<span title="Reputation" class="repValue @if($comment->user()->rep < 0) negative @else positive @endif">{{$comment->user()->rep}}</span>
																				</span>
																				<span id="cdate_{{$comment->id}}" class="lightgrey font11px"> &bull; {{$comment->create_time()}}              </span>
																				@if($comment->user_id == $media->user_id)<div class="uploader"><span class="rank_uploader" alt="uploader"></span></div>@endif
																				<a class="siteButton smallButton reject showComment" id="cshow_{{$comment->id}}" href="javascript:showComment({{$comment->id}})"><span>Show comment</span></a>
																			</div><!-- div class="commentownerLeft" -->
																		</div><!--commentowner-->
																		@if($comment->video != 0 && $comment->audio != 0)
																			<div class="commentAVRate bold font11px">
																				<span>audio: {{$comment->audio}}</span><span>video: {{$comment->video}}</span>   
																			</div>
																		@endif
																		<div id="ctext_{{$comment->id}}" class="commentText botmarg5px topmarg5px">
																		@if(!$comment->deleted)
																			{{$comment->getComment()}}
																		@else
																			<i>Comment is deleted</i>
																		@endif
																				<div class="objectAttachmentsJs overauto topmarg10px">
																				@if(!$comment->deleted)
																					@if(!empty($comment->image_ids))
																						@foreach(json_decode($comment->image_ids) as $userpic)
																							<?php $pic_status = UserPic::where('id', '=' , $userpic)->first(); ?>
																							@if(isset($pic_status->id) && !$pic_status->deleted)
																							<div class="galleryThumbSizerStills inlineblock">
																								<a href="/uploads/user/{{$comment->user_id}}/or/{{$userpic}}.png" class="galleryThumb ajaxLink" rel="gallery_{{$comment->id}}">
																									<img src="/uploads/user/{{$comment->user_id}}/thumb/{{$userpic}}.png" alt="" />
																								</a>
																							</div> 
																							@endif
																						@endforeach
																					@endif
																				@endif
																				</div>
																				@if( $comment->edited)
																					<p class="font11px lightgrey italic" id="edited_{{$comment->id}}">Last edited by <span class="badgeInline"><span class="@if($comment->editor()->isOnline()) online @else offline @endif" title="@if($comment->editor()->isOnline()) online @else offline @endif"></span> <span class="aclColor_1"><a class="plain" href="/user/{{ $comment->editor()->username }}/">{{ $comment->editor()->username }}</a></span></span>, {{$comment->edit_time()}}</p>
																				@endif
																		</div>
																		@if(!Auth::guest())
																		<div id="rep_link{{$comment->id}}" class="replyLink">
																			<a class="siteButton smallButton" href="javascript: showReply('{{$comment->id}}');"><span>reply</span></a>
																		</div>
																		@endif
																	<div style="display:none" id="close_link{{$comment->id}}"><a class="siteButton smallButton" href="javascript: Hide('rep{{$comment->id}}');Show('rep_link{{$comment->id}}');Hide('close_link{{$comment->id}}')"><span>close</span></a></div>
																	<div class="commentform" id="rep{{$comment->id}}" style="display:none;"></div>
																</div><!-- div class="commentcontent" -->
															</div><!-- div class="commentbody" --> 
											
															@if($comment->replies()->count() != 0)
															<div class="commentThread">
																@foreach($comment->replies()->get() as $reply)
																<div class="reply">   
																	<div class="commentbody @if($reply->deleted) deletedComment @elseif($reply->isHidden()) hiddenComment @endif" id="comment{{$reply->id}}" style="background-color:#f8f7f5;">
																		<div id="cpic_{{$reply->id}}" class="userPic">
																			<div class="height50px userPicHeight relative">
																				<a  href="/user/{{$reply->user()->username}}/">
																					@if(!empty($reply->user()->avatar))
																						<img class="lazyjs" data-original="{{URL::asset('/uploads/user/' . $reply->user()->id . '/thumb/' . $reply->user()->avatar . '.png' )}}" src="{{URL::asset('/images/blank.gif')}}">
																					@else
																						<img class="lazyjs" data-original="{{URL::asset('/images/user/commentlogo.png')}}" src="{{URL::asset('/images/blank.gif')}}">
																					@endif
																				</a>
																			</div>
																		</div>
																		<div class="commentcontent">
																			<a name="comment_{{$reply->id}}"></a>
																												
																			<div class="commentowner">
																				<div class="rate rated" id="ratediv_{{$reply->id}}">
																						@if(!Auth::guest() && $reply->hasVoted())	
																							<a class="icon16 @if($reply->totalVotes() < 0) iminus @else iplus @endif disabledButton"><span></span></a>
																							<a href="/comments/votes/{{$reply->id}}/" title="Votes for this comment" class="ajaxLink ratemark @if($reply->totalVotes() < 0) minus @else plus @endif" id="commrate_{{$reply->id}}">{{$reply->totalVotes()}}</a>
																						@else
																							@if(Auth::guest())
																								<a href="/auth/login/" class="icon16 iminus redButton ajaxLink"><span></span></a>
																								<a href="/auth/login/" class="icon16 iplus ajaxLink"><span></span></a>
																							@elseif(Auth::user()->id != $reply->user_id)
																								<a href="javascript:rateMinus({{$reply->id}})" class="icon16 iminus redButton"><span></span></a> 
																								<a href="javascript:ratePlus({{$reply->id}})" class="icon16 iplus"><span></span></a>
																							@endif
																							<a  title="Votes for this comment" class=" ratemark " id="commrate_{{$reply->id}}">{{$reply->totalVotes()}}</a>
																						@endif
																				</div><!-- div class="rate"-->

																				<div class="commentTopControlLine">
																				@if(!Auth::guest())
																					@if(Auth::user()->id != $reply->user_id)
																						<a id="report_comment_{{$reply->id}}" class="ireport redButton icon16" onclick="reportComment({{$reply->id}});" title="Report comment"><span></span></a>
																					@else
																						<a class="icon16 iedit greyButton" onClick="editComment({{$reply->id}});" title="Edit"><span></span></a>                                                    
																						@if(!$reply->deleted)<a class="icross greyButton icon16" title="Delete comment" href="javascript: DeleteComment({{$reply->id}});"><span></span></a>@endif
																					@endif
																				 @endif
																				 </div>
																				<div class="commentownerLeft">
																					<span class="badgeInline">
																						<span class="@if($reply->user()->isOnline()) online @else offline @endif" title="@if($reply->user()->isOnline()) online @else offline @endif"></span> 
																						<span class="aclColor_1"><a class="plain" href="/user/{{$reply->user()->username}}/">{{$reply->user()->username}}</a></span>
																						<span title="Reputation" class="repValue @if($comment->user()->rep < 0) negative @else positive @endif">{{$comment->user()->rep}}</span>
																					</span>
																								<span id="cdate_{{$reply->id}}" class="lightgrey font11px"> &bull; {{$reply->create_time()}}                  </span>
																								@if($reply->user_id == $media->user_id)<div class="uploader"><span class="rank_uploader" alt="uploader"></span></div>@endif
																								<a class="siteButton smallButton reject showComment" id="cshow_{{$reply->id}}" href="javascript:showComment({{$reply->id}})"><span>Show comment</span></a>
																				</div><!-- div class="commentownerLeft" -->
																			</div><!--commentowner-->
																			<div id="ctext_{{$reply->id}}" class="commentText botmarg5px topmarg5px">
																			@if(!$reply->deleted)
																				{{$reply->getComment()}}
																			@else
																				<i>Comment is deleted</i>
																			@endif
																					<div class="objectAttachmentsJs overauto topmarg10px">
																						@if(!$reply->deleted)
																							@if(!empty($reply->image_ids))
																								@foreach(json_decode($reply->image_ids) as $userpic)
																									<?php $pic_status = UserPic::where('id', '=' , $userpic)->first(); ?>
																									@if(isset($pic_status->id) && !$pic_status->deleted)
																									<div class="galleryThumbSizerStills inlineblock">
																										<a href="/uploads/user/{{$reply->user_id}}/or/{{$userpic}}.png" class="galleryThumb ajaxLink" rel="gallery_{{$reply->id}}">
																											<img src="/uploads/user/{{$reply->user_id}}/thumb/{{$userpic}}.png" alt="" />
																										</a>
																									</div> 
																									@endif
																								@endforeach
																							@endif
																						@endif
																					</div>
																				@if( $reply->edited)
																					<p class="font11px lightgrey italic" id="edited_{{$comment->id}}">Last edited by <span class="badgeInline"><span class="@if($reply->editor()->isOnline()) online @else offline @endif" title="@if($reply->editor()->isOnline()) online @else offline @endif"></span> <span class="aclColor_1"><a class="plain" href="/user/{{ $reply->editor()->username }}/">{{ $reply->editor()->username }}</a></span></span>, {{$reply->edit_time()}}</p>
																				@endif
																			</div>
																			@if(!Auth::guest())
																			<div id="rep_link{{$reply->id}}" class="replyLink">
																				<a class="siteButton smallButton" href="javascript: showReply('{{$reply->id}}');"><span>reply</span></a>
																			</div>
																			@endif
																			<div style="display:none" id="close_link{{$reply->id}}"><a class="siteButton smallButton" href="javascript: Hide('rep{{$reply->id}}');Show('rep_link{{$reply->id}}');Hide('close_link{{$reply->id}}')"><span>close</span></a></div>
																			<div class="commentform" id="rep{{$reply->id}}" style="display:none;"></div>
																		</div><!-- div class="commentcontent" -->
																	</div><!-- div class="commentbody" --> 
																</div>
																@endforeach
															</div><!-- div class="commentThread" -->
															@endif
														</div><!-- div class="commentThread" -->
														@endif
													@endforeach

													@if($media->totalComments() > 15)
														<a href="javascript: getPage(2, '{{$media->object_id}}', 'file')" class="showmore folded" id="showmore_2"><span class="font80perc">&#x25BC;</span> Show More</a>
														<div id="morecomments_2" style="display:none;"></div>
													@endif
													
													<form id="comment_form" action="/comments/create/post/" method="post" onsubmit="return addComment(this, 'post');" style="display:none">
														<input type="hidden" name="pid" value="">
														<input type="hidden" name="turing"/>
														<input type="hidden" name="objectId" value="{{$media->object_id}}"/>
														<textarea class="botmarg5px comareajs quicksubmit" name="content" rows="10" cols="10" autofocus required></textarea>
															<div class="objectAttachmentsJs overauto" style="clear: both;"></div>
														<div class="buttonsline">
															<button type="submit" class="siteButton bigButton" name="submit"><span>reply</span></button>
														</div>
													</form>
												</div>
											</div>
										</div><!-- div class="commentsLeftModule" -->
										<br />
									@if(count($media->upVoted()) != 0 || count($media->downVoted()) != 0)
										<h2>User Opinions</h2>
										<div class="userOpinionsContainer" id="useropinion">
											@if(count($media->upVoted()) != 0)
												<span class="isthumbup statusIcon"></span>  
													@foreach($media->upVoted() as $upvote)
													<span class="blank"> </span> <span class="badgeInline"><span class="@if($upvote->user()->isOnline()) online @else offline @endif" title="@if($upvote->user()->isOnline()) online @else offline @endif"></span> <span class="aclColor_1"><a class="plain" href="/user/{{$upvote->user()->username}}/">{{$upvote->user()->username}}</a></span><span title="Reputation" class="repValue @if($upvote->user()->rep < 0) negative @else positive @endif">{{$upvote->user()->rep}}</span> <a href="/messenger/create/{{$upvote->user()->username}}/" title="send private message" class="imessage ajaxLink icon16"><span></span></a></span> 
														
													@endforeach
												@if(($media->upVotes() - count($media->upVoted())) > 0) 	... And {{ ($media->upVotes() - count($media->upVoted())) }} more @endif
												<br />
											@endif
											@if(count($media->downVoted()) != 0)
												<span class="isthumbdown statusIcon valignMiddle"></span> 
													@foreach($media->downVoted() as $downvote)
													<span class="blank"> </span> <span class="badgeInline"><span class="@if($downvote->user()->isOnline()) online @else offline @endif" title="@if($downvote->user()->isOnline()) online @else offline @endif"></span> <span class="aclColor_1"><a class="plain" href="/user/{{$downvote->user()->username}}/">{{$downvote->user()->username}}</a></span><span title="Reputation" class="repValue @if($downvote->user()->rep < 0) negative @else positive @endif">{{$downvote->user()->rep}}</span> <a href="/messenger/create/{{$downvote->user()->username}}/" title="send private message" class="imessage ajaxLink icon16"><span></span></a></span> 

													@endforeach
													@if(($media->downVotes() - count($media->downVoted())) > 0) 	... And {{ ($media->downVotes() - count($media->downVoted())) }} more @endif
												<br />
											@endif
										</div>
									@endif
				
									</div>
								</div><!-- div class="tabs" -->
								<script type="text/javascript">
									function submitGood (id) {
										$.post('/links/vote/like/'+id+'/', { },
											function (data) {
													if(data.method == 'ok'){
														$($("#link_"+id+" span")[0]).attr('onclick','').html('<label></label>' + data.like_count);
														$($("#link_"+id+" span")[0]).parent().addClass( "checked" );
													}else{
														alert(data.html);
													}
											});
									}

									function submitBad(id) {
										$.post('/links/vote/dislike/'+id+'/', { },
											function (data) {
												if(data.method == 'ok'){
													$($("#link_"+id+" span")[1]).attr('onclick','').html('<label></label>' +data.dislike_count);
													$($("#link_"+id+" span")[1]).parent().addClass( "checked" );
												}else{
													alert(data.html);
												}
											});
									}
									
									function requestReupload(e, t) {
										$.ajax({
											type: 'POST',
											url: '/links/requestreupload/' + e + '/',
											data: {
												ajax: 1
											},
											dataType: 'json',
											beforeSend: function (e) {
												$(t).html('<img src="/images/indicator.gif" alt="loading..."/>')
											},
											success: function (e) {
												$(t).removeClass('irefresh').addClass('icheck');
												$(t).attr('onclick','').html('<span></span> Request submitted')
											}
										});
										return !1
									}
								</script>
		</td>
		<td class="sidebarCell">
			@include('layouts.sidebar', array('show_control'=> true))

		</td>
	</tr>
</table>

@stop