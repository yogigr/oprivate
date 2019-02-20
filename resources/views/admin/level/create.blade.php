@extends('admin.layouts.app')
@section('title', 'Jenjang Pendidikan Baru')
@section('breadcrumb')
<li><a href="{{ url('admin/level') }}">Jenjang Pendidikan</a></li>
<li class="active">Tambah</li>
@endsection
@section('content')
<div class="panel panel-body">
	@include('admin.level.form')
</div>		
@endsection