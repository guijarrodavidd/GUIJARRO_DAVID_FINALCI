<!DOCTYPE html>
<html>
<head>
    <title>Solicitudes - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url('admin/dashboard') ?>">⬅ Volver al Dashboard</a>
        </div>
    </nav>

    <div class="container">
        <h2 class="mb-4">Solicitudes de Adopción Recibidas</h2>

        <?php if(session()->getFlashdata('mensaje')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('mensaje') ?></div>
        <?php endif; ?>

        <div class="card shadow">
            <div class="card-body">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Fecha</th>
                            <th>Mascota</th>
                            <th>Usuario Interesado</th>
                            <th>Mensaje</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($solicitudes)): ?>
                            <?php foreach($solicitudes as $s): ?>
                                <tr>
                                    <td><?= date('d/m/Y', strtotime($s['fecha_solicitud'])) ?></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="<?= base_url('uploads/'.$s['imagen']) ?>" width="40" height="40" class="rounded-circle me-2" style="object-fit:cover;">
                                            <strong><?= $s['nombre_mascota'] ?></strong>
                                        </div>
                                    </td>
                                    <td>
                                        <?= $s['nombre_usuario'] ?><br>
                                        <small class="text-muted"><?= $s['email'] ?></small>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="tooltip" title="<?= $s['mensaje'] ?>">
                                            Leer mensaje
                                        </button>
                                    </td>
                                    <td>
                                        <?php 
                                            $clase = 'warning';
                                            if($s['estado'] == 'aprobada') $clase = 'success';
                                            if($s['estado'] == 'rechazada') $clase = 'danger';
                                        ?>
                                        <span class="badge bg-<?= $clase ?>"><?= ucfirst($s['estado']) ?></span>
                                    </td>
                                    <td>
                                        <?php if($s['estado'] == 'pendiente'): ?>
                                            <a href="<?= base_url('admin/solicitudes/estado/'.$s['id'].'/aprobada') ?>" class="btn btn-sm btn-success" onclick="return confirm('¿Aprobar solicitud? Esto marcará a la mascota como ADOPTADA.')">✔ Aprobar</a>
                                            <a href="<?= base_url('admin/solicitudes/estado/'.$s['id'].'/rechazada') ?>" class="btn btn-sm btn-danger">✖ Rechazar</a>
                                        <?php else: ?>
                                            <span class="text-muted">Procesada</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="6" class="text-center">No hay solicitudes pendientes.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
          return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>
</body>
</html>