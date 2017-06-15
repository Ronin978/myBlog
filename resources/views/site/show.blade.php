@extends('layouts.app')
@section('content')
@if(Session::has('message'))
	<div class="alert alert-success">
	{{Session::get('message')}} 					
	</div>

@endif

	
    <ul class="pager">
		@if($next==0)
			<li>Попередня стаття</li>
			<li><a href="{{action('FrontController@show',['article'=>$article->id-$back])}}">Слідуюча стаття</a></li>

		@elseif($back==0)
			<li><a href="{{action('FrontController@show',['article'=>$article->id+$next])}}">Попередня стаття</a></li>
			<li>Слідуюча стаття</li>
		@else
			<li><a href="{{action('FrontController@show',['article'=>$article->id+$next])}}">Попередня стаття</a></li>
			<li><a href="{{action('FrontController@show',['article'=>$article->id-$back])}}">Слідуюча стаття</a></li>
		@endif

	</ul>

	<ul class="pager">
		<li><a onClick="javascript:CallPrint('pagePrint');">Роздрукувати</a></li>
 	</ul>
	
	<div id="pagePrint">
		<h1>{{$article->title}}</h1>
		<br>
				@if ($article->preview)
					<div class="myImg">	
						<img src="{{$article->preview}}">;
					</div>
				@endif
			
			<div>{!!$article->content!!}</div><hr>
	</div>
		

@if(\Auth::user())

<?php 
	$group=\Auth::user()->group;
?>
    @if($group=='admin' || $group=='superAdmin')
        <div class="myBtnGroup">
			<button onclick="location.href='{{action('ArticlesController@edit',['articles'=>$article->id])}}'">Редагувати статтю</button>
						
			@if($article->deleted_at)
				<input type="button" onclick="location.href='{{action('ArticlesController@restore',['id'=>$article->id])}}'" name="restore" value="Відновити">
			@else
				<form method="POST" onSubmit='return confirm("Для видалення натисніть OK?");' action="{{action('ArticlesController@destroy',['articles'=>$article->id])}}">
					<input type="hidden" name="_method" value="delete"/>
					<input type="hidden" name="_token" value="{{csrf_token()}}"/>
					<input type="submit" value="Приховати"/>
				</form><hr>
			@endif
		</div>
    @endif
@endif

<ul class="pager">
	@if($next==0)
		<li>Попередня стаття</li>
		<li><a href="{{action('FrontController@show',['article'=>$article->id-$back])}}">Слідуюча стаття</a></li>

	@elseif($back==0)
		<li><a href="{{action('FrontController@show',['article'=>$article->id+$next])}}">Попередня стаття</a></li>
		<li>Слідуюча стаття</li>
	@else
		<li><a href="{{action('FrontController@show',['article'=>$article->id+$next])}}">Попередня стаття</a></li>
		<li><a href="{{action('FrontController@show',['article'=>$article->id-$back])}}">Слідуюча стаття</a></li>
	@endif

</ul>

	
<div>
	<ul>
	@foreach($comments as $comment)
		<li>
		Автор: {{$comment->author}}<br>
		@if($comment->preview)
			<img class="popup" tabindex="1" src="{{$comment->preview}}">
		@endif
		{{strip_tags($comment->content)}}<br>
		
		<small>Опубліковано: {{$comment->created_at}}</small>

		
		
		
    		@if($group=='admin' || $group=='superAdmin')
				<div class="myBtnGroup">
					<button onclick="location.href='{{action('CommentsController@edit',['comment'=>$comment->id])}}'">Редагувати комент</button>		
						<form method="POST" action="{{action('CommentsController@destroy',['comments'=>$comment->id])}}">
							<input type="hidden" name="_method" value="delete"/>
							<input type="hidden" name="_token" value="{{csrf_token()}}"/>
							<input type="submit" value="Приховати"/>
						</form>
					<button onclick="location.href='{{action('CommentsController@delete',['comment'=>$comment->id])}}'">Видалити комент</button>		
				</div>
    		@endif
    	
		</li><hr>
	@endforeach
	</ul>
</div>

@include('site.comment')


@endsection 