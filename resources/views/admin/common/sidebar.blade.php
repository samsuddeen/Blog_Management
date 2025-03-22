<div class="app-menu">
    <!-- Sidebar -->

    <div class="navbar-vertical navbar nav-dashboard">
        <div class="h-100" data-simplebar>
            <!-- Brand logo -->
            <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                <img src="{{ asset('assets/images/brand/logo/logo-2.svg') }}"
                    alt="dash ui - bootstrap 5 admin dashboard template" />
            </a>
            <!-- Navbar nav -->
            <ul class="navbar-nav flex-column" id="sideNavbar">
                <!-- Nav item -->
                <li class="nav-item">
                    <a class="nav-link has-arrow {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                        href="{{ route('admin.dashboard') }}">
                        <i data-feather="home" class="nav-icon me-2 icon-xxs"></i>
                        Dashboard
                    </a>

                    <div id="navDashboard" class="collapse {{ request()->routeIs('admin.dashboard') || request()->routeIs('user.index')  ? 'show' : '' }}"
                        data-bs-parent="#sideNavbar">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('/') ? 'active' : '' }}"
                                    href="/">
                                    Home
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Nav item -->
                <li class="nav-item">
                    <div class="navbar-heading">Apps</div>
                </li>

                <!-- Nav item for Slider -->


                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('category.index') ? 'active' : '' }}"
                        href="{{ route('category.index') }}">
                        <i data-feather="briefcase" class="nav-icon me-2 icon-xxs"></i>
                        Category
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('blog.index') ? 'active' : '' }}"
                        href="{{ route('blog.index') }}">
                        <i data-feather="file-text" class="nav-icon me-2 icon-xxs"></i>
                        Blogs
                    </a>
                </li>




                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('user.index') ? 'active' : '' }}"
                        href="{{ route('user.index') }}">
                        <i data-feather="users" class="nav-icon me-2 icon-xxs"></i>
                        User Management
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('backup.service') ? 'active' : '' }}"
                        href="{{ route('backup.service') }}">
                        <i data-feather="hard-drive" class="nav-icon me-2 icon-xxs"></i>
                        Backup
                    </a>
                </li>






            </ul>


        </div>
    </div>
</div>
