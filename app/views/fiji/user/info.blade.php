@extends('site/layouts/default')

@section('styles')

		<link rel="stylesheet" type="text/css" href="{{{ asset('css/user.css') }}}" />
@stop
@section('content')
<form method="post" class="form-horizontal" enctype="multipart/form-data" action="{{ URL::to('user/info') }}" autocomplete="off">
<input type="hidden" name="_token" value="{{{ csrf_token() }}}">

<textarea id="intro" name="intro" cols="30" rows="10" placeholder=" {{{ $user->intro }}} "></textarea>
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
