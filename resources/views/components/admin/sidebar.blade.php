        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
                <div class="sidebar-brand-text mx-3">FGID DASHBOARD</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item {{ (request()->is('/') || request()->is('dashboard')) ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="fas fa-fw fa-desktop"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                creator
            </div>

            <!-- Nav Item - Tables -->

            {{-- <li class="nav-item {{ (request()->is('supplier*')) ? 'active' : '' }}"> --}}
            {{-- <li class="nav-item">
                <a class="nav-link" href="{{ route('admin-product.index') }}">
                    <i class="fas fa-fw fa-shopping-bag"></i>
                    <span>Data Products</span></a>
            </li> --}}
            
            <li class="nav-item {{ (request()->routeIs('admin-user.*')) ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin-user.index') }}">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Data User</span></a>
            </li>
            
            <li class="nav-item {{ (request()->routeIs('admin-payout.*')) ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin-payout.index') }}">
                    <i class="fas fa-fw fa-credit-card"></i>
                    <span>Payouts</span></a>
            </li>

            <li class="nav-item {{ (request()->routeIs('admin-settlement.*')) ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin-settlement.index') }}">
                    <i class="fas fa-fw fa-credit-card"></i>
                    <span>Settlements</span></a>
            </li>
            
            {{-- <li class="nav-item">
                <a class="nav-link" href="/supplier">
                    <i class="fas fa-fw fa-credit-card"></i>
                    <span>Payment Settlement</span></a>
            </li> --}}
            
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Nav Item - Log Out -->
            <li class="nav-item">
                <form action="{{ route('logout')}}" method="post">
                    @csrf
                    <button class="btn btn-md nav-link">Logout</button>
                </form>
            </li>

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->