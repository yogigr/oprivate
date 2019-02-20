<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">Menu</li>
            <li class="{{ Route::currentRouteName() == 'admin.index' ? 'active' : '' }}">
                <a href="{{ route('admin.index') }}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
             <li class="{{ Request::segment(1) == 'admin' && Request::segment(2) == 'level' ? 'active' : '' }}">
                <a href="{{ url('admin/level') }}">
                    <i class="fa fa-level-up"></i> <span>Jenjang Pendidikan</span>
                </a>
            </li>
            <li class="{{ Request::segment(1) == 'admin' && Request::segment(2) == 'course' ? 'active' : '' }}">
                <a href="{{ url('admin/course') }}">
                    <i class="fa fa-book"></i> <span>Mata Pelajaran</span>
                </a>
            </li>
            <li class="{{ Request::segment(1) == 'admin' && Request::segment(2) == 'teacher' ? 'active' : '' }}">
                <a href="{{ url('admin/teacher') }}">
                    <i class="fa fa-user-circle"></i> <span>Guru</span>
                </a>
            </li>
            <li class="{{ Request::segment(1) == 'admin' && Request::segment(2) == 'student' ? 'active' : '' }}">
                <a href="{{ url('admin/student') }}">
                    <i class="fa fa-user-circle-o"></i> <span>Siswa</span>
                </a>
            </li>
            <li class="{{ Request::segment(1) == 'admin' && Request::segment(2) == 'schedule' ? 'active' : '' }}">
                <a href="{{ url('admin/schedule') }}">
                    <i class="fa fa-calendar"></i> <span>Jadwal Aktif</span>
                </a>
            </li>
            <li class="{{ Request::segment(1) == 'admin' && Request::segment(2) == 'administrator' ? 'active' : '' }}">
                <a href="{{ url('admin/administrator') }}">
                    <i class="fa fa-user-secret"></i> <span>Administrator</span>
                </a>
            </li>
        </ul>
    </section>
</aside>