<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class StatusBarangRuang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('status_barang_ruang', function (Blueprint $table) {
            $table->increments('id');
            $table->string('status');
        });

        DB::table('status_barang_ruang')->insert(
            array(
                array(
                    'status' => 'Tetap (tidak mungkin dipinjam)'
                ),
                array(
                    'status' => 'Bergerak (mungkin dipinjam)'
                )
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
