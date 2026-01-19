<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'usuarios'; // Nombre de la tabla
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    
    // Aquí ponemos los campos que permitimos modificar
    protected $allowedFields    = ['nombre', 'email', 'clave', 'rol'];

    // Configuración de fechas
    protected $useTimestamps = true;
    protected $createdField  = 'fecha_creacion'; // Mapeamos nuestro campo en español
    protected $updatedField  = ''; // Si no usas campo de actualización, déjalo vacío o crea el campo en la BD
}