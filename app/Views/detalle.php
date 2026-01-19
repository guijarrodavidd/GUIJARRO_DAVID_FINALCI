<?= $this->extend('layout/main') ?>

<?= $this->section('contenido') ?>

<div class="container my-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('mascotas') ?>">Mascotas</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= $mascota['nombre'] ?></li>
        </ol>
    </nav>

    <div class="card shadow-lg">
        <div class="row g-0">
            <div class="col-md-6">
                <img src="<?= base_url('uploads/'.$mascota['imagen']) ?>" class="img-fluid rounded-start w-100 h-100" style="object-fit: cover; min-height: 400px;" alt="<?= $mascota['nombre'] ?>" onerror="this.src='https://via.placeholder.com/500?text=Sin+Foto'">
            </div>
            <div class="col-md-6">
                <div class="card-body p-5">
                    <h1 class="card-title display-5 fw-bold"><?= $mascota['nombre'] ?></h1>
                    <span class="badge bg-success mb-3 fs-6"><?= $mascota['estado'] ?></span>
                    
                    <ul class="list-group list-group-flush mb-4">
                        <li class="list-group-item"><strong>Especie:</strong> <?= $mascota['especie'] ?></li>
                        <li class="list-group-item"><strong>Raza:</strong> <?= $mascota['raza'] ?></li>
                        <li class="list-group-item"><strong>Edad:</strong> <?= $mascota['edad'] ?> años</li>
                        <li class="list-group-item"><strong>Publicado:</strong> <?= date('d/m/Y', strtotime($mascota['fecha_creacion'])) ?></li>
                    </ul>

                    <h4>Historia</h4>
                    <p class="card-text lead"><?= $mascota['descripcion'] ?></p>

                    <hr class="my-4">

                    <?php if(session()->has('is_logged')): ?>
                        <div class="d-grid gap-2">
                            <button type="button" class="btn btn-success btn-lg" data-bs-toggle="modal" data-bs-target="#adopcionModal">
                                <i class="bi bi-heart-fill"></i> ¡Quiero adoptar a <?= $mascota['nombre'] ?>!
                            </button>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-warning text-center">
                            Debes <a href="<?= base_url('login') ?>">iniciar sesión</a> para solicitar la adopción.
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if(session()->has('is_logged')): ?>
<div class="modal fade" id="adopcionModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?= base_url('usuario/solicitar-adopcion') ?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title">Adoptar a <?= $mascota['nombre'] ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="mascota_id" value="<?= $mascota['id'] ?>">
                    <div class="mb-3">
                        <label>¿Por qué quieres adoptar a esta mascota?</label>
                        <textarea name="mensaje" class="form-control" rows="4" required placeholder="Cuéntanos dónde vivirá, si tienes otras mascotas..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Enviar Solicitud</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endif; ?>

<?= $this->endSection() ?>