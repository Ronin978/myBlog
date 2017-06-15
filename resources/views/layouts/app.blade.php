<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/admin.css')}}">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
    <script src="{{asset('js/jquery-3.2.0.min.js')}}"></script>
    <script src="{{asset('js/tinymce/tinymce.min.js')}}"></script>
    <script>
        tinymce.init({
        selector: '.tinyMCE',
        language:"ru",
        height:"400",
        invalid_elements : 'a'
        });
    </script>
    <script type="text/javascript"> 
        $(function() 
        {
            $(window).scroll(function() 
            {
                if($(this).scrollTop() != 0) 
                {
                    $('#toTop').fadeIn();
                } 
                else 
                {
                    $('#toTop').fadeOut();
                }
            });
            $('#toTop').click(function() 
            {
                $('body,html').animate({scrollTop:0},800);
            });
        }); 
    </script>

    <script language="javascript">
    function CallPrint(strid) 
    { 
        var prtContent = document.getElementById(strid); 
        var WinPrint = window.open('','','left=50,top=50,width=800,height=640,toolbar=0,scrollbars=1,status=0'); 
        
        WinPrint.document.write(prtContent.innerHTML); 
        WinPrint.document.close(); 
        WinPrint.focus(); 
        WinPrint.print(); 
        WinPrint.close();
         
        prtContent.innerHTML=strOldOne;
    }
    </script>

</head>


<body>
    <div id="app">
  
        <DIV ID = "toTop"> Вгору </DIV>

        <nav class="navbar navbar-inverse navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar">1</span>
                        <span class="icon-bar">2</span>
                        <span class="icon-bar">3</span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        На головну
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        
                       
                    @if(\Auth::user())
                        @if(\Auth::user()->group=='superAdmin')
                            <li><a href="{{action('UserController@myshow')}}">Керування профілями</a></li>
                            <li><a href="{{action('ArticlesController@index')}}">All article</a></li>
                            <li><a href="{{action('CategoryController@index')}}">All category</a></li>
                            <li><a href="{{action('CommentsController@index')}}">All comments</a></li>
                            <li><a href="/adminzone">Adminka</a></li>
                        @endif
                        @if(\Auth::user()->group=='admin')
                            
                            <li><a href="{{action('ArticlesController@index')}}">All article</a></li>
                            <li><a href="{{action('ArticlesController@create')}}">Додати статтю</a></li>
                            <li><a href="/adminzone">Adminka</a></li>
                        @endif
                    @endif
                    &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                                                       
                                    <li>
                                        <a href="{{action('UserController@index')}}">MyRun</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>

                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
        
        <div id="myContent">
            @yield('content')
        </div>
        
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
