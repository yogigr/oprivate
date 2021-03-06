@extends('admin.layouts.app')
@section('title', 'Mata Pelajaran')
@section('breadcrumb')
<li class="active">Mata Pelajaran</li>
@endsection
@section('content')
<div class="panel panel-body">
	<div class="form-group">
		<div class="row">
			<div class="col-sm-9">
				<a href="{{ url('admin/course/create') }}" 
				class="btn btn-primary">
					<i class="fa fa-plus"></i> Mata Pelajaran
				</a>
			</div>
			<div class="col-sm-3">
				<form method="get" action="{{ url('admin/course') }}">
					<div class="input-group">
						<input type="text" name="search" class="form-control" 
						placeholder="Cari Mata Pelajaran" value="{{ request('search') }}">
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
					<th class="text-center">@sortablelink('name', 'Nama Mata Pelajaran')</th>
					<th class="text-center">@sortablelink('level.name', 'Jenjang')</th>
					<th class="text-center">#</th>
				</tr>
			</thead>
			<tbody>
				@if($courses->count() > 0)
					@foreach($courses as $course)
					<tr>
						<td>{{ $course->name }} ({{$course->short_name}})</td>
						<td>{{ $course->level->name }} ({{$course->level->short_name}})</td>
						<td class="text-center">
							<div class="btn-group">
								<a href="{{ url('admin/course/'.$course->id.'/edit') }}" 
								class="btn btn-warning btn-xs">
									<i class="fa fa-edit"></i>
								</a>
								<button class="btn btn-danger btn-xs btn-delete" 
								url="{{ url('admin/course/'.$course->id) }}">
									<i class="fa fa-trash"></i>
								</button>
							</div>
						</td>
					</tr>
					@endforeach
				@else
				<tr><td colspan="3">Tidak ditemukan</td></tr>
				@endif
			</tbody>
			<thead class="bg-info">
				<tr>
					<th class="text-center">@sortablelink('name', 'Nama Mata Pelajaran')</th>
					<th class="text-center">@sortablelink('short_name', 'Singkatan')</th>
					<th class="text-center">#</th>
				</tr>
			</thead>
		</table>
	</div>
	{!! $courses->appends(\Request::except('page'))->render() !!}
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
			if (confirm('Yakin hapus mata pelajaran?')) {
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