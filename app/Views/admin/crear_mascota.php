<!DOCTYPE html>
<html>
<head>
    <title>Nueva Mascota</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Registrar Nueva Mascota</h4>
            </div>
            <div class="card-body">
                
                <?php if(session()->getFlashdata('errors')): ?>
                    <div class="alert alert-danger">
                        <ul>
                        <?php foreach(session()->getFlashdata('errors') as $error): ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form action="<?= base_url('admin/mascotas/guardar') ?>" method="post" enctype="multipart/form-data">
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Nombre de la mascota</label>
                            <input type="text" name="nombre" class="form-control" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label>Especie</label>
                            <select name="especie" class="form-select">
                                <option value="Perro">Perro</option>
                                <option value="Gato">Gato</option>
                                <option value="Ave">Ave</option>
                                <option value="Otro">Otro</option>
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label>Edad (años)</label>
                            <input type="number" name="edad" class="form-control">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label>Raza</label>
                        <input type="text" name="raza" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Descripción / Historia</label>
                        <textarea name="descripcion" class="form-control" rows="3"></textarea>
                    </div>

                    <div class="mb-3">
                        <label>Foto de la mascota</label>
                        <input type="file" name="imagen" class="form-control" required>
                        <small class="text-muted">Formatos: JPG, PNG. Máx 2MB.</small>
                    </div>

                    <a href="<?= base_url('admin/dashboard') ?>" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-success">Guardar Mascota</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>