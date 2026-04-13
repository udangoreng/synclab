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
        // Hapus foreign key id_pertemuan dari tabel nilais
        Schema::table('nilais', function (Blueprint $table) {
            $table->dropForeignIdFor('pertemuans');
        });

        // Hapus foreign key id_pertemuan dari tabel presensis
        Schema::table('presensis', function (Blueprint $table) {
            $table->dropForeignIdFor('pertemuans');
        });

        // Hapus foreign key id_laboratorium dari tabel praktikums
        Schema::table('praktikums', function (Blueprint $table) {
            $table->dropForeignIdFor('laboratoriums');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Rollback: tambahkan kembali foreign key yang dihapus
        Schema::table('nilais', function (Blueprint $table) {
            $table->foreignId('id_pertemuan')->nullable()->references('id')->on('pertemuans')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('presensis', function (Blueprint $table) {
            $table->foreignId('id_pertemuan')->nullable()->references('id')->on('pertemuans')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('praktikums', function (Blueprint $table) {
            $table->foreignId('id_laboratorium')->nullable()->references('id')->on('laboratoriums')->onDelete('cascade')->onUpdate('cascade');
        });
    }
};
