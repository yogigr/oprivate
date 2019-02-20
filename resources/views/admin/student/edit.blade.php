@extends('admin.layouts.app')
@section('title', 'Edit Siswa')
@section('breadcrumb')
<li><a href="{{ url('admin/student') }}">Siswa</a></li>
<li class="active">Edit</li>
@endsection
@section('content')
<div class="panel panel-body">
	@include('admin.student.form')
</div>		
@endsection