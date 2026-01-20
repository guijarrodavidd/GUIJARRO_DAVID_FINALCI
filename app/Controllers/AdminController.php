<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PetModel;
use App\Models\AdoptionModel; // Necesario para contar solicitudes

class AdminController extends BaseController
{
    // ----------------------------------------------------------------
    // 1. DASHBOARD PRINCIPAL (Estadísticas)
    // ----------------------------------------------------------------
    public function index()
    {
        $petModel = new PetModel();
        $adoptionModel = new AdoptionModel();

        $data = [
            'titulo' => 'Panel de Control',
            // 1. Contamos el total para las tarjetas de colores
            'total_mascotas'    => $petModel->countAll(),
            'total_solicitudes' => $adoptionModel->countAll(),
            
            // 2. Obtenemos las últimas 5 mascotas para la tabla resumen
            'mascotas_recientes' => $petModel->orderBy('id', 'DESC')->findAll(5)
        ];

        return view('admin/dashboard', $data);
    }

    // ----------------------------------------------------------------
    // 2. GESTIÓN DE MASCOTAS (Listado completo)
    // ----------------------------------------------------------------
    public function listarMascotas()
    {
        $petModel = new PetModel();

        $data = [
            'titulo'   => 'Gestionar Mascotas',
            // Aquí sí usamos paginación porque es el listado completo
            'mascotas' => $petModel->orderBy('id', 'DESC')->paginate(10),
            'pager'    => $petModel->pager
        ];

        // OJO: Tendremos que crear esta vista 'admin/mascotas' luego
        return view('admin/mascotas', $data); 
    }

    // ----------------------------------------------------------------
    // 3. CREACIÓN (Formularios)
    // ----------------------------------------------------------------
    public function crearMascota()
    {
        return view('admin/crear_mascota');
    }

    public function guardarMascota()
    {
        $petModel = new PetModel();

        // Validación
        $validacion = $this->validate([
            'nombre'  => 'required',
            'especie' => 'required',
            'imagen'  => [
                'uploaded[imagen]',
                'mime_in[imagen,image/jpg,image/jpeg,image/png,image/webp]',
                'max_size[imagen,2048]',
            ]
        ]);

        if (!$validacion) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Subida de imagen
        $archivoImagen = $this->request->getFile('imagen');
        $nuevoNombre = null;

        if ($archivoImagen->isValid() && !$archivoImagen->hasMoved()) {
            $nuevoNombre = $archivoImagen->getRandomName();
            $archivoImagen->move('assets/uploads', $nuevoNombre); // Recomiendo guardar en assets/uploads
        }

        // Guardar
        $data = [
            'nombre'      => $this->request->getPost('nombre'),
            'especie'     => $this->request->getPost('especie'),
            'raza'        => $this->request->getPost('raza'),
            'edad'        => $this->request->getPost('edad'),
            'sexo'        => $this->request->getPost('sexo'), // Añadido campo sexo
            'descripcion' => $this->request->getPost('descripcion'),
            'estado'      => 'disponible',
            'imagen'      => $nuevoNombre
        ];

        $petModel->save($data);

        // Redirigir al listado de gestión
        return redirect()->to('/admin/mascotas')->with('mensaje', 'Mascota publicada correctamente.');
    }

    // ----------------------------------------------------------------
    // 4. SOLICITUDES
    // ----------------------------------------------------------------
    public function verSolicitudes()
    {
        $adoptionModel = new AdoptionModel();

        $solicitudes = $adoptionModel->select('solicitudes.*, usuarios.nombre as nombre_usuario, usuarios.email, mascotas.nombre as nombre_mascota, mascotas.imagen')
                                     ->join('usuarios', 'usuarios.id = solicitudes.usuario_id')
                                     ->join('mascotas', 'mascotas.id = solicitudes.mascota_id')
                                     ->orderBy('solicitudes.id', 'DESC')
                                     ->findAll();

        $data = [
            'titulo' => 'Solicitudes de Adopción',
            'solicitudes' => $solicitudes
        ];

        return view('admin/solicitudes', $data);
    }

    public function cambiarEstadoSolicitud($id, $estado)
    {
        $adoptionModel = new AdoptionModel();
        
        if (in_array($estado, ['aprobada', 'rechazada'])) {
            $adoptionModel->update($id, ['estado' => $estado]);
            
            if($estado == 'aprobada'){
                $solicitud = $adoptionModel->find($id);
                $petModel = new PetModel();
                $petModel->update($solicitud['mascota_id'], ['estado' => 'adoptado']);
            }
        }

        return redirect()->to('/admin/solicitudes')->with('mensaje', 'Estado actualizado.');
    }
    // Ver el detalle completo de una solicitud
    public function verDetalleSolicitud($id)
    {
        $adoptionModel = new AdoptionModel();

        // Hacemos JOIN para traer TODOS los datos necesarios
        $solicitud = $adoptionModel->select('solicitudes.*, 
                                            usuarios.nombre as nombre_usuario, 
                                            usuarios.email as email_usuario, 
                                            mascotas.nombre as nombre_mascota, 
                                            mascotas.imagen, 
                                            mascotas.especie, 
                                            mascotas.raza, 
                                            mascotas.edad,
                                            mascotas.sexo')
                                   ->join('usuarios', 'usuarios.id = solicitudes.usuario_id')
                                   ->join('mascotas', 'mascotas.id = solicitudes.mascota_id')
                                   ->find($id);

        if (!$solicitud) {
            return redirect()->to('/admin/solicitudes')->with('mensaje', 'Solicitud no encontrada.');
        }

        $data = [
            'titulo'    => 'Detalle de Solicitud',
            'solicitud' => $solicitud
        ];

        return view('admin/detalle_solicitud', $data);
    }
}