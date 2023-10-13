<?php

namespace App\Models;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;

class ProfesoresPorMateria extends Model
{
    protected $table = "profesores_por_materia";

    protected $fillable = [
        'id',
        'id_profesor',
        'id_materia'
    ];
}
