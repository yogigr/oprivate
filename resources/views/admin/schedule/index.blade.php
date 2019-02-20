@extends('admin.layouts.app')
@section('title', 'Jadwal Aktif')
@section('breadcrumb')
<li class="active">Jadwal Aktif</li>
@endsection
@section('content')
<div class="panel panel-body">
	<div class="table-responsive">
		<table class="table table-hover table-striped table-bordered">
			<thead class="bg-info">
				<tr>
					<th class="text-center">@sortablelink('day_id', 'Hari')</th>
					<th class="text-center">@sortablelink('time_id', 'Jam')</th>
					<th class="text-center">@sortablelink('teacher_id', 'Guru')</th>
					<th class="text-center">@sortablelink('student_id', 'Siswa')</th>
					<th class="text-center">#</th>
				</tr>
			</thead>
			<tbody>
				@if($schedules->count() > 0)
					@foreach($schedules as $sc)
					<tr>
						<td>{{ $sc->day->name }}</td>
						<td class="text-right">{{ $sc->time->name }}</td>
						<td>{{ $sc->teacher->name }}</td>
						<td>{{ $sc->student->name }}</td>
						<td class="text-center">
							<div class="btn-group">
								<a href="{{ url('admin/schedule/'.$sc->id) }}" 
								class="btn btn-warning btn-xs">
									Detail
								</a>
							</div>
						</td>
					</tr>
					@endforeach
				@else
				<tr><td colspan="5">Tidak ditemukan</td></tr>
				@endif
			</tbody>
			<thead class="bg-info">
				<tr>
					<th class="text-center">@sortablelink('day.name', 'Hari')</th>
					<th class="text-center">@sortablelink('time.name', 'Jam')</th>
					<th class="text-center">@sortablelink('teacher_id', 'Guru')</th>
					<th class="text-center">@sortablelink('student_id', 'Siswa')</th>
					<th class="text-center">#</th>
				</tr>
			</thead>
		</table>
	</div>
	{!! $schedules->appends(\Request::except('page'))->render() !!}
</div>
@endsection