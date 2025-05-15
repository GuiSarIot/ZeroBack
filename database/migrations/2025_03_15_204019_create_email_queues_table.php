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
    Schema::create('email_queues', function (Blueprint $table) {
        $table->id();
        $table->string('correo');
        $table->string('mensaje')->nullable();
        $table->enum('estado', ['pendiente', 'enviado', 'fallido'])->default('pendiente');
        $table->timestamp('fecha_envio')->nullable(); // Elimina 'after status'
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('email_queues');
    }
};
