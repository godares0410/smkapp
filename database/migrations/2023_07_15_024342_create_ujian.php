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
        Schema::create('ujian', function (Blueprint $table) {
            $table->increments('id_ujian');
            $table->integer('id_jenis');
            $table->integer('id_mapel');
            $table->integer('jumlah_soal');
            $table->integer('jumlah_opsi');
            $table->integer('point');
            $table->date('tgl_mulai');
            $table->date('tgl_selesai');
            $table->time('jam_mulai');
            $table->time('jam_selesai');
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
        Schema::dropIfExists('ujian');
    }
};
