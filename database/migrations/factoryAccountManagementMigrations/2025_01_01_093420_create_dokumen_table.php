<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('dokumen', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nama_perusahaan')->constrained('perusahaan')->onDelete('cascade');
            $table->string('nama_dokumen');
            $table->string('jenis_dokumen');
            $table->date('tanggal_terbit');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('dokumen');
    }
};