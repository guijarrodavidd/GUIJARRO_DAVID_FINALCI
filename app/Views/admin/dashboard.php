<?= $this->extend('layout/admin_layout') ?>

<?= $this->section('contenido_admin') ?>

<div class="row">
    <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                            <h3 class="mb-0"><?= $total_mascotas ?></h3>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="icon icon-box-success ">
                            <span class="mdi mdi-paw icon-item"></span>
                        </div>
                    </div>
                </div>
                <h6 class="text-muted font-weight-normal">Mascotas en sistema</h6>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                            <h3 class="mb-0"><?= $total_solicitudes ?></h3>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="icon icon-box-warning">
                            <span class="mdi mdi-home-heart icon-item"></span>
                        </div>
                    </div>
                </div>
                <h6 class="text-muted font-weight-normal">Solicitudes Totales</h6>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Últimas Mascotas Añadidas</h4>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th> Foto </th>
                                <th> Nombre </th>
                                <th> Especie </th>
                                <th> Estado </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($mascotas_recientes as $m): ?>
                            <tr>
                                <td>
                                    <img src="<?= base_url('uploads/'.$m['imagen']) ?>" alt="img" style="width: 36px; height: 36px; object-fit: cover; border-radius: 50%;" />
                                </td>
                                <td> <?= $m['nombre'] ?> </td>
                                <td> <?= $m['especie'] ?> </td>
                                <td>
                                    <?php if($m['estado'] == 'disponible'): ?>
                                        <div class="badge badge-outline-success">Disponible</div>
                                    <?php else: ?>
                                        <div class="badge badge-outline-danger">Adoptado</div>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>