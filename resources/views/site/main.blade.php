<!DOCTYPE html>
<html>
	<head>
		<meta charaset="utf-8"/>
		<title>UserZone</title>
		<link rel="stylesheet" href="{{asset('css/admin.css')}}">
		 <link href="{{ asset('css/app.css') }}" rel="stylesheet">
		<script src="{{asset('js/jquery-3.2.0.min.js')}}"></script>
		<script src="{{asset('js/tinymce/tinymce.min.js')}}"></script>
		<script>
		tinymce.init({
		selector: 'textarea'
		});
		</script>
	</head> 
<body> 
	<div id="header">
	<h1>UserZone</h1>
	</div>
	<div id="content">@yield('content')</div>
 </body>
</html>