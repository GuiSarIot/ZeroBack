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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id('us_id');
            $table->string('us_num_doc', 255)->nullable(false)->unique();
            $table->string('us_nombre_login', 125)->unique();
            $table->string('us_nombre', 125);
            $table->string('us_apellido', 125);
            $table->string('us_password', 255);
            $table->string('us_email_institucional', 255);
            $table->string('us_email_alternativo', 255)->nullable();
            $table->string('us_skpye', 125)->nullable(true);//->unique()
            $table->string('us_telefono', 20)->nullable(true);
            $table->string('us_image', 100)->nullable(true);
            $table->enum('us_estado', ['ACTIVO', 'INACTIVO'])->default('ACTIVO');
            $table->string('us_origen', 255)->nullable(true);
            $table->dateTime('us_ultima_integracion')->nullable(true);
            $table->string('us_estado_password', 100)->nullable(true);
            $table->enum('us_tipo_vinculacion', ['CONTRATISTA', 'DE_PLANTA'])->default('CONTRATISTA');
            $table->string('us_profesion', 50)->nullable(true);
            $table->dateTime('us_contrato_inicio')->nullable(true);
            $table->dateTime('us_contrato_fin')->nullable(true);
            $table->unsignedBigInteger('us_rol_institucional')->nullable();
            
            //* Foreign keys
            $table->unsignedBigInteger('us_tipo_doc_id_fk');
            $table->unsignedBigInteger('us_cent_id_fk');

            $table->foreign('us_tipo_doc_id_fk')->references('tipo_doc_id')->on('tipo_documento')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('us_cent_id_fk')->references('cent_id')->on('centros')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('us_rol_institucional')->references('id')->on('roles_institucionales')->onDelete('cascade');
            
            $table->timestamps();
        });

        Schema::create('usuarios_roles', function (Blueprint $table) {
            $table->id('usrol_id');
            $table->unsignedBigInteger('usrol_us_id_fk');
            $table->unsignedBigInteger('usrol_rol_id_fk');
            $table->foreign('usrol_us_id_fk')->references('us_id')->on('usuarios')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('usrol_rol_id_fk')->references('rol_id')->on('roles')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
        Schema::dropIfExists('usuarios_roles');
    }
};
