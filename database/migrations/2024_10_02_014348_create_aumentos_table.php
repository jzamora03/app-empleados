<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAumentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aumentos', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->decimal('valor', 8, 2);
            $table->foreignId('cargo_id')->constrained('cargos');
            $table->foreignId('empleado_id')->constrained('empleados');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aumentos');
    }
}
