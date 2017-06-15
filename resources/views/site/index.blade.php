@extends('layouts.app')

@section('content')

@if(Session::has('message'))
	<div id="comment" class="alert alert-danger">
		{{Session::get('message')}}
	</div>
@endif

Сортувати за
<select name="filter" onchange="location.pathname=this.options[this.selectedIndex].value">	
		<option value="">Виберіть фільтр:</option>
	<optgroup label="датою">	
		<option value="filter/date">останні додані</option>
		<option value="filter/dateDESC">датою DESC</option>
	</optgroup>
	<optgroup label="алфавітом">
		<option value="filter/abc">алфавітом</option>		
		<option value="filter/abcDESC">алфавітом DESC</option>
	</optgroup>	
	<optgroup label="По групах">
			<option value="filter/notCategory">Без категорій</option>
		@foreach($categories as $cat)
			<option value="filter/{{$cat}}">{{$cat}}</option>
		@endforeach
	</optgroup>
</select>


@foreach($articles as $article)

	<h1><a href="{{action('FrontController@show',['articles'=>$article->id])}}" title="Читати далі...">{{$article->title}}</a></h1>
	<br>
		@if ($article->preview)
			<img height=40 src="{{$article->preview}}">;
		@endif
	<div>
		{{str_limit(strip_tags($article->content) , 1500)}}
	</div>
<a href="{{action('FrontController@show',['articles'=>$article->id])}}">Читати далі...</a><br>
	<small>Додано: {{$article->updated_at}}</small>
	<hr>

@endforeach

<div class="myPaginate">
	{{$articles->links()}}
</div>



@endsection