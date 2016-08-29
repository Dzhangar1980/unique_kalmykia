@extends('layouts.master')

@section('title', 'AdminZone')

@section('sidebar')
	@include('admin.menu', ['path' => $path])
@stop

@section('content')
<div class="col_100">
	@if(!isset($CurArticle))
		<h2>Новый материал</h2> 
		{!! Form::open(array('url' => 'adminzone/create_article')) !!}
		{!! Form::label('a_caption', 'Заголовок') !!}
		{!! Form::text('title', null, ['class' => 'form-control', 'id' => 'title', 'required' => 'required']) !!}
		{!! Form::label('c_caption', 'Категория') !!}
		{!! Form::select('category', $Categories_select) !!}<br>
		{!! Form::label('a_caption', 'Аннотация') !!}<br>
		{!! Form::textarea('intro', null, ['required' => 'required', 'rows' => '3']) !!}<br>
		{!! Form::label('a_caption', 'Контент') !!}<br>
		{!! Form::textarea('content', null, ['class' => 'editable', 'required' => 'required']) !!}
		{!! Form::select('status', ['0' => 'Не опубликовано', '1' => 'Опубликовано']) !!}<br>
		{{ Form::submit('Создать') }}
		{!! Form::close() !!}
	@else
		<h2>Редактирование материала</h2> 
		{!! Form::open(array('url' => 'adminzone/update_article')) !!}
		{!! Form::label('a_caption', 'Заголовок') !!}
		{!! Form::text('title', $CurArticle['title'], ['class' => 'form-control', 'id' => 'title', 'required' => 'required']) !!}
		{!! Form::label('c_caption', 'Категория') !!}
		{!! Form::select('category', $Categories_select, $CurArticle['category_id']) !!}<br>
		{!! Form::label('a_caption', 'Аннотация') !!}<br>
		{!! Form::textarea('intro', $CurArticle['intro'], ['required' => 'required', 'rows' => '3']) !!}<br>
		{!! Form::label('a_caption', 'Контент') !!}<br>
		{!! Form::textarea('content', stripcslashes($CurArticle['content']), ['class' => 'editable', 'required' => 'required']) !!}
		{!! Form::select('status', ['0' => 'Не опубликовано', '1' => 'Опубликовано'], $CurArticle['status']) !!}<br>
		{!! Form::hidden('id', $CurArticle['id']) !!}
		{{ Form::submit('Сохранить') }}
		{!! Form::close() !!}
	@endif
</div>
@stop

@section('css')
	<link href="{{ URL::asset('css/summernote.css') }}" rel="stylesheet" type="text/css" >
@stop

@section('scripts')
	{{ HTML::script('js/summernote.min.js') }}
	{{ HTML::script('lang/summernote-ru-RU.js') }}
<script>	
	$(document).ready(function(){
	$('.editable').summernote({
		height: 300,   //set editable area's height
		lang: 'ru-RU'
	});
	$('#title').focus();
	});
</script>
@stop
