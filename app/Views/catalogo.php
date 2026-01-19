<?= $this->extend('layout/main') ?>

<?= $this->section('contenido') ?>

<section class="breadcrumb-section" 
         style="background-image: url('<?= base_url('uploads/banner-catalogo.png') ?>'); background-size: cover; background-position: center;">
    <div class="breadcrumb-overlay"></div>
    <div class="container breadcrumb-content">
        <h1 class="display-3 fw-bold">Nuestros Amigos</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a href="<?= base_url('/') ?>" class="text-white text-decoration-none">Inicio</a></li>
                <li class="breadcrumb-item active text-warning" aria-current="page">Catálogo</li>
            </ol>
        </nav>
    </div>
</section>

<section class="py-5 bg-light">
    <div class="container">
        <div class="row">
            
            <div class="col-lg-3 mb-5">
                <div class="sidebar">
                    
                    <div class="mb-5">
                        <h4 class="sidebar-title">Buscar</h4>
                        <div class="sidebar-search">
                            <form action="<?= base_url('mascotas') ?>" method="get">
                                <input type="text" name="q" placeholder="Ej: Bobby...">
                                <button type="submit"><i class="bi bi-search"></i></button>
                            </form>
                        </div>
                    </div>

                    <div class="mb-5 sidebar-categories">
                        <h4 class="sidebar-title">Especies</h4>
                        <ul>
                            <li><a href="<?= base_url('mascotas') ?>"><i class="bi bi-grid-fill me-2"></i> Ver Todos</a></li>
                            <li><a href="<?= base_url('mascotas?tipo=Perro') ?>"><i class="bi bi-caret-right me-2"></i> Perros</a></li>
                            <li><a href="<?= base_url('mascotas?tipo=Gato') ?>"><i class="bi bi-caret-right me-2"></i> Gatos</a></li>
                            <li><a href="<?= base_url('mascotas?tipo=Ave') ?>"><i class="bi bi-caret-right me-2"></i> Aves</a></li>
                        </ul>
                    </div>

                    <div class="text-center p-4 rounded text-white position-relative overflow-hidden" 
                         style="background: var(--primary-color);">
                        <i class="bi bi-piggy-bank display-4 mb-3 d-block"></i>
                        <h5 class="fw-bold">¿Nos ayudas?</h5>
                        <p class="small mb-3">Tu donación compra comida y medicinas.</p>
                        <a href="#" class="btn btn-outline-light btn-sm rounded-pill px-3">Donar ahora</a>
                    </div>

                </div>
            </div>

            <div class="col-lg-9">
                
                <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
                    <h5 class="mb-0 text-muted">Encontramos <span class="text-dark fw-bold"><?= count($mascotas) ?></span> compañeros</h5>
                    <div class="dropdown">
                        <button class="btn btn-white border dropdown-toggle shadow-sm" type="button" data-bs-toggle="dropdown">
                            Ordenar por
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="?orden=reciente">Más recientes</a></li>
                            <li><a class="dropdown-item" href="?orden=edad_asc">Más jóvenes</a></li>
                        </ul>
                    </div>
                </div>

                <div class="row">
                    <?php if($mascotas): ?>
                        <?php foreach($mascotas as $m): ?>
                            <div class="col-lg-4 col-md-6">
                                <div class="product-item">
                                    
                                    <div class="product-pic" style="background-image: url('<?= base_url('uploads/' . $m['imagen']) ?>');">
                                        
                                        <span class="badge-species"><?= $m['especie'] ?></span>

                                        <div class="product-hover-overlay">
                                            <a href="<?= base_url('mascotas/'.$m['id']) ?>" class="product-hover-btn" data-bs-toggle="tooltip" title="Ver Detalles">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="<?= base_url('mascotas/'.$m['id']) ?>" class="product-hover-btn bg-warning text-white" title="¡Me enamoré!">
                                                <i class="bi bi-heart-fill"></i>
                                            </a>
                                        </div>

                                    </div>

                                    <div class="product-text">
                                        <h6><a href="<?= base_url('mascotas/'.$m['id']) ?>"><?= $m['nombre'] ?></a></h6>
                                        <h5><?= $m['raza'] ?></h5>
                                        <div class="mt-2 text-muted small">
                                            <i class="bi bi-calendar3 me-1"></i> <?= $m['edad'] ?> años
                                            <span class="mx-2">|</span>
                                            <i class="bi bi-gender-ambiguous me-1"></i> <?= $m['sexo'] ?? 'Macho' ?>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="col-12 text-center py-5">
                            <i class="bi bi-emoji-dizzy display-1 text-muted"></i>
                            <h3 class="mt-3">Vaya, no hay resultados</h3>
                            <p class="text-muted">Intenta cambiar los filtros de búsqueda.</p>
                            <a href="<?= base_url('mascotas') ?>" class="btn btn-primary rounded-pill mt-2">Ver todos</a>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="d-flex justify-content-center mt-4">
                    <?= $pager->links('default', 'mi_paginacion') ?>
                </div>

            </div>
        </div>
    </div>
</section>

<script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl)
    })
</script>

<?= $this->endSection() ?>