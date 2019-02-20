@extends('admin.layouts.app')
@section('title', 'Edit Mata Pelajaran')
@section('breadcrumb')
<li><a href="{{ url('admin/course') }}">Mata Pelajaran</a></li>
<li class="active">Edit</li>
@endsection
@section('content')
<div class="panel panel-body">
	@include('admin.course.form')
</div>	
@endsection