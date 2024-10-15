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
        Schema::create('children', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('nama');
            $table->string('makan_pagi')->nullable();
            $table->string('makan_siang')->nullable();
            $table->string('makan_sore')->nullable();
            $table->boolean('sudah_minum_obat')->nullable()->default(false);
            $table->date('tanggal')->nullable();
            $table->text('keterangan')->nullable();
            $table->string('nama_pendamping')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('children');
    }
};
