<?= $this->extend('layout/main') ?>

<?= $this->section('contenido') ?>

<div class="container my-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('mascotas') ?>">Mascotas</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= esc($mascota['nombre']) ?></li>
        </ol>
    </nav>

    <div class="card shadow-lg">
        <div class="row g-0">
            <div class="col-md-6">
                <img src="<?= base_url('uploads/'.$mascota['imagen']) ?>" class="img-fluid rounded-start w-100 h-100" style="object-fit: cover; min-height: 400px;" alt="<?= esc($mascota['nombre']) ?>" onerror="this.src='https://via.placeholder.com/500?text=Sin+Foto'">
            </div>
            <div class="col-md-6">
                <div class="card-body p-5">
                    <h1 class="card-title display-5 fw-bold"><?= esc($mascota['nombre']) ?></h1>
                    
                    <?php 
                        $badgeColor = 'success';
                        if($mascota['estado'] == 'adoptado') $badgeColor = 'secondary';
                        if($mascota['estado'] == 'pendiente') $badgeColor = 'warning';
                    ?>
                    <span class="badge bg-<?= $badgeColor ?> mb-3 fs-6"><?= ucfirst($mascota['estado']) ?></span>
                    
                    <ul class="list-group list-group-flush mb-4">
                        <li class="list-group-item"><strong>Especie:</strong> <?= esc($mascota['especie']) ?></li>
                        <li class="list-group-item"><strong>Raza:</strong> <?= esc($mascota['raza']) ?></li>
                        <li class="list-group-item"><strong>Edad:</strong> <?= esc($mascota['edad']) ?> años</li>
                        <li class="list-group-item"><strong>Publicado:</strong> <?= date('d/m/Y', strtotime($mascota['fecha_creacion'])) ?></li>
                    </ul>

                    <div id="infoRaza" class="card mt-4 mb-4 border-info" style="display: none;">
                        <div class="card-header bg-info text-white">
                            <i class="bi bi-lightbulb-fill"></i> ¿Sabías esto sobre los <span id="razaTitulo" class="fw-bold"></span>?
                        </div>
                        <div class="card-body bg-light">
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <p class="mb-1"><strong class="text-info">🧠 Temperamento:</strong></p>
                                    <span id="razaTemp" class="text-muted small">Cargando...</span>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <p class="mb-1"><strong class="text-info">⏳ Esperanza de vida:</strong></p>
                                    <span id="razaVida" class="text-muted"></span>
                                </div>
                                <div class="col-6">
                                    <p class="mb-1"><strong class="text-info">📏 Altura:</strong> <span id="razaAltura"></span></p>
                                </div>
                                <div class="col-6">
                                    <p class="mb-1"><strong class="text-info">⚖️ Peso:</strong> <span id="razaPeso"></span></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            
                            // ==========================================
                            // CONFIGURACIÓN (¡IMPORTANTE!)
                            // ==========================================
                            // Si sigue fallando con error 403, regístrate en thedogapi.com (es gratis y tardas 1 min)
                            // y pega tu clave entre las comillas. Ejemplo: "live_x8s7..."
                            const DOG_API_KEY = "live_9jSSpwRh8Tlhol2wS4m71p1WXH66og02vp6NlXqPWbYq5ST6tLNPMPEy8ytNyyQV"; 
                            const CAT_API_KEY = "live_y9tKS6uaVYLwOQ7ixkcQ6J02NgQlBNb5rTQLHSlJLq3PBv1PMOxKi0q5OrEuYpQR"; 

                            // ==========================================
                            // 1. LIMPIEZA Y PREPARACIÓN
                            // ==========================================
                            const especieRaw = "<?= esc($mascota['especie']) ?>".toLowerCase().trim();
                            const razaRaw = "<?= esc($mascota['raza']) ?>".trim();

                            console.log("🛠️ DEBUG API | Especie:", especieRaw, "| Raza:", razaRaw);

                            // ==========================================
                            // 2. DICCIONARIO MAESTRO (ESPAÑOL -> INGLÉS API)
                            // ==========================================
                            const traducciones = {
                                // --- PERROS (Traducciones exactas para TheDogAPI) ---
                                // Pastores y Boyeros
                                'Pastor Aleman': 'German Shepherd', 'Pastor Alemán': 'German Shepherd',
                                'Pastor Belga': 'Belgian Malinois', 'Pastor Belga Malinois': 'Belgian Malinois',
                                'Pastor Australiano': 'Australian Shepherd',
                                'Border Collie': 'Border Collie',
                                'Bobtail': 'Old English Sheepdog',
                                
                                // Molosos y Grandes
                                'Gran Danés': 'Great Dane', 'Gran Danes': 'Great Dane',
                                'San Bernardo': 'Saint Bernard',
                                'Mastin': 'Mastiff', 'Mastín': 'Mastiff', 'Mastín Español': 'Mastiff',
                                'Rottweiler': 'Rottweiler',
                                'Boxer': 'Boxer',
                                'Doberman': 'Doberman Pinscher',
                                'Bulldog': 'Bulldog',
                                'Bulldog Frances': 'French Bulldog', 'Bulldog Francés': 'French Bulldog',
                                'Shar Pei': 'Chinese Shar-Pei',

                                // Terriers y Pequeños
                                'Yorkshire': 'Yorkshire Terrier', 'Yorkshire Terrier': 'Yorkshire Terrier',
                                'Jack Russell': 'Jack Russell Terrier',
                                'Westy': 'West Highland White Terrier', 'West Highland White Terrier': 'West Highland White Terrier',
                                'Bull Terrier': 'Bull Terrier',
                                'Staffordshire': 'American Staffordshire Terrier', 'American Staffordshire': 'American Staffordshire Terrier',
                                'Chihuahua': 'Chihuahua',
                                'Bichon Maltes': 'Maltese', 'Bichón Maltés': 'Maltese',
                                'Caniche': 'Poodle', 'Poodle': 'Poodle',
                                'Shih Tzu': 'Shih Tzu',
                                'Pomerania': 'Pomeranian',
                                'Pug': 'Pug', 'Carlino': 'Pug',
                                'Teckel': 'Dachshund', 'Salchicha': 'Dachshund',

                                // Sabuesos y Cazadores
                                'Beagle': 'Beagle',
                                'Galgo': 'Greyhound', 'Galgo Español': 'Greyhound',
                                'Podenco': 'Ibizan Hound', // Aproximación (La API no tiene Podenco andaluz específico)
                                'Dalmata': 'Dalmatian', 'Dálmata': 'Dalmatian',
                                'Pointer': 'Pointer',
                                'Setter': 'Irish Setter',
                                'Braco': 'German Shorthaired Pointer',

                                // Nórdicos y Retrivers
                                'Husky': 'Siberian Husky', 'Husky Siberiano': 'Siberian Husky',
                                'Malamute': 'Alaskan Malamute',
                                'Samoyedo': 'Samoyed',
                                'Akita': 'Akita',
                                'Labrador': 'Labrador Retriever', 'Labrador Retriever': 'Labrador Retriever',
                                'Golden': 'Golden Retriever', 'Golden Retriever': 'Golden Retriever',
                                'Cocker': 'Cocker Spaniel', 'Cocker Spaniel': 'Cocker Spaniel',
                                'Chow Chow': 'Chow Chow',

                                // --- GATOS (TheCatAPI) ---
                                'Siames': 'Siamese', 'Siamés': 'Siamese',
                                'Persa': 'Persian',
                                'Bengala': 'Bengal',
                                'Maine Coon': 'Maine Coon',
                                'Sphynx': 'Sphynx', 'Esfinge': 'Sphynx', 'Egipcio': 'Sphynx',
                                'Ragdoll': 'Ragdoll',
                                'Exotico': 'Exotic Shorthair', 'Exótico': 'Exotic Shorthair',
                                'Comun Europeo': 'European Shorthair', 'Común Europeo': 'European Shorthair',
                                'Negro comun': 'European Shorthair', 'Negro común': 'European Shorthair',
                                'Romano': 'American Shorthair',
                                'Azul Ruso': 'Russian Blue',
                                'Siberiano': 'Siberian',
                                'Angora': 'Turkish Angora'
                            };

                            // ==========================================
                            // 3. SELECCIÓN DE API Y CABECERAS
                            // ==========================================
                            let urlApi = "";
                            let apiKey = "";
                            let tipoDetectado = "";

                            // Detector flexible (funciona con "Perros", "Canino", etc.)
                            if (especieRaw.includes('perro') || especieRaw.includes('can')) {
                                urlApi = "https://api.thedogapi.com/v1/breeds/search";
                                apiKey = DOG_API_KEY;
                                tipoDetectado = "perro";
                            } 
                            else if (especieRaw.includes('gato') || especieRaw.includes('felin')) {
                                urlApi = "https://api.thecatapi.com/v1/breeds/search";
                                apiKey = CAT_API_KEY;
                                tipoDetectado = "gato";
                            }

                            // ==========================================
                            // 4. EJECUCIÓN CON MANEJO DE ERRORES ROBUSTO
                            // ==========================================
                            if (urlApi && razaRaw.toLowerCase() !== 'mestizo') {
                                
                                // 1. Traducir (Si no existe traducción, intentamos la raza original)
                                let razaBusqueda = traducciones[razaRaw] || razaRaw;
                                
                                console.log(`🚀 Buscando: "${razaBusqueda}" en ${tipoDetectado.toUpperCase()}`);

                                // 2. Preparar cabeceras (Evita errores 403 si tienes Key)
                                const headers = { 'Content-Type': 'application/json' };
                                if (apiKey) {
                                    headers['x-api-key'] = apiKey;
                                }

                                fetch(`${urlApi}?q=${encodeURIComponent(razaBusqueda)}`, { headers: headers })
                                    .then(response => {
                                        // Si la API nos bloquea (403) o falla (500)
                                        if (!response.ok) {
                                            if(response.status === 403) {
                                                throw new Error("⚠️ ERROR 403: La API pide autenticación. Necesitas una API Key para esta raza.");
                                            }
                                            throw new Error(`Error HTTP: ${response.status}`);
                                        }
                                        return response.json();
                                    })
                                    .then(data => {
                                        // console.log("📦 Respuesta:", data); // Descomenta para ver datos crudos

                                        if (data.length > 0) {
                                            // A veces devuelve varios (ej: "Terrier"), intentamos coger el nombre exacto si existe
                                            // Si no, cogemos el primero de la lista.
                                            let info = data[0];
                                            
                                            // Pequeño truco: si devuelve muchos, buscamos si alguno coincide exacto con el nombre en inglés
                                            const coincidenciaExacta = data.find(r => r.name.toLowerCase() === razaBusqueda.toLowerCase());
                                            if (coincidenciaExacta) info = coincidenciaExacta;

                                            // PINTAR DATOS EN EL HTML
                                            document.getElementById('razaTitulo').innerText = razaRaw; // Mantenemos el nombre en español
                                            document.getElementById('razaTemp').innerText = info.temperament || "No disponible";
                                            document.getElementById('razaVida').innerText = info.life_span || "No disponible";
                                            
                                            // Altura
                                            if(info.height && info.height.metric) {
                                                document.getElementById('razaAltura').innerText = info.height.metric + " cm";
                                            } else {
                                                document.getElementById('razaAltura').innerText = "-";
                                            }

                                            // Peso
                                            if(info.weight && info.weight.metric) {
                                                document.getElementById('razaPeso').innerText = info.weight.metric + " kg";
                                            } else {
                                                document.getElementById('razaPeso').innerText = "-";
                                            }

                                            // MOSTRAR TARJETA Y COLOREAR
                                            const caja = document.getElementById('infoRaza');
                                            caja.style.display = 'block';
                                            
                                            if(tipoDetectado === 'gato') {
                                                caja.classList.remove('border-info');
                                                caja.classList.add('border-warning');
                                                caja.querySelector('.card-header').classList.remove('bg-info');
                                                caja.querySelector('.card-header').classList.add('bg-warning', 'text-dark');
                                            } else {
                                                caja.classList.add('border-info');
                                                caja.classList.remove('border-warning');
                                                caja.querySelector('.card-header').classList.add('bg-info', 'text-white');
                                                caja.querySelector('.card-header').classList.remove('bg-warning', 'text-dark');
                                            }

                                        } else {
                                            console.warn(`⚠️ API OK pero sin datos para: "${razaBusqueda}". ¿Quizás falta traducir esta raza?`);
                                        }
                                    })
                                    .catch(error => {
                                        console.error("❌ FALLO:", error.message);
                                        // Opcional: Mostrar un mensaje en la tarjeta de que no se pudo cargar
                                    });

                            } else {
                                console.log("ℹ️ No se busca en API (Es Mestizo o especie no soportada)");
                            }
                        });
                    </script>
                    <h4>Historia</h4>
                    <p class="card-text lead"><?= nl2br(esc($mascota['descripcion'])) ?></p>

                    <hr class="my-4">

                    <?php if(session()->has('is_logged')): ?>
                        <div class="d-grid gap-2">
                            <button type="button" class="btn btn-success btn-lg" data-bs-toggle="modal" data-bs-target="#adopcionModal">
                                <i class="bi bi-heart-fill"></i> ¡Quiero adoptar a <?= esc($mascota['nombre']) ?>!
                            </button>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-warning text-center">
                            Debes <a href="<?= base_url('auth/login') ?>">iniciar sesión</a> para solicitar la adopción.
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
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">Adoptar a <?= esc($mascota['nombre']) ?></h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="mascota_id" value="<?= $mascota['id'] ?>">
                    <div class="mb-3">
                        <label class="form-label fw-bold">¿Por qué quieres adoptar a esta mascota?</label>
                        <textarea name="mensaje" class="form-control" rows="4" required placeholder="Cuéntanos dónde vivirá, si tienes otras mascotas, tu horario..."></textarea>
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