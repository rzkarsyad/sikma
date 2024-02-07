<ul class="metismenu list-unstyled" id="side-menu">
    <li class="menu-title">Menu</li>

    <li>
        <a href="{{ route('m.dashboard') }}" class="waves-effect">
            <i class="ri-dashboard-line"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <li>
        <a href="{{ route('m.agenda') }}" class=" waves-effect">
            <i class="ri-file-list-line"></i>
            <span>Agenda</span>
        </a>
    </li>

    <li>
        <a href="{{ route('m.aktivitas') }}" class=" waves-effect">
            <i class="ri-file-list-2-line"></i>
            <span>Aktivitas Mahasiswa</span>
        </a>
    </li>

    <li>
        <a href="{{ route('m.mandiri') }}" class=" waves-effect">
            <i class="ri-book-line"></i>
            <span>Kegiatan Mandiri</span>
        </a>
    </li>
    <li>
        <a href="{{ route('m.prestasi') }}" class=" waves-effect">
            <i class="ri-trophy-line"></i>
            <span>Prestasi</span>
        </a>
    </li>
    <li>
        <a href="{{ route('m.ormawa') }}" class=" waves-effect">
            <i class="ri-team-line"></i>
            <span>Ormawa & UKM</span>
        </a>
    </li>
    <li class="menu-title">Pengaturan</li>
    <li>
        <a href="{{ route('m.profile') }}" class=" waves-effect">
            <i class="ri-user-3-line"></i>
            <span>Profil</span>
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
