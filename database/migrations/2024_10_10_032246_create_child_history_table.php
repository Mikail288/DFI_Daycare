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
        Schema::create('child_history', function (Blueprint $table) {
            $table->id();
            $table->foreignId('child_id')->constrained()->onDelete('cascade');
            $table->string('makan_pagi')->nullable();
            $table->string('makan_siang')->nullable();
            $table->string('makan_sore')->nullable();
            $table->boolean('sudah_minum_obat')->nullable()->default(false);
            $table->date('tanggal');
            $table->text('keterangan')->nullable();
            $table->string('nama_pendamping')->nullable();
            $table->integer('susu_pagi')->nullable();
            $table->integer('susu_siang')->nullable();
            $table->integer('susu_sore')->nullable();
            $table->integer('air_putih_pagi')->nullable();
            $table->integer('air_putih_siang')->nullable();
            $table->integer('air_putih_sore')->nullable();
            $table->integer('bak_pagi')->nullable();
            $table->integer('bak_siang')->nullable();
            $table->integer('bak_sore')->nullable();
            $table->integer('bab_pagi')->nullable();
            $table->integer('bab_siang')->nullable();
            $table->integer('bab_sore')->nullable();
            $table->integer('tidur_pagi')->nullable();
            $table->integer('tidur_siang')->nullable();
            $table->integer('tidur_sore')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('child_history');
    }
};
