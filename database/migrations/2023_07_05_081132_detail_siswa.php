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
        Schema::create('detail_siswa', function (Blueprint $table) {
            $table->increments('id_detail');
            $table->integer('id_siswa');
            $table->string('nama_panggilan')->nullable();
            $table->string('kewarganegaraan')->nullable();
            $table->integer('jumlah_saudara_tiri')->nullable();
            $table->integer('jumlah_saudara_angkat')->nullable();
            $table->string('status_orang_tua')->nullable();
            $table->string('bahasa_sehari_hari')->nullable();
            $table->string('golongan_darah')->nullable();
            $table->string('penyakit')->nullable();
            $table->string('kelainan_jasmani')->nullable();
            $table->string('asal_sekolah')->nullable();
            $table->date('tanggal_no_sttb')->nullable();
            $table->integer('lamanya_belajar')->nullable();
            $table->string('diterima_di_kelas')->nullable();
            $table->date('tanggal_diterima')->nullable();
            $table->string('tempat_lahir_ayah')->nullable();
            $table->date('tanggal_lahir_ayah')->nullable();
            $table->string('agama_ayah')->nullable();
            $table->string('kewarganegaraan_ayah')->nullable();
            $table->string('alamat_rumah_ayah')->nullable();
            $table->string('nomor_telepon_ayah')->nullable();
            $table->string('status_hidup_ayah')->nullable();
            $table->string('tempat_lahir_ibu')->nullable();
            $table->date('tanggal_lahir_ibu')->nullable();
            $table->string('agama_ibu')->nullable();
            $table->string('kewarganegaraan_ibu')->nullable();
            $table->string('alamat_rumah_ibu')->nullable();
            $table->string('nomor_telepon_ibu')->nullable();
            $table->string('status_hidup_ibu')->nullable();
            $table->string('tempat_lahir_wali')->nullable();
            $table->date('tanggal_lahir_wali')->nullable();
            $table->string('agama_wali')->nullable();
            $table->string('kewarganegaraan_wali')->nullable();
            $table->string('alamat_rumah_wali')->nullable();
            $table->string('nomor_telepon_wali')->nullable();
            $table->string('hubungan_keluarga')->nullable();
            $table->string('kesenian')->nullable();
            $table->string('olahraga')->nullable();
            $table->string('kemasyarakatan_organisasi')->nullable();
            $table->string('lain_lain')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_siswa');
    }
};
