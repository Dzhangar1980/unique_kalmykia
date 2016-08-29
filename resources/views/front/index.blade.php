@extends('layouts.front-master')

@section('title', 'Уникальная Калмыкия')

@section('sidebar')
	@include('front.menu')
@stop

@section('content')
<header>
	@include('front.slideshow')
</header>
	<div class="box">
	<div class="row">	
		<?php
		foreach ($Articles as $Article){ 
			echo '<div class="12u(mobilep)">
				<p><span class="shadow"><a href="/article/'.$Article->id.'">'.$Article->title.' '.'</a> | 
				<a href="/category/'.$Article->category->id.'">'.$Article->category->name.' '.'</a></span>
				| '.$Article->hits.' просмотров | '.date("d.m.Y г.", strtotime($Article->created_at)).'</p>
			    <p>'.$Article->intro.'</p>'; 
			if($Article->comments->count() == 0){
					echo '<p>Станьте первым комментатором!'; 
				}else{
					echo '<p><a href="/article/'.$Article->id.'#comments">'
					.$Article->comments->count().' комментарий</a>'; 
				}
			echo ' | <a class="button alt small" href="/article/'.$Article->id.'">Подробнее...</a></p>
				<hr></div>';
		}
		?>	
	</div>
	</div>
@stop

@section('scripts')
<script>
var slideIndex = 0;
showSlides();

function showSlides() {
    var i;
    var slides = document.getElementsByClassName("mySlides");
    var dots = document.getElementsByClassName("slideshow-dot");
    for (i = 0; i < slides.length; i++) {
       slides[i].style.display = "none";  
    }
    slideIndex++;
    if (slideIndex> slides.length) {slideIndex = 1}    
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" slideshow-active", "");
    }
    slides[slideIndex-1].style.display = "block";  
    dots[slideIndex-1].className += " slideshow-active";
    setTimeout(showSlides, 2000); // Change image every 2 seconds
}
</script>
@stop
