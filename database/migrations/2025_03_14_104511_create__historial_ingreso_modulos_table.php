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
        Schema::create('historial_ingreso_modulos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('him_us_id');
            $table->unsignedBigInteger('him_rol_id');
            $table->string('him_mod_name', 255);
            $table->timestamp('fecha_ing')->useCurrent();
            $table->foreign('him_us_id')->references('us_id')->on('usuarios')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('him_rol_id')->references('rol_id')->on('roles')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_historial_ingreso_modulos');
    }
};
