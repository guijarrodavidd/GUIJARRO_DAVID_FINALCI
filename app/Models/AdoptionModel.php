<?php

namespace App\Models;

use CodeIgniter\Model;

class AdoptionModel extends Model
{
    protected $table            = 'solicitudes';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['usuario_id', 'mascota_id', 'mensaje', 'estado'];

    protected $useTimestamps = true;
    protected $createdField  = 'fecha_solicitud';
    protected $updatedField  = '';
}