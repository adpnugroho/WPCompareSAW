<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMatriksSaw extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('tbl_matriks_saw');
        Schema::create('tbl_matriks_saw', function (Blueprint $table) {
            $table->increments('id_matriks');
            $table->integer('id_evaluasi')->unsigned();
            $table->double('nilai_matriks');
            $table->timestamps();
            $table->foreign('id_evaluasi')->references('id_evaluasi')->on('tbl_evaluasi')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_matriks_saw');
    }
}
