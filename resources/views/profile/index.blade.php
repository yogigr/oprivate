@extends('layouts.app')
@section('title', 'Profile')
@section('content')

<ul class="nav nav-tabs">
	<li class="nav-item">
		<a class="nav-link" data-toggle="tab" href="#profile">Profile</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" data-toggle="tab" href="#address">Alamat</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" data-toggle="tab" href="#geolocation">Lokasi</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" data-toggle="tab" href="#contact">Contact</a>
	</li>
	@if($user->isTeacher())
	<li class="nav-item">
		<a class="nav-link" data-toggle="tab" href="#educational">Riwayat Pendidikan</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" data-toggle="tab" href="#achievement">Prestasi/Penghargaan</a>
	</li>
	@endif
	<li class="nav-item">
		<a class="nav-link" data-toggle="tab" href="#changePassword">Ubah Password</a>
	</li>
</ul>
<div class="tab-content py-3">
	{{--Profile--}}
	<div class="tab-pane fade" id="profile">
		@include('profile.profile')
	</div>

	{{--Address--}}
	<div class="tab-pane fade" id="address">
		@include('profile.address')
	</div>

	{{--geolocation--}}
	<div class="tab-pane fade" id="geolocation">
		@include('profile.geolocation')
	</div>

	{{--contact--}}
	<div class="tab-pane fade" id="contact">
		@include('profile.contact')
	</div>

	@if($user->isTeacher())
	{{--educational--}}
	<div class="tab-pane fane" id="educational">
		@include('profile.educational')
	</div>

	{{--achievement--}}
	<div class="tab-pane fane" id="achievement">
		@include('profile.achievement')
	</div>
	@endif

	{{--change password--}}
	<div class="tab-pane fade" id="changePassword">
		@include('profile.change_password')
	</div>
</div>

@endsection

@push('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('css/datepicker.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>
<script>
	$(function(){

		$('input[name="birth_date"]').datepicker({
			format: 'dd/mm/yyyy',
		});

		var url = window.location.href;
		var i = url.indexOf('#');
		var id = url.substr(i)
		$('[href="'+id+'"]').addClass('active show');
		$(id).tab('show');
	})
</script>
@endpush