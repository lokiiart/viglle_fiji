<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta charset="utf-8" />
		<title>
			@section('title')
			斐济旅行
			@show
		</title>	
		<meta name="keywords" content="斐济旅行" />
		<meta name="author" content="Viglle" />
		<meta name="description" content="斐济旅行" />

		<!-- Mobile Specific Metas
		================================================== -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- CSS
		================================================== -->
       

		@section('styles')
		@show
		<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

		<!-- Favicons
		================================================== -->
		<link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{{ asset('assets/ico/apple-touch-icon-144-precomposed.png') }}}">
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{{ asset('assets/ico/apple-touch-icon-114-precomposed.png') }}}">
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{{ asset('assets/ico/apple-touch-icon-72-precomposed.png') }}}">
		<link rel="apple-touch-icon-precomposed" href="{{{ asset('assets/ico/apple-touch-icon-57-precomposed.png') }}}">
		<link rel="shortcut icon" href="{{{ asset('assets/ico/favicon.png') }}}">
	</head>
	<body>
			<!-- 头部开始  -->
			<div class="box">
				<div class="head" style="position:absolute;top:0px;z-index:1;"></div>
				<div style="width:1000px;margin-right:auto;margin-left:auto;z-index:2;position:relative;height:630px;">
					<div class="head_list">
						<div class="logo"><a href="{{{ URL::to('/') }}}" style="display:block;width:100%;height:100%;"></a></div>
						<div class="list">
							<ul class="list_card">
									<li><a href="{{{ URL::to('/') }}}" {{ (Request::is('/') ? ' class="active"' : '')}}>首页</a></li>
									<li class="list_index"><a href="{{{ URL::to('/hotel/index') }}}" {{ (Request::is('hotel/index') ? ' class="active"' : '')}}>酒店</a></li>
								<li><a href="{{{ URL::to('/ticket/index') }}}" {{ (Request::is('ticket/index') ? ' class="active"' : '')}}>机票</a></li>
								<li class="list_end"><a href="{{{ URL::to('/travel/index') }}}" {{ (Request::is('travel/index') ? ' class="active"' : '')}}>攻略</a></li>
							</ul>
						</div>
						<div class="login">
							<ul class="login_card">
	                        @if (Auth::check())
							 @if (Auth::user()->hasRole('admin'))
							 <li style="font-size:12px;"><a href="{{{ URL::to('admin') }}}"> 管理员</a></li>
							  @endif
							 <li style="font-size:12px;"><a href="{{{ URL::to('user/show/'.Auth::user()->id) }}}"> {{{ Auth::user()->username }}}</a></li>
							  <li style="font-size:12px;"><a href="{{{ URL::to('user/logout') }}}">登出</a></li>
							@else
								<li style="font-size:12px;" {{ (Request::is('user/login') ? ' class="active"' : '') }}><a href="{{{ URL::to('user/login') }}}" class="iframe">登陆</a></li>
								<li style="font-size:12px;" {{ (Request::is('user/register') ? ' class="active"' : '') }}><a href="{{{ URL::to('user/create') }}}" class="iframe">{{{ Lang::get('site.sign_up') }}}</a></li>
	                        @endif
							</ul>
						</div>
					@section('userprofile')
						<div class="love_feiji">
							<div class="love_word">世界上有两个天堂,一个在你心里,一个在斐济。</div>
						</div>
				@show
				</div>
			</div>
		</div>
			<!-- 头部结束  -->
			@include('notifications')
			<!-- ./ notifications -->

			<!-- 正文开始  -->
			@yield('content')
			<!-- 正文结束  -->
			<!-- 底部开始  -->
			<div class="bottom">
				<div class="bottom_word">因为有你，冲绳天堂的距离更进一步！</div>
				<div class="bottom_wall"></div>
				<div class="bottom_href"></div>
			</div>
			<!-- 底部结束  -->
        {{ Basset::show('public.js') }}
		@section('scripts')
		@show
		<script>
				$(document).ready(function(){
						$(".iframe").colorbox({iframe:true,width:"480px",height:"670px:",opacity:"0.5"});
						$(".login_close").click(function(){
							$.colorbox.close();
						});
				})
		</script>
	</body>
</html>
