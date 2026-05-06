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
        Schema::create('pertemuans', function (Blueprint $table) {
            $table->id();
<<<<<<< HEAD:database/migrations/2026_04_10_134846_create_pertemuans_table.php
            $table->foreignId('id_praktikum')->nullable()->references('id')->on('praktikums')->onDelete('cascade')->onUpdate('cascade');
=======
            $table->foreignId('id_praktikum')->references('id')->on('praktikums')->onDelete('cascade')->onUpdate('cascade');
>>>>>>> 678a83826b4cbe2f46bb253ccc21e84b4d159423:database/migrations/2026_04_12_134849_create_pertemuans_table.php
            $table->foreignId('id_jadwal')->references('id')->on('jadwals')->onDelete('cascade')->onUpdate('cascade');
            $table->string('nama_pertemuan');
            $table->integer('pertemuan_ke');
            $table->longText('deskripsi_pertemuan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pertemuans');
    }
};
