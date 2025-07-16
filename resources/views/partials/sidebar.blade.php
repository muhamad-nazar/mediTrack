<ul class="navbar-nav sidebar sidebar-dark accordion" style="background-color: #356a7c" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" style="background-color: #fff;border-right: 1px solid #356a7c;color: #000;" href="{{ route('dashboard') }}">
        <div class="sidebar-brand-icon">
            Medi Track
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item @if ($link == "dash")
    active
    @endif">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->

    <div class="sidebar-heading">
        Data
    </div>

    <li class="nav-item @if ($link == "pasien")
    active
    @endif">
        <a class="nav-link" href="{{ route('data.pasien') }}">
            <i class="fas fa-id-card"></i>
            <span>Data Pasien</span></a>
    </li>

    <li class="nav-item @if ($link == 'kunjungan') active @endif">
    <a class="nav-link" href="{{ route('data.kunjungan') }}">
        <i class="fas fa-stethoscope"></i>
        <span>Daftar Kunjungan</span>
    </a>
    </li>


    <hr class="sidebar-divider">
    <!-- Heading -->

    <div class="sidebar-heading">
        Report
    </div>

    <li class="nav-item @if ($link == 'riwayat') active @endif">
    <a class="nav-link" href="{{ route('data.riwayat') }}">
        <i class="fas fa-book-medical"></i>
        <span>Riwayat Kunjungan</span>
    </a>
    </li>

    <hr class="sidebar-divider">

    <!-- Heading -->

    <div class="sidebar-heading">
        Manage Account
    </div>

    <li class="nav-item @if ($link == "profile")
    active
    @endif">
        <a class="nav-link" href="{{ route('profile') }}">
            <i class="fas fa-user-circle"></i>
            <span>Profile Account</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>


</ul>
