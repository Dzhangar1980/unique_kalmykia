@extends('layouts.master')

@section('title', 'AdminZone')

@section('sidebar')
	@include('admin.menu', ['path' => $path])
@stop

@section('content')
	<div class="col_100">
	<h2>Пользователи</h2> 
<hr>
@if (count($users) > 0)
	<table border="0" width="100%">
    @foreach ($users as $user)
		@if($user->id != Auth::user()->id)
		<div>
			<table width="100%" border="0">
				<tr>
					<td>
						<div 
						@if($user->block == 1)
							class="warning"
						@elseif($user->block == 0)	
							class="success"
						@endif	
						>
						<img src="{{ $user->avatar }}" width="24px" height="24px"> 
						<strong>{{ $user->name }}</strong>
						</div>
					</td>
					<td align="center">
			{{ count($user->comments) }} комментарий(ев)
					</td>
					<td>
						{{ date("d.m.Y г. H:i ч.", strtotime($user->created_at)) }}
					</td>
					<td>
						<table>
							<tr>
								<td>
								{!! Form::open(array('url' => 'adminzone/set_user_role')) !!}
								{!! Form::select('user_role', ['user' => 'Пользователь', 'admin' => 'Администратор'], $user->role) !!}
								</td><td>
								{{ Form::submit('ok') }}
								{!! Form::hidden('user_id', $user->id) !!}
								{!! Form::hidden('redirectPath', Request::url()) !!}
								{!! Form::close() !!}
								</td>
							</tr>
						</table>
					</td>
					<td>
			{!! Form::open(array('url' => 'adminzone/block_user')) !!}
			{!! Form::hidden('user_id', $user->id) !!}
			{!! Form::hidden('redirectPath', Request::url()) !!}
			@if($user->block == 0) 
				{!! Form::hidden('task', 'block') !!}
				{{ Form::submit('Заблокировать') }}
			@elseif($user->block == 1) 
				{!! Form::hidden('task', 'unblock') !!}
				{{ Form::submit('Разблокировать') }}	
			@endif
			{!! Form::close() !!}
					</td>
				</tr>
			</table>
		</div>
		<hr>
		@endif
    @endforeach
	</table>
	<!-- pagination -->
	{{ $users->render() }}
@else
    No any records!
@endif	
</div>
@stop
