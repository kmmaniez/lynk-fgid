<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap5/css/bootstrap.min.css') }}">

    @stack('style')

    <style>
        body {
            background-color: #e0f3f7;
        }

        .container {
            width: 800px;
        }

        .sidebar {
            position: absolute;
            z-index: 2;
            width: 280px;
            height: 100vh;
            transition: transform 500ms ease-in;
        }

        .sidebar::after {
            content: '';
            position: absolute;
            top: 0;
            left: 280px;
            z-index: 0;
            width: 100vw;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
            transition: all 500ms ease-out;
        }

        .sidebar:is(.hidden)::after {
            display: none;
        }

        .sidebar:is(.hidden) {
            transform: translateX(-280px);
            transition: transform 800ms ease-in-out;
        }

        .toggle-sidebar {
            position: absolute;
            top: 0;
            left: 280px;
            z-index: 1;
            padding: 8px 16px;
            border-radius: 0 8px 8px 0;
            cursor: pointer;
        }
        @media (max-width: 768px) {
            .container {
                width: 100%;
                padding: 0;
                /* height: 100vh; */
            }

            nav {
                position: relative;
            }
        }

        #wrapper {
            height: 100vh;
            overflow-x: hidden;
            overflow-y: scroll;
            scroll-snap-align: center;
            position: relative;
        }

        /* Hide scrollbar for Chrome, Safari and Opera */
        #wrapper::-webkit-scrollbar, main::-webkit-scrollbar {
            display: none;
        }

        /* Hide scrollbar for IE, Edge and Firefox */
        #wrapper, main {
            -ms-overflow-style: none;  /* IE and Edge */
            scrollbar-width: none;  /* Firefox */
        }
        i{
            width: 24px;
            height: 24px;
            padding: 4px;
            outline: 1px solid red;
        }
        main {
            width: 100%;
            height: 100vh;
            overflow-y: scroll;
            margin: 0;
            padding: 32px 8px;
            /* background-color: red; */
        }
        .nav-link:is(:hover){
            background-color: #e8f4ff;
        }
    </style>
    <script src="{{ asset('assets/feather-icons/dist/feather.min.js') }}"></script>
</head>

<body>

    <div id="wrapper" class="container bg-white">

        <nav id="navbar" class="navbar border-bottom px-3">
            <a class="navbar-brand" href="{{ route('admin') }}">
                <img src="{{ asset('assets/logo.png') }}" alt="Logo" width="150"
                    class="d-inline-block align-text-top">
            </a>
        </nav>

        <div class="sidebar hidden d-flex flex-column flex-shrink-0 bg-body-tertiary p-3">
            <div class="toggle-sidebar bg-primary">
                <i data-feather="chevrons-right" class="feathers text-white"></i>
            </div>
            <span class="fs-4">Hello @username</span>
            <hr>
            <ul class="nav nav-pills flex-column gap-1 mb-auto">
                <li class="nav-item">
                    <a href="{{ route('admin') }}" class="nav-link {{ (Request::routeIs('admin') ? 'fw-semibold active bg-gradient bg-gradient-primary' : 'text-secondary') }}">Dashboard</a>
                </li>
                <li>
                    <a href="{{ route('statistik') }}" class="nav-link {{ (Request::routeIs('statistik') ? 'fw-semibold active bg-gradient bg-gradient-primary' : 'text-secondary') }}">Statistic</a>
                </li>
                <li>
                    <a href="#" class="nav-link text-secondary">Order</a>
                </li>
                <div class="list-group ps-3 mt-3">
                    <small class="text-body-tertiary text-uppercase fw-bold mb-2">Settings</small>

                    <li>
                        <a href="{{ route('account') }}" class="nav-link {{ (Request::routeIs('account') ? 'fw-semibold active bg-gradient bg-gradient-primary' : 'text-secondary') }}">Account
                            Settings</a>
                    </li>
                    {{-- <li>
                        <a href="{{ route('account') }}" class="nav-link {{ (Request::routeIs('account') ? 'fw-semibold active' : 'text-secondary') }}">Affiliate
                            Settings</a>
                    </li> --}}
                    <li>
                        <a href="{{ route('earning') }}" class="nav-link {{ (Request::routeIs('earning') ? 'fw-semibold active bg-gradient bg-gradient-primary' : 'text-secondary') }}">Earning Settings</a>
                    </li>
                    <li>
                        <a href="{{ route('history') }}" class="nav-link {{ (Request::routeIs('history') ? 'fw-semibold active bg-gradient bg-gradient-primary' : 'text-secondary') }}">History
                            Settings</a>
                    </li>
                    <li>
                        <a href="{{ route('payout') }}" class="nav-link {{ (Request::routeIs('payout') ? 'fw-semibold active bg-gradient bg-gradient-primary' : 'text-secondary') }}">Payout
                            Settings</a>
                    </li>
                </div>

                <li>
                    <a href="#" class="nav-link text-secondary  link-body-emphasis">
                        Logout
                    </a>
                </li>
            </ul>
        </div>

        <main>
            @yield('content')
        </main>

    </div>

    <script src="{{ asset('assets/vendor/bootstrap5/js/bootstrap.bundle.min.js') }}"></script>

    <script>
        const sidebar = document.getElementsByClassName('sidebar');
        const toggleSidebar = document.querySelector('.toggle-sidebar');

        toggleSidebar.addEventListener('click', (e) => {
            sidebar[0].classList.toggle('hidden');
        })
        feather.replace();
    </script>
    
    @stack('scripts')
    
</body>

</html>
