<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mhs_prestasi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->integer('id_kegiatan');
            $table->string('nama');
            $table->string('penyelenggara');
            $table->integer('jumlah');
            $table->string('capaian');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->string('tropi');
            $table->string('url_penyelenggara');
            $table->string('foto');
            $table->string('undangan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mhs_prestasis');
    }
};
