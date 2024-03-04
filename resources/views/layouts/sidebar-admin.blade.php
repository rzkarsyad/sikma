<ul class="metismenu list-unstyled" id="side-menu">
    <li class="menu-title">MENU</li>

    <li>
        <a href="{{ route('admin.home') }}" class="waves-effect">
            <i class="ri-dashboard-line"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <li>
        <a href="{{ route('admin.agenda') }}" class=" waves-effect">
            <i class="ri-book-2-line"></i>
            <span>Agenda</span>
        </a>
    </li>

    <li>
        <a href="{{ route('admin.kegiatan') }}" class=" waves-effect">
            <i class="ri-book-line"></i>
            <span>Kegiatan</span>
        </a>
    </li>

    <li>
        <a href="{{ route('admin.ormawa') }}" class=" waves-effect">
            <i class="ri-team-line"></i>
            <span>Ormawa</span>
        </a>
    </li>

    <li class="menu-title">MENU LAIN</li>

    <li>
        <a href="{{ route('admin.jalur-masuk') }}" class=" waves-effect">
            <i class="ri-file-text-line"></i>
            <span>Jalur Masuk</span>
        </a>
    </li>

    <li>
        <a href="{{ route('admin.prodi') }}" class=" waves-effect">
            <i class="ri-booklet-line"></i>
            <span>Program Studi</span>
        </a>
    </li>

    <li>
        <a href="{{ route('admin.fakultas') }}" class=" waves-effect">
            <i class="ri-folder-line"></i>
            <span>Fakultas</span>
        </a>
    </li>

    <li class="menu-title">DATA MASTER</li>

    <li>
        <a href="{{ route('admin.mahasiswa') }}" class=" waves-effect">
            <i class="ri-contacts-line"></i>
            <span>Mahasiswa</span>
        </a>
    </li>

    <li>
        <a href="{{ route('admin.dosen') }}" class=" waves-effect">
            <i class="ri-group-line"></i>
            <span>Dosen</span>
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
