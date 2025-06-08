<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    protected $table = 'equipos';
    protected $primaryKey = 'id';
    public $incrementing = true;

    protected $fillable = ['nombre', 'puntos'];
}
