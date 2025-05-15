<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
    table roles_institucionales{
        rolin_id integer [pk, increment]
        rolin_nombre varchar(100)
        rolin_estado estado
        rolin_descripcion varchar(250)
        rolin_us_id_fk integer
    }

    table Roles_institucionales_roles {
        rolinrol_id integer [PK, increment]
        rolinrol_rolin_id_fk integer
        rolinrol_rol_id_fk integer
    }

     */
    public function up(): void
    {
        Schema::create('roles_institucionales', function (Blueprint $table) {
            $table->id();
            $table->string('rolin_nombre', 100);
            $table->enum('rolin_estado', ['Activo', 'Inactivo']);
            $table->string('rolin_descripcion', 250);
            $table->enum('rolin_nivel_acceso', ['CENTRO', 'REGIONAL', 'NACIONAL', 'ROOT']); // Agregar esta línea

            //* Timestamps
            $table->timestamps();
        });

        Schema::create('roles_institucionales_roles', function (Blueprint $table) {
            $table->id();

            //* Foreign keys
            $table->unsignedBigInteger('rolinrol_rolin_id_fk');
            $table->foreign('rolinrol_rolin_id_fk')->references('id')->on('roles_institucionales')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('rolinrol_rol_id_fk');
            $table->foreign('rolinrol_rol_id_fk')->references('rol_id')->on('roles')->onDelete('cascade')->onUpdate('cascade');

            //* Timestamps
            $table->timestamps();
        });

        //* agregar columna us_rol_institucional a usuarios

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles_institucionales');
        Schema::dropIfExists('roles_institucionales_roles');
    }
};
