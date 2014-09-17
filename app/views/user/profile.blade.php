@extends('layouts.master')
@section('content')

<table width="100%" cellspacing="0" cellpadding="0" class="doublecelltable">
	<tr>
		<td width="100%"> 	
		
			<h1 class="nickname">{{ $user->username }}<span title="Reputation" class="repValue @if($user->rep < 0) negative @else positive @endif">{{$user->rep}}</span> </h1>
			<div class="lightgrey font12px"><span class="aclColor_1">{{$user->levelName()}}</span></div>
			<div class="tabs">
				<ul class="tabNavigation">
					<li><a href="/user/{{ $user->username }}/" class="darkButton selectedTab"><span>profile</span></a></li>
					@if(!Auth::guest() && $user->id == Auth::user()->id) <li><a href="/user/{{ $user->username }}/recentimages/" class="darkButton "><span>images</span></a></li> @endif
					@if($user->allFriends()->count() != 0) <li><a href="/user/{{ $user->username }}/friends/" class="darkButton"><span>Friends <i class="menuValue">{{$user->allFriends()->count() }}</i></span></a></li>   @endif   
					<li><a href="/user/{{ $user->username }}/comments/" class="darkButton "><span>Comments <i class="menuValue">1</i></span></a></li>          
				</ul>
				<hr class="tabsSeparator" />
			</div>

			<div class="userPic floatleft userPicSize100px">
				<div class="userPicHeight relative" >
					@if(!empty($user->avatar))
						<img src="/uploads/user/{{$user->id}}/thumb/{{$user->avatar}}.png" class="maxwidth100px maxheight100px">
					@else
						<img src="/images/user/commentlogo.png" class="maxwidth100px maxheight100px">
					@endif
					
				</div>
				<div class="badgeSiteStatus width100px botmarg10px">
					<span class="@if($user->isOnline()) online @else offline @endif" title="@if($user->isOnline()) online @else offline @endif"></span>
				</div>
			</div>
			@if(!Auth::guest() && Auth::user()->id != $user->id)
				<div class="botmarg10px" style="margin-left: 115px">
						<a href="/bookmarks/add/user/30e5cb48edac59153fe973900e24695c/" class="postLink textButton iheart icon16"><span></span>add to bookmarks</a>
						@if(Auth::user()->friendStatus($user) != 1)
							@if(Auth::user()->friendStatus($user) == 3 || Auth::user()->friendStatus($user) == 2)
								@if(Auth::user()->friendStatus($user) == 2)
									<a href="/friend/approve/{{$user->username}}/" class="postLink textButton icheck icon16"><span></span>accept friend request</a>
									<a href="/friend/cancel/{{$user->username}}/" class="ajaxLink textButton greyButton icross icon16"><span></span>reject friend request</a>
								@else	
									<a href="/friend/cancel/{{$user->username}}/" class="ajaxLink textButton greyButton icross icon16"><span></span>cancel friend request</a>
								@endif
							@else
								<a href="/friend/request/{{$user->username}}/" class="postLink textButton iplus icon16"><span></span>send a friend request</a>
							@endif
						@else
							<a href="/friend/cancel/{{$user->username}}/" class="ajaxLink textButton redButton icross icon16"><span></span>remove from friends</a>
						@endif
						<a href="/account/report/{{$user->hash}}/" class="ajaxLink textButton redButton ireport icon16"><span></span>report user</a>
				</div>
			@endif
			<div class="botmarg10px"  style="margin-left: 110px">
				<div class="profileBody"> 
					@if(!empty($user->status) || ( !Auth::guest() && Auth::user()->id == $user->id))
						<div class="profileCloud">
							<div class="statusCloud"> 				
								@if(!empty($user->status))
									@if( !Auth::guest() && Auth::user()->id == $user->id)
									<a onclick="$('#edit_status').toggle();return false;" title="edit status" class="editStatus smallButton siteButton"><span>edit status</span></a>	
									@endif
									<div id="status_message" class="userStatusMessage"> {{ $user->status }} </div>
									<div class="updatedStatus">updated	{{$user->status_last}}</div>
								@else
									<div id="status_message" class="userStatusMessage">  </div>
									<div class="updatedStatus"></div>
								@endif
									<div id="edit_status" @if(!empty($user->status)) style="display:none;" @endif ><br />
										<form action="/account/updatestatus/" method="post" accept-charset="utf-8" onsubmit="return setStatusMessage(this);">
											<input type="hidden" name="csrf_token" value="8b13d0785094ae1e701293f8abfad2b1"/>
											<input name="message" class="textinput longinput" type="text" id="message" autofocus />&nbsp;<button type="submit" class="bigButton siteButton" value="" onclick=""><span>Update</span></button>
										</form>
									</div>
							</div>
						</div>
					@endif
					<div class="leftpad10px"> 						
						<table class="formtable" cellspacing="0" cellpadding="0">
							<tr>
								<td class="nobr"><strong>Joined:</strong></td>
								<td width="100%">{{ $user->joined }}</td>
							</tr>
                            <tr>
								<td class="nobr"><strong>Last visit:</strong></td>
								<td>{{ $user->last }}</td>
							</tr>													                            																					
						</table>
					</div>
				</div>
				<!-- div class="profileBody" --> 
			</div>
			<!-- div class="profileCard"--> 
			@if($user->achievements()->count() != 0)
			<h2>User Achievements</h2>
			<table class="achTable">
					@if($user->achievements()->where('type','=', 4)->count() != 0)
						<tr>
							<td><strong>Special:</strong></td>
							<td class="botpad5px"> 
									@foreach($user->achievements()->where('type','=', 4)->get() as $s)
										<span class="specialAch"><span title="Surprise !!  Earned 1&nbsp;min.&nbsp;ago."><a href="/achievements/{{$s->name}}/">{{$s->name}}</a></span></span>   
									@endforeach      		
							</td>
						</tr>
					@endif
					@if($user->achievements()->where('type','=', 3)->count() != 0)
					<tr>
						<td><strong>Gold:</strong></td>
						<td class="botpad5px"> 		
								@foreach($user->achievements()->where('type','=', 3)->get() as $g)
									<span class="goldAch"><span title="More than a year with us. Earned 11&nbsp;min.&nbsp;ago."><a href="/achievements/{{$g->name}}/">{{$g->name}}</a></span></span>
								@endforeach	
						</td>
					</tr>
					@endif
					@if($user->achievements()->where('type','=', 2)->count() != 0)
						<tr>
							<td><strong>Silver:</strong></td>
							<td class="botpad5px"> 
								@foreach($user->achievements()->where('type','=', 2)->get() as $sv)
									<span class="silverAch"><span title="Visited Kickasstorrents over 50 times. Earned 3&nbsp;years&nbsp;ago."><a href="/achievements/{{$sv->name}}/">{{$sv->name}}</a></span></span>  
								@endforeach
							</td>
						</tr>
					@endif
					@if($user->achievements()->where('type','=', 1)->count() != 0)
					<tr>
						<td><strong>Bronze:</strong></td>
						<td class="botpad5px"> 
							@foreach($user->achievements()->where('type','=', 1)->get() as $b)
								<span class="bronzeAch"><span title="Visited Kickasstorrents over 10 times Earned 8&nbsp;months&nbsp;ago."><a href="/achievements/{{$b->name}}/">{{$b->name}}</a></span></span>            		
							@endforeach
						</td>
					</tr>
					@endif
					@if($user->achievements()->where('type','=', 0)->count() != 0)
					<tr>
						<td><strong>Simple:</strong></td>
						<td class="botpad5px"> 
							@foreach($user->achievements()->where('type','=', 0)->get() as $sm)
								<span class="simpleAch"><span title="Downloaded first torrent. Earned 1&nbsp;year and 5&nbsp;months&nbsp;ago."><a href="/achievements/{{$sm->name}}/">{{$sm->name}}</a></span></span>            		
							@endforeach
						</td>
					</tr>
					@endif
			</table>
			<hr />
			@endif
			@if(!Auth::guest() && Auth::user()->id == $user->id)
				<h2>Share yourself!</h2>
				<h4>Standard Userbar</h4>
				<div class="width405px floatleft botpad10px"><img src="/widgets/user/basic/{{$user->id}}.png" alt="widget" /></div>
				<div class="leftpad15px floatleft">
					<label class="inlineblock width50px">bbcode</label> 
					<input onclick="select()" value='[img]//dat.as//widgets/user/basic/{{$user->id}}.png[/img]' type="text" class="textinput" />
				</div>
				<br class="clear" /><br />
				<h4>Full Info Widget</h4>
				<div class="width405px floatleft botpad10px"><img src="/widgets/user/full/{{$user->id}}.png" alt="widget" /></div>
				<div class="leftpad15px floatleft">
					<label class="inlineblock width50px">html</label> 
					<input onclick="select()" value='<a href="http://dat.as/user/{{$user->username}}/"><img src="//dat.as/widgets/user/full/{{$user->id}}.png"></a>' type="text" class="textinput" /><br />
					<label class="inlineblock width50px">bbcode</label> 
					<input onclick="select()" value='[url="//dat.as/user/{{$user->username}}/"][img]//dat.as/widgets/user/full/{{$user->id}}.png[/img][/url]' type="text" class="textinput" />
				</div>
			<br class="clear" /><hr />
			@endif
		@if(!Auth::guest())	
			@if(Auth::user()->id == $user->id && Auth::user()->friendsAccept()->count() != 0)
				<h3>Awaiting my approval</h3>
				<div class="botmarg10px overauto clear">
					@foreach( Auth::user()->friendsAccept()->take(5)->get() as $friendAccept)
						<div class="badge">
							<div class="userPic">
						 
								<div class="userPicHeight relative">
												<a href="/user/{{$friendAccept->username}}/"><img src="/images/user/commentlogo.png"></a>		</div>
								<div class="badgeSiteStatus">
													<a href="/messenger/create/{{$friendAccept->username}}/" title="send private message" class="imessage ajaxLink icon16"><span></span></a>
												<span class="@if($friendAccept->isOnline()) online @else offline @endif" title="@if($friendAccept->isOnline()) online @else offline @endif"></span>
											</div>
							</div><!-- div class="userPic" -->
							<div class="badgeInfo">
								<span class="badgeUsernamejs font12px overhidden nobr">
										<a class="plain" href="/user/{{$friendAccept->username}}/">{{$friendAccept->username}}</a><span title="Reputation" class="repValue @if($friendAccept->rep < 0) negative @else positive @endif">{{$friendAccept->rep}}</span></span>
								<span class="font10px lightgrey aclColor_1">{{$friendAccept->levelName()}}</span>    

								<div class="smallButtonsline">
									<a class="siteButton smallButton" onclick="return saveFriendRequest(this);" href="/friend/approve/{{$friendAccept->username}}/"><span>accept</span></a>
									<a class="siteButton smallButton greyButton" onclick="return saveFriendRequest(this);" href="/friend/cancel/{{$friendAccept->username}}/"><span>reject</span></a>
								</div>
							</div>
						</div><!-- div class="badge" -->    	
					@endforeach
				</div>
			@endif
			
			@if(Auth::user()->id == $user->id && Auth::user()->friendsPending()->count() != 0)
				<h3>Pending Approval</h3>
				<div class="botmarg10px overauto clear">
					@foreach( Auth::user()->friendsPending()->take(5)->get() as $friendPending)
						<div class="badge">
							<div class="userPic">
						 
								<div class="userPicHeight relative">
									<a href="/user/{{$friendPending->username}}/"><img src="/images/user/commentlogo.png"></a>		
								</div>
								<div class="badgeSiteStatus">
									<a href="/messenger/create/{{$friendPending->username}}/" title="send private message" class="imessage ajaxLink icon16"><span></span></a>
									<span class="@if($friendPending->isOnline()) online @else offline @endif" title="@if($friendPending->isOnline()) online @else offline @endif"></span>
								</div>
							</div><!-- div class="userPic" -->
							<div class="badgeInfo">
								<span class="badgeUsernamejs font12px overhidden nobr">
									<a class="plain" href="/user/{{$friendPending->username}}/">{{$friendPending->username}}</a><span title="Reputation" class="repValue @if($friendPending->rep < 0) negative @else positive @endif">{{$friendPending->rep}}</span>
								</span>
								<span class="font10px lightgrey aclColor_1">{{$friendPending->levelName()}}</span>    

								<div class="smallButtonsline">
									<a class="siteButton smallButton redButton" onclick="return saveFriendRequest(this);" href="/friend/cancel/{{$friendPending->username}}/"><span>cancel</span></a>
								</div>
							</div>
						</div><!-- div class="badge" -->    
					@endforeach
				</div>
			@endif
		@endif
			<div class="clear"></div>
			<div class="comments">
				<h2>The Wall</h2>
				@if(!Auth::guest())
				<div class="floatleft">
				
                    <div class="commentform" id="main">
						<form action="/comments/create/user/" method="post" onsubmit="return addComment(this, 'user');">
							<input type="hidden" name="turing"/>
							<input type="hidden" name="objectId" value="{{$user->object_id}}"/>

							<textarea name="content" class="comareajs botmarg5px quicksubmit"></textarea>
							<div class="objectAttachmentsJs overauto botmarg5px" style="clear: both;"></div>
							<div class="buttonsline">
								<button type="submit" class="siteButton bigButton"><span>post comment</span></button>
							</div>
						</form>
					</div>
                </div>
				@endif
				<div id="comments">	
					@foreach($user->comments() as $comment)
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
							@if($user->totalComments() > 15)
								<a href="javascript: getPage(2, '{{$user->object_id}}', 'user')" class="showmore folded" id="showmore_2"><span class="font80perc">&#x25BC;</span> Show More</a>
								<div id="morecomments_2" style="display:none;"></div>
							@endif
							<form id="comment_form" action="/comments/create/user/" method="post" onsubmit="return addComment(this, 'user');" style="display:none">
								<input type="hidden" name="pid" value="">
								<input type="hidden" name="turing"/>
								<input type="hidden" name="objectId" value="{{$user->object_id}}"/>
								<textarea class="botmarg5px comareajs quicksubmit" name="content" rows="10" cols="10" autofocus required></textarea>
									<div class="objectAttachmentsJs overauto" style="clear: both;"></div>
								<div class="buttonsline">
									<button type="submit" class="siteButton bigButton" name="submit"><span>reply</span></button>
								</div>
							</form>
				</div>
			</div>
		</td>
		<td class="sidebarCell">
			
			<div id="sidebar" class="sidebarLogged font11px">
					<div class="sliderbox">
					<h3>Latest Searches</h3>
					<ul>
						<li>
							<a href="/search/domino%20rally%20wii/"><span class="isearch icon16"><span></span></span>domino rally wii</a>
									<span class="explanation">just&nbsp;now</span>
						</li>
						<li>
							<a href="/search/oblivion/"><span class="isearch icon16"><span></span></span>oblivion</a>
									<span class="explanation">just&nbsp;now</span>
						</li>
						<li>
							<a href="/search/jonathan%20maberry/"><span class="isearch icon16"><span></span></span>jonathan maberry</a>
									<span class="explanation">just&nbsp;now</span>
						</li>
						<li>
							<a href="/search/emergency/"><span class="isearch icon16"><span></span></span>emergency</a>
									<span class="explanation">just&nbsp;now</span>
						</li>
						<li>
							<a href="/search/%3Dshort%20xxx%20clip/"><span class="isearch icon16"><span></span></span>=short xxx clip</a>
									<span class="explanation">just&nbsp;now</span>
						</li>
						<li>
							<a href="/search/this.is.40.2012.unrated.720p.brrip/"><span class="isearch icon16"><span></span></span>this.is.40.2012.unrated.720p.brrip</a>
									<span class="explanation">just&nbsp;now</span>
						</li>
						<li>
							<a href="/search/neat%20cs4/"><span class="isearch icon16"><span></span></span>neat cs4</a>
									<span class="explanation">just&nbsp;now</span>
						</li>
						<li>
							<a href="/search/hate/"><span class="isearch icon16"><span></span></span>hate</a>
									<span class="explanation">just&nbsp;now</span>
						</li>
						<li>
							<a href="/search/t.i.%20flac/"><span class="isearch icon16"><span></span></span>t.i. flac</a>
									<span class="explanation">just&nbsp;now</span>
						</li>
						<li>
							<a href="/search/off%20the%20black/"><span class="isearch icon16"><span></span></span>Off the Black</a>
									<span class="explanation">just&nbsp;now</span>
						</li>
						<li>
							<a href="/search/dj%20shadow/"><span class="isearch icon16"><span></span></span>dj shadow</a>
									<span class="explanation">just&nbsp;now</span>
						</li>
					</ul>
					</div><!-- div class="sliderbox" -->
					<div class="sliderbox">
						<h3>Friends Links</h3>
						<ul>
							
							<li>
								<a href="http://torrents.to/" target="_blank" rel="external">
									<span class="itorrentsto thirdPartIcons"></span>Torrents.to
								</a>
							</li>
							<li>
								<a href="http://www.torrentdownloads.net/" target="_blank" rel="external">
									<span class="itorrentdownloads thirdPartIcons"></span>Torrent Downloads
								</a>
							</li>
							
							<li>
								<a href="http://www.torrentreactor.net/" target="_blank" rel="external">
									<span class="itorreact thirdPartIcons"></span>TorrentReactor
								</a>
							</li>
							

							<li>
								<a href="http://torrent-finder.info/" target="_blank" rel="external">
									<span class="itorrentfinder thirdPartIcons"></span>Torrent Finder
								</a>
							</li>
						</ul>
					</div><!-- div class="sliderbox" -->
        
			</div>
        </td>
	</tr>
</table>
@stop