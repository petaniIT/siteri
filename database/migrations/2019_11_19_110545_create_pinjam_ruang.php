<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePinjamRuang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pinjam_ruang', function (Blueprint $table) {
            $table->increments('id');
            $table->date('tanggal_mulai');
            $table->date('tanggal_berakhir');
            $table->time('jam_mulai');
            $table->time('jam_berakhir');
            $table->string('kegiatan');
            $table->integer('jumlah_peserta');
            $table->boolean('verif_baper')->default(false);
            $table->boolean('verif_ktu')->default(false);
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
        Schema::dropIfExists('pinjam_ruang');
    }
}
