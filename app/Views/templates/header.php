<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AdoptaLove - <?= $titulo ?? 'Inicio' ?></title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&family=Playfair+Display:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

    <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet">
</head>
<?php 
    // Detectamos si estamos en la raiz (Home)
    $uri = service('uri');
    $esHome = ($uri->getSegment(1) == ''); 
?>
<body class="d-flex flex-column min-vh-100 <?= $esHome ? 'home-page' : 'internal-page' ?>">
    <nav class="navbar navbar-expand-lg fixed-top navbar-custom">
        <div class="container">
            
            <a class="navbar-brand navbar-brand-custom" href="<?= base_url('/') ?>">
                <i class="bi bi-paw-fill"></i> AdoptaLove
            </a>

            <button class="navbar-toggler shadow-none border-0 text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon" style="filter: invert(1);"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom" href="<?= base_url('/') ?>">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom" href="<?= base_url('mascotas') ?>">Catálogo</a>
                    </li>
                    </ul>
                
                <div class="d-flex align-items-center">
                    <?php if(session()->has('is_logged')): ?>
                        <div class="dropdown">
                            <a class="nav-link dropdown-toggle text-white fw-bold" href="#" role="button" data-bs-toggle="dropdown">
                                <img src="https://ui-avatars.com/api/?name=<?= session('nombre') ?>&background=d4af37&color=fff&size=32" class="rounded-circle me-2"> 
                                <?= session('nombre') ?>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark-custom shadow">
                                <?php if(session('rol') == 'admin'): ?>
                                    <li><a class="dropdown-item" href="<?= base_url('admin/dashboard') ?>"><i class="bi bi-speedometer2 me-2"></i> Panel Admin</a></li>
                                <?php endif; ?>
                                <li><hr class="dropdown-divider bg-secondary"></li>
                                <li><a class="dropdown-item text-danger" href="<?= base_url('logout') ?>"><i class="bi bi-box-arrow-right me-2"></i> Cerrar Sesión</a></li>
                            </ul>
                        </div>
                    <?php else: ?>
                        <a class="btn-login" href="<?= base_url('auth/login') ?>">Login</a>
                        <a class="btn-register" href="<?= base_url('auth/registro') ?>">Regístrate</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>