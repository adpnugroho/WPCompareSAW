<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableVektorSaw extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('tbl_vektor_saw');
        Schema::create('tbl_vektor_saw', function (Blueprint $table) {
            $table->increments('id_vektor_saw');
            $table->integer('id_alternatif')->unsigned();
            $table->double('nilai_vektor_saw');
            $table->timestamps();
            $table->foreign('id_alternatif')->references('id_alternatif')->on('tbl_alternatif')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_vektor_saw');
    }
}
