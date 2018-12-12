    <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
            <a class="navbar-brand brand-logo" href="#" style="width:100%; height:100%; border-radius:0%; padding:5px;" alt="profile"><img src="../images/logo/logo_menu.png" alt="logo" style="width:100%; height:100%; border-radius:0%;" alt="profile"/></a>
            <a class="navbar-brand brand-logo-mini" href="#" style="width:100%; height:100%; border-radius:0%; padding:5px;" alt="profile"><img src="../images/logo/logo_menu.png" alt="logo" style="width:100%; height:100%; border-radius:0%;" alt="profile"/></a>
        </div>

        <div class="navbar-menu-wrapper d-flex align-items-stretch">
            <div class="search-field d-none d-md-block">
                <p style="font-size:2.5rem !important; font-weight:bold; margin:0px; padding:5px;">SISTEMA KERA <span style="font-size:1rem !important;">v1.0<span></p>
            </div>
            <ul class="navbar-nav navbar-nav-right">
                <li class="nav-item nav-profile dropdown">
                    <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                        <div class="nav-profile-img">
                            <img src="../images/favicon.png" alt="image">
                            <span class="availability-status online"></span>             
                        </div>
                        <div class="nav-profile-text">
                            <p class="mb-1 text-black"> MENU </p>
                        </div>
                    </a>
                    <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                        <a class="dropdown-item" href="../pages/giro_busca_fec.php">
                            <i class="mdi mdi-cached mr-2 text-success"></i>
                            BUSCA X FECHA
                        </a>
                        <a class="dropdown-item" href="../pages/giro_busca_ben.php">
                            <i class="mdi mdi-cached mr-2 text-success"></i>
                            BUSCA X BENEFICIARIO
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="../class/logout.php">
                            <i class="mdi mdi-power mr-2 text-danger"></i>
                            CERRAR SESI&Oacute;N
                        </a>
                    </div>
                </li>
            </ul>

            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                <span class="mdi mdi-menu"></span>
            </button>
        </div>
    </nav>