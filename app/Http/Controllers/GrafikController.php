<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class GrafikController extends Controller
{
    public function index(){
        return view('content.grafik');
    }
    public function grafik(){
        $dataAlternatif = DB::table('tbl_alternatif')
                            ->join('tbl_vektor_wp','tbl_alternatif.id_alternatif','=','tbl_vektor_wp.id_alternatif')
                            ->join('tbl_vektor_saw','tbl_alternatif.id_alternatif','=','tbl_vektor_saw.id_alternatif')
                            ->get();
        if(count(json_decode(json_encode($dataAlternatif)))>0){
            $labels = array();
            $nilaiWP = array();
            $nilaiSAW = array();
            foreach($dataAlternatif as $RAlt){
                $labels[] = $RAlt->nama_alternatif;
                $nilaiWP[] = $RAlt->nilai_vektor_v;
                $nilaiSAW[] = $RAlt->nilai_vektor_saw;
            }
            $dataWP = array(
                'label'=>'WP',
                'backgroundColor'=>'rgba(220,220,220,0.5)',
                'borderColor'=>'rgba(220,220,220,0.8)',
                'highlightFill'=>'rgba(220,220,220,0.75)',
                'highlightStroke'=>'rgba(220,220,220,1)',
                'data'=>$nilaiWP
            );
            $dataSAW = array(
                'label'=>'SAW',
                'backgroundColor'=>'rgba(151,187,205,0.5)',
                'borderColor'=>'rgba(151,187,205,0.8)',
                'highlightFill'=>'rgba(151,187,205,0.75)',
                'highlightStroke'=>'rgba(151,187,205,1)',
                'data'=>$nilaiSAW
            );
            $returnWP['labels'] = $labels;
            $returnSAW['labels'] = $labels;
            $returnWP['datasets'][0] = $dataWP;
            $returnSAW['datasets'][0] = $dataSAW;
            
            return response()->json(array('wp'=>$returnWP,'saw'=>$returnSAW,'status'=>true));
        }else{
            return response()->json(array('status'=>false));
        }
    }
}
