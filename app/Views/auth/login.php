<?= $this->extend('layout/main') ?>

<?= $this->section('contenido') ?>

<div class="container">
    <div class="row g-0 auth-wrapper">
        
        <div class="col-lg-6 auth-form-side">
            
            <div class="mb-5">
                <i class="bi bi-paw-fill text-accent fs-1"></i>
                <h2 class="auth-title">Bienvenido</h2>
                <p class="text-muted">¿No tienes cuenta? <a href="<?= base_url('registro') ?>" class="text-accent fw-bold text-decoration-none">Crea una cuenta</a></p>
            </div>

            <?php if(session()->getFlashdata('error')): ?>
                <div class="alert alert-danger mb-4 border-0 shadow-sm">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <?php if(session()->getFlashdata('mensaje')): ?>
                <div class="alert alert-success mb-4 border-0 shadow-sm">
                    <?= session()->getFlashdata('mensaje') ?>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('auth/check') ?>" method="post">
                <div class="mb-4">
                    <label class="text-uppercase small fw-bold text-muted mb-2">Email</label>
                    <input type="email" name="email" class="form-control form-control-clean" placeholder="tu@email.com" required>
                </div>

                <div class="mb-4">
                    <label class="text-uppercase small fw-bold text-muted mb-2">Contraseña</label>
                    <input type="password" name="password" class="form-control form-control-clean" placeholder="••••••••" required>
                </div>

                <div class="d-grid mt-5">
                    <button type="submit" class="btn btn-orange btn-lg shadow-sm">Iniciar Sesión</button>
                </div>
            </form>
            
        </div>

        <div class="col-lg-6 auth-visual-side d-none d-lg-flex">
            <div class="auth-overlay-card">
                <h3 class="fw-bold mb-3" style="font-family: 'Playfair Display'; color: #1a3c1e;">¡Hola de nuevo!</h3>
                <p class="text-muted mb-0">Te echábamos de menos.</p>
            </div>
        </div>

    </div>
</div>

<?= $this->endSection() ?>