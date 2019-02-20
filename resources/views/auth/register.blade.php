@extends('layouts.app')
@section('title', 'Daftar Pengguna')
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
                <form method="POST" action="{{ url('register') }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                        value="{{ isset($name) ? $name : old('name') }}" placeholder="Nama Lengkap" autofocus>
                    </div>
                    <div class="form-group">
                        <input id="email" type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" 
                        name="email" value="{{ isset($email) ? $email : old('email') }}" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" name="password" placeholder="password">
                    </div>
                     <div class="form-group">
                        <input type="password" class="form-control" name="password_confirmation" placeholder="Konfirmasi Password">
                    </div>
                    <div class="form-group">
                        <select name="role_id" class="custom-select {{ $errors->has('role_id') ? 'is-invalid' : '' }}" required>
                            <option value="">Daftar Sebagai</option>
                            <option value="2" {{ old('role_id') == 2 ? 'selected' : '' }}>Guru</option>
                            <option value="3" {{ old('role_id') == 3 ? 'selected' : '' }}>Siswa</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            Daftar
                        </button>
                    </div>
                    <a href="{{ route('login') }}">
                        Sudah daftar?
                    </a>
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
