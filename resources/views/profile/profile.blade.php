<form method="post" action="{{ $user->isTeacher() ? url('teacher/profile/update-profile') : url('student/profile/update-profile') }}" enctype="multipart/form-data">
	{{ csrf_field() }}
	{{ method_field('patch') }}
	<div class="row">
		<div class="col-sm-6">
			<div class="form-group">
				<label>Nama Lengkap</label>
				<input type="text" name="name" 
				class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" placeholder="Nama Lengkap"
				value="{{ isset($user) ? $user->name : old('name') }}">
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group">
				<label>Email</label>
				<input type="text" name="email" 
				class="form-control {{ $errors->has('email') ? 'has-error' : '' }}" placeholder="Email"
				value="{{ isset($user) ? $user->email : old('email') }}">
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group">
				<label class="form-control-label">Jenis Kelamin</label>
				<select class="custom-select {{ $errors->has('sex') ? 'is-invalid' : '' }}" name="sex">
					<option value="">Pilih Jenis Kelamin</option>
					<option value="m" {{ isset($user->profile) ? ($user->profile->sex == 'm' ? 'selected' : '') : 
						(old('sex') == 'm' ? 'selected' : '') }}>Laki laki</option>
					<option value="f" {{ isset($user->profile) ? ($user->profile->sex == 'f' ? 'selected' : '') : 
						(old('sex') == 'f' ? 'selected' : '') }}>Perempuan</option>
				</select>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group">
				<label class="form-control-label">Tempat Kelahiran</label>
				<input type="text" name="birth_place" 
				class="form-control {{ $errors->has('birth_place') ? 'is-invalid' : '' }}" placeholder="Contoh: Bandung" 
				value="{{ isset($user->profile) ? $user->profile->birth_place : old('birth_place') }}">
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group">
				<label class="form-control-label">Tanggal Kelahiran</label>
				<input type="text" name="birth_date" 
				class="form-control {{ $errors->has('birth_date') ? 'is-invalid' : '' }}"
				value="{{ isset($user->profile) ? $user->profile->birth_date : old('birth_date') }}">
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group">
				<label class="form-control-label">Upload Photo</label>
				<input type="file" name="image" 
				class="form-control {{ $errors->has('image') ? 'is-invalid' : '' }}">
			</div>
		</div>
		<div class="col">
			<div class="form-group">
				<label>Tentang anda</label>
				<textarea class="form-control {{ $errors->has('about') ? 'is-invalid' : '' }}" 
				name="about">{{ isset($user->profile) ? $user->profile->about : old('about') }}</textarea>
			</div>
		</div>
	</div>
	<div class="form-group">
		<button type="submit" class="btn btn-primary">Update</button>
	</div>
</form>