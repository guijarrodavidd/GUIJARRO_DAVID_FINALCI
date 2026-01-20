<?= $this->extend('layout/admin_layout') ?>

<?= $this->section('contenido_admin') ?>

<div class="page-header">
    <h3 class="page-title"> Gestión de Solicitudes </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Solicitudes</li>
        </ol>
    </nav>
</div>

<?php if(session()->getFlashdata('mensaje')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('mensaje') ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Solicitudes Recibidas</h4>
                <p class="card-description"> Administra las peticiones de adopción pendientes. </p>
                
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th> Fecha </th>
                                <th> Mascota </th>
                                <th> Solicitante </th>
                                <th> Mensaje </th>
                                <th> Estado </th>
                                <th> Acciones </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($solicitudes)): ?>
                                
                                <?php foreach($solicitudes as $s): ?>
                                    <tr>
                                        <td> 
                                            <?= date('d/m/Y', strtotime($s['created_at'] ?? date('Y-m-d'))) ?> 
                                        </td>
                                        
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="<?= base_url('uploads/'.$s['imagen']) ?>" alt="img" 
                                                     style="width: 35px; height: 35px; border-radius: 50%; object-fit: cover; margin-right: 10px;">
                                                <span><?= $s['nombre_mascota'] ?></span>
                                            </div>
                                        </td>
                                        
                                        <td>
                                            <?= $s['nombre_usuario'] ?>
                                            <div class="text-muted small"><?= $s['email'] ?></div>
                                        </td>
                                        
                                        <td>
                                            <a href="<?= base_url('admin/solicitudes/ver/'.$s['id']) ?>" class="btn btn-info btn-sm text-white">
                                                <i class="mdi mdi-eye"></i> Ver Detalle
                                            </a>
                                        </td>
                                        
                                        <td>
                                            <?php if($s['estado'] == 'pendiente'): ?>
                                                <div class="badge badge-outline-warning">Pendiente</div>
                                            <?php elseif($s['estado'] == 'aprobada'): ?>
                                                <div class="badge badge-outline-success">Aprobada</div>
                                            <?php else: ?>
                                                <div class="badge badge-outline-danger">Rechazada</div>
                                            <?php endif; ?>
                                        </td>
                                        
                                        <td>
                                            <?php if($s['estado'] == 'pendiente'): ?>
                                                <a href="<?= base_url('admin/solicitudes/estado/'.$s['id'].'/aprobada') ?>" 
                                                   class="btn btn-inverse-success btn-sm"
                                                   onclick="return confirm('¿Aprobar solicitud? Esto marcará a la mascota como ADOPTADA.')">
                                                   <i class="mdi mdi-check"></i> Aprobar
                                                </a>
                                                
                                                <a href="<?= base_url('admin/solicitudes/estado/'.$s['id'].'/rechazada') ?>" 
                                                   class="btn btn-inverse-danger btn-sm"
                                                   onclick="return confirm('¿Seguro que quieres rechazar esta solicitud?')">
                                                   <i class="mdi mdi-close"></i> Rechazar
                                                </a>
                                            <?php else: ?>
                                                <span class="text-muted font-italic small">Cerrada</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>

                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center py-4">
                                        <i class="mdi mdi-inbox-outline text-muted" style="font-size: 2rem;"></i>
                                        <p class="text-muted mt-2">No hay solicitudes nuevas.</p>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>