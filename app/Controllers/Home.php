<?php

namespace App\Controllers;

use App\Models\PetModel;

class Home extends BaseController
{
    // Página Principal (Landing Page)
    public function index()
    {
        $petModel = new PetModel();

        // Obtenemos las 3 últimas mascotas para mostrarlas como "Destacadas"
        $data = [
            'titulo' => 'Inicio',
            'mascotas_destacadas' => $petModel->where('estado', 'disponible')
                                              ->orderBy('id', 'DESC')
                                              ->findAll(3)
        ];

        return view('home', $data);
    }

    // Catálogo completo con Filtros y Buscador
    public function catalogo()
    {
        $petModel = new PetModel();
        
        // Cargar el servicio de Request para leer la URL (?q=... &tipo=...)
        $request = \Config\Services::request();

        // 1. Capturar las variables de la URL
        $busqueda = $request->getGet('q');      // Lo que escriben en el buscador
        $tipo     = $request->getGet('tipo');   // Perro, Gato, Ave...
        $orden    = $request->getGet('orden');  // Reciente o Edad

        // 2. Preparar la consulta base (Solo disponibles)
        $query = $petModel->where('estado', 'disponible');

        // 3. Aplicar filtro de Búsqueda (si escribieron algo)
        if (!empty($busqueda)) {
            $query->groupStart()
                  ->like('nombre', $busqueda)
                  ->orLike('raza', $busqueda)
                  ->groupEnd();
        }

        // 4. Aplicar filtro de Especie (si hicieron clic en la sidebar)
        if (!empty($tipo)) {
            $query->where('especie', $tipo);
        }

        // 5. Aplicar Ordenación
        if ($orden == 'edad_asc') {
            $query->orderBy('edad', 'ASC'); // De más joven a más viejo
        } else {
            $query->orderBy('id', 'DESC');  // Por defecto: Los últimos añadidos primero
        }

        $data = [
            'titulo'   => 'Nuestras Mascotas',
            // Mantenemos paginate(6) -> 6 animales por página
            'mascotas' => $query->paginate(6), 
            'pager'    => $petModel->pager
        ];

        return view('catalogo', $data);
    }
    // Detalle de una mascota
    public function detalle($id)
    {
        $petModel = new PetModel();
        $mascota = $petModel->find($id);

        if (!$mascota) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'titulo'  => $mascota['nombre'],
            'mascota' => $mascota
        ];

        return view('detalle', $data);
    }
    // Función para el buscador en vivo
    public function buscarAjax()
    {
        // 1. Recoger lo que escribe el usuario
        $texto = $this->request->getVar('q'); 
        
        // 2. Si no escribe nada, devolvemos vacío
        if(empty($texto)) return $this->response->setJSON([]);

        // 3. Buscar en la BD (Por nombre o por especie)
        $petModel = new \App\Models\PetModel();
        
        // Buscamos coincidencias y limitamos a 5 resultados para no saturar
        $resultados = $petModel->select('id, nombre, especie, imagen')
                               ->like('nombre', $texto)
                               ->orLike('especie', $texto)
                               ->findAll(5);

        // 4. Devolver en formato JSON
        return $this->response->setJSON($resultados);
    }
}