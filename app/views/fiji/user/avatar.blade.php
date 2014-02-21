@extends('site/layouts/default')

@section('styles')

		<link rel="stylesheet" type="text/css" href="{{{ asset('css/user.css') }}}" />
@stop
@section('content')
<form method="post" class="form-horizontal" enctype="multipart/form-data" action="{{ URL::to('user/avatar') }}" autocomplete="off">
<input type="hidden" name="_token" value="{{{ csrf_token() }}}">

@foreach($userpics as $userpic)    
<div style="float:left;">
<img style="width:100px;height:100px" src="{{{ asset($userpic->pic_url.'/'.$userpic->filename) }}}" alt="">
<br>

<input id=" {{{ $userpic->id }}} "  style="margin-left:40px;" type="radio" name="avatar" value="{{{ asset($userpic->pic_url.'/'.$userpic->filename) }}}">
</div>
@endforeach
<div class="clearfix"></div>
	<div class="form-group">
		<div class="col-md-12">
			<input type="submit" class="btn btn-default" id="submit" value="Submit" />
		</div>
	</div>

</form>
@stop
@section('scripts')
	<script type="text/javascript" src="js/jquery.js"></script> 
@stop
