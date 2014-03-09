@extends('fiji/layouts/default')

@section('styles')
		{{ Basset::show('customer.css') }}
@stop


@section('userprofile')
<div id="user_mes">
						<div class="user_img">
							<img src=" {{{ $user->avatar }}} " width=230 height=230 style="margin:6px 6px;" />
                            @if ((!is_null($currentuser))&&($currentuser->id == $user->id)) 
                            <a class="iframe" style="position: absolute;
color: black;
z-index: 999;
margin-top: -25px;
margin-left: 10px;
font-size: small;" href="/user/avatar">点击更换头像</a>
                            @endif
						</div>
						<div class="user_content">
                            @if ((!is_null($currentuser))&&($currentuser->id == $user->id)) 
							<a href="/user/set" class="iframe">    <div class="user_set"></div></a>
                            @else
                            <div class="user_set" style="background:none;"></div>
                            @endif
							<div class="user_word">
								<div class="user_top">
									<div class="user_introduce"><span style="margin-left:20px;">{{{ $user->username }}}</span></div>
									<div class="user_Triangle"></div>
								</div>
								<div class="user_bottom">
									<div class="user_show_word">{{{ $user->intro }}}</div>
                            @if ((!is_null($currentuser))&&($currentuser->id == $user->id)) 
									<a href="/user/info" class="iframe">    <p>编辑个人介绍</p></a>
                            @endif
								</div>
							</div>
						</div>
					</div>
@stop

@section('content')
<div class="content">
				<div class="content_title">
                            @if ((!is_null($currentuser))&&($currentuser->id == $user->id)) 
					<a href="{{{URL::to('user/album')}}}" class="iframe"><div class="content_upload_pic"></div></a>
                            @endif
				</div>
				<div class="content_show_pic">
					<div class="pic_left"><img src="{{{asset('images/left.png')}}}" width=45 height=90 /></div>
					<div class="pic_center">
						<table cellspacing=0 cellpadding=0 class="user_all_img" style="width:1100px;">
							<tr>
@foreach($userpics as $userpic)
								<td class="imgs_td"><img src="{{{ asset($userpic->pic_url.'/'.$userpic->filename) }}}" width=200 height=200 /></td>
@endforeach
								<td>&nbsp;</td>
							</tr>
						</table>
					</div>
					<div class="pic_right"><img src="{{{ asset('images/right.png') }}}" width=45 height=90 /></div>
				</div>
				<div class="content_body">
					<div class="content_user_show">
						<ul class="content_user_ul">
							<li class="content_user_card1">我的攻略</li>
							<li class="content_user_card2" style="margin-left:10px;">我喜欢</li>
							<li class="content_user_card2" style="margin-left:10px;">我的足迹</li>
						</ul>
						<div class="content_user_card_bottom"></div>
						<div class="raiders_msg">
							<ul class="raiders_content">
@foreach($travels as $travel)
								<li class="raiders_li1"><img src=" {{{ $travel->has_pic }}} " width=300 height=200 /></li>
								<li class="raiders_li2">
									<div style="width:380px;margin:20px;">
                                        <a href=" {{{ $travel->url() }}} ">
										<p class="raiders_title">{{{ $travel->title }}}</p>
                                        </a>
                                        <p><span class="raiders_user_name">{{{ $travel->author->username }}}</span><span class="raiders_user_time">发布于{{{ $travel->date() }}}</span></p>
                                        <p class="raiders_user_text">{{{ $travel->summary() }}}……</p>
									</div>
<div id="travel_mark_{{{ $travel->id }}}" style="float:right">
				<a href="javascript:;" onclick="unlike({{{$travel->id}}})" class="unlike_post" style="display:none;" >取消赞</a>
                <a href="javascript:;" onclick="like({{{$travel->id}}})" class="like_post" >
                    <img src=" {{asset('images/good.png')}} " alt="">
                </a> 
					<span id="if_like_{{{$travel->id}}}"></span> <span id="likecontent_{{{$travel->id}}}"><span  id="count_{{{$travel->id}}}" class="color">{{{$travel->mark}}}</span> <span id="people_{{{$travel->id}}}" class="color">人</span>喜欢</span>
</div>
								</li>
