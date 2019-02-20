@extends('layouts.app')
@section('title', 'Profile')
@section('content')
	<div class="row mt-3">
		<div class="col-sm-3">
			<div class="card card-body text-center">
				<div class="row justify-content-center mb-3">
					<div class="col-sm-8">
						<img src="{{ $user->profile->image_thumb_url }}"
						class="img-fluid rounded-circle">
					</div>
				</div>
				<h5>{{ $user->name }}</h5>
				<p class="font-italic text-muted">
					{{ $user->role->name }} 
					{{ $user->isTeacher() ? $user->course->name : '' }} 
					{{ $user->isTeacher() ? $user->course->level->name : ''}}
				</p>
				@if($user->isTeacher())
				<div>{!! $user->print_rate_star !!}</div>
				<p class="text-muted">
					{{ $user->ratings()->count() }} Pemberi Bintang
				</p>
				<a href="javascript:void(0)" id="rateLink" class="text-warning">Beri Bintang</a>
				@endif
			</div>
		</div>
		<div class="col-sm-9">
			<div class="card card-body">
				@include('layouts.alert')
				<ul class="nav nav-tabs">
					<li class="nav-item">
						<a class="nav-link active show" data-toggle="tab" href="#about">Tentang</a>
					</li>
					@if($user->isTeacher())
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#schedule">Jadwal Mengajar</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#educational">Riwayat Pendidikan</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#achievement">Penghargaan</a>
					</li>
					@endif
				</ul>
				<div id="myTabContent" class="tab-content py-5">
					<div class="tab-pane fade active show" id="about">
						@include('profile.show.about')
					</div>
					@if($user->isTeacher())
					<div class="tab-pane fade" id="schedule">
						@include('profile.show.schedule')
					</div>
					<div class="tab-pane fade p-3" id="direction">
						@include('profile.show.direction')
					</div>
					<div class="tab-pane fade" id="educational">
						@include('profile.show.educational')
					</div>
					<div class="tab-pane fade" id="achievement">
						@include('profile.show.achievement')
					</div>
					@endif
				</div>
			</div>
		</div>
	</div>
	<div class="modal" tabindex="-1" role="dialog" id="certificateModal">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title"></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<img src="" class="img-fluid" id="certificateImg">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal" tabindex="-1" role="dialog" id="rateModal">
		<div class="modal-dialog modal-sm" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Beri Bintang</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body text-center">
					@for($i=1; $i<=5; $i++)
						<form method="post" action="{{ url('rate/'.$user->id) }}">
							{{ csrf_field() }}
							<input type="hidden" name="rate" value="{{ $i }}">
							<button type="submit" class="btn btn-default">
								@for($j=1; $j<=5; $j++)
									@if($i >= $j)
										<span class="fa fa-star fa-2x text-warning"></span>
									@else
										<span class="fa fa-star fa-2x"></span>
									@endif
								@endfor
							</button>
						</form>
					@endfor
				</div>
			</div>
		</div>
	</div>
	@if(Auth::check())
	<div class="modal" tabindex="-1" role="dialog" id="requestScheduleModal">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Permintaan Jadwal Mengajar</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form method="post" action="{{ url('schedule') }}">
						{{ csrf_field() }}
						<div class="form-group">
							<label>Nama Siswa</label>
							<select class="custom-select" name="student_id">
								<option value="{{ Auth::id() }}">{{ Auth::user()->name }}</option>
							</select>
						</div>
						<div class="form-group">
							<label>Nama Guru</label>
							<select class="custom-select" name="teacher_id">
								<option value="{{ $user->id }}">{{ $user->name }}</option>
							</select>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label>Hari</label>
									<select class="custom-select" name="day_id">
										@foreach($days as $day)
										<option value="{{ $day->id }}">{{ $day->name }}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label>Jam</label>
									<select class="custom-select" name="time_id">
										@foreach($times as $time)
										<option value="{{ $time->id }}">{{ $time->name }}</option>
										@endforeach
									</select>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label>Catatan Tambahan</label>
							<textarea class="form-control" name="note"></textarea>
						</div>
						<div class="form-group">
						 	<div class="custom-control custom-checkbox">
						      	<input type="checkbox" class="custom-control-input" id="requestScheduleConfirm">
						      	<label class="custom-control-label" for="requestScheduleConfirm">
						      		Mengetahui dan menyetujui tarif guru bersangkutan
					      			<span class="text-muted">Rp {{ $user->price }} / Pertemuan</span>
						      	</label>
						    </div>
						</div>
						<hr>
						<div class="form-group">
							<button type="submit" id="submitBtn" class="btn btn-primary pull-right" disabled>
								Kirim Permintaan
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	@endif
@endsection
@push('scripts')
<script>
	$('.show-certificate').on('click', function(){
		$('#certificateImg').attr('src', $(this).attr('url'));
		$('#certificateModal').modal('show');
	});
	$('#rateLink').on('click', function(){
		$('#rateModal').modal('show');
	});
	$('.request-schedule-btn').on('click', function(){
		$('select[name="day_id"]').val($(this).attr('day-id'));
		$('select[name="time_id"]').val($(this).attr('time-id'));
		$('#requestScheduleConfirm').prop('checked', false);
		$('#requestScheduleModal').modal('show');
	});	
	$('#requestScheduleConfirm').on('change', function(){
		if ($(this).prop('checked') == true) {
			$('#submitBtn').attr('disabled', false)
		} else {
			$('#submitBtn').attr('disabled', true)
		}
	});
</script>
@endpush