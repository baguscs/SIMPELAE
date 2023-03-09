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
        Schema::create('surat_terbits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengajuans_id')->constrained();
            $table->foreignId('jenis_surats_id')->constrained();
            $table->string('nomor_surat');
            $table->string('keterangan');
            $table->date('tanggal_terbit');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_terbits');
    }
};
