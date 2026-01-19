<?= $this->extend('layout/main') ?>

<?= $this->section('contenido') ?>

<div class="container">
    <div class="row g-0 auth-wrapper">
        
        <div class="col-lg-6 auth-form-side order-lg-2"> <div class="mb-4">
                <h2 class="auth-title">Únete al Club</h2>
                <p class="text-muted">¿Ya tienes cuenta? <a href="<?= base_url('login') ?>" class="text-accent fw-bold text-decoration-none">Inicia sesión aquí</a></p>
            </div>

            <?php if(session('errors')): ?>
                <div class="alert alert-danger small">
                    <ul class="mb-0 ps-3">
                    <?php foreach(session('errors') as $error): ?>
                        <li><?= $error ?></li>
                    <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('registro/guardar') ?>" method="post">
                <div class="mb-3">
                    <label class="text-uppercase small fw-bold text-muted">Nombre Completo</label>
                    <input type="text" name="nombre" class="form-control form-control-clean" value="<?= old('nombre') ?>" required>
                </div>

                <div class="mb-3">
                    <label class="text-uppercase small fw-bold text-muted">Email</label>
                    <input type="email" name="email" class="form-control form-control-clean" value="<?= old('email') ?>" required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="text-uppercase small fw-bold text-muted">Contraseña</label>
                        <input type="password" name="password" class="form-control form-control-clean" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-uppercase small fw-bold text-muted">Confirmar</label>
                        <input type="password" name="confirm_password" class="form-control form-control-clean" required>
                    </div>
                </div>

                <div class="form-check mt-3 mb-4">
                    <input class="form-check-input" type="checkbox" required>
                    <label class="form-check-label small text-muted">
                        Acepto los términos y condiciones de adopción.
                    </label>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-orange btn-lg shadow-sm">Crear Cuenta</button>
                </div>
            </form>
        </div>

        <div class="col-lg-6 auth-visual-side d-none d-lg-flex order-lg-1" style="background-image: url('<?= base_url('uploads/registro.webp') ?>');">
            <div class="auth-overlay-card">
                <h3 class="fw-bold mb-3" style="font-family: 'Playfair Display'; color: #1a3c1e;">Salva una vida hoy</h3>
                <p class="text-muted mb-0">
                    Al registrarte podrás iniciar procesos de adopción, guardar tus mascotas favoritas y recibir noticias del refugio.
                </p>
            </div>
        </div>

    </div>
</div>

<?= $this->endSection() ?>