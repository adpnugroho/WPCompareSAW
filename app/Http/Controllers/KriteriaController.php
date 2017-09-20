<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Datatables;
use Sync;
class KriteriaController extends Controller
{
    public function index(){
        return view('content.kriteria');
    }
    public function get(Request $request){
        if($request->ajax()){
            $kriteria = DB::table('tbl_kriteria')
                            ->join('tbl_bobot_kriteria','tbl_kriteria.id_kriteria','=','tbl_bobot_kriteria.id_kriteria')
                            ->where('tbl_kriteria.id_kriteria','=',$request->id_kriteria)
                            ->first();
            $response = array(
                'id_kriteria'=>$kriteria->id_kriteria,
                'nama_kriteria'=>$kriteria->nama_kriteria,
                'nilai_kriteria'=>$kriteria->nilai_kriteria
            );
            return response()->json($response);
        }
    }
    public function update(Request $request){
        if($request->ajax()){
            $data = array(
                'nama_kriteria'=>$request->nama_kriteria
            );
            DB::table('tbl_kriteria')->where('id_kriteria',$request->id_kriteria)->update($data);
            $data = array(
                'nilai_kriteria'=>$request->nilai_kriteria
            );
            DB::table('tbl_bobot_kriteria')->where('id_kriteria',$request->id_kriteria)->update($data);
            Sync::SyncVectorSWP();
            Sync::SyncVectorVSAW();   
            Sync::SyncVectorVWP();
            $response = array(
                'message'=>'Data Kriteria Sudah Di Ubah',
                'status'=>'info'
            );
            return response()->json($response);
        }
    }
    public function data(){
        $data = DB::table('tbl_kriteria')
                    ->join('tbl_bobot_kriteria','tbl_kriteria.id_kriteria','=','tbl_bobot_kriteria.id_kriteria')
                    ->get();
        return Datatables::of($data)->make(true);
    }
}
