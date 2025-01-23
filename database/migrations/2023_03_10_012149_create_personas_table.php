<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->id();
            $table->string('razon_social');
            $table->string('direccion')->nullable();
            $table->string('telefono', 15)->nullable();
            $table->enum('tipo', ['NATURAL', 'JURIDICA']);
            $table->string('email')->nullable();
            $table->tinyInteger('estado')->default(1);
            $table->foreignId('documento_id')->constrained()->cascadeOnDelete();
            $table->string('numero_documento', 20);
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
        Schema::dropIfExists('personas');
    }
};
