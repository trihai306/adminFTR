@include('future::app.sidebar')
<header class="navbar navbar-expand-md d-none position-sticky top-0 d-lg-flex d-print-none m-0" data-bs-theme="dark"
        style="z-index: 100">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu"
                aria-controls="sidebar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <h1 class="navbar-brand  d-none-navbar-horizontal pe-0 pe-md-3">
            <a href="">
                {{--                <img src="{{asset('dist/img/logo.png')}}" width="200" height="32" alt="Tabler" class="navbar-brand-image">--}}
            </a>
        </h1>
        <div class="navbar-nav flex-row order-md-last mt-2">

            <div class="d-none d-md-flex">
                <a href="?theme=dark" class="nav-link me-2 px-0 hide-theme-dark" title="Enable dark mode"
                   data-bs-toggle="tooltip"
                   data-bs-placement="bottom">
                    <!-- Download SVG icon from http://tabler-icons.io/i/moon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                         stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                         stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z"/>
                    </svg>
                </a>
                <a href="?theme=light" class="nav-link px-0 hide-theme-light" title="Enable light mode"
                   data-bs-toggle="tooltip"
                   data-bs-placement="bottom">
                    <!-- Download SVG icon from http://tabler-icons.io/i/sun -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                         stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                         stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"/>
                        <path
                            d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7"/>
                    </svg>
                </a>
                @if(config('future.future.messages'))
                    @livewire('future::admin.messages.icon')
                @endif
                @if(config('future.future.notifications'))
                    @livewire('future::livewire.admin.notifications.icon')
                @endif

            </div>
            <div class="nav-item dropdown">
                <a href="#" class=" nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
                   aria-label="Open user menu">
                    <span class="avatar avatar-sm"
                          style="background-image: url({{ auth()->user()->avatar ? Storage::url(auth()->user()->avatar) : asset('static/avatars/001f.jpg') }})"></span>
                    <div class="d-none d-xl-block ps-2">
                        <div>{{Auth::user()->name}}</div>
                        <div class="mt-1 small text-muted">{{
                        Auth::user()->roles->first()->name ?? 'Chưa có quyền'
                       }}</div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <a wire:navigate href="{{route('admin.profile')}}" class="dropdown-item">Profile</a>
                    <div class="dropdown-divider"></div>
                    <a href="./settings.html" class="dropdown-item">Settings</a>
                    <a href="{{route('logout')}}" class="dropdown-item">Logout</a>
                </div>
            </div>
        </div>
    </div>
</header>
