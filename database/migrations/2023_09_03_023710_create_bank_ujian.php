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
        Schema::create('bank_ujian', function (Blueprint $table) {
            $table->increments('id_bank_ujian');
            $table->string('nama_bank_ujian');
            $table->integer('id_mapel');
            $table->integer('id_bank_soal');
            $table->integer('id_kelas');
            $table->integer('id_jurusan');
            $table->integer('durasi');
            $table->integer('jumlah_soal');
            $table->integer('acak_soal');
            $table->integer('acak_jawaban');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bank_ujian');
    }
};
