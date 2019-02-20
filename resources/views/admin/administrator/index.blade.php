@extends('admin.layouts.app')
@section('title', 'Administrator')
@section('breadcrumb')
<li class="active">Administrator</li>
@endsection
@section('content')
<div class="panel panel-body">
	<div class="form-group">
		<div class="row">
			<div class="col-sm-9">
				<a href="{{ url('admin/administrator/create') }}" 
				class="btn btn-primary">
					<i class="fa fa-plus"></i> Administrator
				</a>
			</div>
			<div class="col-sm-3">
				<form method="get" action="{{ url('admin/administrator') }}">
					<div class="input-group">
						<input type="text" name="search" class="form-control" 
						placeholder="Cari Administrator" value="{{ request('search') }}">
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
					<th class="text-center">@sortablelink('name', 'Nama Administrator')</th>
					<th class="text-center">@sortablelink('email', 'Email')</th>
					<th class="text-center">@sortablelink('is_active', 'Status')</th>
					<th class="text-center">#</th>
				</tr>
			</thead>
			<tbody>
				@if($administrators->count() > 0)
					@foreach($administrators as $administrator)
					<tr>
						<td>{{ $administrator->name }}</td>
						<td>{{ $administrator->email }}</td>
						<td class="text-center">{!! $administrator->statusBadge() !!}</td>
						<td class="text-center">
							@if(Auth::id() != $administrator->id)
							<div class="btn-group">
								<a href="{{ url('admin/administrator/'.$administrator->id.'/edit') }}" 
								class="btn btn-warning btn-xs">
									<i class="fa fa-edit"></i>
								</a>
								<button class="btn btn-danger btn-xs btn-delete" 
								url="{{ url('admin/administrator/'.$administrator->id) }}">
									<i class="fa fa-trash"></i>
								</button>
							</div>
							@endif
						</td>
					</tr>
					@endforeach
				@else
				<tr><td colspan="4">Tidak ditemukan</td></tr>
				@endif
			</tbody>
			<thead class="bg-info">
				<tr>
					<th class="text-center">@sortablelink('name', 'Nama Administrator')</th>
					<th class="text-center">@sortablelink('email', 'Email')</th>
					<th class="text-center">@sortablelink('is_active', 'Status')</th>
					<th class="text-center">#</th>
				</tr>
			</thead>
		</table>
	</div>
	{!! $administrators->appends(\Request::except('page'))->render() !!}
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
			if (confirm('Yakin hapus Administrator?')) {
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