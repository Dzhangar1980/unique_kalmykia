<!doctype html>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <meta name="_token" content="{!! csrf_token() !!}">
  <link href="{{ URL::asset('alpha/icon.ico') }}" rel="shortcut icon">
  <!--[if lte IE 8]>{{ HTML::script('alpha/assets/js/ie/html5shiv.js') }}<![endif]-->
  <link href="{{ URL::asset('alpha/assets/css/main.css') }}" rel="stylesheet" type="text/css" >
  <link href="{{ URL::asset('alpha/assets/css/slideshow.css') }}" rel="stylesheet" type="text/css" >
  <!--[if lte IE 8]><link href="{{ URL::asset('alpha/assets/css/ie8.css') }}" rel="stylesheet"> <![endif]-->
  @section('css')
  @show
  <title>@yield('title')</title>  
 </head>

<body class="landing">
	<div id="page-wrapper">
	@section('header')
		@include('front.menu')
    @show
    
	@section('banner')
		<section id="banner">
			<h2>Уникальная Калмыкия</h2>
		</section>
    @show
    
	<!-- Main -->
		<section id="main" class="container">    
			@yield('content')
		</section>
		
	<!-- cta  -->
		<section id="cta">
			@section('cta')
				@include('front.cta')		
			@show
		</section>
	
	<!-- Footer -->
		<footer id="footer">
			<ul class="copyright">
				<li>&copy; 2016 Уникальная Калмыкия. Все права защищены.</li><li>Дизайн и программинг: <a href="http://kalmyk.info">Кукеев Джангар</a></li>
			</ul>
		</footer>
	</div>
	
	<div id="counts" class="modalDialog">
	<div>
		<a href="#close" title="Закрыть" class="close">X</a>
		<center>
		<p class="shadow">Счетчики и Сертификаты</p>
		<p>Javascript code of yandex count</p>
		</center>
	</div>
	</div>

	<div id="blockUser" class="modalDialog">
	<div>
		<a href="#close" title="Закрыть" class="close">X</a>
		<center>
		<p class="shadow">Ваш аккаунт заблокирован!</p>
		</center>
		<p>Администрация сайта "Уникальная Калмыкия" заблокировала Ваш аккаунт.</p>
		<p>Причиной блокировки аккаунта стало нарушение Пользовательского соглашения.</p>
		<p>Для разблокировки Вы можете <a href="mailto:info@uni08.ru">написать нам письмо</a>.</p>
		<p>Чтобы закрыть это сообщение, нажмите <a href="/logout" class="button special">Выход</a></p>
	</div>
	</div>

	<div id="socailAuth" class="modalDialog">
	<div>
		<a href="#close" title="Закрыть" class="close">X</a>
		<center>
		<p class="shadow">Авторизация через социальные сети</p>
		<p>Авторизуясь, вы принимаете <a href="#rules">Пользовательское соглашение</a>.</p>
		<ul class="actions">
				<li><a href="{{ URL::asset('auth/facebook') }}" class="icon alt button fa-facebook">Facebook<span class="label">Facebook</span></a></li>
				<li><a href="{{ URL::asset('auth/vkontakte') }}" class="icon alt button fa-vk">ВКонтакте<span class="label">ВКонтакте</span></a></li>
		</ul>
		</center>
	</div>
	</div>
		
  {{ HTML::script('alpha/assets/js/jquery.min.js') }}
  {{ HTML::script('alpha/assets/js/jquery.dropotron.min.js') }}
  {{ HTML::script('alpha/assets/js/jquery.scrollgress.min.js') }}
  {{ HTML::script('alpha/assets/js/skel.min.js') }}
  {{ HTML::script('alpha/assets/js/util.js') }}
  <!--[if lte IE 8]>{{ HTML::script('alpha/assets/js/ie/respond.min.js') }}<![endif]-->
  {{ HTML::script('alpha/assets/js/main.js') }}
  
  	<?php
	if (Auth::check()){
	if (Auth::user()->block == 1){
	?>	
		<script>
			$(document).ready(function() {
				$('#blockUser').attr("style", "pointer-events: auto; dislpay: block;");
				$('#blockUser').show();
			});
		</script>";
	<?php	
	}
	} 
	?>	
	
  @section('scripts')
  @show
  
  <?php echo 'Памяти использовано: ',round(memory_get_usage()/1024/1024,2),' MB'; ?>
</body>
</html>
