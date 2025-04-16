<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users'; // Nombre de la tabla
    protected $primaryKey = 'id'; // Clave primaria

    // Definir los campos que pueden ser insertados o actualizados
    protected $allowedFields = ['username', 'email', 'password'];

    // Configuración para la protección de datos
    protected $useTimestamps = true; // Usar timestamp para created_at y updated_at
    protected $createdField  = 'created_at'; // Campo para fecha de creación
    protected $updatedField  = 'updated_at'; // Campo para fecha de actualización
}
