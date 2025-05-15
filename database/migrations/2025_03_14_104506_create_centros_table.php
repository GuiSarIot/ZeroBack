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
        Schema::create('centros', function (Blueprint $table) {
            $table->id('cent_id');
            $table->string('cent_nombre', 255);
            $table->unsignedBigInteger('cent_reg_id_fk')->nullable();
            $table->timestamps();

            //* Foreign keys
            $table->foreign('cent_reg_id_fk')->references('reg_id')->on('regionales')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('centros');
    }
};
