@extends('admin.layouts.app')
@section('title', 'Siswa Baru')
@section('breadcrumb')
<li><a href="{{ url('admin/student') }}">Siswa</a></li>
<li class="active">Tambah</li>
@endsection
@section('content')
<div class="panel panel-body">
	@include('admin.student.form')
</div>		
@endsection