@endforeach
							</ul>
						</div>
						<div>
							<ul class="show_page_1">
                                {{ $travels->appends(array('p'=>'travel'))->links() }}
								<li  class="show_li_1">1</li>
								<li  class="show_li_2">2</li>
								<li class="show_page_next">下一页</li>
							</ul>
						</div>
					</div>
					<div class="content_other_mes">
							<a href="{{{ URL::to('travel/create') }}}">						<div class="enter_raiders"></div></a>
						<div class="go_where">
							<a href="/user/list">    <div class="more_where">更多</div></a>
							<ul class="show_where_user">
                                @foreach($users as $userlow)
								<li>
                                <p><img src=" {{{ $userlow->avatar }}} " width=105 height=105 /></p>
                                <p style="font-size:14px;color:#808080;height:30px;line-height:30px;" align=center>{{{$userlow->username}}}</p>
								</li>
                                @endforeach
							</ul>
						</div>
						<div class="your_city">
							<a href="/user/list">    <div class="more_city">更多</div></a>
							<ul class="show_city_user">
                                @foreach($usersincity as $userlow)
								<li>
                                <p><img src=" {{{ $userlow->avatar }}} " width=105 height=105 /></p>
                                <p style="font-size:14px;color:#808080;height:30px;line-height:30px;" align=center>{{{$userlow->username}}}</p>
								</li>
                                @endforeach
							</ul>
						</div>
					</div>
				</div>
					<div id="usercomment"  class="talk_place">
                        @include('notifications')
						<div class="talk_title"></div>
						<div class="talk_bg">
                            <form id="usercommentform" action=" {{{ URL::to('user/show/'.$user->id) }}}" method="POST" >
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <textarea name="comment" style="width:938px;height:138px;border:0px;font-size:18px;color:#999;text-indent:2em;line-height:30px;overflow:hidden;" onfocus="if(this.value=='说你想说的'){this.value='';}" onblur="if(this.value==''){this.value='说你想说的';}" value="说你想说的">说你想说的</textarea>
                            </form>
						</div>
						<div  class="talk_enter" onclick="document.getElementById('usercommentform').submit()"></div>
                        <!--评论展示开始-->
                        @foreach($comments as $comment)
                        @if ( $comment->owner->id == $user->id )
                            <div class="talk_user_msg_1">
                                <div class="talk_user_text_2">
                                    <p class="user_text_1">{{{ $comment->content }}}</p>
                                    <p class="user_time_2">{{{ $comment->date() }}}</p>
                                </div>
                                
                                <div class="talk_user_img_2" style="background:none;">
                                    <img src=" {{{ $comment->owner->avatar }}} "  style="border-radius:5em;border:5px solid #fff;" width=100 height=100 />
                                </div>
                                
                                <div class="talk_user_box_2">
                                    <ul>
                                        <li class="talk_user_name">{{{ $comment->owner->username }}}</li>
                                        <li class="talk_user_enter">回复</li>
                                    </ul>
                                </div>
                            </div>
                        @else
                            <div class="talk_user_msg_1">
                                <div class="talk_user_img_1" style="background:none;">
                                    <img src="{{{ $comment->owner->avatar }}} " style="border-radius:5em;border:5px solid #fff;" width=100 height=100 />
                                </div>
                                <div class="talk_user_text_1">
                                    <p class="user_text_1">{{{ $comment->content }}}</p>
                                    <p class="user_time_1">{{{ $comment->date() }}}</p>
                                </div>
                                <div class="talk_user_box_1">
                                    <ul>
                                        <li class="talk_user_name">{{{ $comment->owner->username }}}</li>
                                        <li class="talk_user_enter">回复</li>
                                    </ul>
                                </div>
                            </div>
                        @endif
                        @endforeach
						
						<div>
							<ul class="show_page_2">
	                            {{ $comments->appends(array('p'=>'usercomment'))->links() }}
								<li  class="show_li_1">1</li>
								<li  class="show_li_2">2</li>
								<li class="show_page_next">下一页</li>
							</ul>
						</div>
					</div>
					
			</div>
@stop
@section('scripts')
	<script type="text/javascript" src="js/jquery.js"></script> 
	<script type="text/javascript">
		var thispage=0;
		var countpage="4";
		$(document).ready(function(){
			 $(".pic_right").click(function () {
				if (thispage == (parseInt(countpage) - 1)) {
					return;
				}
				thispage++;
				var MarginLeft = thispage *220;
				 $(".user_all_img").stop(true).delay(300).animate({"marginLeft": "-" + MarginLeft + "px"});
			});
			$(".pic_left").click(function () {
				if (thispage == 0) {
					return;
				}
				thispage--;
				var MarginRight = thispage * 220;
				$(".user_all_img").stop(true).delay(300).animate({"marginLeft": "-" + MarginRight + "px"});
			});
		});

function like(travel_id){
        @if (is_null($user))
        window.location.href='/user/login';
        @else
        var user_id = {{{$user->id}}};
        $.ajax({
            url: '/travel/addmark',
            type: 'GET',
            data: 'user_id='+user_id+'&travel_id='+travel_id,
            success: function(data) {
            console.log(data);
            }
        });
        

        var count = parseFloat($('#count_'+travel_id).html()) + 1;
        if(count > 1) {
            $('#if_like_'+travel_id).html('除了你，还有');
            $('#people_'+travel_id).html('人也喜欢');
            $('#count_'+travel_id).html(count);
        } else {
            $('#if_like_'+travel_id).html('你点了赞');
            $('#likecontent_'+travel_id).hide();
		}

		$('#like_post_'+travel_id).hide();
		$('#unlike_post_'+travel_id).show();
        @endif
}

function unlike(travel_id){
        @if (is_null($user))
        window.location.href='/user/login';
        @else
        var user_id = {{{$user->id}}};
        $.ajax({
            url: '/travel/submark',
            type: 'GET',
            data: 'user_id='+user_id+'&travel_id='+travel_id,
            success: function(data) {
            console.log(data);
            }
        });
        var count = parseFloat($('#count_'+travel_id).html()) - 1;
        if(count < 1) {
            $('#likecontent_'+travel_id).show();	
        }
        $('#unlike_post_'+travel_id).hide();
        $('#like_post_'+travel_id).show();
        $('#if_like_'+travel_id).html('');
        $('#people_'+travel_id).html('人');
        @endif
}


	</script>
@stop
