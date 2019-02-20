@extends('admin.layouts.app')
@section('title', 'Mata Pelajaran Baru')
@section('breadcrumb')
<li><a href="{{ url('admin/course') }}">Mata Pelajaran</a></li>
<li class="active">Tambah</li>
@endsection
@section('content')
<div class="panel panel-body">
	@include('admin.course.form')
</div>		
@endsection