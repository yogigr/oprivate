@extends('layouts.app')
@section('title', 'Pengaturan')
@section('content')
<form method="post" action="{{ url('teacher/setting') }}">
	{{ csrf_field() }}
	{{ method_field('patch') }}
	<div class="row">
		<div class="col">
			<div class="form-group">
				<label>Mata Pelajaran</label>
				<select class="custom-select" name="course_id">
					<option value="">Pilih Mata Pelajaran</option>
					@foreach($courses as $course)
						<option value="{{ $course->id }}"
						{{ isset($teacher->course_id) ? ($teacher->course_id == $course->id ? 'selected' : '') :
						(old('course_id') == $course->id ? 'selected' : '') }}>
							{{ $course->name }} {{ $course->level->name }}
						</option>
					@endforeach
				</select>
			</div>
		</div>
		<div class="col">
			<div class="form-group">
				<label>Harga/Pertemuan</label>
				<input type="number" name="price" value="{{ isset($teacher->price) ? $teacher->price : old('price')  }}"
				class="form-control">
			</div>
		</div>
	</div>
	<div class="form-group">
		<button type="submit" class="btn btn-primary">
			Update
		</button>
	</div>
</form>
@endsection