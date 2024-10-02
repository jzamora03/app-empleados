<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    protected $fillable = ['cargo', 'salario'];

    public function empleados() {
        return $this->hasMany(Empleado::class);
    }

    public function aumentos() {
        return $this->hasMany(Aumento::class);
    }
}