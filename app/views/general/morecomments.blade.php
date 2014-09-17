													@foreach($comments as $comment)
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
													
													@if($media->totalComments() > $limit)
														<a href="javascript: getPage({{$page}}, '{{$media->object_id}}', 'post')" class="showmore folded" id="showmore_{{$page}}"><span class="font80perc">&#x25BC;</span> Show More</a>
														<div id="morecomments_{{$page}}" style="display:none;"></div>
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