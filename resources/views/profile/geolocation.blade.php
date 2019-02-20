<form method="post" action="{{ $user->isTeacher() ? url('teacher/profile/update-geolocation') : url('student/profile/update-geolocation') }}" enctype="multipart/form-data">
	{{ csrf_field() }}
	{{ method_field('patch') }}
	<geolocation-input :errors="{{$errors}}"
	:lat-init="{{ isset($user->geolocation) ? $user->geolocation->latitude : (old('latitude')??'null')  }}"
	:long-init="{{ isset($user->geolocation) ? $user->geolocation->longitude : (old('longitude')??'null')  }}"></geolocation-input>
	<div class="form-group mt-3">
		<button type="submit" class="btn btn-primary">Update</button>
	</div>
</form>