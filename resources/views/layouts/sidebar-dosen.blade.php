<ul class="metismenu list-unstyled" id="side-menu">
    <li class="menu-title">MENU</li>

    <li>
        <a href="{{ route('dosen.home') }}" class="waves-effect">
            <i class="ri-dashboard-line"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <li>
        <a href="{{ route('dosen.agenda') }}" class=" waves-effect">
            <i class="ri-file-list-line"></i>
            <span>Agenda</span>
        </a>
    </li>

    <li>
        <a href="{{ route('dosen.aktivitas') }}" class=" waves-effect">
            <i class="ri-file-list-2-line"></i>
            <span>Aktivitas Mahasiswa</span>
        </a>
    </li>

    <li>
        <a href="{{ route('dosen.mandiri') }}" class=" waves-effect">
            <i class="ri-book-line"></i>
            <span>Kegiatan Mandiri</span>
        </a>
    </li>
    <li>
        <a href="{{ route('dosen.prestasi') }}" class=" waves-effect">
            <i class="ri-trophy-line"></i>
            <span>Prestasi</span>
        </a>
    </li>
    <li>
        <a href="{{ route('dosen.ormawa') }}" class=" waves-effect">
            <i class="ri-team-line"></i>
            <span>Kegiatan Ormawa</span>
        </a>
    </li>
    <li class="menu-title">LAINNYA</li>
    <li>
        <a href="{{ route('dosen.mahasiswa') }}" class=" waves-effect">
            <i class="ri-user-3-line"></i>
            <span>Mahasiswa</span>
        </a>
    </li>
    <li>
        <a href="{{ route('logout') }}"
            onclick="event.preventDefault();
    document.getElementById('logout-form').submit();"
            class=" waves-effect">
            <i class="ri-logout-box-line"></i>
            <span>Keluar</span>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </li>

</ul>
