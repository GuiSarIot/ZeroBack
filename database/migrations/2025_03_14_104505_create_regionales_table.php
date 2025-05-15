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
        Schema::create('regionales', function (Blueprint $table) {
            $table->id('reg_id');
            $table->string('reg_nombre', 255);
            $table->unsignedBigInteger('reg_dpt_id_fk')->nullable();
            $table->foreign('reg_dpt_id_fk')->references('dpt_id')->on('departamento')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('regionales');
    }
};
