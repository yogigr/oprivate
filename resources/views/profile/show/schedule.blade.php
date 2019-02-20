<h3>Jadwal Mengajar</h3>
<hr>
<div class="table-responsive">
	<table class="table table-sm table-bordered">
		<thead>
			<tr>
				<th></th>
				@foreach($days as $day)
				<th class="text-center">{{ $day->name }}</th>
				@endforeach
			</tr>
		</thead>
		<tbody>
			@foreach($times as $time)
				<tr>
					<th class="text-center"><i class="fa fa-clock-o"></i> {{ $time->name }}</th>
					@foreach($days as $day)
						<td class="text-center">
							@if($user->teacherSchedules()
							->where('day_id', $day->id)
							->where('time_id', $time->id)
							->where('is_active', true)->exists())
							<i class="fa fa-check-circle-o fa-2x text-success"></i>
							@else
								@if(Auth::check())
									<a href="javascript:void(0)" class="text-warning request-schedule-btn"
									day-id="{{ $day->id }}" time-id="{{ $time->id }}">
										<i class="fa fa-question-circle-o fa-2x text-warning"></i>
									</a>
								@endif
							@endif
						</td>
					@endforeach
				</tr>
			@endforeach
		</tbody>
	</table>
</div>