<?php
class Sync{
    public static function ReSyncAll(){

    }
    public static function SyncAlternative($id){
        $dataKriteria = DB::table('tbl_kriteria')->get();
        $dataSync = array();
        foreach($dataKriteria as $row){
            $r = array(
                'id_alternatif'=>$id,
                'id_kriteria'=>$row->id_kriteria,
                'nilai'=>'1'
            );
            array_push($dataSync,$r);
        }
        DB::table('tbl_evaluasi')->insert($dataSync);
        DB::table('tbl_vektor_wp')->insert(array('id_alternatif'=>$id,'nilai_vektor_s'=>0,'nilai_vektor_v'=>0));
        DB::table('tbl_vektor_saw')->insert(array('id_alternatif'=>$id,'nilai_vektor_saw'=>0));
    }
    public static function SyncMatrix(){
        $dataKriteria = DB::table('tbl_kriteria')->get();
        $dataAlternatif = DB::table('tbl_alternatif')->count();
        if($dataAlternatif>0){
            $dataInsertMatriks = array();
            $y = array();
            foreach($dataKriteria as $row){
                $dataEvaluasi = DB::table('tbl_kriteria')
                    ->join('tbl_evaluasi','tbl_kriteria.id_kriteria','=','tbl_evaluasi.id_kriteria')
                    ->where('tbl_kriteria.id_kriteria','=',$row->id_kriteria)
                    ->get();                
                $max = max(array_column(json_decode(json_encode($dataEvaluasi)), 'nilai'));
                $min = min(array_column(json_decode(json_encode($dataEvaluasi)), 'nilai'));
                foreach($dataEvaluasi as $rowEv){
                    if($row->tipe_kriteria=='benefit'){
                        $y = array(
                            'id_evaluasi'=>$rowEv->id_evaluasi,
                            'nilai_matriks'=>$rowEv->nilai/$max
                        );
                    }else{
                        $y = array(
                            'id_evaluasi'=>$rowEv->id_evaluasi,
                            'nilai_matriks'=>$min/$rowEv->nilai
                        );
                    }
                    array_push($dataInsertMatriks,$y);
                }
            }
            DB::table('tbl_matriks_saw')->truncate();
            DB::table('tbl_matriks_saw')->insert($dataInsertMatriks);
        }
    }
    public static function SyncVectorSWP(){
        $dataKriteria = DB::table('tbl_kriteria')->join('tbl_bobot_kriteria','tbl_kriteria.id_kriteria','=','tbl_bobot_kriteria.id_kriteria')->get();
        $sum = array_sum(array_column(json_decode(json_encode($dataKriteria)), 'nilai_kriteria'));
        $dataInsert = array();
        foreach($dataKriteria as $row){
            $r = array(
                'id_bobot_kriteria'=>$row->id_bobot_kriteria,
                'id_kriteria'=>$row->id_kriteria,
                'nilai_kriteria'=>$row->nilai_kriteria,
                'nilai_bobot'=>$row->nilai_kriteria/$sum
            );
            array_push($dataInsert,$r);
        }
        DB::table('tbl_bobot_kriteria')->truncate();
        DB::table('tbl_bobot_kriteria')->insert($dataInsert);
    }
    public static function SyncVectorVSAW(){
        $dataAlternatif = DB::table('tbl_alternatif')->get();
        $dataKriteria = DB::table('tbl_kriteria')->get();
        $dataInsert = array();
        if(count(json_decode(json_encode($dataAlternatif))>0)){
            foreach($dataAlternatif as $xRow){
                $nilaiV = 0;
                foreach($dataKriteria as $yRow){
                    $nilai = DB::table('tbl_evaluasi')
                        ->join('tbl_matriks_saw','tbl_evaluasi.id_evaluasi','=','tbl_matriks_saw.id_evaluasi')
                        ->join('tbl_kriteria','tbl_evaluasi.id_kriteria','=','tbl_kriteria.id_kriteria')
                        ->join('tbl_bobot_kriteria','tbl_kriteria.id_kriteria','=','tbl_bobot_kriteria.id_kriteria')
                        ->where('tbl_evaluasi.id_kriteria','=',$yRow->id_kriteria)
                        ->where('tbl_evaluasi.id_alternatif','=',$xRow->id_alternatif)
                        ->first();
                    $nilaiV = $nilaiV + ($nilai->nilai_matriks*$nilai->nilai_kriteria);
                }
                $r = array(
                    'id_alternatif'=>$xRow->id_alternatif,
                    'nilai_vektor_saw'=>$nilaiV
                );
                array_push($dataInsert,$r);
            }
            DB::table('tbl_vektor_saw')->truncate();
            DB::table('tbl_vektor_saw')->insert($dataInsert);
        }
    }
    public static function SyncVectorVWP(){
        $dataAlternatif = DB::table('tbl_alternatif')->get();
        $dataKriteria = DB::table('tbl_kriteria')
                        ->join('tbl_bobot_kriteria','tbl_kriteria.id_kriteria','=','tbl_bobot_kriteria.id_kriteria')
                        ->get();
        $dataInsertVecWP = array();
        $sum = 0;
        if(count(json_decode(json_encode($dataAlternatif)))>0){
            foreach($dataAlternatif as $xRow){
                $nilai = 1;
                foreach($dataKriteria as $yRow){
                    $nilaiEvaluasi = DB::table('tbl_evaluasi')
                                    ->where('id_alternatif','=',$xRow->id_alternatif)
                                    ->where('id_kriteria','=',$yRow->id_kriteria)->first();
                    $nilai = $nilai * pow($nilaiEvaluasi->nilai,$yRow->nilai_bobot);
                }
                $r = array(
                    'id_alternatif'=>$xRow->id_alternatif,
                    'nilai_vektor_s'=>$nilai
                );
                array_push($dataInsertVecWP,$r);
                $sum = $sum + $nilai;
            }
            for($x=0;$x<count($dataInsertVecWP);$x++){
                $dataInsertVecWP[$x]['nilai_vektor_v'] = $dataInsertVecWP[$x]['nilai_vektor_s'] / $sum;
            }
            DB::table('tbl_vektor_wp')->truncate();
            DB::table('tbl_vektor_wp')->insert($dataInsertVecWP);
        }
    }
}