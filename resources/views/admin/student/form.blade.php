<form method="post" action="{{ isset($student) 
? url('admin/student/'.$student->id) : url('admin/student') }}" enctype="multipart/form-data">
	{{ csrf_field() }}
	@if(isset($student))
		{{ method_field('patch') }}
		<input type="hidden" name="student_id" value="{{$student->id}}">
	@endif

	{{--Akun--}}
	<div class="row">
		<div class="col-sm-12">
			<div class="page-header">Akun</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group {{ $errors->has('student_name') ? 'has-error' : '' }}">
				<label>Nama Siswa</label>
				<input type="text" name="student_name" class="form-control" placeholder="Nama Siswa" autofocus
				value="{{ isset($student) ? $student->name : old('student_name') }}">
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group {{ $errors->has('student_email') ? 'has-error' : '' }}">
				<label>Email</label>
				<input type="text" name="student_email" class="form-control" placeholder="Email Siswa"
				value="{{ isset($student) ? $student->email : old('student_email') }}">
			</div>
		</div>
		@if(!isset($student))
		<div class="col-sm-6">
			<div class="form-group {{ $errors->has('student_password') ? 'has-error' : '' }}">
				<label>Password</label>
				<input type="password" name="student_password" class="form-control" placeholder="Password">
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group">
				<label>Konfirmasi Password</label>
				<input type="password" name="student_password_confirmation" class="form-control" placeholder="Konfirmasi Password">
			</div>
		</div>
		@endif
	</div>

	{{--Profile--}}
	<div class="row">
		<div class="col-sm-12">
			<div class="page-header">Profil</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group {{ $errors->has('student_sex') ? 'has-error' : '' }}">
				<label>Jenis Kelamin</label>
				<select class="form-control" name="student_sex">
					<option value>Pilih Jenis Kelamin</option>
					<option value="m" {{ isset($student) ? ($student->profile->sex == 'm' ? 'selected' : '') : 
						(old('student_sex') == 'm' ? 'selected' : '') }}>Laki laki</option>
					<option value="f" {{ isset($student) ? ($student->profile->sex == 'f' ? 'selected' : '') : 
						(old('student_sex') == 'f' ? 'selected' : '') }}>Perempuan</option>
				</select>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group {{ $errors->has('student_birth_place') ? 'has-error' : '' }}">
				<label>Tempat Kelahiran</label>
				<input type="text" name="student_birth_place" class="form-control" placeholder="Contoh: Bandung" 
				value="{{ isset($student) ? $student->profile->birth_place : old('student_birth_place') }}">
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group {{ $errors->has('student_birth_date') ? 'has-error' : '' }}">
				<label>Tanggal Kelahiran</label>
				<input type="text" name="student_birth_date" class="form-control"
				value="{{ isset($student) ? $student->profile->birth_date : old('student_birth_date') }}">
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group {{ $errors->has('student_image') ? 'has-error' : '' }}">
				<label>Upload Photo</label>
				<input type="file" name="student_image" class="form-control">
			</div>
		</div>
	</div>
	
	{{--Address--}}
	<div class="row">
		<div class="col-sm-12">
			<div class="page-header">Alamat</div>
		</div>
		<province-city-select :errors='{{$errors}}' 
		:province-value="{{isset($student) ? $student->address->province_id : (old('province_id') ?? '""')}}"
		:city-value="{{isset($student) ? $student->address->city_id : (old('city_id') ?? '""')}}"></province-city-select>
		<div class="col-sm-12">
			<div class="form-group {{ $errors->has('student_address') ? 'has-error' : '' }}">
				<label>Alamat</label>
				<textarea class="form-control" 
				name="student_address">{{ isset($student) ? $student->address->address : old('student_address') }}</textarea>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group {{ $errors->has('student_postal_code') ? 'has-error' : '' }}">
				<label>Kode Pos</label>
				<input type="text" name="student_postal_code" class="form-control"
				value="{{ isset($student) ? $student->address->postal_code : old('student_postal_code') }}">
			</div>
		</div>
	</div>

	{{--Geolocation--}}
	<geolocation-input :errors="{{$errors}}"
	:lat-init="{{ isset($student) ? $student->geolocation->latitude : (old('latitude')??'null')  }}"
	:long-init="{{ isset($student) ? $student->geolocation->longitude : (old('longitude')??'null')  }}"></geolocation-input>

	{{--Contact--}}
	<div class="row">
		<div class="col-sm-12">
			<div class="page-header">Kontak</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group {{ $errors->has('student_phone_number') ? 'has-error' : '' }}">
				<label>Nomor Telp</label>
				<input type="text" name="student_phone_number" class="form-control"
				value="{{ isset($student) ? $student->contact->phone_number : old('student_phone_number')}}">
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group {{ $errors->has('student_wa_number') ? 'has-error' : '' }}">
				<label>Nomor WhatsApp</label>
				<input type="text" name="student_wa_number" class="form-control"
				value="{{ isset($student) ? $student->contact->wa_number : old('student_wa_number')}}">
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group {{ $errors->has('student_facebook_url') ? 'has-error' : 'error' }}">
				<label>Facebook URL</label>
				<input type="text" name="student_facebook_url" class="form-control"
				value="{{ isset($student) ? $student->contact->facebook_url : old('student_facebook_url') }}">
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group {{ $errors->has('student_instagram_url') ? 'has-error' : 'error' }}">
				<label>Instagram URL</label>
				<input type="text" name="student_instagram_url" class="form-control"
				value="{{ isset($student) ? $student->contact->instagram_url : old('student_instagram_url') }}">
			</div>
		</div>
	</div>

	<hr>

	<div class="form-group">
		<a href="{{ url('admin/student') }}" class="btn btn-default">
			<i class="fa fa-angle-double-left"></i>
			Kembali
		</a>
		<button type="submit" class="btn btn-primary">
			<i class="fa fa-save"></i>
			{{ isset($student) ? 'Perbarui' : 'Simpan' }}
		</button>	
	</div>
</form>

@push('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('css/datepicker.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>
<script>
	$(function(){
		$('input[name="student_birth_date"]').datepicker({
			format: 'dd/mm/yyyy',
		});
	})
</script>
@endpush
