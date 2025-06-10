<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Usuario extends Model
{
    //
    protected $table = 'usuarios';
    protected $primaryKey = 'id';
    public $incrementing = true;

    protected $fillable = ['nombre', 'pass'];

    public function setPassAttribute($value)
    {
        $this->attributes['pass'] = Hash::make($value);
    }
}
