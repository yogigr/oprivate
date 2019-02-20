<form method="post" action="{{ isset($administrator) 
? url('admin/administrator/'.$administrator->id) : url('admin/administrator') }}">
	{{ csrf_field() }}
	@if(isset($administrator))
		{{ method_field('patch') }}
		<input type="hidden" name="administrator_id" value="{{$administrator->id}}">
	@endif

	{{--Akun--}}
	<div class="row">
		<div class="col-sm-12">
			<div class="page-header">Akun</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group {{ $errors->has('administrator_name') ? 'has-error' : '' }}">
				<label>Nama</label>
				<input type="text" name="administrator_name" class="form-control" placeholder="Nama" autofocus
				value="{{ isset($administrator) ? $administrator->name : old('administrator_name') }}">
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group {{ $errors->has('administrator_email') ? 'has-error' : '' }}">
				<label>Email</label>
				<input type="text" name="administrator_email" class="form-control" placeholder="Email"
				value="{{ isset($administrator) ? $administrator->email : old('administrator_email') }}">
			</div>
		</div>
		@if(!isset($administrator))
		<div class="col-sm-6">
			<div class="form-group {{ $errors->has('administrator_password') ? 'has-error' : '' }}">
				<label>Password</label>
				<input type="password" name="administrator_password" class="form-control" placeholder="Password">
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group">
				<label>Konfirmasi Password</label>
				<input type="password" name="administrator_password_confirmation" class="form-control" placeholder="Konfirmasi Password">
			</div>
		</div>
		@endif
	</div>

	<hr>

	<div class="form-group">
		<a href="{{ url('admin/administrator') }}" class="btn btn-default">
			<i class="fa fa-angle-double-left"></i>
			Kembali
		</a>
		<button type="submit" class="btn btn-primary">
			<i class="fa fa-save"></i>
			{{ isset($administrator) ? 'Perbarui' : 'Simpan' }}
		</button>	
	</div>
</form>
