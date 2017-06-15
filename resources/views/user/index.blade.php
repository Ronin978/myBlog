@extends('layouts.app')

@section('content')

@if(Session::has('message'))
	<div id="comment" class="alert alert-danger">
		{{Session::get('message')}}
	</div>
@endif

	<h1>{{$user->name}}</h1>

	@if ($user->preview)
		<img class="popup" tabindex="1" src={{$user->preview}}>;
	@endif

	<p>Ви знаходитесь у групі: {{$user->group}}</p>

	<p>Email: {{$user->email}}</p>

	<p>Аккаунт створено: {{$user->created_at}} </p>


<button onclick="location.href='{{route('myEdit')}}'">Редагувати</button>
<hr>
@if(\Auth::user())
<?php 
	$group=\Auth::user()->group;
?>
    @if($group=='admin' || $group=='superAdmin')
		<ul>
			@if(\Auth::user()->group=='superAdmin')
			<li><a href="{{action('UserController@myshow')}}">Керування профілями</a></li>
			<hr>
			@endif
			<li><a href="{{action('ArticlesController@index')}}">All article</a></li>
			<li><a href="{{action('ArticlesController@create')}}">Add article</a></li>
			<hr>
			<li><a href="{{action('CategoryController@index')}}">All category</a></li>
			<li><a href="{{action('CategoryController@create')}}">Add category</a></li>
			<hr> 
			<li><a href="{{action('CommentsController@index')}}">All comments</a></li>
		</ul>
	@endif
@endif





@endsection 