<nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-primary"
style="{{Request::segment(1) == '' ? 'box-shadow: 0px 0px 0px !important; -webkit-box-shadow: 0px 0px 0px !important' : ''}}">
    <div class="container">
        @php
        $home = '';
        if(Auth::check()){
            if(Auth::user()->isAdmin()){
                $home = url('/admin');
            }elseif(Auth::user()->isTeacher()){
                $home = url('/teacher');
            }else{
                $home = url('/student');
            }
        }else{
            $home = url('/');
        }
        @endphp
        <a class="navbar-brand" href="{{ $home  }}">{{ config('app.name', 'Laravel') }}</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarColor01">
            <ul class="navbar-nav mr-auto">
                @guest
                    <li class="nav-item {{ Request::segment(1) == 'search-teacher' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('search-teacher') }}">
                            Cari Guru
                        </a>
                    </li>
                @else
                    @if(!Auth::user()->isTeacher())
                         <li class="nav-item {{ Request::segment(1) == 'search-teacher' ? 'active' : '' }}">
                            <a class="nav-link" href="{{ url('search-teacher') }}">
                                Cari Guru
                            </a>
                        </li>
                    @endif
                @endguest
            </ul>
            <ul class="navbar-nav my-2 my-lg-0">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu">
                            
                            <a class="dropdown-item" href="{{ Auth::user()->isTeacher() ? url('teacher/profile/#profile') : url('student/profile/#profile') }}">
                                Profile
                            </a>

                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                                Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                            
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
@if(Request::segment(1) == '')
<div class="jumbotron bg-primary text-light">
    <div class="container text-center">
        <h1 class="display-3">Selamat Datang</h1>
        <p class="lead">
            Selamat datang di <strong>oprivate.com</strong>. Oprivate adalah layanan belajar online. Siswa dapat mencari guru sesuai mata pelajaran yang diinginkan, Guru dapat mengajar siswa nya sesuai jadwal yang diajukan. Keduanya boleh mendaftar dan masuk di web ini.
        </p>
    </div>
</div>
@endif