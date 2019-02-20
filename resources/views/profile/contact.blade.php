<form method="post" action="{{ $user->isTeacher() ? url('teacher/profile/update-contact') : url('student/profile/update-contact') }}">
	{{ csrf_field() }}
	{{ method_field('patch') }}
	<div class="row">
		<div class="col-sm-6">
			<div class="form-group">
				<label>Nomor Telp</label>
				<input type="text" name="phone_number" 
				class="form-control {{ $errors->has('phone_number') ? 'is-invalid' : '' }}"
				value="{{ isset($user->contact) ? $user->contact->phone_number : old('phone_number')}}">
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group">
				<label>Nomor WhatsApp</label>
				<input type="text" name="wa_number" 
				class="form-control {{ $errors->has('wa_number') ? 'is-invalid' : '' }}"
				value="{{ isset($user->contact) ? $user->contact->wa_number : old('wa_number')}}">
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group">
				<label>Facebook URL</label>
				<input type="text" name="facebook_url" 
				class="form-control {{ $errors->has('facebook_url') ? 'is-invalid' : '' }}"
				value="{{ isset($user->contact) ? $user->contact->facebook_url : old('facebook_url') }}">
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group">
				<label>Instagram URL</label>
				<input type="text" name="instagram_url" 
				class="form-control {{ $errors->has('instagram_url') ? 'is-invalid' : '' }}"
				value="{{ isset($user->contact) ? $user->contact->instagram_url : old('instagram_url') }}">
			</div>
		</div>
	</div>
	<div class="form-group">
		<button type="submit" class="btn btn-primary">Update</button>
	</div>
</form>