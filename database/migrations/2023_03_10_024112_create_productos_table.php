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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo',50);
            $table->string('nombre',80);
            $table->integer('stock')->unsigned()->default(0);
            $table->string('descripcion',255)->nullable();
            $table->date('fecha_vencimiento')->nullable();
            $table->string('img_path',255)->nullable();
            $table->tinyInteger('estado')->default(1);
            $table->foreignId('marca_id')->constrained('marcas')->onDelete('cascade');
            $table->foreignId('presentacione_id')->constrained('presentaciones')->onDelete('cascade');
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
        Schema::dropIfExists('productos');
    }
};
