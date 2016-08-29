<!doctype html>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <meta name="_token" content="{!! csrf_token() !!}">
  <link href="favicon.ico" rel="shortcut icon">
  <link href="{{ URL::asset('css/style.css') }}" rel="stylesheet" type="text/css" >
  <link href="{{ URL::asset('css/jquery-ui.min.css') }}" rel="stylesheet" type="text/css" >
  <link href="{{ URL::asset('css/bootstrap.css') }}" rel="stylesheet" type="text/css" >
  @section('css')
  @show
  {{ HTML::script('js/jquery-2.1.4.js') }}
  {{ HTML::script('js/bootstrap.js') }}
  {{ HTML::script('js/jquery-ui.min.js') }}
  @section('scripts')
  @show
  <title>@yield('title')</title>  
  <!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>

<body>
  <div class="container">
	  <header class="header clearfix">
      <div class="logo">AdminZone</div>
	@section('sidebar')
    @show
    </header>
<!--
    <div class="info">
      <article class="hero clearfix">
        <div class="col_100">
          @section('info')
          @show
        </div>
      </article>
	</div>
-->	
	<article class="article clearfix">
        <div class="col_100">
          @yield('content')
        </div>
      </article>
  
    <footer class="footer clearfix">
      <div class="copyright">2016 Кукеев Джангар</div>
    </footer>

  </div>
</body>
</html>
