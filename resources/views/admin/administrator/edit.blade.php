@extends('admin.layouts.app')
@section('title', 'Edit Administrator')
@section('breadcrumb')
<li><a href="{{ url('admin/administrator') }}">Administrator</a></li>
<li class="active">Edit</li>
@endsection
@section('content')
<div class="panel panel-body">
	@include('admin.administrator.form')
</div>		
@endsection