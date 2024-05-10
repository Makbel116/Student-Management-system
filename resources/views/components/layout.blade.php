<!DOCTYPE html>
<html lang="en">
@include('partials._head')


<body class="sb-nav-fixed">

    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="/">Omishitu-joy Tech</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0" action="/" role="search">
            <div class="input-group">
                <input class="form-control" type="text" name="search" type="search" placeholder="Search for..."
                    aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="submit"><i
                        class="fas fa-search"></i></button>
            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="/settings"><i class="fas fa-gear"></i> Settings</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="/user/{{Auth::user()->id}}/edit"><i class="fas fa-user"></i> User account settings</a></li>

                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li>
                        <form action="/logout" method="POST">
                            @csrf
                            <button class="nav-link border-0  d-flex align-items-center  w-100 bg-white text-dark gap-2" role="button" type="submit">
                               <i class="fas fa-sign-out"></i> Sign out
                            </button>
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Core</div>
                        <a class="nav-link" href="/">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <div class="sb-sidenav-menu-heading">Tables</div>
                        @if (Auth::user()->can('read students'))
                        <a class="nav-link" href="/students">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Students
                        </a>
                        @endif
                            
                        @if (Auth::user()->can('read batches'))
                            
                        <a class="nav-link" href="/batches">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Batches
                        </a>
                        @endif

                        @if (Auth::user()->can('read courses'))
                            <a class="nav-link" href="/courses">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Courses
                            </a>
                        @endif
                            
                        @if (Auth::user()->can('read teachers'))
                            
                        <a class="nav-link" href="/teachers">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Teachers
                        </a>
                        @endif
                        
                            <div class="sb-sidenav-menu-heading">Settings</div>
                            <a class="nav-link" href="/settings">
                                <div class="sb-nav-link-icon"><i class="fas fa-gear"></i></div>
                                Settings
                            </a>
                    </div>

                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    {{ Auth::user()->name }}
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">

                    {{ $slot }}

                </div>
            </main>
            @include('partials._footer')
        </div>
