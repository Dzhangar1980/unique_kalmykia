@extends('layouts.front-master')

@section('title', 'Уникальная Калмыкия. '.$Category->name)

@section('content')
<header>
	<h2>{{ $Category->name }}</h2>
	@if($Category->mather)
		<h4><a href="/category/{{ $Category->mather->id }}">{{ $Category->mather->name }}</a></h4>
	@endif
</header>
	<div class="box">
	<div class="row">	
		<?php
		foreach ($Articles as $Article){ 
			echo '<div class="4u 12u(mobilep)">
				<h4><a href="/article/'.$Article->id.'">'.$Article->title.' '.'</a></h4>
				<p><a href="/category/'.$Article->category->id.'">'.$Article->category->name.' '.'</a>
				<br>'.$Article->hits.' просмотров
				<br>'.date("d.m.Y г.", strtotime($Article->updated_at)).'</p>'; 
			echo '<p>'.$Article->intro.'</p>'; 
			if($Article->comments->count() == 0){
					echo '<p>Станьте первым комментатором!</p>'; 
				}else{
					echo '<p><a href="/article/'.$Article->id.'#comments">'
					.$Article->comments->count().' комментарий</a></p>'; 
				}
			echo '<a class="button small" href="/article/'.$Article->id.'">Подробнее...</a>
				<hr>
				</div>';
		}
		?>	
	</div>
	<div class="pagination">	
		@include('front.pagination', ['paginator' => $Articles])
	</div>
	</div>
@stop

@section('scripts')
@stop
