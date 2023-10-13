<?php

namespace App\Models;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    protected $table = "materia";

    protected $fillable = [
        'id',
        'nombre',
        'codigo'
    ];
}
