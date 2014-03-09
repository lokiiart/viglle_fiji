<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title></title>
		<meta charset="utf-8" />
        {{ Basset::show('public.css') }}
		<style>
			*
			{
				margin:0px;
				padding:0px;
			}
			body
			{
				margin:0px;
				padding:0px;
				font-family:'微软雅黑';
			}
			.login_box
			{
				position:relative;
				width:470px;
				height:480px;
			}
			.login_close
			{
				position:absolute;
				top:110px;
				left:420px;
				width:45px;
				height:45px;
				background:url({{{ asset('images/login_close.png') }}});
				cursor:pointer;
			}
			.login_top
			{
				width:444px;
				height:133px;
				background:url({{{ asset('images/fiji_you.png') }}});
			}
			.mes_box
			{
				width:445px;
				height:350px;
				background:white;
			}
			.td1
			{
				width:110px;
				height:40px;
				line-height:40px;
				text-align:right;
			}
			.td2
			{
				height:100px;
			}
			.mes_show input,textarea
			{
				width:308px;
				height:33px;
				border:1px solid #ff9500;
			}
			.mes_title
			{
				font-size:20px;
				color:#333;
				height:55px;
				line-height:55px;
			}
			.mes_title span
			{
				padding-left:15px;
			}
			.go_login
			{
				width:445px;
				height:105px;
				background:#f3f3f3;
			}
			.go_lg
			{
				margin:10px auto;
				width:250px;
				height:38px;
				background:url({{{ asset('images/go_lg.png') }}});
				cursor:pointer;
			}
			.login_in
			{
				margin-left:5px;
			}
			.login_in ul
			{
				list-style-type:none;
			}
			.login_in ul li
			{
				width:100px;
				height:30px;
				float:left;
				margin-left:5px;
				margin-top:12px;
				cursor:pointer;
			}
			.sina
			{
					background:url({{{ asset('images/sina.png') }}});
			}
			.qq
			{
				background:url({{{ asset('images/qq.png)') }}};
			}
			.qq_wb
			{
				background:url({{{ asset('images/qq_wb.png') }}});
			}
			.more
			{
				background:url({{{ asset('images/more.png') }}});
			}
		</style>
	</head>
	<body style="background-color:transparent;">
		<div class="login_box">
			<div class="login_close" onclick="window.parent.$.colorbox.close();"></div>
			<div class="login_top"></div>
			<div class="mes_box">
				<p class="mes_title"><span>使用YO斐济账号登录</span><span style="font-size:14px;padding-left:80px;">没有帐号?</span><span style="font-size:14px;color:#197ed6;cursor:pointer;"><a href={{{ URL::to('user/create') }}}>立即注册</a></span></p>
			<form class="form-horizontal" id="form1" method="POST" action="{{ URL::to('user/login') }}" accept-charset="UTF-8">
    			<input type="hidden" name="_token" value="{{ csrf_token() }}">

				<table cellspacing=0 cellpadding=0 style="font-size:18px;color:#313131;" class="mes_show">
					<tr>
						<td class="td1">帐号:&nbsp;</td>
						<td><input type="text" name="email" id="email" value="{{{ Input::old('email') }}}" /></td>
					</tr>
					<tr>
						<td class="td1">密码:&nbsp; </td>
						<td><input type="password" name="password" id="password" /></td>
					</tr>
					<tr>
						<td class="td1">&nbsp; </td>
						<td><input type=checkbox style="width:15px;height:15px; "  name="remember"  /><span style="margin-left:220px;font-size:14px;color:#197ed6;cursor:pointer;width:60px;"><a  href="forgot">忘记密码?</a></span></td>
					</tr>
       
        @if ( Session::get('error') )
        <div class="alert alert-danger">{{ Session::get('error') }}</div>
        @endif

        @if ( Session::get('notice') )
        <div class="alert">{{ Session::get('notice') }}</div>
        @endif
				</table>
				<div class="go_lg" onclick="document.getElementById('form1').submit()"></div>
				<!--input type=image class="go_lg" /-->

			</div>
			<div class="go_login">
				<p style="margin-left:;padding-top:20px;">使用以下帐号直接登录</p>
				<div class="login_in">
		</form>
					<ul>
						<li class="sina"></li>
						<li class="qq"></li>
						<li class="qq_wb"></li>
						<li class="more"></li>
					</ul>
				</div>
			</div>
		</div>
	</body>
</html>
