<h3>Daftar Penghargaan</h3>
<hr>
@if($user->achievements->count() > 0)
@foreach($user->achievements as $ac)
	<h5 class="text-primary mb-0">{{ $ac->name }}</h5>
	<p class="text-muted">
		{{ $ac->year }} -  
		<a href="javascript:void(0)" class="show-certificate text-muted" url="{{ $ac->certificate_url }}">
			Lihat Sertifikat
		</a>
	</p>
	<hr>
@endforeach
@else
	<p class="text-muted">Belum ada Penghargaan</p>
@endif
