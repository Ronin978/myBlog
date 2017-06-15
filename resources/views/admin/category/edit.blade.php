@extends('layouts.app')
@section('content')
@if(Session::has('message'))
    <div id="comment" class="alert alert-success">
        {{Session::get('message')}}
    </div>
@endif
	<form method="POST" action="{{action('CategoryController@update',['category'=>$category->id])}}"/>
		Название категории<br>
		<input type="text" name="title" value="{{$category->title}}"/><br>
		<input type="hidden" name="_method" value="put"/>
		<input type="hidden" name="_token" value="{{csrf_token()}}"/>
		<input type="submit" value="Сохранить">
		
	</form>
@endsection