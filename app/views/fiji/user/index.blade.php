@extends('fiji.layouts.default')

@section('styles')
{{ Basset::show('user.css') }}
		<style>
			.head
			{
				background:url(../assets/images/user_big.jpg) center 0px;
			}
		</style>
@stop
@section('content')
			<div class="content">
				<div class="content_body">
					<div class="content_user_show">
							<ul class="content_user_ul">
								<li class="content_user_card1">我的好友</li>
								<li class="content_user_card2" style="margin-left:10px;">我喜欢</li>
							</ul>
							<div class="content_user_card_bottom"></div>
					</div>
					<div style="height:auto;margin-right:-20px;margin-top:15px;">
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
						<div style="clear:both;"></div>
					</div>
					<div style="width:100%;height:40px;margin-top:30px;">
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
@stop

@section('scripts')
	<script type="text/javascript" src="{{{ asset('js/jquery.js') }}} "></script> 
	<script type="text/javascript" src=" {{{ asset('js/haccordion.js') }}} "></script> 
	<script src="{{{ asset('js/My97DatePicker/WdatePicker.js') }}} " type="text/javascript"></script>
	<script type="text/javascript">
		haccordion.setup({
		accordionid: 'line_show', //main accordion div id
		paneldimensions: {peekw:'160px', fullw:'360px', h:'512px'},
		selectedli: [0, true], //[selectedli_index, persiststate_bool]
		collapsecurrent: false //<- No comma following very last setting!
		})
	</script>
@stop
