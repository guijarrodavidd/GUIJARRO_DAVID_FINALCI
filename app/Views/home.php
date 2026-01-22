<?= $this->extend('layout/main') ?>

<?= $this->section('contenido') ?>

<div class="hero-wrapper">
    
    <video autoplay muted loop playsinline class="hero-video">
        <source src="<?= base_url('uploads/herovideo.mp4') ?>" type="video/mp4">
    </video>

    <div class="hero-overlay"></div>

    <div class="container hero-content text-center position-relative">
        <h1 class="animate-up">Compañeros de vida,<br>no mascotas.</h1>
        <p class="animate-up delay-1 mt-4">
            Cientos de historias increíbles comienzan con una adopción. 
            <br>Descubre la lealtad en su forma más pura.
        </p>
        
        <div class="mt-5 animate-up delay-2">
            <a href="<?= base_url('mascotas') ?>" class="btn btn-custom me-3">
                Ver Catálogo
            </a>
            <?php if(!session()->has('is_logged')): ?>
                <a href="<?= base_url('auth/registro') ?>" class="btn btn-outline-light-custom">
                    Unirse al club
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>
</div> 

<section class="cta-section">
    <div class="container">
        <h2 class="cta-title">¡Deja tu huella!</h2>
        <p class="lead mb-4" style="max-width: 700px; margin: 0 auto; opacity: 0.9;">
            Ayúdanos a seguir salvando vidas. Hay muchas formas de colaborar 
            y conseguir que vuelvan a tener esperanza.
        </p>
        <a href="<?= base_url('auth/registro') ?>" class="btn btn-orange">
            Colabora con nosotros
        </a>
    </div>
</section>

<section class="bg-light pb-5">
    <div class="container">
        <div class="row">
            
            <div class="col-lg-5 pt-5 mt-lg-5">
                <span class="text-warning fw-bold text-uppercase ls-2 small">Vidas Cambiadas</span>
                <h2 class="display-4 fw-bold mt-2 mb-4" style="font-family: 'Playfair Display', serif; color: #2d3436;">
                    Finales Felices
                </h2>
                <p class="text-muted mb-4 lead">
                    Nuevas familias, nuevos comienzos, una nueva vida que disfrutar. 
                    Cada adopción es una historia de amor que reescribimos juntos.
                </p>
                <a href="<?= base_url('mascotas') ?>" class="btn btn-orange">
                    Huellas Felices
                </a>
            </div>

            <div class="col-lg-6 offset-lg-1">
                <div class="floating-stats-card bg-white">
                    <div class="row text-center g-4">
                        
                        <div class="col-6 stat-item">
                            <i class="bi bi-emoji-smile"></i>
                            <div class="stat-number">1500+</div>
                            <div class="stat-label">Perros Rescatados</div>
                        </div>

                        <div class="col-6 stat-item">
                            <i class="bi bi-stars"></i>
                            <div class="stat-number">10+</div>
                            <div class="stat-label">Colonias Felinas</div>
                        </div>

                        <div class="col-6 stat-item">
                            <i class="bi bi-house-heart"></i>
                            <div class="stat-number">1200+</div>
                            <div class="stat-label">Adopciones</div>
                        </div>

                        <div class="col-6 stat-item">
                            <i class="bi bi-piggy-bank"></i>
                            <div class="stat-number">€8000+</div>
                            <div class="stat-label">Fondos Recaudados</div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<section class="py-5 bg-light">
    <div class="container py-5">
        <div class="text-center mb-5">
            <span class="text-accent text-uppercase fw-bold ls-2">Esperando un hogar</span>
            <h2 class="display-4 mt-2">Recién llegados al refugio</h2>
        </div>

        <div class="row">
            <?php foreach($mascotas_destacadas as $m): ?>
                <div class="col-md-4 mb-4">
                    <div class="card card-custom h-100">
                        <div class="card-img-wrapper position-relative">
                            <span class="position-absolute top-0 start-0 m-3 badge-custom">Nueva Oportunidad</span>
                            <img src="<?= base_url('uploads/'.$m['imagen']) ?>" alt="<?= $m['nombre'] ?>"
                                 onerror="this.src='https://via.placeholder.com/400x300?text=Sin+Foto'">
                        </div>
                        <div class="card-body text-center p-4">
                            <h3 class="h4 mb-1"><?= $m['nombre'] ?></h3>
                            <p class="text-muted small text-uppercase mb-3"><?= $m['raza'] ?> • <?= $m['edad'] ?> años</p>
                            <a href="<?= base_url('mascotas/'.$m['id']) ?>" class="btn btn-outline-dark rounded-0 px-4 py-2 small fw-bold">
                                Conocer Historia
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="py-5" style="background-color: var(--primary-color); color: white;">
    <div class="container text-center py-4">
        <i class="bi bi-quote fs-1 text-accent"></i>
        <h2 class="display-6 fst-italic mt-3 text-white">"Salvar a un animal no cambiará el mundo, pero cambiará el mundo para ese animal."</h2>
    </div>
</section>

<?= $this->endSection() ?>