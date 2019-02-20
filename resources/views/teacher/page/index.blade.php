@extends('layouts.app')
@section('title', 'Panel Guru')
@section('content')
<div class="row">
	<div class="col-sm-4">
		<div class="card card-body rounded-0 bg-success text-center text-white">
			<h3>
				{{ $teacher->teacherSchedules()->where('is_active', 1)->count() }}
			</h3>
			<a href="{{ url('teacher/schedule') }}" class="text-white">Jadwal Aktif</a>
		</div>
	</div>
	<div class="col-sm-4">
		<div class="card card-body rounded-0 bg-warning text-center text-white">
			<h3>
				{{ $teacher->teacherSchedules()->where('is_active', 0)->count() }}
			</h3>
			<a href="{{ url('teacher/pending-schedule') }}" class="text-white">Permintaan Jadwal</a>
		</div>
	</div>
</div>
<div class="table-responsive mt-3">
	<table class="table table-bordered">
		<tbody>
			<tr>
				<th colspan="3">Jadwal Hari ini</th>
			</tr>
			@if($todaySchedules->count() > 0)
			@foreach($todaySchedules as $sc)
				<tr>
					<td>{{ $sc->time->name }} WIB</td>
					<td>
						<img src="{{ $sc->student->profile->image_thumb_url }}" class="rounded-circle mr-2 pull-left" 
						style="width: 50px">
						<p> 
							<a href="{{ url('profile/'.$sc->student->id) }}">{{ $sc->student->name }}</a><br>
						</p>
					</td>
					<td>
						<a href="{{ url('teacher/schedule/'.$sc->id) }}" class="btn btn-primary">
							Detail
						</a>
					</td>
				</tr>
			@endforeach
			@else
			<tr><td colspan="3">Tidak ada Jadwal</td></tr>
			@endif
		</tbody>
	</table>
</div>
@endsection