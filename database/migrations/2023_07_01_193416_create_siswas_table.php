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
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nis')->unique();
            $table->string('kelas');
            $table->string('jurusan');
            $table->string('jenis_kelamin');
            $table->string('alamat');
            $table->unsignedBigInteger('pondok_id')->nullable();
            $table->unsignedBigInteger('wali_id');
            $table->foreign('wali_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('pondok_id')->references('id')->on('pondoks')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};
