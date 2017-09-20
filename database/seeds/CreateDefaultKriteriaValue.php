<?php

use Illuminate\Database\Seeder;
class CreateDefaultKriteriaValue extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbl_kriteria')->delete();
        DB::table('tbl_kriteria')->insert(array(
            array('id_kriteria'=>'1','nama_kriteria'=>'Kerajinan','tipe_kriteria'=>'benefit'),
            array('id_kriteria'=>'2','nama_kriteria'=>'Kesopanan','tipe_kriteria'=>'benefit'),
            array('id_kriteria'=>'3','nama_kriteria'=>'Kerapian','tipe_kriteria'=>'benefit'),
            array('id_kriteria'=>'4','nama_kriteria'=>'Kedisiplinan','tipe_kriteria'=>'benefit'),
            array('id_kriteria'=>'5','nama_kriteria'=>'Prestasi','tipe_kriteria'=>'benefit'),
        ));
        DB::table('tbl_bobot_kriteria')->delete();
        DB::table('tbl_bobot_kriteria')->insert(array(
            array('id_bobot_kriteria'=>'1','id_kriteria'=>'1','nilai_kriteria'=>'1','nilai_bobot'=>'0.20'),
            array('id_bobot_kriteria'=>'2','id_kriteria'=>'2','nilai_kriteria'=>'1','nilai_bobot'=>'0.20'),
            array('id_bobot_kriteria'=>'3','id_kriteria'=>'3','nilai_kriteria'=>'1','nilai_bobot'=>'0.20'),
            array('id_bobot_kriteria'=>'4','id_kriteria'=>'4','nilai_kriteria'=>'1','nilai_bobot'=>'0.20'),
            array('id_bobot_kriteria'=>'5','id_kriteria'=>'5','nilai_kriteria'=>'1','nilai_bobot'=>'0.20'),
        ));
    }
}
