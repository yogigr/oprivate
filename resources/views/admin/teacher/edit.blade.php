@extends('admin.layouts.app')
@section('title', 'Edit Guru')
@section('breadcrumb')
<li><a href="{{ url('admin/teacher') }}">Guru</a></li>
<li class="active">Edit</li>
@endsection
@section('content')
<div class="panel panel-body">
	@include('admin.teacher.form')
</div>		
@endsection