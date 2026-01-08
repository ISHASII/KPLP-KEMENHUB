<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3"
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="https://www.dephub.go.id" target="_blank">
            <img src="{{ asset('img/kemenhub-logo.png') }}" class="navbar-brand-img h-100" alt="logo_kemenhub"
                style="max-height: 60px; object-fit: contain;">
            <span class="ms-1 font-weight-bold">Kemenhub</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto  max-height-vh-100 h-100" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <x-navlink href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')" icon="fa-house">
                Dashboard
            </x-navlink>

            @if(auth()->check())
            <x-navlink href="{{ url('/layanan-publik') }}" :active="request()->is('layanan-publik*')" icon="fa-globe">
                Layanan Publik
            </x-navlink>

            <x-navlink href="{{ route('ppid.index') }}" :active="request()->routeIs('ppid.*')" icon="fa-file-lines">
                Laporan PPID
            </x-navlink>

            <x-navlink href="{{ url('/laporan-skm') }}" :active="request()->is('laporan-skm*')" icon="fa-lock">
                Laporan SKM
            </x-navlink>

            <x-navlink href="{{ url('/laporan-media-visual') }}" :active="request()->is('laporan-media-visual*')"
                icon="fa-ticket">
                Laporan Media
            </x-navlink>

            <x-navlink href="{{ url('/laporan-berita-kplp') }}" :active="request()->is('laporan-berita-kplp*')"
                icon="fa-ship">
                Laporan KPLP
            </x-navlink>

            <x-navlink href="{{ route('siaran_pers.index') }}" :active="request()->routeIs('siaran_pers.*')"
                icon="fa-newspaper">
                Laporan Pers
            </x-navlink>

            <x-navlink href="{{ route('laporan_masuk.index') }}" :active="request()->routeIs('laporan_masuk.*')"
                icon="fa-inbox">
                Laporan Masuk
            </x-navlink>

            @if(auth()->check() && auth()->user()->isAdmin())
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Account pages</h6>
            </li>

            <x-navlink href="{{ route('users.index') }}" :active="request()->routeIs('users.*')" icon="fa-users-gear">
                Kelola Akun
            </x-navlink>
            @endif
            @endif
        </ul>
    </div>
</aside>
