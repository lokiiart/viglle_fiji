<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title></title>
		<meat charset="utf-8" />
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
				height:630px;
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
				height:385px;
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
				line-height:33px;
				border:1px solid #ff9400;
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
			.go_rg
			{
				width:183px;
				margin-top:10px;
				margin-left:130px;
				height:39px;
				background:url({{{ asset('images/go_rg.png') }}});
				cursor:pointer;
			}
		</style>
	</head>
	<body>
		<div class="login_box">
			<div class="login_top"></div>
			<div class="login_close" onclick="window.parent.$.colorbox.close();"></div>
			<div class="mes_box">
				<p class="mes_title"><span>注册斐济帐号</span></p>
<form method="POST" action="{{{ (Confide::checkAction('UserController@store')) ?: URL::to('user')  }}}" accept-charset="UTF-8">
    <input type="hidden" name="_token" value="{{{ Session::getToken() }}}">
				<table cellspacing=0 cellpadding=0 style="font-size:18px;color:#313131;" class="mes_show">
        @if ( Session::get('error') )
        <div class="alert alert-danger">{{ Session::get('error') }}</div>
        @endif

        @if ( Session::get('notice') )
        <div class="alert">{{ Session::get('notice') }}</div>
        @endif
					<tr>
						<td class="td1">邮箱 :&nbsp;</td>
						<td><input type='text' name="email" id="email" valud="{{{ Input::old('email') }}}") /></td>
					</tr>
					<tr>
						<td class="td1">昵称 :&nbsp;</td>
						<td><input type='text' name="username" id="username"  value="{{{ Input::old('username') }}}" /></td>
					</tr>
					<tr>
						<td class="td1">密码: </td>
						<td><input type='password' name="password" id="password" /></td>
					</tr>
					<tr>
						<td class="td1">确认密码 :&nbsp; </td>
						<td><input type='password' name="password_confirmation" id="password_confirmation"  /></td>
					</tr>
					<tr>
						<td class="td1">手机号码 :&nbsp; </td>
						<td><input type='text' name="telephone"  id="telephone" /></td>
					</tr>
					<tr>
						<td class="td1">所在城市 :&nbsp; </td>
						<td><input type='text' name="city" id="city" /></td>
					</tr>
					<tr>
						<td class="td1">个性简介 :&nbsp; </td>
						<td><input type='text' name="intro" id="intro" /></td>
					</tr>
				</table>
			</div>
				<p style="text-align:center;padding-top:20px;"><input type="checkbox" checked="checked" />我已阅读和同意YO斐济<span style="color:#0099ff;">《使用条例》</span></p>
			<button type="submit" class="go_rg"></button>
				</form>
			</div>
		</div>
	</body>
</html>
