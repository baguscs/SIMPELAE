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
        Schema::create('wargas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wilayah_rts_id')->constrained()->cascadeOnDelete();
            $table->bigInteger('nik')->unique();
            $table->bigInteger('no_kk')->unique();
            $table->string('nama_warga');
            $table->string('tempat_lahir');
            $table->string('tanggal_lahir');
            $table->enum('jenis_kelamin', ['Laki-Laki', 'Perempuan']);
            $table->enum('agama', ['Islam', 'Kristen', 'Katolik', 'Hindhu', 'Budha', 'Konghucu']);
            $table->string('alamat');
            $table->string('pekerjaan');
            $table->string('kewarganegaraan');
            $table->string('no_telp');
            $table->enum('status_akun', ['1', '0']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wargas');
    }
};
