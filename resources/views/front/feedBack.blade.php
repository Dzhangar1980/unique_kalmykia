@extends('layouts.front-master')

@section('title', 'Уникальная Калмыкия. Обратная связь')

@section('content')
<header>
	<h2>Мы всегда рады Вашим письмам!</h2>
</header>
	<div class="box">
	<div class="row">	
		@include('front.yandex-share')
		<hr width="1px">
		<br>
		@if(Session::has('flashMessage'))
			<blockquote>{!! Session::get('flashMessage') !!}</blockquote>
		@endif		
		<br>		
		{!! Form::open(array('url' => 'feedBack')) !!}
		@if(Auth::check())
			{!! Form::text('name', Auth::user()->name, ['class' => 'form-control', 'placeholder' => 'Фамилия Имя','required' => 'required']) !!}
		@else
			{!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Фамилия Имя','required' => 'required']) !!}
		@endif
		@if(Auth::check())
			{!! Form::text('email', Auth::user()->email, ['class' => 'form-control', 'placeholder' => 'Email', 'required' => 'required']) !!}
		@else
			{!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Email', 'required' => 'required']) !!}
		@endif
		{!! Form::text('phone', null, ['class' => 'form-control', 'placeholder' => 'Телефон']) !!}
		
		{!! Form::select('theme', ['commerce' => 'Коммерческое предложение', 
									'jaloba' => 'Жалоба',
									'athers' => 'Другое'
									]) !!}<br>
		{!! Form::textarea('userMessage', null, ['required' => 'required', 'placeholder' => 'Текст сообщения', 'rows' => '3']) !!}<br>
		<p>Используйте простой текст. Все HTML-теги будут удалены автоматически.</p>
		
		{{ Form::submit('Отправить', ['class' => 'small']) }}
		{!! Form::close() !!}
		
		@if (count($errors) > 0)
			<ul>
			@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
			</ul>
		@endif
				
	</div>
	</div>
@stop

@section('scripts')
@stop
