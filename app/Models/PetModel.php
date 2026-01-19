<?php

namespace App\Models;

use CodeIgniter\Model;

class PetModel extends Model
{
    protected $table            = 'mascotas';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['nombre', 'especie', 'raza', 'edad', 'descripcion', 'imagen', 'estado'];

    protected $useTimestamps = true;
    protected $createdField  = 'fecha_creacion';
    protected $updatedField  = ''; 
}