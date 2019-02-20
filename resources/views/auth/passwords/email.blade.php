@extends('layouts.app')
@section('title', 'Lupa Password')
@section('content')
<div class="row justify-content-center">
    <div class="col-sm-4">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        @if($errors->all())
            <div class="alert alert-danger">
                <ul>
                @foreach($errors->all() as $msg)
                    <li>{{ $msg }}</li>
                @endforeach
                </ul>
            </div>
        @endif
        <div class="card card-default">
            <div class="card-header">@yield('title')</div>

            <div class="card-body">

                <form method="POST" action="{{ route('password.email') }}">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <input id="email" type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Masukkan email">
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            Lupa Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $(function(){
        setTimeout(function(){
            $('.alert').fadeOut();
        }, 2000);
    });
</script>
@endpush
