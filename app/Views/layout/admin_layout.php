<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin - AdoptaLove</title>
    
    <link rel="stylesheet" href="<?= base_url('assets/admin/vendors/mdi/css/materialdesignicons.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/admin/vendors/css/vendor.bundle.base.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/admin/css/style.css') ?>">
    <link rel="shortcut icon" href="<?= base_url('assets/admin/images/favicon.png') ?>" />
</head>
<body>
    <div class="container-scroller">
        
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
                <a class="sidebar-brand brand-logo text-white text-decoration-none" href="<?= base_url('admin/dashboard') ?>">
                    🐾 AdoptaLove
                </a>
                <a class="sidebar-brand brand-logo-mini text-white" href="#">🐾</a>
            </div>
            
            <ul class="nav">
                <li class="nav-item profile">
                    <div class="profile-desc">
                        <div class="profile-pic">
                            <div class="count-indicator">
                                <img class="img-xs rounded-circle" src="https://ui-avatars.com/api/?name=<?= session('nombre') ?>&background=random" alt="">
                                <span class="count bg-success"></span>
                            </div>
                            <div class="profile-name">
                                <h5 class="mb-0 font-weight-normal"><?= session('nombre') ?></h5>
                                <span>Administrador</span>
                            </div>
                        </div>
                    </div>
                </li>

                <li class="nav-item nav-category">
                    <span class="nav-link">Navegación</span>
                </li>
                
                <li class="nav-item menu-items">
                    <a class="nav-link" href="<?= base_url('admin/dashboard') ?>">
                        <span class="menu-icon"><i class="mdi mdi-speedometer"></i></span>
                        <span class="menu-title">Dashboard</span>
                    </a>
                </li>
                
                <li class="nav-item menu-items">
                    <a class="nav-link" href="<?= base_url('admin/mascotas') ?>">
                        <span class="menu-icon"><i class="mdi mdi-cat"></i></span>
                        <span class="menu-title">Gestionar Mascotas</span>
                    </a>
                </li>

                <li class="nav-item menu-items">
                    <a class="nav-link" href="<?= base_url('/') ?>" target="_blank">
                        <span class="menu-icon"><i class="mdi mdi-web"></i></span>
                        <span class="menu-title">Ir a la Web</span>
                    </a>
                </li>
            </ul>
        </nav>

        <div class="container-fluid page-body-wrapper">
            
            <nav class="navbar p-0 fixed-top d-flex flex-row">
                <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
                    <a class="navbar-brand brand-logo-mini" href="#"><strong class="text-white">AL</strong></a>
                </div>
                <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
                    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                        <span class="mdi mdi-menu"></span>
                    </button>
                    
                    <ul class="navbar-nav navbar-nav-right">
                        <li class="nav-item dropdown">
                            <a class="nav-link" id="profileDropdown" href="#" data-toggle="dropdown">
                                <div class="navbar-profile">
                                    <img class="img-xs rounded-circle" src="https://ui-avatars.com/api/?name=<?= session('nombre') ?>&background=random" alt="">
                                    <p class="mb-0 d-none d-sm-block navbar-profile-name"><?= session('nombre') ?></p>
                                    <i class="mdi mdi-menu-down d-none d-sm-block"></i>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="profileDropdown">
                                <a href="<?= base_url('logout') ?>" class="dropdown-item preview-item">
                                    <div class="preview-thumbnail">
                                        <div class="preview-icon bg-dark rounded-circle">
                                            <i class="mdi mdi-logout text-danger"></i>
                                        </div>
                                    </div>
                                    <div class="preview-item-content">
                                        <p class="preview-subject mb-1">Cerrar Sesión</p>
                                    </div>
                                </a>
                            </div>
                        </li>
                    </ul>
                    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                        <span class="mdi mdi-format-line-spacing"></span>
                    </button>
                </div>
            </nav>

            <div class="main-panel">
                <div class="content-wrapper">
                    <?= $this->renderSection('contenido_admin') ?>
                </div>
                
                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">AdoptaLove Admin Panel</span>
                    </div>
                </footer>
            </div>
            
        </div>
    </div>

    <script src="<?= base_url('assets/admin/vendors/js/vendor.bundle.base.js') ?>"></script>
    <script src="<?= base_url('assets/admin/js/off-canvas.js') ?>"></script>
    <script src="<?= base_url('assets/admin/js/hoverable-collapse.js') ?>"></script>
    <script src="<?= base_url('assets/admin/js/misc.js') ?>"></script>
</body>
</html>