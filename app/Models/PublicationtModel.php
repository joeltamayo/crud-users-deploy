<?php

namespace App\Models;

use CodeIgniter\Model;

class PublicationtModel extends Model // Herencia
{
    protected $table = 'publication'; // Tabla de publicaciones 
    protected $allowedFields = ['content', 'user'];  // Solo permite actualizar 'content' y 'user'

    public function get($id = false)
    {
        if ($id === false) {
            return $this->findAll(); // Consulta SELECT * FROM publication
        }

        return $this->asArray()
            ->where(['id' => $id])
            ->first();
    }
}
