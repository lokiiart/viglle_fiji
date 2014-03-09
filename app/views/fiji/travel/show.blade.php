@extends('fiji.layouts.default')

@section('styles')
<link rel="stylesheet" type="text/css" href="{{{ asset('css/show.css') }}}" />
@stop
@section('content')
<div class="content">
				<div class="content_body">
					<div class="content_show">
						<div class="content_show_text">
							<div class="content_show_title">
								<ul>
									<li class="content_show_border"></li>
									<li class="raiders_img"><img src="http://placehold.it/50x50" width=50 height=50 /></li>
									<li class="raiders_show_msg">
										<p class="raiders_title">{{{ $travel->title }}}</p>
										<p>
                                        <a href=" {{{ $author->url() }}} ">
                                        <span class="raiders_user_name">{{{ $author->username }}}</span>
                                        </a>
                                        <span class="raiders_user_time">发布于{{{ $travel->date() }}}</span>
                                        </p>
									</li>
								</ul>
							</div>
							<div class="raiders_show_html">{{ $travel->content() }}</div>
							<div class="raiders_other_mes">
								<ul>
<div id="travel_mark_{{{ $travel->id }}}" style="float:right">
				<a href="javascript:;" onclick="unlike({{{$travel->id}}})" class="unlike_post" style="display:none;" >取消赞</a>
                <a href="javascript:;" onclick="like({{{$travel->id}}})" class="like_post" >
                    <img src=" {{asset('images/good.png')}} " alt="">
                </a> 
					<span id="if_like_{{{$travel->id}}}"></span> <span id="likecontent_{{{$travel->id}}}"><span  id="count_{{{$travel->id}}}" class="color">{{{$travel->mark}}}</span> <span id="people_{{{$travel->id}}}" class="color">人</span>喜欢</span>
</div>




									<!--li class="share"></li-->
								</ul>
							</div>
						</div>

						<div class="raiders_more">
							<div class="raiders_more_list_1">
								<div class="raiders_list_1_top"></div>
								<ul class="raiders_show_text">
									<li><div>1</div>海岛自由行 斐济南迪自由行...</li>
									<li><div>2</div>海岛自由行 斐济南迪自由行...</li>
									<li><div>3</div>海岛自由行 斐济南迪自由行...</li>
									<li><div>4</div>海岛自由行 斐济南迪自由行...</li>
									<li><div>5</div>海岛自由行 斐济南迪自由行...</li>
									<li><div>6</div>海岛自由行 斐济南迪自由行...</li>
									<li><div>7</div>海岛自由行 斐济南迪自由行...</li>
									<li><div>8</div>海岛自由行 斐济南迪自由行...</li>
									<li><div>9</div>海岛自由行 斐济南迪自由行...</li>
									<li><div>10</div>海岛自由行 斐济南迪自由行...</li>
								</ul>
							</div>
							<div class="raiders_more_list_1">
								<div class="raiders_list_2_top"></div>
								<ul class="raiders_show_text">
									<li><div>1</div>海岛自由行 斐济南迪自由行...</li>
									<li><div>2</div>海岛自由行 斐济南迪自由行...</li>
									<li><div>3</div>海岛自由行 斐济南迪自由行...</li>
									<li><div>4</div>海岛自由行 斐济南迪自由行...</li>
									<li><div>5</div>海岛自由行 斐济南迪自由行...</li>
									<li><div>6</div>海岛自由行 斐济南迪自由行...</li>
									<li><div>7</div>海岛自由行 斐济南迪自由行...</li>
									<li><div>8</div>海岛自由行 斐济南迪自由行...</li>
									<li><div>9</div>海岛自由行 斐济南迪自由行...</li>
									<li><div>10</div>海岛自由行 斐济南迪自由行...</li>
								</ul>
							</div>
						</div>
					</div>
					<div style="clear:both;">
						<!--<ul class="show_page_1">-->
							<!--<li  class="show_li_1">1</li>-->
							<!--<li  class="show_li_2">2</li>-->
							<!--<li class="show_page_next">下一页</li>-->
						<!--</ul>-->
					</div>
				</div>
				<div class="content_bottom"></div>
			</div>
@stop
@section('scripts')
<script>
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
