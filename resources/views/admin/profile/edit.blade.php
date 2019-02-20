@extends('admin.layouts.app')
@section('title', 'Profile')
@section('breadcrumb')
<li class="active">Profile</li>
@endsection
@section('content')
<div class="nav-tabs-custom">
	<ul class="nav nav-tabs">
		<li class="active"><a href="#profile" data-toggle="tab" aria-expanded="true">Profile</a></li>
		<li class=""><a href="#changePassword" data-toggle="tab" aria-expanded="false">Change Password</a></li>
	</ul>
	<div class="tab-content">
		<div class="tab-pane active" id="profile">
			<form method="post" action="{{ url('admin/profile') }}">
				{{ csrf_field() }}
				{{ method_field('patch') }}
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
							<label>Nama</label>
							<input type="text" name="name" class="form-control" placeholder="Nama" autofocus
							value="{{ isset($admin) ? $admin->name : old('name') }}">
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
							<label>Email</label>
							<input type="text" name="email" class="form-control" placeholder="Email"
							value="{{ isset($admin) ? $admin->email : old('email') }}">
						</div>
					</div>
				</div>
				<hr>
				<div class="form-group">
					<button type="submit" class="btn btn-primary">
						<i class="fa fa-save"></i>
						{{ isset($admin) ? 'Perbarui' : 'Simpan' }}
					</button>	
				</div>
			</form>
		</div>
		<div class="tab-pane" id="changePassword">
			<form method="post" action="{{ url('admin/change-password') }}">
				{{ csrf_field() }}
				{{ method_field('patch') }}
				<div class="row">
					<div class="col-sm-4">
						<div class="form-group {{ $errors->has('old_password') ? 'has-error' : '' }}">
							<label>Password Lama</label>
							<input type="password" name="old_password" class="form-control" autofocus>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="form-group {{ $errors->has('new_password') ? 'has-error' : '' }}">
							<label>Password Baru</label>
							<input type="password" name="new_password" class="form-control">
						</div>
					</div>
					<div class="col-sm-4">
						<div class="form-group">
							<label>Konfirmasi Password Baru</label>
							<input type="password" name="new_password_confirmation" class="form-control">
						</div>
					</div>
				</div>
				<hr>
				<div class="form-group">
					<button type="submit" class="btn btn-primary">
						<i class="fa fa-save"></i>
						Ganti Password
					</button>	
				</div>
			</form>
		</div>
	</div>
</div>	
@endsection