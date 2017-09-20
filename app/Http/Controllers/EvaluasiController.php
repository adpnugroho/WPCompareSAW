<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Sync;
use Datatables;
class EvaluasiController extends Controller
{
    public function index(){
        return view('content.evaluasi');
    }
    public function get(Request $request){
        if($request->ajax()){
            $dataEvaluasi = DB::table('tbl_alternatif')
                            ->join('tbl_evaluasi','tbl_alternatif.id_alternatif','=','tbl_evaluasi.id_alternatif')
                            ->join('tbl_kriteria','tbl_evaluasi.id_kriteria','=','tbl_kriteria.id_kriteria')
                            ->where('tbl_alternatif.id_alternatif','=',$request->id_alternatif)->get();
            $dataAlternatif = DB::table('tbl_alternatif')->where('id_alternatif','=',$request->id_alternatif)->first();
            return response()->json(array('evaluasi'=>$dataEvaluasi,'alternatif'=>$dataAlternatif));
        }
    }
    public function update(Request $request){
        //UBAH DATA EVALUASI
        $data = $request->all();
        $dataInsert = array();
        DB::table('tbl_evaluasi')->where('id_alternatif',$data['id_alternatif'][0])->delete();
        for($x=0;$x<count($data['id_alternatif']);$x++){
            $r = array(
                'id_evaluasi'=>$data['id_evaluasi'][$x],
                'id_alternatif'=>$data['id_alternatif'][$x],
                'id_kriteria'=>$data['id_kriteria'][$x],
                'nilai'=>$data['nilai'][$x]
            );
            array_push($dataInsert,$r);
        }
        DB::table('tbl_evaluasi')->insert($dataInsert);
        //END UBAH DATA EVALUASI
        Sync::SyncMatrix();
        Sync::SyncVectorVSAW();   
        Sync::SyncVectorVWP();
        $response = array(
            'message'=>'Data Evaluasi Sudah Di Ubah',
            'status'=>'info'
        );
        return response()->json($response);
    }
    public function data(){
        $alternatif = DB::table('tbl_alternatif')->get();
        $kriteria = DB::table('tbl_kriteria')->get();

        $arrAlternatif = array();
        $arrKriteria = array();
        $arrEvaluasi = array();

        $x = 0;
        foreach($alternatif as $rowAlt){
            $y = 0;
            foreach($kriteria as $rowKr){
                $data = DB::table('tbl_evaluasi')
                        ->where('id_alternatif',$rowAlt->id_alternatif)
                        ->where('id_kriteria',$rowKr->id_kriteria)
                        ->first();
                $arrEvaluasi[$x][$y] = $data->nilai;
                $y++;
            }
            $x++;
        }
        $arrAlternatif = json_decode(json_encode($alternatif));
        $arrKriteria = json_decode(json_encode($kriteria));

        return response()->json(array(
            'kriteria'=>$arrKriteria,
            'alternatif'=>$arrAlternatif,
            'evaluasi'=>$arrEvaluasi
        ));
    }
    public function dataMatriks(){
        $alternatif = DB::table('tbl_alternatif')->get();
        $kriteria = DB::table('tbl_kriteria')->get();

        $arrAlternatif = array();
        $arrKriteria = array();
        $arrEvaluasi = array();

        $x = 0;
        foreach($alternatif as $rowAlt){
            $y = 0;
            foreach($kriteria as $rowKr){
                $data = DB::table('tbl_evaluasi')
                        ->join('tbl_matriks_saw','tbl_evaluasi.id_evaluasi','=','tbl_matriks_saw.id_evaluasi')
                        ->where('id_alternatif',$rowAlt->id_alternatif)
                        ->where('id_kriteria',$rowKr->id_kriteria)
                        ->first();
                $arrEvaluasi[$x][$y] = $data->nilai_matriks;
                $y++;
            }
            $x++;
        }
        $arrAlternatif = json_decode(json_encode($alternatif));
        $arrKriteria = json_decode(json_encode($kriteria));

        return response()->json(array(
            'kriteria'=>$arrKriteria,
            'alternatif'=>$arrAlternatif,
            'evaluasi'=>$arrEvaluasi
        ));
    }
    public function dataWP(){
        $data = DB::table('tbl_alternatif')
                    ->join('tbl_vektor_wp','tbl_alternatif.id_alternatif','=','tbl_vektor_wp.id_alternatif')
                    ->get();
        return Datatables::of($data)->make(true);
    }
    public function dataSAW(){
        $data = DB::table('tbl_alternatif')
                    ->join('tbl_vektor_saw','tbl_alternatif.id_alternatif','=','tbl_vektor_saw.id_alternatif')
                    ->get();
        return Datatables::of($data)->make(true);
    }
}
