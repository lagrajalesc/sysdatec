<?php

namespace App\Models;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;
class Profesor extends Model
{
    protected $table = "profesor";

    protected $fillable = [
        'id',
        'nombres',
        'apellido',
        'correo',
        'id_estado'
    ];
}
