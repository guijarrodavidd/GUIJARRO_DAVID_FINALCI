<?= $this->extend('layout/admin_layout') ?>

<?= $this->section('contenido_admin') ?>

<div class="page-header">
    <h3 class="page-title"> Detalle de la Solicitud #<?= $solicitud['id'] ?> </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('admin/solicitudes') ?>">Solicitudes</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detalle</li>
        </ol>
    </nav>
</div>

<div class="row">
    
    <div class="col-md-7 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title text-info mb-4">
                    <i class="mdi mdi-account-card-details"></i> Datos del Solicitante
                </h4>

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Nombre:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control text-white" value="<?= $solicitud['nombre_usuario'] ?>" readonly style="background-color: #2A3038;">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Email:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control text-white" value="<?= $solicitud['email_usuario'] ?>" readonly style="background-color: #2A3038;">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Fecha Solicitud:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control text-white" value="<?= date('d/m/Y H:i', strtotime($solicitud['created_at'] ?? date('Y-m-d'))) ?>" readonly style="background-color: #2A3038;">
                    </div>
                </div>

                <hr class="border-secondary my-4">

                <h4 class="card-title text-warning">
                    <i class="mdi mdi-message-text"></i> Mensaje de Adopción
                </h4>
                <div class="p-3 rounded" style="background-color: #2A3038; border: 1px solid #4df;">
                    <p class="mb-0 text-white" style="line-height: 1.6;">
                        <?= !empty($solicitud['mensaje']) ? $solicitud['mensaje'] : '<em>El usuario no escribió ningún mensaje adicional.</em>' ?>
                    </p>
                </div>

            </div>
        </div>
    </div>

    <div class="col-md-5 grid-margin stretch-card">
        <div class="card">
            <div class="card-body text-center">
                <h4 class="card-title text-success mb-4">
                    <i class="mdi mdi-paw"></i> Mascota Solicitada
                </h4>
                
                <img src="<?= base_url('uploads/'.$solicitud['imagen']) ?>" 
                     alt="Mascota" 
                     class="img-fluid rounded-circle mb-4 shadow" 
                     style="width: 150px; height: 150px; object-fit: cover; border: 3px solid #00d25b;">

                <h3 class="text-white"><?= $solicitud['nombre_mascota'] ?></h3>
                <p class="text-muted"><?= ucfirst($solicitud['especie']) ?> - <?= $solicitud['raza'] ?></p>

                <div class="row mt-4 text-start">
                    <div class="col-6">
                        <p class="text-muted mb-1">Edad:</p>
                        <h5 class="text-white"><?= $solicitud['edad'] ?> años</h5>
                    </div>
                    <div class="col-6">
                        <p class="text-muted mb-1">Sexo:</p>
                        <h5 class="text-white"><?= ucfirst($solicitud['sexo'] ?? 'No especificado') ?></h5>
                    </div>
                </div>
                
                <div class="mt-4">
                    <label class="badge badge-outline-<?= ($solicitud['estado'] == 'pendiente') ? 'warning' : (($solicitud['estado'] == 'aprobada') ? 'success' : 'danger') ?> fs-6 px-4 py-2">
                        Estado Actual: <?= ucfirst($solicitud['estado']) ?>
                    </label>
                </div>

            </div>
        </div>
    </div>
</div>

<?php if($solicitud['estado'] == 'pendiente'): ?>
<div class="row">
    <div class="col-12 grid-margin">
        <div class="card border-primary">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="card-title mb-1">Gestionar esta solicitud</h4>
                    <p class="text-muted mb-0">Decide si apruebas la adopción o la rechazas.</p>
                </div>
                <div>
                    <a href="<?= base_url('admin/solicitudes/estado/'.$solicitud['id'].'/rechazada') ?>" 
                       class="btn btn-inverse-danger btn-lg me-3"
                       onclick="return confirm('¿Rechazar solicitud?')">
                       <i class="mdi mdi-close-circle"></i> Rechazar
                    </a>

                    <a href="<?= base_url('admin/solicitudes/estado/'.$solicitud['id'].'/aprobada') ?>" 
                       class="btn btn-success btn-lg text-white"
                       onclick="return confirm('¿APROBAR? La mascota pasará a estado ADOPTADO.')">
                       <i class="mdi mdi-check-circle"></i> Aprobar Adopción
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<?= $this->endSection() ?>