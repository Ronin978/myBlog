@extends('layouts.app')
@section('content')
<form method="POST" action="{{action('CommentsController@update',['comments'=>$comment->id])}}" >
	<textarea name="content" class="form-control">{{$comment->content}}</textarea><br>
	<input type="hidden" name="_method" value="put"/>
	<input type="hidden" name="_token" value="{{csrf_token()}}"/>
	<input type="submit" value="Update">
@if(Session::has('message'))
	<div id="comment" class="alert alert-success">
	{{Session::get('message')}} 
	</div>
@endif
</form>


@endsection