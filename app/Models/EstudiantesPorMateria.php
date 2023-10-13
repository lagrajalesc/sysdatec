<?php

namespace App\Models;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;

class EstudiantesPorMateria extends Model
{
    protected $table = "estudiantes_por_materia";

    protected $fillable = [
        'id',
        'id_estudiante',
        'id_materia'
    ];
}
