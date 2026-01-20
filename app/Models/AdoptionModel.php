<?php

namespace App\Models;

use CodeIgniter\Model;

class AdoptionModel extends Model
{
    protected $table = 'solicitudes';
    protected $primaryKey = 'id';
    
    // IMPORTANTE: Aquí deben estar todos los campos
    protected $allowedFields = ['usuario_id', 'mascota_id', 'estado', 'mensaje', 'created_at'];
    
    protected $useTimestamps = true; // Si tienes created_at en la BD
}