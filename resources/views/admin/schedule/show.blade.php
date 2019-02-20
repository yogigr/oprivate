@extends('admin.layouts.app')
@section('title', 'Detail Jadwal Aktif')
@section('breadcrumb')
<li><a href="{{ url('admin/schedule') }}">Jadwal Aktif</a></li>
<li class="active">Detail</li>
@endsection
@section('content')
<div class="panel panel-body">
	<div class="table-responsive">
		<table class="table table-bordered table-striped">
			<thead class="bg-info">
				<tr>
					<th>Waktu</th>
					<th>Note</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>{{ $schedule->day->name . ' ' . $schedule->time->name }}</td>
					<td>{{ $schedule->note }}</td>
				</tr>
			</tbody>
		</table>
		<br>
		<h3>Data Guru</h3>
		<table class="table table-bordered table-striped">
			<thead class="bg-info">
				<tr>
					<th>Nama</th>
					<th>Mengajar</th>
					<th>Tarif/Pertemuan</th>
					<th>Info Kontak</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>
						<img src="{{ $schedule->teacher->profile->image_thumb_url }}" style="width: 30px">
						<a href="{{ url('admin/teacher/'.$schedule->teacher_id.'/edit') }}">{{ $schedule->teacher->name }}</a>
					</td>
					<td>{{ $schedule->teacher->course->name }}</td>
					<td class="text-right">Rp {{ $schedule->teacher->price }}</td>
					<td>
						Telp: {{ $schedule->teacher->contact->phone_number }}
					</td>
				</tr>
			</tbody>
		</table>
		<br>
		<h3>Data Siswa</h3>
		<table class="table table-bordered table-striped">
			<thead class="bg-info">
				<tr>
					<th>Nama</th>
					<th>Info Kontak</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>
						<img src="{{ $schedule->student->profile->image_thumb_url }}" style="width: 30px">
						<a href="{{ url('admin/student/'.$schedule->student_id.'/edit') }}">{{ $schedule->student->name }}</a>
					</td>
					<td>
						Telp: {{ $schedule->student->contact->phone_number }}
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
@endsection