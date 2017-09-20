<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableEvaluasi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('tbl_evaluasi');
        Schema::create('tbl_evaluasi', function (Blueprint $table) {
            $table->increments('id_evaluasi');
            $table->integer('id_alternatif')->unsigned();
            $table->integer('id_kriteria')->unsigned();
            $table->integer('nilai');
            $table->timestamps();
            $table->foreign('id_alternatif')->references('id_alternatif')->on('tbl_alternatif')->onDelete('cascade');
            $table->foreign('id_kriteria')->references('id_kriteria')->on('tbl_kriteria')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_evaluasi');
    }
}
