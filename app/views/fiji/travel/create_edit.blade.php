@extends('fiji.layouts.default')
@section('styles')


		<link rel="stylesheet" type="text/css" href="{{{ asset('css/raiders_w.css') }}}" />


@stop
@section('scripts')
<script charset="utf-8" src="{{{asset('js/kindeditor/kindeditor.js')}}}"></script>
		<script charset="utf-8" src="{{{asset('js/kindeditor/lang/zh_CN.js')}}}"></script>
		<script>
var editor;
KindEditor.ready(function(K) {
editor = K.create('textarea[name="content"]', {
allowFileManager : true,
uploadJson : 'user/album/upload',
fileManagerJson : 'user/album/data',
extraFileUploadParams : {
    _token: '{{{ csrf_token() }}}',
},
items :[
'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
'insertunorderedlist', '|', 'emoticons', 'image', 'link','preview']

});
K('#enter').click(function(e) {
$('#raider_content').val(editor.html());
$('#form_travel').submit();
});
K('#del_empty').click(function(e) {
editor.html('');
});
});
					</script>
@stop

@section('content')


<div class="content">
				<div class="raiders_head"></div>
					<form method="post" id="form_travel" action="{{{ URL::to('travel/create') }}}" accept-charset="UTF-8">
		<!-- CSRF Token -->
		<input  type="hidden" name="_token" value="{{{ csrf_token() }}}" />
				<div class="raiders_title">
					<p>攻略标题<input name="title" type=text value="" id="works_title" /></p>
				</div>
				<div class="content_body">
						<textarea name="content" id="raider_content" style="width:1000px;height:700px;visibility:hidden;"></textarea>
					<div class="content_button">
						<div class="content_button_top">
							<ul>
								<li class="buttons" id="enter"></li>
								<li class="buttons" id="del_empty"></li>
							</ul>
						</div>
						<div class="content_button_bottom"></div>
					</div>
				</div>
					</form>
				<div class="content_bottom"></div>
			</div>

@stop
