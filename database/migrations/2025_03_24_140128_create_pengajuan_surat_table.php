<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('pengajuan_surat', function (Blueprint $table) {
            $table->id('id_log');
            $table->integer('status_surat')->default(0);
            $table->timestamp('tanggal_perubahan')->default(now());
            $table->text('keterangan_penolakan')->nullable();
            $table->foreignId('id_surat')->constrained('detail_surat')->onDelete('cascade');
            $table->string('nrp', 20);
            $table->foreignId('id_staff')->constrained('staff')->onDelete('cascade');
            $table->string('id_kaprodi', 20);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pengajuan_surat');
    }
};
