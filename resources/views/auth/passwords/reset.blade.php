@extends('layouts.app')
@section('title', 'Reset password')
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
                    <form method="POST" action="{{ route('password.request') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="form-group">
                            <input id="email" type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" name="email" value="{{ $email or old('email') }}" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <input id="password" type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" name="password" placeholder="Password Baru">
                        </div>
                        <div class="form-group">        
                            <input id="password-confirm" type="password" class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}" name="password_confirmation" placeholder="Konfirmasi Password Baru">
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                Reset Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
