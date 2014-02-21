@extends('site.layouts.default')

@section('content')

<div class="test">
@foreach ($userpics as $userpic)
<img style="width:100px;height:100px" src="{{{ asset($userpic->pic_url.'/'.$userpic->filename) }}}" alt="">
@endforeach
</div>


<form method="post" class="form-horizontal"  action="{{ URL::to('user/album') }}" autocomplete="off">
<input type="hidden" name="_token" value="{{{ csrf_token() }}}">

<div class="form-group {{{ $errors->has('pic_url') ? 'error' :'' }}}">
		<div class="col-md-12">
				<label class="control-label" for="pic_url">图片上传</label>
				<input id="pic_url" mutiple class="form-control" type="file" name="pic_url">
						{{{ $errors->first('pic_url', '<span class="help-inline">:message</span>') }}}
		</div>
</div>
	<div class="form-group">
		<div class="col-md-12">
			<input type="submit" class="btn btn-default" id="submit" value="Submit" />
		</div>
	</div>

</form>
@stop
