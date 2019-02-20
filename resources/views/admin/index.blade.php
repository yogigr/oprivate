@extends('admin.layouts.app')
@section('title', 'Dashboard')
@section('content')
<div class="row">
	<div class="col-lg-3 col-xs-6">
		<div class="small-box bg-aqua">
			<div class="inner">
				<h3>{{ $teachers->count() }}</h3>
				<p>Guru</p>
			</div>
			<div class="icon">
				<i class="fa fa-user-circle"></i>
			</div>
			<a href="{{ url('admin/teacher') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div>
	<div class="col-lg-3 col-xs-6">
		<div class="small-box bg-green">
			<div class="inner">
				<h3>{{ $students->count() }}</h3>
				<p>Siswa</p>
			</div>
			<div class="icon">
				<i class="fa fa-user-circle-o"></i>
			</div>
			<a href="{{ url('admin/student') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div>
	<div class="col-lg-3 col-xs-6">
		<div class="small-box bg-red">
			<div class="inner">
				<h3>{{ $courses->count() }}</h3>
				<p>Mata Pelajaran</p>
			</div>
			<div class="icon">
				<i class="fa fa-book"></i>
			</div>
			<a href="{{ url('admin/course') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div>
</div>
@endsection