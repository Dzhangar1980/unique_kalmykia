@extends('layouts.master')

@section('title', 'AdminZone')

@section('sidebar')
	@include('admin.menu', ['path' => $path])
@stop

@section('content')
<div class="col_100">
	<h2>Материалы</h2> 
	<a href="../adminzone/article"><button class="new_article">Новый материал</button></a>
<hr>
@if (count($articles) > 0)
	<table border="0" width="100%">
    @foreach ($articles as $article)
		<tr>
			<td><a href="../adminzone/article/{{ $article->id }}">{{ $article->title }}</a></td>
			<td>{{ $article->category }}</td>
			<td>{{ date("d.m.Y г. H:i ч.", strtotime($article->updated_at)) }}</td>
			<td>
				{!! Form::open(array('url' => 'adminzone/change_article_status')) !!}
				{!! Form::hidden('article_id', $article->id) !!}
				{!! Form::hidden('article_status', $article->status) !!}
				@if ($article->status == 0)
					{{ Form::submit('Не опубликован', ["style" => "background: red; color: white"]) }}
				@elseif ($article->status == 1)	
					{{ Form::submit('Опубликован', ["style" => "background: green; color: white"])}}
				@endif
				{!! Form::close() !!}
			</td>
		<td>
			{!! Form::open(array('url' => 'adminzone/delete_article')) !!}
			{!! Form::hidden('article_id', $article->id) !!}
			{{ Form::submit('Удалить') }}
			{!! Form::close() !!}
		</td>
@endforeach
	</table>
	<!-- pagination -->
	{{ $articles->render() }}
@else
    I don't have any records!
@endif	
</div>
@stop

@section('scripts')
<!--	{{ HTML::script('js/articles.js') }} -->
@stop
