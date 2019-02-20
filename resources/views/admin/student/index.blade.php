@extends('admin.layouts.app')
@section('title', 'Siswa')
@section('breadcrumb')
<li class="active">Siswa</li>
@endsection
@section('content')
<div class="panel panel-body">
	<div class="form-group">
		<div class="row">
			<div class="col-sm-9">
				<a href="{{ url('admin/student/create') }}" 
				class="btn btn-primary">
					<i class="fa fa-plus"></i> Siswa
				</a>
			</div>
			<div class="col-sm-3">
				<form method="get" action="{{ url('admin/student') }}">
					<div class="input-group">
						<input type="text" name="search" class="form-control" 
						placeholder="Cari Siswa" value="{{ request('search') }}">
						<span class="input-group-btn">
							<button class="btn btn-default">
								<i class="fa fa-search"></i>
							</button>
						</span>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="table-responsive">
		<table class="table table-hover table-striped table-bordered">
			<thead class="bg-info">
				<tr>
					<th class="text-center">Photo</th>
					<th class="text-center">@sortablelink('name', 'Nama Siswa')</th>
					<th class="text-center">@sortablelink('email', 'Email')</th>
					<th class="text-center">@sortablelink('contact.phone_number', 'No. HP')</th>
					<th class="text-center">@sortablelink('is_active', 'Status')</th>
					<th class="text-center">#</th>
				</tr>
			</thead>
			<tbody>
				@if($students->count() > 0)
					@foreach($students as $student)
					<tr>
						<td class="text-center">
							<img src="{{ $student->profile->image_thumb_url }}"
							width="40px">
						</td>
						<td>{{ $student->name }}</td>
						<td>{{ $student->email }}</td>
						<td>{{ $student->contact->phone_number }}</td>
						<td class="text-center">{!! $student->statusBadge() !!}</td>
						<td class="text-center">
							<div class="btn-group">
								<a href="{{ url('admin/student/'.$student->id.'/edit') }}" 
								class="btn btn-warning btn-xs">
									<i class="fa fa-edit"></i>
								</a>
								<button class="btn btn-danger btn-xs btn-delete" 
								url="{{ url('admin/student/'.$student->id) }}">
									<i class="fa fa-trash"></i>
								</button>
							</div>
						</td>
					</tr>
					@endforeach
				@else
				<tr><td colspan="6">Tidak ditemukan</td></tr>
				@endif
			</tbody>
			<thead class="bg-info">
				<tr>
					<th class="text-center">Photo</th>
					<th class="text-center">@sortablelink('name', 'Nama Siswa')</th>
					<th class="text-center">@sortablelink('email', 'Email')</th>
					<th class="text-center">@sortablelink('contact.phone_number', 'No. HP')</th>
					<th class="text-center">@sortablelink('is_active', 'Status')</th>
					<th class="text-center">#</th>
				</tr>
			</thead>
		</table>
	</div>
	{!! $students->appends(\Request::except('page'))->render() !!}
</div>
	
<form id="formDelete" method="post" action="">
	{{ csrf_field() }}
	{{ method_field('delete') }}
</form>
@endsection

@push('scripts')
<script>
	$(function(){
		$('body').on('click', '.btn-delete', function(){
			if (confirm('Yakin hapus Siswa?')) {
				var form = $('#formDelete');
				form.attr('action', $(this).attr('url'));
				form.submit();
			} else {
				return false;
			}
		});
	});
</script>
@endpush