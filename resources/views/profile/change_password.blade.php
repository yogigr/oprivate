<form method="post" action="{{ $user->isTeacher() ? url('teacher/profile/change-password') : url('student/profile/change-password') }}" enctype="multipart/form-data">
	{{ csrf_field() }}
	{{ method_field('patch') }}
	<div class="row">
		<div class="col-sm-4">
			<div class="form-group">
				<label>Password Lama</label>
				<input type="password" name="old_password" 
				class="form-control {{ $errors->has('old_password') ? 'is-invalid' : '' }}">
			</div>
		</div>
		<div class="col-sm-4">
			<div class="form-group">
				<label>Password Baru</label>
				<input type="password" name="new_password" 
				class="form-control {{ $errors->has('new_password') ? 'is-invalid' : '' }}">
			</div>
		</div>
		<div class="col-sm-4">
			<div class="form-group">
				<label>Konfirmasi Password Baru</label>
				<input type="password" name="new_password_confirmation" class="form-control">
			</div>
		</div>
	</div>
	<div class="form-group">
		<button type="submit" class="btn btn-primary">Ubah Password</button>
	</div>
</form>