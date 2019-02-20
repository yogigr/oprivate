<form method="post" action="{{ $user->isTeacher() ? url('teacher/profile/update-address') : url('student/profile/update-address') }}">
	{{ csrf_field() }}
	{{ method_field('patch') }}
	<div class="row">
		<div class="col-sm-12">
			<province-city-select :errors='{{$errors}}' 
			:province-value="{{isset($user->address) ? $user->address->province_id : (old('province_id') ?? '""')}}"
			:city-value="{{isset($user->address) ? $user->address->city_id : (old('city_id') ?? '""')}}"></province-city-select>
		</div>
		<div class="col-sm-12">
			<div class="form-group">
				<label>Alamat</label>
				<textarea class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" 
				name="address">{{ isset($user->address) ? $user->address->address : old('address') }}</textarea>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group">
				<label>Kode Pos</label>
				<input type="text" name="postal_code" 
				class="form-control {{ $errors->has('postal_code') ? 'is-invalid' : '' }}"
				value="{{ isset($user->address) ? $user->address->postal_code : old('postal_code') }}">
			</div>
		</div>
	</div>
	<div class="form-group">
		<button type="submit" class="btn btn-primary">Update</button>
	</div>
</form>