<?php

namespace App\Models;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;

class Estados extends Model
{
    protected $table = "estados";

    protected $fillable = [
        'id',
        'estado'
    ];
}
