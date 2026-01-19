<?php 
// 1. CONFIGURACIÓN
$pager->setSurroundCount(2); 

// 2. MATEMÁTICAS SIMPLES (Calculamos qué números queremos)
$paginaActual = $pager->getCurrentPageNumber();
$totalPaginas = $pager->getPageCount();
$numAnterior  = $paginaActual - 1;
$numSiguiente = $paginaActual + 1;

// 3. BUSCAMOS LAS URLS EXACTAS DENTRO DE LOS ENLACES GENERADOS
// CodeIgniter ya ha generado las URLs para los números (4, 5, 6...). 
// Vamos a "robarle" la URL del número 5 para dársela a la flecha.
$urlAnterior = $pager->getPrevious(); // Fallback por defecto
$urlSiguiente = $pager->getNext();    // Fallback por defecto

foreach ($pager->links() as $link) {
    // Si encontramos el enlace que tiene como título el número anterior, ESE es el bueno
    if ($link['title'] == $numAnterior) {
        $urlAnterior = $link['uri'];
    }
    // Lo mismo para el siguiente
    if ($link['title'] == $numSiguiente) {
        $urlSiguiente = $link['uri'];
    }
}
?>

<nav aria-label="Navegación de páginas">
    <ul class="pagination justify-content-center">
        
        <?php if ($paginaActual > 1) : ?>
            <li class="page-item">
                <a class="page-link" href="<?= $urlAnterior ?>" aria-label="Anterior">
                    <i class="bi bi-chevron-left"></i>
                </a>
            </li>
        <?php else: ?>
            <li class="page-item disabled">
                <span class="page-link"><i class="bi bi-chevron-left"></i></span>
            </li>
        <?php endif ?>


        <?php foreach ($pager->links() as $link) : ?>
            <li class="page-item <?= $link['active'] ? 'active' : '' ?>">
                <a class="page-link" href="<?= $link['uri'] ?>">
                    <?= $link['title'] ?>
                </a>
            </li>
        <?php endforeach ?>


        <?php if ($paginaActual < $totalPaginas) : ?>
            <li class="page-item">
                <a class="page-link" href="<?= $urlSiguiente ?>" aria-label="Siguiente">
                    <i class="bi bi-chevron-right"></i>
                </a>
            </li>
        <?php else: ?>
            <li class="page-item disabled">
                <span class="page-link"><i class="bi bi-chevron-right"></i></span>
            </li>
        <?php endif ?>
        
    </ul>
</nav>