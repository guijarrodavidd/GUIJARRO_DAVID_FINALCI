<?php

namespace App\Controllers;

use App\Models\UserModel;

class AuthController extends BaseController
{
    // 1. Mostrar formulario de Login
    public function login()
    {
        if (session()->get('is_logged')) {
            return redirect()->to('/');
        }
        
        return view('auth/login'); 
    }

    // 2. Procesar el Login
    public function intentarLogin()
    {
        $userModel = new UserModel();

        // 1. Recoger datos
        $email    = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // 2. Buscar usuario
        $usuario = $userModel->where('email', $email)->first();

        if ($usuario) {
            // 3. Verificar contraseña (Asegúrate de que tu columna en BD se llama 'password')
            if (password_verify($password, $usuario['password'])) {
                
                // Crear Sesión
                $sessionData = [
                    'id'        => $usuario['id'],
                    'nombre'    => $usuario['nombre'],
                    'email'     => $usuario['email'],
                    'rol'       => $usuario['rol'], 
                    'is_logged' => true
                ];

                session()->set($sessionData);

                // --- AQUÍ ESTÁ EL CAMBIO ---
                // Forzamos que vaya siempre al dashboard (o solo si es admin)
                return redirect()->to('/admin/dashboard');

            } else {
                return redirect()->back()->with('error', 'La contraseña es incorrecta.');
            }
        } else {
            return redirect()->back()->with('error', 'Este email no está registrado.');
        }
    }

    // 3. Mostrar formulario de Registro
    public function registro()
    {
        if (session()->get('is_logged')) {
            return redirect()->to('/');
        }
        return view('auth/registro');
    }

    // 4. Guardar Nuevo Usuario
    public function guardarUsuario()
    {
        $userModel = new UserModel();

        // Validaciones
        $reglas = [
            'nombre'           => 'required|min_length(3)',
            'email'            => 'required|valid_email|is_unique[usuarios.email]',
            'password'         => 'required|min_length(6)',
            'confirm_password' => 'matches[password]'
        ];

        if (!$this->validate($reglas)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Preparamos los datos
        $data = [
            'nombre'   => $this->request->getPost('nombre'),
            'email'    => $this->request->getPost('email'),
            // ¡IMPORTANTE! Encriptamos la contraseña antes de guardarla
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'rol'      => 'usuario' // Por defecto son usuarios normales
        ];

        $userModel->save($data);

        return redirect()->to('/login')->with('mensaje', '¡Cuenta creada! Ahora puedes iniciar sesión.');
    }

    // 5. Cerrar Sesión
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}