<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aumento extends Model
{
    protected $fillable = ['fecha', 'valor', 'cargo_id', 'empleado_id'];

    public function empleado() {
        return $this->belongsTo(Empleado::class);
    }

    public function cargo() {
        return $this->belongsTo(Cargo::class);
    }
}
