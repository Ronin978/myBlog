@extends('layouts.app')
@section('content')
@if(Session::has('message'))
    <div id="comment" class="alert alert-success">
        {{Session::get('message')}}
    </div>
@endif
<form method="POST" action="{{action('UserController@update',['user'=>$user->id])}}" enctype="multipart/form-data">
	<p>Name</p>
	<input type="text" name="name" class="form-control" value="{{$user->name}}"/><br><br>
	
	<p>Email</p>
	<input type="text" name="email" class="form-control" value="{{$user->email}}"/><br><br>

	@if(\Auth::user())
		@if(\Auth::user()->group=='superAdmin')
			<p>Group</p>
	        @if($user->group=='user')
		        <div class="col-md-6">
		            <input id="admin" type="radio" name="group" required  value="admin">admin<br>
		            <input id="user" type="radio" name="group" required checked="checked" value="user">user
		        </div>
			@elseif($user->group=='admin')
				<div class="col-md-6">
		            <input id="admin" type="radio" name="group" required checked="checked" value="admin">admin<br>
		            <input id="user" type="radio" name="group" required  value="user">user
		        </div>
			@endif
	    @endif
  	@endif
	
	<input type="hidden" name="_method" value="put"/>
	<input type="hidden" name="_token" value="{{csrf_token()}}"/>
	@if(!empty($user->preview))
		<div class="myImg">
			<img src="{{$user->preview}}">
		</div>
	@endif
	<input type="file" name="preview"><br>
	<input type="submit" value="Update">

</form>


@endsection