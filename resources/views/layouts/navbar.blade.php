@php
    use Laravolt\Avatar\Facade as Avatar;
@endphp

<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box bg-dark">
                <a href="#" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ asset('assets/images/logo-unaic-text.png') }}" alt="logo-sm-dark" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('assets/images/logo-unaic-text.png') }}" alt="logo-dark" height="20">
                    </span>
                </a>

                <a href="#" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ asset('assets/images/logo-unaic.png') }}" alt="logo-sm-light" height="24">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('assets/images/logo-unaic-text.png') }}" class="mt-2 center" alt="logo-light"
                            height="56">
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
                <i class="ri-menu-2-line align-middle"></i>
            </button>
        </div>

        <div class="d-flex">

            <div class="dropdown d-none d-lg-inline-block ms-1">
                <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                    <i class="ri-fullscreen-line"></i>
                </button>
            </div>

            <div class="dropdown d-inline-block user-dropdown">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    @if (Auth::user()->type == 'dosen')
                        <img src="{{ Avatar::create(Auth::user()->dosen->nama)->toBase64() }}" alt="Avatar">
                    @elseif (Auth::user()->type == 'mahasiswa')
                        <img src="{{ Avatar::create(Auth::user()->mahasiswa->nama)->toBase64() }}" alt="Avatar">
                    @elseif (Auth::user()->type == 'admin')
                        <img src="{{ Avatar::create(ucfirst(Auth::user()->nim_nidn))->toBase64() }}" alt="Avatar">
                    @endif

                    @if (Auth::user()->type == 'dosen')
                        <span class="d-none d-xl-inline-block ms-1">{{ Auth::user()->dosen->nama }}</span>
                    @endif
                    @if (Auth::user()->type == 'mahasiswa')
                        <span class="d-none d-xl-inline-block ms-1">{{ Auth::user()->mahasiswa->nama }}</span>
                    @endif
                    @if (Auth::user()->type == 'admin')
                        <span class="d-none d-xl-inline-block ms-1">{{ ucfirst(Auth::user()->nim_nidn) }} </span>
                    @endif
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">

                    @if (Auth::user()->type == 'mahasiswa')
                        <a class="dropdown-item" href="{{ route('m.profile') }}"><i
                                class="ri-user-line align-middle me-1"></i>
                            Profil</a>
                        <div class="dropdown-divider"></div>
                    @endif

                    @if (Auth::user()->type == 'dosen')
                        <a class="dropdown-item" href="{{ route('dosen.profile') }}"><i
                                class="ri-user-line align-middle me-1"></i>
                            Profil</a>
                        <div class="dropdown-divider"></div>
                    @endif

                    @if (Auth::user()->type == 'admin')
                        <a class="dropdown-item" href="{{ route('admin.profile') }}"><i
                                class="ri-user-line align-middle me-1"></i>
                            Profil</a>
                        <div class="dropdown-divider"></div>
                    @endif

                    <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="ri-shut-down-line align-middle me-1 text-danger"></i>
                        Keluar
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>

        </div>
    </div>
</header>
