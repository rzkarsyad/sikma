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
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('nim');
            $table->string('nama');     
            $table->string('institusi')->default('Universitas Al-Irsyad Cilacap');
            $table->integer('id_prodi');
            $table->integer('id_jalur');
            $table->enum('jns_kelamin', ['P', 'W']);
            $table->string('tempat_lahir');
            $table->date('tgl_lahir');
            $table->string('nik');
            $table->string('no_hp');
            $table->string('email')->nullable();
            $table->text('alamat');
            $table->string('nama_ortu')->nullable();
            $table->string('hubungan_ortu')->nullable();
            $table->string('no_hp_ortu')->nullable();
            $table->year('tahun_masuk');
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
        Schema::dropIfExists('mahasiswas');
    }
};
