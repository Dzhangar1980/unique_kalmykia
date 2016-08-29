@extends('layouts.front-master')

@section('title', 'Уникальная Калмыкия. Ошибка 404')

@section('sidebar')
	@include('front.menu')
@stop

@section('banner')
<section id="banner">
		<h2>Уникальная Калмыкия</h2>
</section>
@stop

@section('content')
<header>
	<h2>Страница не найдена (ошибка 404)</h2>
</header>
	<div class="box">
	<div class="row">	
		<h4>Упс...</h4>
		<div class="features-row">
			<p>Очень жаль, но мы не можем найти страницу, которую вы ищете. Как такое могло случиться?</p>
			<ul>
				<li>Страница была удалена или перемещена</li>
				<li>Вы допустили опечатку в адресе страницы</li>
				<li>Вам нравятся 404-ые страницы</li>
			</ul>    
		</div>
	</div>
	</div>
@stop

@section('scripts')
@stop

