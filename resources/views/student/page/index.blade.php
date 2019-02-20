@extends('layouts.app')
@section('title', 'Panel Siswa')
@section('breadcrumb')
<li class="breadcrumb-item active">Panel Siswa</li>
@endsection
@section('content')
<div class="row">
	<div class="col-sm-4">
		<div class="card card-body rounded-0 bg-success text-center text-white">
			<h3>
				{{ $student->studentSchedules()->where('is_active', 1)->count() }}
			</h3>
			<a href="{{ url('student/schedule') }}" class="text-white">Jadwal Aktif</a>
		</div>
	</div>
	<div class="col-sm-4">
		<div class="card card-body rounded-0 bg-warning text-center text-white">
			<h3>
				{{ $student->studentSchedules()->where('is_active', 0)->count() }}
			</h3>
			<a href="{{ url('student/pending-schedule') }}" class="text-white">Permintaan Jadwal</a>
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
						<img src="{{ $sc->teacher->profile->image_thumb_url }}" class="rounded-circle mr-2 pull-left" 
						style="width: 50px">
						<p> 
							<a href="{{ url('profile/'.$sc->teacher->id) }}">{{ $sc->teacher->name }}</a><br>
							<span class="text-muted font-italic">
								Guru {{ $sc->teacher->course->name }} {{ $sc->teacher->course->level->name }}
							</span>
						</p>
					</td>
					<td>
						<a href="{{ url('student/schedule/'.$sc->id) }}" class="btn btn-primary">
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