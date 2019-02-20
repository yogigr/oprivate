@extends('admin.layouts.app')
@section('title', 'Guru Baru')
@section('breadcrumb')
<li><a href="{{ url('admin/teacher') }}">Guru</a></li>
<li class="active">Tambah</li>
@endsection
@section('content')
<div class="panel panel-body">
	@include('admin.teacher.form')
</div>		
@endsection