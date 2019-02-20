<div class="card">
    <div class="card-body">
    	<div class="row justify-content-center">
    		<div class="col-sm-8">
    			<img src="{{ Auth::user()->profile->image_thumb_url ?? asset('image/no-image.jpg') }}" class="img-fluid rounded-circle">
    		</div>
    	</div>
    </div>
    <div class="card-body">
    	<p class="text-center mb-0">
    		<strong>{{ Auth::user()->name }}</strong><br>
    		{{ Auth::user()->role->name }}
    	</p>
    </div>
	<div class="list-group list-group-flush">

		{{--teacher--}}
		@if(Auth::user()->isTeacher())
			<a href="{{ url('teacher') }}" class="list-group-item list-group-item-action
			{{ Request::segment(1) == 'teacher' && Request::segment(2) == '' ? 'active' : '' }}">
				Home
			</a>
			<a href="{{ url('teacher/schedule') }}" class="list-group-item list-group-item-action
			{{ Request::segment(1) == 'teacher' && Request::segment(2) == 'schedule' ? 'active' : '' }}">
				Jadwal Mengajar
			</a>
			<a href="{{ url('teacher/pending-schedule') }}" class="list-group-item list-group-item-action
			{{ Request::segment(1) == 'teacher' && Request::segment(2) == 'pending-schedule' ? 'active' : '' }}">
				Permintaan Mengajar
			</a>
			<a href="{{ url('teacher/setting') }}" class="list-group-item list-group-item-action
			{{ Request::segment(1) == 'teacher' && Request::segment(2) == 'setting' ? 'active' : '' }}">
				Pengaturan
			</a>
		@endif

		{{--student--}}
		@if(Auth::user()->isStudent())
			<a href="{{ url('student') }}" class="list-group-item list-group-item-action
			{{ Request::segment(1) == 'student' && Request::segment(2) == '' ? 'active' : '' }}">
				Home
			</a>
			<a href="{{ url('student/schedule') }}" class="list-group-item list-group-item-action
			{{ Request::segment(1) == 'student' && Request::segment(2) == 'schedule' ? 'active' : '' }}">
				Jadwal Aktif
			</a>
			<a href="{{ url('student/pending-schedule') }}" class="list-group-item list-group-item-action
			{{ Request::segment(1) == 'student' && Request::segment(2) == 'pending-schedule' ? 'active' : '' }}">
				Permintaan Jadwal
			</a>
		@endif

	</div>
</div>