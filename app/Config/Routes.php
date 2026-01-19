<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// --------------------------------------------------------------------
// 1. RUTA PRINCIPAL (Landing Page / Home)
// --------------------------------------------------------------------
$routes->get('/', 'Home::index');


// --------------------------------------------------------------------
// 2. RUTAS PÚBLICAS (Catálogo para usuarios y visitantes)
// --------------------------------------------------------------------
// Estas rutas servirán para que la gente vea las mascotas sin ser admin
// (Más adelante modificaremos el controlador Home para esto)
$routes->get('mascotas', 'Home::catalogo');          // Ver lista completa
$routes->get('mascotas/(:num)', 'Home::detalle/$1'); // Ver detalle de una mascota


// --------------------------------------------------------------------
// 3. RUTAS DE AUTENTICACIÓN (Login, Registro y Salir)
// --------------------------------------------------------------------
$routes->get('auth/registro', 'AuthController::registro');         // Formulario Registro
$routes->post('auth/store', 'AuthController::guardarUsuario'); // Acción de guardar usuario

$routes->get('auth/login', 'AuthController::login');  // Formulario Login
$routes->post('auth/check', 'AuthController::intentarLogin');  // Acción de verificar credenciales
$routes->get('logout', 'AuthController::logout');             // Cerrar sesión
// Rutas de Usuario (Protegidas por filtro auth)
// Si intentas entrar aquí sin login, el filtro te echará
$routes->group('usuario', ['filter' => 'auth'], function($routes) {
    $routes->post('solicitar-adopcion', 'UserController::solicitarAdopcion');
});

// --------------------------------------------------------------------
// 4. RUTAS DE ADMINISTRACIÓN (BACKEND)
// --------------------------------------------------------------------
$routes->group('admin', ['filter' => 'auth:admin'], function($routes) {
    
    // 1. Dashboard (Estadísticas y resumen)
    $routes->get('dashboard', 'AdminController::index');

    // 2. Gestión de Mascotas (Catálogo completo, creación, edición)
    $routes->get('mascotas', 'AdminController::listarMascotas'); // <--- NUEVA RUTA
    $routes->get('mascotas/crear', 'AdminController::crearMascota');
    $routes->post('mascotas/guardar', 'AdminController::guardarMascota');

    // Editar y Borrar
    $routes->get('mascotas/editar/(:num)', 'AdminController::editarMascota/$1');
    $routes->post('mascotas/actualizar', 'AdminController::actualizarMascota');
    $routes->get('mascotas/borrar/(:num)', 'AdminController::borrarMascota/$1');

    // 3. Gestión de Solicitudes
    $routes->get('solicitudes', 'AdminController::verSolicitudes');
    $routes->get('solicitudes/estado/(:num)/(:segment)', 'AdminController::cambiarEstadoSolicitud/$1/$2');
});