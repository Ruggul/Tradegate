<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('akun', function (Blueprint $table) {
            $table->id();
            $table->string('kode_akun')->unique();
            $table->string('nama_akun');
            $table->enum('kategori', ['Aktiva', 'Kewajiban', 'Modal', 'Pendapatan', 'Beban']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('akun');
    }
};