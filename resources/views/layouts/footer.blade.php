<footer id="footer">
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
    <nav class="navbar navbar-expand-lg fixed-bottom navbar-light bg-white">
        <div class="container">
           <ul class="nav">
               <li class="nav-item">
                   <a class="nav-link" href="{{ $home }}">
                       &copy; {{ config('app.name') }} {{ date('Y') }}
                   </a>
               </li>
           </ul>
        </div>
    </nav>
</footer>