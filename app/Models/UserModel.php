<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'usuarios';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    
    // ¡AQUÍ ESTÁ LA CLAVE!
    // Tienes que listar TODOS los campos que se pueden guardar.
    // Asegúrate de que pone 'password' y no 'pass' ni 'clave'.
    protected $allowedFields = ['nombre', 'email', 'password', 'rol']; 

    protected $useTimestamps = false; 
}