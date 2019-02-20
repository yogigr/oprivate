@extends('layouts.app')
@section('title', 'Welcome')
@section('content')
<div id="oprivate" class="mb-5">
    <h1 class="text-center"><span class="text-muted"><small>Kenapa pilih</small></span> <strong>OPRIVATE</strong>?</h1>
    <hr>
    <div class="row">
        <div class="col">
            <div class="card bg-info card-body rounded-0 text-center text-white">
                <i class="fa fa-graduation-cap fa-4x"></i><br>
                <p>Pengajar di oprivate adalah pengajar terverifikasi yang berkompeten, berpengalaman dibidangnya, dan lulusan terbaik dari perguruan tinggi ternama.</p>
            </div>
        </div>
        <div class="col">
            <div class="card bg-warning card-body rounded-0 text-center text-white">
                <i class="fa fa-globe fa-4x"></i><br>
                <p>Oprivate terintegrasi dengan GIS, sehingga siswa maupun pengajar dapat sangat mudah bertemu kapanpun dimanapun.</p>
            </div>
        </div>
        <div class="col">
            <div class="card bg-danger card-body rounded-0 text-center text-white">
                <i class="fa fa-universal-access fa-4x"></i><br>
                <p>Pengajar maupun siswa dapat sangat mudah mengakses oprivate dengan pilihan autentikasi google maupun facebook</p>
            </div>
        </div>
    </div>
</div>
<div id="teacher">
    <div class="row">
        @if($teachers->count() > 0)
            @foreach($teachers as $t)
            <div class="col-sm-3">
                <div class="card rounded-0 text-center mb-2">
                    <div class="card-body">
                        <div class="row justify-content-center mb-3">
                            <div class="col-sm-6">
                                <img src="{{ $t->profile->image_thumb_url }}"
                                class="img-fluid rounded-circle">
                            </div>
                        </div>
                        <h5>{{ $t->name }}</h5>
                        <div class="mb-2">{!! $t->print_rate_star !!}</div>
                        <h5><span class="badge badge-success">Rp {{ $t->price }}/Pertemuan</span></h5>
                        <p class="font-italic">{{ $t->course ? $t->course->name : '' }} <br> 
                        {{ $t->course ? $t->course->level->name : '' }}</p>
                        <a href="{{ url('profile/'.$t->id) }}" class="btn btn-primary">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        @else
            <div class="col">
                <div class="card card-body">
                    Belum ada guru
                </div>
            </div>
        @endif
    </div>
</div>
@endsection