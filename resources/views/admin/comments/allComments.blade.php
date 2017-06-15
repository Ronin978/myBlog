@extends('layouts.app')
@section('content')




	
	<ul>
	@foreach ($comments as $comment)
		<li>
			<p>Коментар до статті: "{{$comment->article_id}}"</p>

			<p>Автор: {{$comment->author}}</p>
			@if($comment->preview)
				<img class="popup" tabindex="1" src="{{$comment->preview}}">
			@endif
			<div id="{{$comment->id}}" class="content">
				{{$comment->content}}
			</div><br>
			<small>Додано: {{$comment->created_at}}</small>
			<div class="myBtnGroup">
				<button onclick="location.href='{{action('CommentsController@edit',['comment'=>$comment->id])}}'">Редагувати</button>		
				@if($comment->deleted_at)
					<form action="{{action('CommentsController@restore',['id'=>$comment->id])}}">
						<input type="submit" value="Відновити">
					</form>				
				@else				
					<form method="POST" action="{{action('CommentsController@destroy',['comments'=>$comment->id])}}">
						<input type="hidden" name="_method" value="delete"/>
						<input type="hidden" name="_token" value="{{csrf_token()}}"/>
						<input type="submit" value="Приховати"/>
					</form>
				@endif
				<button onclick="location.href='{{action('CommentsController@delete',['comment'=>$comment->id])}}'">Видалити комент</button>
			</div>
		<hr>
		</li>
	@endforeach
	</ul>	

{{ $comments->links() }}
	
@endsection