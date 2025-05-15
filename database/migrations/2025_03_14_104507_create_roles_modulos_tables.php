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
        Schema::create('roles', function (Blueprint $table) {
            $table->id('rol_id');
            $table->string('rol_nombre', 100);
            $table->enum('rol_estado', ['ACTIVO', 'INACTIVO']);
            $table->string('rol_descripcion', 255);
            $table->string('rol_url', 255)->nullable(true);
        });

        Schema::create('modulos_sist', function (Blueprint $table) {
            $table->id('modsis_id');
            $table->enum('mod_estado', ['ACTIVO', 'INACTIVO']);
            $table->string('mod_controller', 50);
            $table->string('mod_descripcion', 255);
        });

        

        Schema::create('roles_modulos_sist', function (Blueprint $table) {
            $table->id('rolmodsis_id');
            $table->unsignedBigInteger('rolmodsis_rol_id_fk');
            $table->unsignedBigInteger('rolmodsis_modsis_id_fk');
            $table->foreign('rolmodsis_rol_id_fk')->references('rol_id')->on('roles')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('rolmodsis_modsis_id_fk')->references('modsis_id')->on('modulos_sist')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles_modulos_sist');
        Schema::dropIfExists('modulos_sist');
        Schema::dropIfExists('roles');
    }
};
