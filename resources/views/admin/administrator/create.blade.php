@extends('admin.layouts.app')
@section('title', 'Administrator Baru')
@section('breadcrumb')
<li><a href="{{ url('admin/administrator') }}">Administrator</a></li>
<li class="active">Tambah</li>
@endsection
@section('content')
<div class="panel panel-body">
	@include('admin.administrator.form')
</div>		
@endsection