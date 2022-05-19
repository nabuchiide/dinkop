<body class="fixed-left ">
    <!-- Loader -->
    <div id="preloader">
        <div id="status">
            <div class="spinner"></div>
        </div>
    </div>
    <!-- Begin page -->
    <div id="wrapper">
        <!-- ========== Left Sidebar Start ========== -->
        <div class="left side-menu">
            <button type="button" class="button-menu-mobile button-menu-mobile-topbar open-left waves-effect ">
                <i class="ion-close"></i>
            </button>

            <!-- LOGO -->
            <div class="topbar-left bg-secondary">
                <div class="text-left offset-md-1">
                    <!--<a href="index.html" class="logo"><i class="mdi mdi-assistant"></i>Zoter</a>-->
                    <div class="row justify-content-md-left">
                        <div class="col-md-2 mt-1">
                            <a href="index.html" class="logo mt-1">
                                <img src="<?= BASEURL ?>/assets/images/bappeda-logo.png" height="50" alt="logo">
                            </a>
                        </div>
                        <div class="col-md-7 mt-0 mb-1 text-white">
                            <h4 class="mb-0">DINKOP</h4>
                            <h6 class="mt-0" style="font-size: 1rem;">Dinas Koperasi dan UMKN</h6>
                        </div>
                    </div>
                </div>
            </div>

            <div class="sidebar-inner niceScrollleft">

                <div id="sidebar-menu">
                    <ul>
                        <li>
                            <a href="<?= BASEURL ?>/home" class="waves-effect">
                                <i class="mdi mdi-airplay"></i>
                                <span> Dashboard </span>
                            </a>
                        </li>

                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-layers"></i> <span> Personalia </span> <span class="float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                            <ul class="list-unstyled">
                                <li><a href="<?= BASEURL ?>/user">User</a></li>
                                <li><a href="<?= BASEURL ?>/pegawai">Pegawai</a></li>
                            </ul>
                        </li>

                        <li class="menu-title">Main</li>

                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-bullseye"></i> <span> Kegiatan </span> <span class="float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                            <ul class="list-unstyled">
                                <li><a href="<?= BASEURL ?>/kegiatan">Kegitan</a></li>
                                <li><a href="<?= BASEURL ?>/pemasukan">Pemasukan</a></li>
                                <li><a href="<?= BASEURL ?>/pengeluaran">Pengeluaran</a></li>
                            </ul>
                        </li>

                        <li class="menu-title">Laporan</li>

                        <li>
                            <a href="<?= BASEURL ?>/laporan/pajak" class="waves-effect">
                                <i class="mdi mdi-file-document"></i>
                                <span> Laporan Keuangan </span>
                            </a>
                        </li>

                    </ul>
                </div>
                <div class="clearfix"></div>
            </div> <!-- end sidebarinner -->
        </div>
        <!-- Left Sidebar End -->
        <div class="content-page">
            <!-- Start content -->
            <div class="content">
                <!-- Top Bar Start -->
                <div class="topbar ">
                    <nav class="navbar-custom">
                        <ul class="list-inline float-right mb-0">

                            <li class="list-inline-item dropdown notification-list">
                                <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                    <img src="<?= BASEURL ?>/assets/images/users/avatar-1.jpg" alt="user" class="rounded-circle">
                                </a>
                                <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                    <!-- item-->
                                    <div class="dropdown-item noti-title bg-secondary">
                                        <h5>Welcome</h5>
                                    </div>
                                    <a class="dropdown-item" href="<?= BASEURL ?>/login/logOut"><i class="mdi mdi-logout m-r-5 text-muted"></i> Logout</a>
                                </div>
                            </li>

                        </ul>

                        <ul class="list-inline menu-left mb-0">
                            <li class="float-left">
                                <button class="button-menu-mobile open-left waves-light waves-effect  bg-secondary">
                                    <i class="mdi mdi-menu"></i>
                                </button>
                            </li>
                        </ul>

                        <div class="clearfix bg-secondary"></div>

                    </nav>
                </div>
                <!-- Top Bar End -->