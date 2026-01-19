<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AdoptionModel;

class UserController extends BaseController
{
    // Procesar el formulario del modal de adopción
    public function solicitarAdopcion()
    {
        // 1. Verificar si está logueado (Doble seguridad)
        if (!session()->has('is_logged')) {
            return redirect()->to('/login');
        }

        $request = \Config\Services::request();
        $adoptionModel = new AdoptionModel();

        // 2. Validar que no haya pedido ya a esa mascota (Opcional, pero recomendado)
        $existe = $adoptionModel->where('usuario_id', session('id_usuario'))
                                ->where('mascota_id', $request->getPost('mascota_id'))
                                ->first();

        if ($existe) {
            return redirect()->back()->with('error', 'Ya has enviado una solicitud para esta mascota.');
        }

        // 3. Guardar la solicitud
        $data = [
            'usuario_id' => session('id_usuario'),
            'mascota_id' => $request->getPost('mascota_id'),
            'mensaje'    => $request->getPost('mensaje'),
            'estado'     => 'pendiente'
        ];

        $adoptionModel->save($data);

        return redirect()->back()->with('mensaje', '¡Solicitud enviada! Nos pondremos en contacto contigo pronto.');
    }
}