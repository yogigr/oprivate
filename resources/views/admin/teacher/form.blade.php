<form method="post" action="{{ isset($teacher) 
? url('admin/teacher/'.$teacher->id) : url('admin/teacher') }}" enctype="multipart/form-data">
	{{ csrf_field() }}
	@if(isset($teacher))
		{{ method_field('patch') }}
		<input type="hidden" name="teacher_id" value="{{$teacher->id}}">
	@endif

	{{--Akun--}}
	<div class="row">
		<div class="col-sm-12">
			<div class="page-header">Akun</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group {{ $errors->has('teacher_name') ? 'has-error' : '' }}">
				<label>Nama Guru</label>
				<input type="text" name="teacher_name" class="form-control" placeholder="Nama Guru" autofocus
				value="{{ isset($teacher) ? $teacher->name : old('teacher_name') }}">
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group {{ $errors->has('teacher_email') ? 'has-error' : '' }}">
				<label>Email</label>
				<input type="text" name="teacher_email" class="form-control" placeholder="Email Guru"
				value="{{ isset($teacher) ? $teacher->email : old('teacher_email') }}">
			</div>
		</div>
		@if(!isset($teacher))
		<div class="col-sm-6">
			<div class="form-group {{ $errors->has('teacher_password') ? 'has-error' : '' }}">
				<label>Password</label>
				<input type="password" name="teacher_password" class="form-control" placeholder="Password">
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group">
				<label>Konfirmasi Password</label>
				<input type="password" name="teacher_password_confirmation" class="form-control" placeholder="Konfirmasi Password">
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
			<div class="form-group {{ $errors->has('teacher_sex') ? 'has-error' : '' }}">
				<label>Jenis Kelamin</label>
				<select class="form-control" name="teacher_sex">
					<option value>Pilih Jenis Kelamin</option>
					<option value="m" {{ isset($teacher) ? ($teacher->profile->sex == 'm' ? 'selected' : '') : 
						(old('teacher_sex') == 'm' ? 'selected' : '') }}>Laki laki</option>
					<option value="f" {{ isset($teacher) ? ($teacher->profile->sex == 'f' ? 'selected' : '') : 
						(old('teacher_sex') == 'f' ? 'selected' : '') }}>Perempuan</option>
				</select>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group {{ $errors->has('teacher_birth_place') ? 'has-error' : '' }}">
				<label>Tempat Kelahiran</label>
				<input type="text" name="teacher_birth_place" class="form-control" placeholder="Contoh: Bandung" 
				value="{{ isset($teacher) ? $teacher->profile->birth_place : old('teacher_birth_place') }}">
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group {{ $errors->has('teacher_birth_date') ? 'has-error' : '' }}">
				<label>Tanggal Kelahiran</label>
				<input type="text" name="teacher_birth_date" class="form-control"
				value="{{ isset($teacher) ? $teacher->profile->birth_date : old('teacher_birth_date') }}">
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group {{ $errors->has('teacher_image') ? 'has-error' : '' }}">
				<label>Upload Photo</label>
				<input type="file" name="teacher_image" class="form-control">
			</div>
		</div>
	</div>
	
	{{--Address--}}
	<div class="row">
		<div class="col-sm-12">
			<div class="page-header">Alamat</div>
		</div>
		<province-city-select :errors='{{$errors}}' 
		:province-value="{{isset($teacher) ? $teacher->address->province_id : (old('province_id') ?? '""')}}"
		:city-value="{{isset($teacher) ? $teacher->address->city_id : (old('city_id') ?? '""')}}"></province-city-select>
		<div class="col-sm-12">
			<div class="form-group {{ $errors->has('teacher_address') ? 'has-error' : '' }}">
				<label>Alamat</label>
				<textarea class="form-control" 
				name="teacher_address">{{ isset($teacher) ? $teacher->address->address : old('teacher_address') }}</textarea>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group {{ $errors->has('teacher_postal_code') ? 'has-error' : '' }}">
				<label>Kode Pos</label>
				<input type="text" name="teacher_postal_code" class="form-control"
				value="{{ isset($teacher) ? $teacher->address->postal_code : old('teacher_postal_code') }}">
			</div>
		</div>
	</div>

	{{--Geolocation--}}
	<geolocation-input :errors="{{$errors}}"
	:lat-init="{{ isset($teacher) ? $teacher->geolocation->latitude : (old('teacher_latitude')??'null')  }}"
	:long-init="{{ isset($teacher) ? $teacher->geolocation->longitude : (old('teacher_longitude')??'null')  }}"></geolocation-input>

	{{--Contact--}}
	<div class="row">
		<div class="col-sm-12">
			<div class="page-header">Kontak</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group {{ $errors->has('teacher_phone_number') ? 'has-error' : '' }}">
				<label>Nomor Telp</label>
				<input type="text" name="teacher_phone_number" class="form-control"
				value="{{ isset($teacher) ? $teacher->contact->phone_number : old('teacher_phone_number')}}">
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group {{ $errors->has('teacher_wa_number') ? 'has-error' : '' }}">
				<label>Nomor WhatsApp</label>
				<input type="text" name="teacher_wa_number" class="form-control"
				value="{{ isset($teacher) ? $teacher->contact->wa_number : old('teacher_wa_number')}}">
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group {{ $errors->has('teacher_facebook_url') ? 'has-error' : 'error' }}">
				<label>Facebook URL</label>
				<input type="text" name="teacher_facebook_url" class="form-control"
				value="{{ isset($teacher) ? $teacher->contact->facebook_url : old('teacher_facebook_url') }}">
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group {{ $errors->has('teacher_instagram_url') ? 'has-error' : 'error' }}">
				<label>Instagram URL</label>
				<input type="text" name="teacher_instagram_url" class="form-control"
				value="{{ isset($teacher) ? $teacher->contact->instagram_url : old('teacher_instagram_url') }}">
			</div>
		</div>
	</div>

	@if(isset($teacher))
		{{--educational--}}
	<div class="row">
		<div class="col-sm-12">
			<div class="page-header">Riwayat Pendidikan</div>
			<education-form :educations-init="{{isset($teacher->educationals) ? $teacher->educationals : '[]'}}"
			:teacher-id="{{ $teacher->id }}"></education-form>
		</div>
	</div>
		{{--achievement--}}
	<div class="row">
		<div class="col-sm-12">
			<div class="page-header">Penghargaan</div>
			<achievement-form :achievements-init="{{ isset($teacher->achievements) ? $teacher->achievements : '[]' }}"
			:teacher-id="{{ $teacher->id }}"></achievement-form>	
		</div>
	</div>

	@endif

	<hr>

	<div class="form-group">
		<a href="{{ url('admin/teacher') }}" class="btn btn-default">
			<i class="fa fa-angle-double-left"></i>
			Kembali
		</a>
		<button type="submit" class="btn btn-primary">
			<i class="fa fa-save"></i>
			{{ isset($teacher) ? 'Perbarui' : 'Simpan' }}
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
		$('input[name="teacher_birth_date"]').datepicker({
			format: 'dd/mm/yyyy',
		});
	})
</script>
@endpush
