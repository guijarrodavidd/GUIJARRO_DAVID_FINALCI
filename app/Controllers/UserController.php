<?php

namespace App\Controllers;

use App\Models\AdoptionModel;

class UserController extends BaseController
{
    public function solicitarAdopcion()
    {
        $adoptionModel = new AdoptionModel();

        // 1. Recogemos el ID de la mascota del formulario (campo oculto)
        $mascotaId = $this->request->getPost('mascota_id');

        // 2. ¡AQUÍ ESTABA EL ERROR! 
        // Recogemos el ID del usuario desde la SESIÓN (no del formulario)
        $usuarioId = session()->get('id');

        // (Seguridad extra) Si por lo que sea no hay usuario, al login
        if (!$usuarioId) {
            return redirect()->to('/auth/login')->with('error', 'Debes iniciar sesión para adoptar.');
        }

        // 3. Preparamos los datos
        $data = [
            'usuario_id' => $usuarioId,  // <--- ESTO SOLUCIONA TU ERROR
            'mascota_id' => $mascotaId,
            'estado'     => 'pendiente', // Estado inicial
            'mensaje'    => $this->request->getPost('mensaje') // Si tienes un campo de "cuéntanos por qué"
        ];

        // 4. Guardamos
        $adoptionModel->save($data);

        return redirect()->back()->with('mensaje', '¡Solicitud enviada! Nos pondremos en contacto contigo.');
    }
}