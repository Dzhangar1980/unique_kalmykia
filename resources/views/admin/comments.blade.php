@extends('layouts.master')

@section('title', 'AdminZone')

@section('sidebar')
	@include('admin.menu', ['path' => $path])
@stop

@section('content')
<div class="col_100">
	<h2>Комментарии</h2> 
<hr>
@if (count($comments) > 0)
	<table border="0" width="100%">
    @foreach ($comments as $comment)
		<div>
			{{ date("d.m.Y г. H:i ч.", strtotime($comment->created_at)) }}
			<img src="{{ $comment->user->avatar }}" width="24px" height="24px"> 
			<strong>{{ $comment->user->name }}</strong> прокомментировал 
			<em>{{ $comment->article->title }} </em><br>
			<div 
			@if($comment->status == 0)
				class="warning"
			@elseif($comment->status == 1)	
				class="success"
			@endif	
			>{{ $comment->content }}</div>
			<table width="100%" border="0">
				<tr>
					<td>
			@if($comment->status == 0) 
			{!! Form::open(array('url' => 'adminzone/approve_comment')) !!}
			{!! Form::hidden('comment_id', $comment->id) !!}
			{!! Form::hidden('redirectPath', Request::url()) !!}
			{{ Form::submit('Одобрить') }}
			{!! Form::close() !!}
			@endif
					</td>
					<td>
			{!! Form::open(array('url' => 'adminzone/delete_user_comments')) !!}
			{!! Form::hidden('user_id', $comment->user_id) !!}
			{!! Form::hidden('redirectPath', Request::url()) !!}
			{{ Form::submit('Удалить все комментарии этого пользователя') }}
			{!! Form::close() !!}
					</td>
					<td>
			{!! Form::open(array('url' => 'adminzone/delete_comment')) !!}
			{!! Form::hidden('comment_id', $comment->id) !!}
			{!! Form::hidden('redirectPath', Request::url()) !!}
			{{ Form::submit('Удалить') }}
			{!! Form::close() !!}						
					</td>
				</tr>
			</table>
		</div>
		<hr>
    @endforeach
	</table>
	<!-- pagination -->
	{{ $comments->render() }}
@else
    No any records!
@endif	
</div>
@stop

@section('scripts')
<!--	{{ HTML::script('js/articles.js') }} -->
@stop
