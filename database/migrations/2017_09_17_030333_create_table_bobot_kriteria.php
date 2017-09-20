<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableBobotKriteria extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('tbl_bobot_kriteria');
        Schema::create('tbl_bobot_kriteria', function (Blueprint $table) {
            $table->increments('id_bobot_kriteria');
            $table->integer('id_kriteria')->unsigned();
            $table->integer('nilai_kriteria');
            $table->double('nilai_bobot');
            $table->timestamps();
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
        Schema::dropIfExists('tbl_bobot_kriteria');
    }
}
