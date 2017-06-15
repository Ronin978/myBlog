@extends('layouts.app')
@section('content')

<form method="POST" action="{{action('ArticlesController@store')}}" enctype="multipart/form-data"/>
	Title<br>
	<input type="text" name="title" class="form-control" /><br>
	
	Categories:<br>
	<select name="category_id">
		@foreach($categories as $category)
			<option value="{{$category->title}}">{{$category->title}}</option>
		@endforeach
	</select><br>
	
	Text<br>
	<textarea name="content" class="tinyMCE"> </textarea><br>
	
	Preview<br>
	<input type="file" name="preview"><br>

	<input type="hidden" name="_token" value="{{csrf_token()}}"/>
	<input type="submit" value="Save">
	
	@if(Session::has('message'))
    <div id="comment" class="alert alert-success">
        {{Session::get('message')}}
    </div>
	@endif
</form>

@endsection