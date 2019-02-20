@extends('layouts.app')
@section('title', 'Jadwal Mengajar '.$schedule->student->name)
@section('content')
@if($schedule->is_request_finish)
<div class="alert alert-dismissible alert-warning">
	Siswa anda meminta jadwal selesai, <a href="#" class="text-white font-weight-bold finish-btn"
	url="{{ url('teacher/schedule/'.$schedule->id.'/confirm-finish') }}">Setujui?</a> 
</div>
@endif
<div class="table-responsive">
	<table class="table table-bordered">
		<tbody>
			<tr>
				<th style="width: 200px">Waktu</th>
				<th>Deskripsi</th>
			</tr>
			<tr>
				<td>{{ $schedule->day->name }} {{ $schedule->time->name }} WIB</td>
				<td>
					{{ $schedule->note }} <a href="javascript:void(0)" class="text-warning edit-btn"><i class="fa fa-edit"></i></a>
				</td>
			</tr>
		</tbody>
	</table>
	<table class="table table-bordered">
		<tbody>
			<tr>
				<th colspan="2">Data Siswa</th>
			</tr>
			<tr>
				<td>
					<img src="{{ $schedule->student->profile->image_thumb_url }}" class="rounded-circle mr-2 pull-left" 
					style="width: 50px">
					<p> 
						<a href="{{ url('profile/'.$schedule->student->id) }}">{{ $schedule->student->name }}</a><br>
					</p>
				</td>
				<td>
					<div class="btn-group">
						<a href="http://wa.me/{{ $schedule->student->contact->wa_number }}" class="btn btn-success"
							target="_blank">
							<i class="fa fa-video-camera"></i>
						</a>
						<a href="tel:{{ $schedule->student->contact->phone_number }}" class="btn btn-success"
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
					<direction :user="{{$schedule->student}}"></direction>
				</td>
			</tr>
		</tbody>
	</table>
</div>

<form id="formFinish" method="post" action="">
	{{ csrf_field() }}
	{{ method_field('delete') }}
</form>

<div class="modal" tabindex="-1" role="dialog" id="editModal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Edit Catatan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="post" action="{{ url('teacher/schedule/'.$schedule->id.'/update-note') }}">
					{{ csrf_field() }}
					{{ method_field('patch') }}
					<div class="form-group">
						<textarea class="form-control" name="note" required>{{ $schedule->note }}</textarea>
					</div>
					
					<button type="submit" class="btn btn-primary">
						Update
					</button>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
@push('scripts')
<script>
	$(function(){
		$('body').on('click', '.finish-btn', function(){
			if (confirm('Yakin terima permintaan?')) {
				var form = $('#formFinish');
				form.attr('action', $(this).attr('url'));
				form.submit();
			} else {
				return false;
			}
			
		});

		$('.edit-btn').on('click', function(){
			$('#editModal').modal('show');
		});
	});
</script>
@endpush