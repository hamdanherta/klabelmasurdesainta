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
        Schema::create('color_datasets', function (Blueprint $table) {
            $table->id();
            $table->string('warna_dominan_1')->nullable();
            $table->string('warna_dominan_2')->nullable();
            $table->string('warna_dominan_3')->nullable();
            $table->string('warna_dominan_4')->nullable();
            $table->string('warna_dominan_5')->nullable();
            $table->string('warna_kombinasi')->nullable(); // Used for text color
            $table->string('teori_warna')->nullable();
            $table->string('jenis')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('color_datasets');
    }
};
