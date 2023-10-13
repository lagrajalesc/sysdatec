<?php

namespace App\Models;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    protected $table = "estudiante";

    protected $fillable = [
        'id',
        'nombres',
        'apellido',
        'correo',
        'id_estado'
    ];
}
