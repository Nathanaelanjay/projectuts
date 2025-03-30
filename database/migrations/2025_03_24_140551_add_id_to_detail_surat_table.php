<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('detail_surat', function (Blueprint $table) {
            $table->id(); // Tambahkan primary key auto-increment
            $table->string('nama');
            $table->integer('kategori_surat');
            $table->date('tanggal_surat');
            $table->integer('semester');
            $table->string('tujuan_surat');
            $table->string('alamat_mhs');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('detail_surat');
    }
};
