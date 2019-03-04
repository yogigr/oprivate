@extends('layouts.app')
@section('title', 'Login')
@section('content')
<div class="row justify-content-center">
    <div class="col-sm-4">
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
                <form method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <input id="email" type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" 
                        name="email" value="{{ old('email') }}" placeholder="Email">
                    </div>

                    <div class="form-group">
                        <input id="password" type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" name="password" placeholder="password">
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">
                            Login
                        </button>
                    </div>
                </form>
                <a href="{{ route('password.request') }}">
                    Forgot Your Password?
                </a>
                <br>
                <a href="{{ url('register') }}">
                    Belum Daftar?
                </a>
                <br>
                <p class="text-center">
                    Login dengan:<br><br>
                    <a href="{{ url('login/google') }}" class="btn btn-danger btn-sm">
                        <i class="fa fa-google fa-2x"></i>
                    </a>
                </p>
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