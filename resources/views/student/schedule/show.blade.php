@extends('layouts.app')
@section('title', 'Jadwal Belajar ' . $schedule->teacher->course->name . ' ' .$schedule->teacher->course->level->name)
@section('content')
<button type="button" class="btn btn-warning mb-2 request-finish-btn"
url="{{ url('student/schedule/'.$schedule->id.'/request-finish') }}">
	Minta Jadwal selesai
</button>
<div class="table-responsive">
	<table class="table table-bordered">
		<tbody>
			<tr>
				<th style="width: 200px">Waktu</th>
				<th>Deskripsi</th>
			</tr>
			<tr>
				<td>{{ $schedule->day->name }} {{ $schedule->time->name }} WIB</td>
				<td>{{ $schedule->note }}</td>
			</tr>
		</tbody>
	</table>
	<table class="table table-bordered">
		<tbody>
			<tr>
				<th colspan="2">Data Guru</th>
			</tr>
			<tr>
				<td>
					<img src="{{ $schedule->teacher->profile->image_thumb_url }}" class="rounded-circle mr-2 pull-left" 
					style="width: 65px">
					<p> 
						<a href="{{ url('profile/'.$schedule->teacher->id) }}">{{ $schedule->teacher->name }}</a><br>
						<span class="text-muted font-italic">
							Guru {{ $schedule->teacher->course->name }} {{ $schedule->teacher->course->level->name }}
						</span>
						<br>
						<span class="text-muted">Rp {{ $schedule->teacher->price }} / Pertemuan</span>
					</p>
				</td>
				<td>
					<div class="btn-group">
						<a href="http://wa.me/{{ $schedule->teacher->contact->wa_number }}" class="btn btn-success"
							target="_blank">
							<i class="fa fa-video-camera"></i>
						</a>
						<a href="tel:{{ $schedule->teacher->contact->phone_number }}" class="btn btn-success"
							target="_blank">
							<i class="fa fa-phone"></i>
						</a>
					</div>
				</td>
			</tr>
		</tbody>
	</table>
	<table class="table table-bordered">
		<tbody>
			<tr>
				<th>Direction</th>
			</tr>
			<tr>
				<td>
					<direction :user="{{$schedule->teacher}}"></direction>
				</td>
			</tr>
		</tbody>
	</table>
</div>
<form id="formRequest" method="post" action="">
	{{ csrf_field() }}
	{{ method_field('patch') }}
</form>
@endsection
@push('scripts')
<script>
	$(function(){
		$('body').on('click', '.request-finish-btn', function(){
			if (confirm('Yakin Kirim permintaan?')) {
				var form = $('#formRequest');
				form.attr('action', $(this).attr('url'));
				form.submit();
			} else {
				return false;
			}
			
		});
	});
</script>
@endpush