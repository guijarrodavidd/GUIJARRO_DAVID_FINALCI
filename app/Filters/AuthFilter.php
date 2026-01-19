<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Si no está logueado, fuera
        if (!session()->get('is_logged')) {
            return redirect()->to('/login')->with('error', 'Debes iniciar sesión primero.');
        }

        // Si intentan entrar a rutas de admin y no son admin
        if ($arguments && $arguments[0] == 'admin') {
            if (session()->get('rol') != 'admin') {
                return redirect()->to('/')->with('error', 'No tienes permisos de administrador.');
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No hacer nada aquí
    }
}