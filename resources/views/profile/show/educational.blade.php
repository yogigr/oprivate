<h3>Riwayat Pendidikan</h3>
<hr>
@if($user->educationals->count() > 0)
@foreach($user->educationals as $ed)
	<h5 class="text-primary mb-0">{{ $ed->name }}</h5>
	<p class="text-muted">
		{{ $ed->start_year }} - {{ $ed->end_year }} - 
		<a href="javascript:void(0)" class="show-certificate text-muted" url="{{ $ed->certificate_url }}">
			Lihat Ijazah
		</a>
	</p>
	<hr>
@endforeach
@else
	<p class="text-muted">Belum ada riwayat pendidikan</p>
@endif
