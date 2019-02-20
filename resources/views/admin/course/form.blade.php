<form method="post" action="{{ isset($course) ? url('admin/course/'.$course->id) : url('admin/course') }}">
	{{ csrf_field() }}
	@if(isset($course))
		{{ method_field('patch') }}
	@endif
	<div class="row">
		<div class="col-sm-8">
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
						<label>Nama Mata Pelajaran</label>
						<div class="input-group">
							<span class="input-group-addon">
								<i class="fa fa-book"></i>
							</span>
							<input type="text" name="course_name" class="form-control" 
							value="{{ isset($course) ? $course->name : old('course_name') }}" autofocus>
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						<label>Singkatan</label>
						<div class="input-group">
							<span class="input-group-addon">
								<i class="fa fa-book"></i>
							</span>
							<input type="text" name="course_short_name" class="form-control" 
							value="{{ isset($course) ? $course->short_name : old('course_short_name') }}">
						</div>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label>Jenjang Pendidikan</label>
				<div class="input-group">
					<span class="input-group-addon">
						<i class="fa fa-level-up"></i>
					</span>
					<select name="level_id" class="form-control">
						<option value="">Pilih</option>
						@foreach($levels as $level)
						<option value="{{ $level->id }}"
						{{ isset($course) ? ($level->id == $course->level_id ? 'selected' : '') 
						: ($level->id == old('level_id') ? 'selected' : '') }}>
							{{ $level->name }} ({{ $level->short_name }})
						</option>
						@endforeach
					</select>
				</div>
			</div>
		</div>
		<div class="col-sm-4">
			<div class="form-group">
				<label>Dibuat</label>
				<div class="input-group">
					<span class="input-group-addon">
						<i class="fa fa-calendar"></i>
					</span>
					<input type="text" class="form-control" value="{{ isset($course) ? $course->created_at : '' }}" readonly>
				</div>
			</div>
			<div class="form-group">
				<label>Diperbarui</label>
				<div class="input-group">
					<span class="input-group-addon">
						<i class="fa fa-calendar"></i>
					</span>
					<input type="text" class="form-control" value="{{ isset($course) ? $course->updated_at : '' }}" readonly>
				</div>
			</div>
		</div>
	</div>
	<div class="form-group">
		<a href="{{ url('admin/course') }}" class="btn btn-default">
			<i class="fa fa-angle-double-left"></i>
			Kembali
		</a>
		<button type="submit" class="btn btn-primary">
			<i class="fa fa-save"></i>
			{{ isset($course) ? 'Perbarui' : 'Simpan' }}
		</button>	
	</div>
</form>