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
     Schema::create('nilais', function (Blueprint $table) {
    $table->id();
    
    // Kolom nilai per komponen
    $table->integer('proses1')->default(0);
    $table->integer('proses2')->default(0);
    $table->integer('uts')->default(0);
    $table->integer('proses3')->default(0);
    $table->integer('proses4')->default(0);
    $table->integer('uas')->default(0);
    
    $table->text('catatan')->nullable();

    // Relasi antar tabel
    $table->foreignId('siswa_id')->constrained('siswas')->onDelete('cascade');
    $table->foreignId('mapel_id')->constrained('mapels')->onDelete('cascade');
    $table->foreignId('guru_id')->constrained('gurus')->onDelete('cascade');
    $table->foreignId('kelas_id')->constrained('kelas')->onDelete('cascade');
    $table->foreignId('tahun_akademik_id')->constrained('tahun_akademik')->onDelete('cascade');
    $table->foreignId('semester_id')->constrained('semesters')->onDelete('cascade');

    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilais');
    }
};
