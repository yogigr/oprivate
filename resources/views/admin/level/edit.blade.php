@extends('admin.layouts.app')
@section('title', 'Edit Jenjang Pendidikan')
@section('breadcrumb')
<li><a href="{{ url('admin/level') }}">Jenjang Pendidikan</a></li>
<li class="active">Edit</li>
@endsection
@section('content')
<div class="panel panel-body">
	@include('admin.level.form')
</div>	
@endsection