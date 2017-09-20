<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Datatables;
use Sync;
class AlternatifController extends Controller
{
    public function index(){
        return view('content.alternatif');
    }
    public function save(Request $request){
        if($request->ajax()){
            //INSERT ALTERNATIF
            $get = $request->all();
            $data = array(
                'nama_alternatif'=>$get['nama_alternatif']
            );
            $id = DB::table('tbl_alternatif')->insertGetId($data);
            Sync::SyncAlternative($id);
            Sync::SyncMatrix();
            Sync::SyncVectorVSAW();   
            Sync::SyncVectorVWP();      
            $response = array(
                'message'=>'Data Alternatif Sudah Di Simpan ',
                'status'=>'info'
            );
            return response()->json($response);
        }
    }
    public function get(Request $request){
        if($request->ajax()){
            $alternatif = DB::table('tbl_alternatif')->where('id_alternatif','=',$request->id_alternatif)->first();
            $response = array(
                'id_alternatif'=>$alternatif->id_alternatif,
                'nama_alternatif'=>$alternatif->nama_alternatif
            );
            return response()->json($response);
        }
    }
    public function update(Request $request){
        if($request->ajax()){
            $data = array(
                'nama_alternatif'=>$request->nama_alternatif
            );
            DB::table('tbl_alternatif')->where('id_alternatif',$request->id_alternatif)->update($data);
            $response = array(
                'message'=>'Data Alternatif Sudah Di Ubah',
                'status'=>'info'
            );
            return response()->json($response);
        }
    }
    public function delete(Request $request){
        if($request->ajax()){
            //HAPUS ALTERNATIF
            DB::table('tbl_alternatif')->where('id_alternatif', '=',$request->id_alternatif)->delete();
            //END HAPUS ALTERNATIF
            Sync::SyncMatrix();
            Sync::SyncVectorVSAW();   
            Sync::SyncVectorVWP();
            $response = array(
                'message'=>'Alternatif Berhasil Di Hapus',
                'status'=>'error'
            );   
            return response()->json($response);
        }
    }
    public function data(){
        $data = DB::table('tbl_alternatif')->get();
        return Datatables::of($data)->make(true);
    }
    
}
