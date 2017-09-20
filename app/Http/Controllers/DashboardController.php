<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class DashboardController extends Controller
{
    public function index(){
        $dataWP = DB::table('tbl_vektor_wp')->join('tbl_alternatif','tbl_vektor_wp.id_alternatif','=','tbl_alternatif.id_alternatif')->orderBy('tbl_vektor_wp.nilai_vektor_v','desc')->first();
        $dataSAW = DB::table('tbl_vektor_saw')->join('tbl_alternatif','tbl_vektor_saw.id_alternatif','=','tbl_alternatif.id_alternatif')->orderBy('tbl_vektor_saw.nilai_vektor_saw','desc')->first();
        if(count(json_decode(json_encode($dataWP)))>0){
            $wp = $dataSAW->nama_alternatif;
        }else{
            $wp = "Tidak Ada Data Alternatif";
        }
        if(count(json_decode(json_encode($dataSAW)))>0){
            $saw = $dataSAW->nama_alternatif;
        }else{
            $saw = "Tidak Ada Data Alternatif";
        }
        $data = array(
            'alternatif'=>DB::table('tbl_alternatif')->count(),
            'kriteria'=>DB::table('tbl_kriteria')->count(),
            'saw'=>$saw,
            'wp'=>$wp
        );
        return view('content.dashboard',$data);
    }
}
