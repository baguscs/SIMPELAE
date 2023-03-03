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
        Schema::create('pengajuans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wargas_id')->constrained()->cascadeOnDelete();
            $table->foreignId('jenis_surats_id')->constrained()->cascadeOnDelete();
            $table->string('nama_pengaju');
            $table->string('nik_pengaju');
            $table->enum('jenis_kelamin_pengaju', ['Laki-Laki', 'Perempuan']);
            $table->string('bukti_akta')->nullable();
            $table->string('bukti_kk')->nullable();
            $table->string('bukti_ktp')->nullable();
            $table->string('bukti_surat_dokter')->nullable();
            $table->enum('status', ['0', '1']);
            $table->string('keterangan')->nullable();
            $table->date('tanggal_pengajuan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuans');
    }
};
