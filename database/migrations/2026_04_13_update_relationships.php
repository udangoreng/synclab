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
        // 1. Update 'nilais' table
        Schema::table('nilais', function (Blueprint $table) {
            // Drop the foreign key constraint first using the column name in an array
            $table->dropForeign(['id_pertemuan']);
            // Then drop the actual column
            $table->dropColumn('id_pertemuan');
        });

        // 2. Update 'presensis' table
        Schema::table('presensis', function (Blueprint $table) {
            $table->dropForeign(['id_pertemuan']);
            $table->dropColumn('id_pertemuan');
        });

        // 3. Update 'praktikums' table
        Schema::table('praktikums', function (Blueprint $table) {
            $table->dropForeign(['id_laboratorium']);
            $table->dropColumn('id_laboratorium');
        });
    }

    /**
     * Reverse the migrations (Rollback).
     */
    public function down(): void
    {
        Schema::table('nilais', function (Blueprint $table) {
            $table->foreignId('id_pertemuan')->nullable()
                  ->constrained('pertemuans')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });

        Schema::table('presensis', function (Blueprint $table) {
            $table->foreignId('id_pertemuan')->nullable()
                  ->constrained('pertemuans')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });

        Schema::table('praktikums', function (Blueprint $table) {
            $table->foreignId('id_laboratorium')->nullable()
                  ->constrained('laboratoriums')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });
    }
};