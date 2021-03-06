@extends('layouts.app')
@section('title', 'Jadwal Aktif Belajar')
@section('content')
<div class="table-responsive">
	<table class="table table-bordered table-striped">
		<thead>
			<tr>
				<th class="text-center">@sortablelink('day.name', 'Hari')</th>
				<th class="text-center">@sortablelink('time.name', 'Jam')</th>
				<th class="text-center">@sortablelink('teacher_id', 'Guru')</th>
				<th class="text-center">#</th>
			</tr>
		</thead>
		<tbody>
			@if($schedules->count() > 0)
				@foreach($schedules as $sc)
					<tr>
						<td class="text-center">{{ $sc->day->name }}</td>
						<td class="text-center">{{ $sc->time->name }}</td>
						<td>
							<img src="{{ $sc->teacher->profile->image_thumb_url }}" class="rounded-circle" style="width: 30px">
							<a href="{{ url('profile/'.$sc->teacher->id) }}">
								{{ $sc->teacher->name }}
							</a>
						</td>
						<td class="text-center">
							<a href="{{ url('student/schedule/'.$sc->id) }}" class="btn btn-primary">
								Detail
							</a>
						</td>
					</tr>
				@endforeach
			@else
			<tr><td colspan="4">Tidak ada Jadwal aktif</td></tr>
			@endif
		</tbody>
		<thead>
			<tr>
				<th class="text-center">@sortablelink('day.name', 'Hari')</th>
				<th class="text-center">@sortablelink('time.name', 'Jam')</th>
				<th class="text-center">@sortablelink('teacher_id', 'Guru')</th>
				<th class="text-center">#</th>
			</tr>
		</thead>
	</table>
</div>
@endsection