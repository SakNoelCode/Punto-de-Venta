<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('empresa', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('propietario');
            $table->string('ruc', 50);
            $table->integer('porcentaje_impuesto')->unsigned();
            $table->string('abreviatura_impuesto', 5);
            $table->string('direccion');
            $table->string('correo')->nullable();
            $table->string('telefono')->nullable();
            $table->string('ubicacion')->nullable();
            $table->foreignId('moneda_id')->unique()->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empresa');
    }
};
