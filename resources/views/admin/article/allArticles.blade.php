
@extends('layouts.app')
@section('content')

<h1>All Articles</h1>

<table border="1px" class="table">
<tr>
	<td>№п/п</td>
	<td>Title</td>
	<td>Дія</td>
	
	<td>Додано</td>
	<td>Поновлено</td>
	<td>Приховано</td>

</tr>

<?php 
	if(!empty($_GET["page"]))
		{
			$page=$_GET['page'];
			$i=($page-1)*10;
		}
	else $i=0;
?>

@foreach ($articles as $article)
<?php 
	$i++;
?>
	<tr>
		<td>{{$i}}</td>			
		<td>{{$article->title}}</td>
		<td width="350">
			
			<div class="myBtnGroup">  			
  				<button onclick="location.href='{{action('ArticlesController@edit',['articles'=>$article->id])}}'">Редагувати</button>
				<button onclick="location.href='{{action('FrontController@show',['articles'=>$article->id])}}'">Читати</button>
			 		
				@if($article->deleted_at)
					<input type="button" onclick="location.href='{{action('ArticlesController@restore',['id'=>$article->id])}}'" name="restore" value="Поновити">
				@else
					<form method="POST" onSubmit='return confirm("Для видалення натисніть OK?");' action="{{action('ArticlesController@destroy',['articles'=>$article->id])}}">
						<input type="hidden" name="_method" value="delete"/>
						<input type="hidden" name="_token" value="{{csrf_token()}}"/>
						<input type="submit" value="Приховати"/>
					</form>
				@endif
				
				<form action="{{action('ArticlesController@delete',['id'=>$article->id])}}" onSubmit='return confirm("Для видалення натисніть OK?");'>
					<input type="submit" name="delete" value="Delete">
				</form>
			</div>

			
		</td>
	
			
		<td>{{$article->created_at}}</td>
		<td>{{$article->updated_at}}</td>
		<td>{{$article->deleted_at}}</td>
		

	</tr>
	
@endforeach
</table>

<button onclick="location.href='{{action('ArticlesController@create')}}'">Додати статтю</button>

<br><hr>

{{ $articles->links() }}


@endsection 