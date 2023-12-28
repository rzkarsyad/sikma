<div class="vertical-menu bg-dark">

    <div data-simplebar class="h-100">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            @if (Auth::user()->type == 'dosen')
                @include('layouts.sidebar-dosen')
            @endif
            @if (Auth::user()->type == 'mahasiswa')
                @include('layouts.sidebar-mahasiswa')
            @endif
            @if (Auth::user()->type == 'admin')
                @include('layouts.sidebar-admin')
            @endif
        </div>
        <!-- Sidebar -->
    </div>
</div>
