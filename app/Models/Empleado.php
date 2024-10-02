<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{

    protected $fillable = ['nombres', 'apellidos', 'sexo', 'fecha_ingreso', 'cargo_id'];

    public function cargo() {
        return $this->belongsTo(Cargo::class);
    }

    public function aumentos() {
        return $this->hasMany(Aumento::class);
    }
}
