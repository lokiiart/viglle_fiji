@extends('fiji.layouts.default')
@section('styles')
		@parent
		<link rel="stylesheet" type="text/css" href="css/index.css" />
@stop
@section('content')
			<!-- 正文开始  -->
			<div class="content">
                <div class="content_title"><div style="float:left;"><span style="font-size:30px;color:#0099ff;">旅行</span><strong style="color:#333333;">攻略</strong></div>
<a href="/travel/index">    <div class="more_raiders"></div></a>
</div>
				<div class="content_body">
				<div class="hotel_1">
					<div class="hotel_part1">
						<div class="hotel_part1_img1">
							<img src="{{{ URL::asset($hotels[0]->pic1_url) }}}/origin.jpg" />
						</div>
						<div class="hotel_part1_img2">
							<img src="{{{ URL::asset($hotels[0]->pic2_url) }}}/origin.jpg" />
						</div>
					</div>
					<div class="hotel_part2">
						<div class="hotel_part2_img1" onmouseenter ="show_bg(0)">
							<img src="{{{ URL::asset($hotels[0]->pic3_url) }}}/origin.jpg" />
							<div class="hotel_base" onmouseleave="close_bg(0)">
								<div class="hotel_part3_base"></div>
								<div class="hotel_price_bg" >
									<div class="hotel_price_show"><span style="font-size:30px;">RMB</span><span class="hotel_price">{{{ $hotels[0]->price }}}</span></div>
								</div>
							</div>
						</div>
						<div class="hote1_part2_word">
							<div class="hote1_part2_word_top"></div>
                            <div class="hote1_part2_word_text"><div class="hote_special">玩转斐济岛</div></div>
						</div>
					</div>
					<div class="hotel_part3">
						<div class="hotel_part3_top"></div>
						<div class="hotel_part3_content" onmouseenter="show_bg(1)">
							<img src="{{{ URL::asset($hotels[0]->pic4_url) }}}/origin.jpg" />
							<div class="hotel_base" onmouseleave="close_bg(1)">
								<div class="hotel_part3_text">{{{ $hotels[0]->content }}}</div>
							</div>
						</div>
					</div>
				</div>
				
				<div class="hotel_2">
					<div class="hotel_part2" >
						<div class="hote1_part2_word">
							<div class="hote1_part2_word_text"><div class="hote_special">吃货走天下</div></div>
							<div class="hote1_part2_word_top"></div>
						</div>
						<div class="hotel_part2_img1" style="margin:0px;" onmouseenter="show_bg(2)">
							<img src="{{{ URL::asset($hotels[0]->pic3_url) }}}/origin.jpg" />
							<div class="hotel_base"  onmouseleave="close_bg(2)">
								<div class="hotel_part3_base"></div>
								<div class="hotel_price_bg">
									<div class="hotel_price_show"><span style="font-size:30px;">RMB</span><span class="hotel_price">{{{ $hotels[0]->price }}}</span></div>
								</div>
							</div>
						</div>
					</div>
					<div class="hotel_part1">
						<div class="hotel_part1_img1" onmouseenter="show_bg(3)" >
							<img src="{{{ URL::asset($hotels[1]->pic2_url) }}}/origin.jpg" />
							<div class="hotel_base" onmouseleave="close_bg(3)">
								<div class="hotel_text_show">{{{ $hotels[1]->content }}}</div>
							</div>
						</div>
						<div class="hotel_part1_img2">
							<img src="{{{ URL::asset($hotels[1]->pic3_url) }}}/origin.jpg" />
						</div>
					</div>
					<div class="hotel_part3">
						<img src="{{{ URL::asset($hotels[1]->pic4_url) }}}/origin.jpg" />
					</div>
				</div>
				<div class="content_center">
					<p><span style="font-size:30px;margin-left:30px;color:#ff9500;">机票</span><span style="font-size:18px;color:#333;">信息</span></p>
					<div class="plane">
						<div class="plane_search">
							<table cellspacing=0 cellpadding=0 class="plane_mes">
								<tr>
									<td class="td1">航程类型</td>
									<td align=center><input type="radio" name="plane_type" value="0" />单程<input type="radio" name="plane_type" style="margin-left:25px;" value="0"  />往返</td>
								</tr>
								<tr>
									<td class="td1">出发城市</td>
									<td><input type="text" id="plane_city" class="inputs" /></td>
								</tr>
								<tr>
									<td class="td1">出发日期</td>
									<td><input type="text" id="plane_date_go" class="inputs" /></td>
								</tr>
								<tr>
									<td class="td1">返回日期</td>
									<td><input type="text" id="plane_date_return" class="inputs" /></td>
								</tr>
								<tr>
									<td class="td1">&nbsp;</td>
									<td class="td2"><div class="search"></div></td>
								</tr>
							</table>
						</div>
						<div class="plane_bg"></div>
					</div>
					<div class="plane_show">
						<table cellspacing=8 cellpadding=0 style="font-size:18px;width:340px;margin:40px auto;border:0px solid red;">
							<tr>
								<td class="plane_date_td">2013/12/13</td>
								<td class="plane_city_td">香港 - 斐济</td>
								<td class="plane_price_td">￥3968元</td>
							</tr>
							<tr>
								<td class="plane_date_td">2013/12/13</td>
								<td class="plane_city_td">香港 - 斐济</td>
								<td class="plane_price_td">￥3968元</td>
							</tr>
							<tr>
								<td class="plane_date_td">2013/12/13</td>
								<td class="plane_city_td">香港 - 斐济</td>
								<td class="plane_price_td">￥3968元</td>
							</tr>
							<tr>
								<td class="plane_date_td">2013/12/13</td>
								<td class="plane_city_td">香港 - 斐济</td>
								<td class="plane_price_td">￥3968元</td>
							</tr>
							<tr>
								<td class="plane_date_td">2013/12/13</td>
								<td class="plane_city_td">香港 - 斐济</td>
								<td class="plane_price_td">￥3968元</td>
							</tr>
							<tr>
								<td class="plane_date_td">2013/12/13</td>
								<td class="plane_city_td">香港 - 斐济</td>
								<td class="plane_price_td">￥3968元</td>
							</tr>
						</table>
					</div>
					<div class="weather">
						<div class="weather_top"><span style="font-size:30px;margin-left:20px;">天气</span><span style="font-size:16px;margin-left:30px;">{{ date('Y/m/d') }}</span></div>
						<?php
							$url = 'http://xml.weather.yahoo.com/forecastrss?w=2345335&u=c';
							$yweather = "http://xml.weather.yahoo.com/ns/rss/1.0";	//命名空间
							$res = new DOMDocument();
							$res->load($url);
							$node = $res->getElementsByTagNameNS($yweather, 'atmosphere');
							$humi = $node->item(0)->attributes->item(0)->nodeValue;		//获取湿度
							$node = $res->getElementsByTagNameNS($yweather, 'condition');
							$code = $node->item(0)->attributes->item(1)->nodeValue;
							echo $code."度"."<br />";
							$temp = $node->item(0)->attributes->item(2)->nodeValue;	
							function code2char($code){
								switch($code){
									case 0:
										return '龙卷风';
									case 1:
										return '热带风暴';
									case 2:
										return '暴风';
									case 3:
										return '大雷雨';
									case 4:
										return '雷阵雨';
									case 5:
										return '雨夹雪';
									case 6:
										return '雨夹雹';
									case 7:
										return '雪夹雹';
									case 8:
										return '冻雾雨';
									case 9:
										return '细雨';
									case 10:
										return '冻雨';
									case 11:
										return '阵雨';
									case 12:
										return '阵雨';
									case 13:
										return '阵雪';
									case 14:
										return '小阵雪';
									case 15:
										return '高吹雪';
									case 16:
										return '雪';
									case 17:
										return '冰雹';
									case 18:
										return '雨淞';
									case 19:
										return '粉尘';
									case 20:
										return '雾';
									case 21:
										return '薄雾';
									case 22:
										return '烟雾';
									case 23:
										return '大风';
									case 24:
										return '风';
									case 25:
										return '冷';
									case 26:
										return '阴';
									case 27:
										return '多云';
									case 28:
										return '多云';
									case 29:
										return '局部多云';
									case 30:
										return '局部多云';
									case 31:
										return '晴';
									case 32:
										return '晴';
									case 33:
										return '转晴';
									case 34:
										return '转晴';
									case 35:
										return '雨夹冰雹';
									case 36:
										return '热';
									case 37:
										return '局部雷雨';
									case 38:
										return '偶有雷雨';
									case 39:
										return '偶有雷雨';
									case 40:
										return '偶有阵雨';
									case 41:
										return '大雪';
									case 42:
										return '零星阵雪';
									case 43:
										return '大雪';
									case 44:
										return '局部多云';
									case 45:
										return '雷阵雨';
									case 46:
										return '阵雪';
									case 47:
										return '局部雷阵雨';
									default:
										return '水深火热';
								}
							}
							echo code2char($code);
						?>

					</div>
				</div>
				<div class="content_bottom"></div>
				<div style="height:845px;width:100%;margin-top:45px;">
					<p><span style="font-size:30px;margin-left:30px;color:#ff9500;">人气</span><span style="font-size:18px;color:#333;">之星</span></p>
					<ul>
				<?php $i=0;?>
				@foreach($users as $user)
				<?php $i++;?>
						<li class="user_mes" <?php if($i%3==0 && $i!=0){echo 'style=margin-right:0px;';} ?>>
							<ul>
								<li class="user_img"> <a href=" {{{ URL::to('user/show/'.$user->id) }}} "><img src="{{{$user->avatar}}}" width=320 height=250 /></a></li>
								<li class="user_name"><div class="user_name_box">{{{$user->username}}}</div><div class="user_word">{{{$user->intro}}}</div>
                                <a href=" {{{ URL::to('user/show/'.$user->id.'#usercomment') }}} ">
                                <div class="user_talk"></div>
                                </a>
                                </li>
							</ul>
						</li>
				@endforeach
						<li class="user_mes">
							<ul>
								<li class="user_img"><img src="images/user1.png" width=320 height=250 /></li>
								<li class="user_name"><div class="user_name_box">漫天小星星</div><div class="user_talk"></div></li>
							</ul>
						</li>
						<li class="user_mes">
							<ul>
								<li class="user_img"><img src="images/user1.png" width=320 height=250 /></li>
								<li class="user_name"><div class="user_name_box">漫天小星星</div><div class="user_talk"></div></li>
							</ul>
						</li>
						<li class="user_mes" style="margin-right:0px">
							<ul>
								<li class="user_img"><img src="images/user1.png" width=320 height=250 /></li>
								<li class="user_name"><div class="user_name_box">漫天小星星</div><div class="user_talk"></div></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
				
			</div>
			<!-- 正文结束  -->
			<script>
				function show_bg(num)
				{
					$(".hotel_base").eq(num).slideDown("fast");
				}
				function close_bg(num)
				{
					$(".hotel_base").eq(num).slideUp("fast");
				}
			</script>
			@stop
		
