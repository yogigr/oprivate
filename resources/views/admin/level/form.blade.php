<form method="post" action="{{ isset($level) 
? url('admin/level/'.$level->id) : url('admin/level') }}">
	{{ csrf_field() }}
	@if(isset($level))
		{{ method_field('patch') }}
	@endif
	<div class="row">
		<div class="col-sm-8">
			<div class="form-group">
				<label>Nama Jenjang Pendidikan</label>
				<div class="input-group">
					<span class="input-group-addon">
						<i class="fa fa-level-up"></i>
					</span>
					<input type="text" name="level_name" class="form-control" 
					value="{{ isset($level) ? $level->name : old('level_name') }}" autofocus>
				</div>
			</div>
			<div class="form-group">
				<label>Singkatan</label>
				<div class="input-group">
					<span class="input-group-addon">
						<i class="fa fa-level-up"></i>
					</span>
					<input type="text" name="level_short_name" class="form-control" 
					value="{{ isset($level) ? $level->short_name : old('level_short_name') }}">
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
					<input type="text" class="form-control" 
					value="{{ isset($level) ? $level->created_at : '' }}" readonly>
				</div>
			</div>
			<div class="form-group">
				<label>Diperbarui</label>
				<div class="input-group">
					<span class="input-group-addon">
						<i class="fa fa-calendar"></i>
					</span>
					<input type="text" class="form-control" 
					value="{{ isset($level) ? $level->updated_at : '' }}" readonly>
				</div>
			</div>
		</div>
	</div>
	<div class="form-group">
		<a href="{{ url('admin/level') }}" class="btn btn-default">
			<i class="fa fa-angle-double-left"></i>
			Kembali
		</a>
		<button type="submit" class="btn btn-primary">
			<i class="fa fa-save"></i>
			{{ isset($level) ? 'Perbarui' : 'Simpan' }}
		</button>	
	</div>
</form>