@extends('layouts.master')

@section('title', 'Заголовок страницы')

@section('content')
    <p>Это - содержимое страницы.</p>
    @for ($i = 0; $i < 10; $i++)
		Текущее значение: {{ $i }}
	@endfor
@stop
