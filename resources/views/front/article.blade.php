@extends('layouts.front-master')

@section('title', 'Уникальная Калмыкия. '.$Article->title)

@section('content')
<header>
	<h2>{{ $Article->title }}</h2>
	<h4><a href="/category/{{ $Category->id }}">{{ $Category->name }}</a></h4>
</header>
	<div class="box">
	<div class="row">	
		@include('front.yandex-share')
		<hr width="1px">
		<?php 
			echo stripcslashes($Article->content); 
		?>
		<a name="comments"></a>
		<h4>Комментарии</h4>
		<div class="features-row">
			<?php 
			if (Auth::check()){ 
				if (Auth::user()->block == 0){ 
			?>
				<p><img src="{{ Auth::user()->avatar }}" width="24px" height="24px"> <b>{{ Auth::user()->name }}</b></p>
				{!! Form::open(array('url' => 'create_comment')) !!}
				{!! Form::textarea('comment', null, ['required' => 'required', 'rows' => '3']) !!}<br>
				{!! Form::hidden('user_id', Auth::user()->id) !!}
				{!! Form::hidden('redirectPath', Request::url().'#comments') !!}
				{!! Form::hidden('article_id', $Article->id) !!}
				{{ Form::submit('Комментировать') }}
				{!! Form::close() !!}
			<?php
				}elseif(Auth::user()->block == 1){
			?>
				<blockquote>
				<center><p class="shadow">Ваш аккаунт заблокирован!</p></center>
				<p>Администрация сайта "Уникальная Калмыкия" заблокировала Ваш аккаунт.</p>
				<p>Причиной блокировки аккаунта стало нарушение  <a href="#rules">Пользовательского соглашения</a>.</p>
				<p>Для разблокировки Вы можете <a href="mailto:info@uni08.ru">написать нам письмо</a>.</p>
				<p>Чтобы закрыть это сообщение, нажмите <a href="/logout" class="button special">Выход</a></p>
				</blockquote>
			<?php		
				}	
			}else{ 
			?>
				<p>Чтобы комментировать, <a href="#socailAuth">авторизуйтесь</a>!</p>
			<?php } ?>
			<!-- комментарии -->
			@if (count($Comments) > 0)
				<div class="features-row">
				@foreach ($Comments as $comment)
					<section>
						<img src="{{ $comment->user->avatar }}" width="24px" height="24px"> 
						<strong>{{ $comment->user->name }}</strong> 
						( {{ date("d.m.Y г. H:i ч.", strtotime($comment->created_at)) }} )<br>
						<blockquote>{{ $comment->content }}</blockquote>		
						<?php 
						if(Auth::check()){ 
							if(Auth::user()->role == "admin"){
						?>		
								{!! Form::open(array('url' => 'adminzone/delete_comment')) !!}
								{!! Form::hidden('comment_id', $comment->id) !!}
								{!! Form::hidden('redirectPath', Request::url().'#comments') !!}
								{{ Form::submit('Удалить этот комментарий', ['class' => 'small special']) }}
								{!! Form::close() !!}
						<?php
							}
						}
						?>
					</section>
				@endforeach
				</div>
			@endif
		</div>
	</div>
	</div>
@stop

@section('scripts')
@stop
