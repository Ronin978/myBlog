@extends('layouts.app')
@section('content')
@if(Session::has('message'))
    <div id="comment" class="alert alert-success">
        {{Session::get('message')}}
    </div>
@endif
<form method="POST" action="{{action('ArticlesController@update',['articles'=>$article->id])}}" enctype="multipart/form-data">
	<p>Title</p>
	<input type="text" name="title" class="form-control" value="{{$article->title}}"/><br><br>
	
	Категория:<br>
	<select name="category_id">
		@foreach($categories as $category)
			@if($article->category_id==$category->title)
				<option value="{{$category->title}}" selected>{{$category->title}}</option>
			@else
				<option value="{{$category->title}}">{{$category->title}}</option>
			@endif
		@endforeach
	</select>

	<p>Text</p>
	<textarea name="content" class="tinyMCE">{{$article->content}}</textarea><br>
	
	@if(!empty($article->preview))
		<div class="myImg">
			<img src="{{$article->preview}}">
		</div>
	@endif
	<br>

	<input type="file" name="preview"><br>

	<input type="hidden" name="_method" value="put"/>
	<input type="hidden" name="_token" value="{{csrf_token()}}"/>
	
	<input type="submit" value="Update">

</form>


@endsection