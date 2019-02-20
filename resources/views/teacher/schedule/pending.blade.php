@extends('layouts.app')
@section('title', 'Permintaan Mengajar')
@section('content')
<div class="table-responsive">
	<table class="table table-bordered table-striped">
		<thead>
			<tr>
				<th class="text-center">@sortablelink('day.name', 'Hari')</th>
				<th class="text-center">@sortablelink('time.name', 'Jam')</th>
				<th class="text-center">@sortablelink('student_id', 'Siswa')</th>
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
							<img src="{{ $sc->student->profile->image_thumb_url }}" class="rounded-circle" style="width: 30px">
							<a href="{{ url('profile/'.$sc->student->id) }}">
								{{ $sc->student->name }}
							</a>
						</td>
						<td class="text-center">
							<button class="btn btn-warning confirm-btn btn-sm"
							url="{{ url('teacher/pending-schedule/'.$sc->id.'/confirm') }}">
								Terima
							</button>
						</td>
					</tr>
				@endforeach
			@else
			<tr><td colspan="4">Tidak ada Permintaan Mengajar</td></tr>
			@endif
		</tbody>
		<thead>
			<tr>
				<th class="text-center">@sortablelink('day.name', 'Hari')</th>
				<th class="text-center">@sortablelink('time.name', 'Jam')</th>
				<th class="text-center">@sortablelink('student_id', 'Siswa')</th>
				<th class="text-center">#</th>
			</tr>
		</thead>
	</table>
</div>
<form id="formConfirm" method="post" action="">
	{{ csrf_field() }}
	{{ method_field('patch') }}
</form>
@endsection
@push('scripts')
<script>
	$(function(){
		$('body').on('click', '.confirm-btn', function(){
			if (confirm('Yakin terima permintaan?')) {
				var form = $('#formConfirm');
				form.attr('action', $(this).attr('url'));
				form.submit();
			} else {
				return false;
			}
			
		});
	});
</script>
@endpush