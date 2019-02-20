@extends('layouts.app')
@section('title', 'Permintaan Jadwal')
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
							<button class="btn btn-warning cancel-btn btn-sm"
							url="{{ url('student/pending-schedule/'.$sc->id.'/cancel') }}">
								Batalkan
							</button>
						</td>
					</tr>
				@endforeach
			@else
			<tr><td colspan="4">Tidak ada Permintaan Jadwal</td></tr>
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
<form id="formCancel" method="post" action="">
	{{ csrf_field() }}
	{{ method_field('delete') }}
</form>
@endsection
@push('scripts')
<script>
	$(function(){
		$('body').on('click', '.cancel-btn', function(){
			if (confirm('Yakin batalkan permintaan?')) {
				var form = $('#formCancel');
				form.attr('action', $(this).attr('url'));
				form.submit();
			} else {
				return false;
			}
			
		});
	});
</script>
@endpush