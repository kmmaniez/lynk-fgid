<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap5/css/bootstrap.min.css') }}">

    @stack('style')

    <style>
        #btnLogin {
            border: 1px solid rgb(232, 32, 32);
            color: #fff;
            font-weight: bold;
        }

        #btnLogin:is(:hover) {
            border: 1px solid #fff;
        }

        .feather:is(#product) {
            width: 48px;
            height: 48px;
        }

        body {
            background-color: #e0f3f7;
        }

        .nav-link {
            color: #141414;
        }

        .nav-underline .nav-link:hover {
            color: #198754;
        }

        .nav-underline .nav-link.active {
            color: #198754;
            font-weight: bold;
        }

        .nav-item:not(:nth-child(1)) {
            /* padding: 0 24px; */
        }

        .menu {
            width: 100%;
            flex-wrap: wrap;
            gap: 8px;
            display: flex;
            justify-content: space-between;
        }

        .link-information {
            padding: 0 16px 0 0;
            width: 100%;
            display: flex;
            justify-content: space-between;
        }

        #wrapper {
            /* height: 100vh; */
            min-height: 100vh;
            max-height: max-content;
            /* height: min(100vh, max-content); */
            /* overflow-y: visible; */
        }

        .nav-underline {
            order: 2;
            width: 600px;
            flex-direction: row;
            justify-content: space-around;
        }

        .container {
            width: 800px;
            /* height: 100vh; */
        }

        @media (max-width: 768px) {
            .container {
                width: 100%;
                /* height: 100vh; */
            }

            #wrapper {
                /* padding: 0 16px; */
                /* background-color: red; */
            }

            .menu {
                padding: 8px;
                flex-direction: column;
                gap: 1rem;
                width: 100%;
            }

            .nav-underline {
                order: 2;
                width: 100%;
                justify-content: space-between;
            }

            .link-information {
                padding-inline-start: 0;
            }

            nav {
                position: relative;
            }

            .dropdown-menu {
                width: 300px;
            }
        }
    </style>
    {{-- <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script> --}}
    <script src="{{ asset('assets/feather-icons/dist/feather.js') }}"></script>

</head>

<body>

    <div id="wrapper" class="container bg-white pb-4">

        <nav class="navbar border-bottom navbar-expand-lg p-0 d-flex justify-content-between" style="height: 4rem;">
            <a class="navbar-brand" href="{{ route('creator') }}">
                <img src="{{ asset('assets/logo.png') }}" alt="Logo" width="150"
                    class="d-inline-block align-text-top">
            </a>
            <div class="dropdown">
                <button type="button" class="btn dropdown-toggle border-0" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i id="user-profile" data-feather="user"></i> My Profile
                </button>
                <ul class="dropdown-menu dropdown-menu-end mt-2 py-3">
                    <li>
                        <h6 class="dropdown-header">Profile</h6>
                    </li>
                    <li><a class="dropdown-item px-5 py-2" href="{{ route('account') }}">My Account</a></li>
                    <li>
                        <h6 class="dropdown-header">Settings</h6>
                    </li>
                    <li><a class="dropdown-item px-5 py-2" href="/affiliate">Affiliate Settings</a></li>
                    <li><a class="dropdown-item px-5 py-2" href="/earning">Earning Settings</a></li>
                    <li><a class="dropdown-item px-5 py-2" href="/history">History Settings</a></li>
                    <li><a class="dropdown-item px-5 py-2" href="/payout">Payout Settings</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="#">Logout</a></li>
                </ul>
            </div>
        </nav>

        <div class="menu mt-2">

            <ul class="nav nav-underline w-100">
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('admin') ? 'active' : '' }}" href="/admin">Dashboard</a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link" href="#">Appereance</a>
                </li> --}}
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('statistik') ? 'active' : '' }}"
                        href="/statistik">Statistic</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Order</a>
                </li>
            </ul>

            <div class="link-information">
                <span>Your link <a href="#" class="text-decoration-none"
                        id="contentLink"><?= $_SERVER['HTTP_HOST'] ?></a></span>
                <a href="#" id="shareLink" class="text-success text-decoration-none fw-bold">Share</a>
            </div>

        </div>

        @yield('content')

    </div>

    <script src="{{ asset('assets/vendor/bootstrap5/js/bootstrap.bundle.min.js') }}"></script>

    <script>
        const link = document.getElementById('shareLink');
        const contentLink = document.getElementById('contentLink');
        link.addEventListener('click', (e) => {
            e.preventDefault();
            console.log(contentLink.innerText);
        })

        feather.replace();
    </script>
    @stack('scripts')
</body>

</html>
