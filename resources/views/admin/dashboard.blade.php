@extends('layouts.app')
@section('content')
<h1>Admin-ка</h1>
<h2>Articles</h2>
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
@endsection