<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>斐济旅行</title>
		{{ Basset::show('user.css') }}
		<meat charset="utf-8" />
	</head>
	<body>
		<div class="box" id="box">
			<!-- 头部开始  -->
			<div class="head">
				<div class="head_list">
					<div class="logo"></div>
					<div class="list">
						<ul class="list_card">
							<li>首页</li>
							<li class="list_index">酒店</li>
							<li>机票</li>
							<li class="list_end">专题</li>
						</ul>
					</div>
					<div class="login">
						<ul class="login_card">
							<li>登录</li>
							<li class="list_end">注册</li>
						</ul>
					</div>
					<div class="love_feiji">
						<div class="love_word">世界上有两个天堂,一个在你心里,一个在斐济。</div>
					</div>
				</div>
			</div>
			<!-- 头部结束  -->
			<!-- 正文开始  -->
			<div class="content">
				<div class="content_body">
					<div class="content_user_show">
							<ul class="content_user_ul">
								<li class="content_user_card1">我的好友</li>
								<li class="content_user_card2" style="margin-left:10px;">我喜欢</li>
							</ul>
							<div class="content_user_card_bottom"></div>
					</div>
					<div style="height:1580px;margin-right:-20px;margin-top:15px;">
						<ul>
@foreach($users as $user)
<a href=" {{{ URL::to('user/show/'.$user->id)}}} ">
							<li class="user_mes">
								<ul>
									<li class="user_img"><img src=" {{{ $user->avatar }}} " width=320 height=250 /></li>
									<li class="user_name"><div class="user_name_box">{{{ $user->username }}}</div><div class="user_word">{{{$user->intro}}}</div><div class="user_talk"></div></li>
								</ul>
							</li>
</a>
@endforeach
						</ul>
					</div>
					<div>
					{{ $users->links() }}
						<ul class="show_page_2">
							<li  class="show_li_1">1</li>
							<li  class="show_li_2">2</li>
							<li class="show_page_next">下一页</li>
						</ul>
					</div>
				</div>
				<div class="content_bottom"></div>
			</div>
			<!-- 正文结束  -->
			<!-- 底部开始  -->
			<div class="bottom">
				<div class="bottom_word">因为有你，冲绳天堂的距离更进一步！</div>
				<div class="bottom_wall"></div>
				<div class="bottom_href"></div>
			</div>
			<!-- 底部结束  -->
		</div>
		<script type="text/javascript">
			function check_screen()
			{
				var w=window.screen.width;
				var width=document.documentElement.clientWidth;
				if(w<1920)
				{
					document.getElementById("box").style.left=-(1920-width)/2+"px";
				}
			}
			check_screen();
		</script>
	</body>
</html>
