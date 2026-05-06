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
        Schema::create('praktikums', function (Blueprint $table) {
            $table->id();
<<<<<<< HEAD
            $table->string('kode_praktikum');
=======
            $table->string('kode_praktikum')->unique();
>>>>>>> 678a83826b4cbe2f46bb253ccc21e84b4d159423
            $table->string('nama_praktikum');
            $table->unsignedBigInteger('id_dosen');
            $table->foreign('id_dosen')->references('nomor_induk')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('angkatan');
            $table->integer('semester');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('praktikums');
    }
};
