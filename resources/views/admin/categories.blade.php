@extends('layouts.master')

@section('title', 'AdminZone')

@section('sidebar')
	@include('admin.menu', ['path' => $path])
@stop

@section('content')

{!! Form::open(array('url' => 'adminzone/create_category')) !!}
    {!! Form::label('title', 'Новая категория:') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
    {!! Form::select('parent', $Categories_select) !!}
    {{ Form::submit('Создать') }}
{!! Form::close() !!}

<div class="col_100">
<h2>Категории</h2>
@if (count($categories) > 0)
	<table border="0">
    @foreach ($categories as $category)    
    @if ($category->parent == 0)
		<tr><td>Категория "{{ $category->name }}"</td>
		<td>
			{!! Form::open(array('url' => 'adminzone/delete_category')) !!}
			{!! Form::hidden('categoty_id', $category->id) !!}
			{{ Form::submit('Удалить') }}
			{!! Form::close() !!}
		</td>
		<td><button class="change" parent="{{ $category->parent }}" data="{{ $category->name }}" id="{{ $category->id }}">Изменить</button></td></tr>
		@foreach ($categories as $subcategory)    
		@if ($subcategory->parent == $category->id)
		<tr>
			<td>-- "{{ $subcategory->name }}"</td>
			<td>
			{!! Form::open(array('url' => 'adminzone/delete_category')) !!}
			{!! Form::hidden('categoty_id', $subcategory->id) !!}
			{{ Form::submit('Удалить') }}
			{!! Form::close() !!}
			</td>
			<td><button class="change" parent="{{ $subcategory->parent }}" data="{{ $subcategory->name }}" id="{{ $subcategory->id }}">Изменить</button></td>			
		</tr>
		@endif    
		@endforeach
	@endif    
@endforeach
	</table>
@else
    I don't have any records!
@endif
</div>
<div id="modal" style="display:none;">
{!! Form::open(array('url' => 'adminzone/update_category')) !!}
    {!! Form::text('up_name', null, ['id'=>'up_name', 'class' => 'form-control', 'required' => 'required']) !!}
    {!! Form::select('up_parent', $Categories_select) !!}
    {!! Form::hidden('up_categoty_id', 0, ['id'=>'up_categoty_id']) !!}
    {{ Form::submit('Сохранить') }}
{!! Form::close() !!}
</div>

@stop

@section('scripts')
<script>
	$(document).ready(function(){
		$(".change").click(function(){
			var my_category_name = $(this).attr("data");
			var my_category_id = $(this).attr("id");
			var my_category_parent = $(this).attr("parent");
			//alert(my_category_parent);
			$("#modal").dialog({ title: 'Категория' });
			$("#up_name").val(my_category_name);
			//$("#up_parent option[value='"+my_category_parent+"']").attr('selected','selected');
			$("#up_parent").val(my_category_parent);
			$("#up_categoty_id").val(my_category_id);
			});
	});
</script>
@stop
