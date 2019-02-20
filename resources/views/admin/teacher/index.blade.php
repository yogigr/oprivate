@extends('admin.layouts.app')
@section('title', 'Guru')
@section('breadcrumb')
<li class="active">Guru</li>
@endsection
@section('content')
<div class="panel panel-body">
	<div class="form-group">
		<div class="row">
			<div class="col-sm-9">
				<a href="{{ url('admin/teacher/create') }}" 
				class="btn btn-primary">
					<i class="fa fa-plus"></i> Guru
				</a>
			</div>
			<div class="col-sm-3">
				<form method="get" action="{{ url('admin/teacher') }}">
					<div class="input-group">
						<input type="text" name="search" class="form-control" 
						placeholder="Cari Guru" value="{{ request('search') }}">
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
					<th class="text-center">@sortablelink('name', 'Nama Guru')</th>
					<th class="text-center">@sortablelink('email', 'Email')</th>
					<th class="text-center">@sortablelink('contact.phone_number', 'No. HP')</th>
					<th class="text-center">@sortablelink('is_active', 'Status')</th>
					<th class="text-center">#</th>
				</tr>
			</thead>
			<tbody>
				@if($teachers->count() > 0)
					@foreach($teachers as $teacher)
					<tr>
						<td class="text-center">
							<img src="{{ $teacher->profile->image_thumb_url }}"
							width="40px">
						</td>
						<td>{{ $teacher->name }}</td>
						<td>{{ $teacher->email }}</td>
						<td>{{ $teacher->contact->phone_number }}</td>
						<td class="text-center">{!! $teacher->statusBadge() !!}</td>
						<td class="text-center">
							<div class="btn-group">
								@if($teacher->isActive())
									<a href="{{ url('admin/teacher/'.$teacher->id.'/set-nonactive') }}"
									class="btn bg-purple btn-xs">Non aktif</a>
								@else
									<a href="{{ url('admin/teacher/'.$teacher->id.'/set-active') }}"
									class="btn btn-primary btn-xs">Aktifkan</a>
								@endif
								<a href="{{ url('admin/teacher/'.$teacher->id.'/edit') }}" 
								class="btn btn-warning btn-xs">
									<i class="fa fa-edit"></i>
								</a>
								<button class="btn btn-danger btn-xs btn-delete" 
								url="{{ url('admin/teacher/'.$teacher->id) }}">
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
					<th class="text-center">@sortablelink('name', 'Nama Guru')</th>
					<th class="text-center">@sortablelink('email', 'Email')</th>
					<th class="text-center">@sortablelink('contact.phone_number', 'No. HP')</th>
					<th class="text-center">@sortablelink('is_active', 'Status')</th>
					<th class="text-center">#</th>
				</tr>
			</thead>
		</table>
	</div>
	{!! $teachers->appends(\Request::except('page'))->render() !!}
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
			if (confirm('Yakin hapus Guru?')) {
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