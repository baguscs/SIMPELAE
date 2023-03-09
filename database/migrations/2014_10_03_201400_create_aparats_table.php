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
        Schema::create('aparats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wilayah_rts_id')->nullable()->constrained();
            $table->foreignId('jabatans_id')->constrained();
            $table->foreignId('wargas_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aparats');
    }
};
