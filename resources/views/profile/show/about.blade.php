<div class="row">
	<div class="col-6">
		<div class="form-group">
			<label>Nama Lengkap</label>
			<input type="text" class="form-control" value="{{ $user->name }}" readonly>
		</div>
	</div>
	<div class="col-6">
		<div class="form-group">
			<label>Umur</label>
			<input type="text" class="form-control" value="{{ $user->age }} Tahun" readonly>
		</div>
	</div>
	<div class="col-6">
		<div class="form-group">
			<label>Jenis Kelamin</label>
			<input type="text" class="form-control" value="{{ $user->profile->sex == 'm' ? 'Laki-laki': 'perempuan'  }}" readonly>
		</div>
	</div>
	<div class="col-6">
		<div class="form-group">
			<label>Tempat Tinggal</label>
			<input type="text" class="form-control" value="{{ $user->address->city->name }}" readonly>
		</div>
	</div>
	<div class="col">
		<blockquote class="blockquote">
		 	<p class="mb-0">{{ $user->profile->about }}</p>
			<footer class="blockquote-footer"><cite title="Source Title">{{ $user->name }}</cite></footer>
		</blockquote>
	</div>
</div>
