@extends('layouts.app')
@section('content')
<table class="table" border="1">
	<tr>
		<td>id</td>
		<td>Название</td>
		<td>Действие</td>
		
	</tr>
@foreach ($categories as $category)
	<tr>
		<td>{{$category->title}}</td>
		<td><a href="{{action('CategoryController@edit',['category'=>$category->id])}}">Изменить</a></td>
		<td>
			<div class="myBtnGroup">
				@if($category->deleted_at)
					<form action="{{action('CategoryController@restore',['id'=>$category->id])}}">
						<input type="submit" value="Відновити">
					</form>				
				@else				
					<form method="POST" action="{{action('CategoryController@destroy',['comments'=>$category->id])}}">
						<input type="hidden" name="_method" value="delete"/>
						<input type="hidden" name="_token" value="{{csrf_token()}}"/>
						<input type="submit" value="Приховати"/>
					</form>
				@endif
				<button onclick="location.href='{{action('CategoryController@delete',['category'=>$category->id])}}'">Видалити</button>
			</div>
		</td>
		
	</tr>
@endforeach

</table>

<a href="{{action('CategoryController@create',['category'=>$category->id])}}">Add Category</a>

@endsection