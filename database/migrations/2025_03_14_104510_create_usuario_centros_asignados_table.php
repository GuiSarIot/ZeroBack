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
        Schema::create('usuario_centros_asignados', function (Blueprint $table) {
            $table->id();
            $table->string('uscentasg_tipo', 255);
            $table->string('uscentasg_centros_id', 255)->nullable(true);
            $table->unsignedBigInteger('uscentasg_us_id_fk');
            $table->foreign('uscentasg_us_id_fk')->references('us_id')->on('usuarios')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuario_centros_asignados');
    }
};
