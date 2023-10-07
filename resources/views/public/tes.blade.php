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
            /* height: 100vh; */
        }

        .sidebar {
            position: absolute;
            z-index: 2;
            width: 280px;
            /* height: calc(100vh - 3rem); */
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
            background-color: rgba(0, 0, 0, 0.733);
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
            background-color: wheat;
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
            /* min-height: 100vh; */
            height: 100vh;
            /* max-height: max-content; */
            overflow-x: hidden;
            scroll-snap-align: center;
            /* scroll-snap-type-y: mandatory; */
            /* overflow-y: ; */
            /* background-color:cyan; */
            position: relative;
        }

        main {
            width: 100%;
            max-height: 100vh;
            overflow: scroll;
            /* padding: 8px 8px 16px 8px; */
            background-color: #fff;
        }

        #navbar {
            position: relative;
            /* z-index: 1; */
            top: 0;
            right: 0;
        }
        .kotak{
            margin-top: 10rem;
            width: 500px;
            height: max-content;
            /* background-color: #e0f3f7; */
        }
        .item{
            border-radius: 8px;
            /* width: 150px; */
            /* flex-grow: 1; */
            flex-basis: 250px;
            height: 50px;
            background-color: rgb(202, 202, 202);
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
</head>

<body>

    <div id="wrapper" class="container bg-white">

        <div class="kotak">
            <div class="hstack flex-wrap gap-2">
                <div class="item"></div>
                <div class="item"></div>
                <div class="item"></div>
                <div class="item"></div>
                <div class="item"></div>
                <div class="item"></div>
            </div>
        </div>
        {{-- <nav id="navbar" class="navbar bg-white border-bottom px-3">
            <a class="navbar-brand" href="{{ route('admin') }}">
                <img src="{{ asset('assets/logo.png') }}" alt="Logo" width="150"
                    class="d-inline-block align-text-top">
            </a>
        </nav>

        <div class="sidebar d-flex flex-column flex-shrink-0 bg-body-tertiary p-3">
            <div class="toggle-sidebar">
                <a href="#" role="button" class="">Show</a>
            </div>
            <span class="fs-4">Hello @username</span>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="{{ route('admin') }}" class="nav-link fw-semibold active" aria-current="page">Dashboard</a>
                </li>
                <li>
                    <a href="{{ route('statistik') }}" class="nav-link text-secondary link-body-emphasis">Statistic</a>
                </li>
                <li>
                    <a href="#" class="nav-link text-secondary link-body-emphasis">Order</a>
                </li>
                <div class="list-group ps-3 mt-3">
                    <small class="text-body-tertiary text-uppercase fw-bold mb-2">Settings</small>

                    <li>
                        <a href="{{ route('account') }}" class="nav-link text-secondary link-body-emphasis">Account
                            Settings</a>
                    </li>
                    <li>
                        <a href="{{ route('account') }}" class="nav-link text-secondary link-body-emphasis">Affiliate
                            Settings</a>
                    </li>
                    <li>
                        <a href="{{ route('earning') }}" class="nav-link text-secondary link-body-emphasis">Earning
                            Settings</a>
                    </li>
                    <li>
                        <a href="{{ route('history') }}" class="nav-link text-secondary link-body-emphasis">History
                            Settings</a>
                    </li>
                    <li>
                        <a href="{{ route('account') }}" class="nav-link text-secondary link-body-emphasis">Payout
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
            <section id="manage-rekening">

                <div class="card border-0 mt-3">
                    <div class="card-body p-2">
                        <h4>Manage Earnings</h4>
                        <div class="vstack mt-3">
                            <div class="card">
                                <div class="card-header bg-transparent">
                                    <span class="fs-5 text-secondary">Indonesian Bank Transfer</span>
                                </div>
                                <div class="card-body pb-4">
                                    <form action="" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="">Nama Bank</label>
                                            <input class="form-control shadow-none" placeholder="BCA/BNI..." type="text" name="" id="">
                                        </div>
                                        <div class="form-group mt-3">
                                            <label for="">Nomor Rekening</label>
                                            <input class="form-control shadow-none" placeholder="111111..." min="1" type="number" name="" id="">
                                        </div>
                                        <div class="form-group mt-3">
                                            <label for="">Nama Rekening</label>
                                            <input class="form-control shadow-none" placeholder="Dadang.." type="text" name="" id="">
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="vstack mt-3 gap-2">
                                <button class="btn btn-md bg-success bg-gradient text-white">Save Change</button>
                                <button class="btn btn-md btn-outline-success">Cancel</button>
                            </div>
                        </div>
            
                    </div>
                </div>
            </section>

        </main> --}}

    </div>

    {{-- <script src="{{ asset('assets/vendor/bootstrap5/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap-5.3.1/js/dist/popover.js') }}"></script> --}}

    <script>
        const sidebar = document.getElementsByClassName('sidebar');
        // const aside = document.getElementsByTagName('aside');
        const ea = document.querySelector('.toggle-sidebar');
        ea.addEventListener('click', (e) => {
            // console.log('ea');

            sidebar[0].classList.toggle('hidden');
            // sidebar[0].classList.add('hidden');
        })
        // const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
        // const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))
        // const link = document.getElementById('shareLink');
        // const contentLink = document.getElementById('contentLink');
        // link.addEventListener('click', (e) => {
        //     e.preventDefault();
        //     console.log(contentLink.innerText);
        // })

        // feather.replace();
    </script>
    {{-- @stack('scripts') --}}


    <script src="{{ asset('assets/vendor/bootstrap5/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/sidebars/sidebar.js') }}"></script>
</body>

</html>
