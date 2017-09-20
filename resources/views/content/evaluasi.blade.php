@extends('template')
@section('breadcrumb')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
    <li class="breadcrumb-item active">Evaluasi</li>
</ol>
@endsection
@section('content')
<div class="col-md-12 mb-12">
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#data" role="tab" aria-controls="profile"><i class="icon-basket-loaded"></i> Data Alternatif</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#matriks" role="tab" aria-controls="profile"><i class="icon-basket-loaded"></i> Table Matriks</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#vektor" role="tab" aria-controls="profile"><i class="icon-basket-loaded"></i> Table Vektor</a>
        </li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane active" id="data" role="tabpanel">
            <div class="col-md-7" id="formEditEvaluasi" style="display: none;">
                <div class="card">
                    <div class="card-header">
                        <strong>Edit Data Kriteria</strong>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="editIdKriteria">Nama Alternatif</label>
                            <div class="col-md-9">
                                <input type="text" id="namaEvaluasiAlternatif" class="form-control" placeholder="ID Kriteria" readonly>
                            </div>
                        </div>
                        {!! Form::open(array('id'=>'formEvaluasiAlternatif')) !!}
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kriteria</th>
                                    <th>Nilai Kriteria</th>
                                </tr>
                            </thead>
                            <tbody id="bodyEditKriteria">
                            
                            </tbody>
                        </table>
                        {!! Form::close() !!}
                    </div>
                    <div class="card-footer">
                        <button id="saveEvaluasi" type="submit" class="btn btn-sm btn-primary"><i class="icon-plus"></i> Submit</button>
                        <button id="cancelEvaluasi" type="button" class="btn btn-sm btn-danger"><i class="icon-close"></i> Cancel</button>
                    </div>
                </div>
            </div>

            <table class="table table-bordered">
                <thead id="tableHeading"></thead>
                <tbody id="tableBody"></tbody>
            </table>
        </div>
        <div class="tab-pane" id="matriks" role="tabpanel">
            <table class="table table-bordered">
                <thead id="tableHeadingMatriks"></thead>
                <tbody id="tableBodyMatriks"></tbody>
            </table>
        </div>
        <div class="tab-pane" id="vektor" role="tabpanel">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Tabel Vektor WightedProduct</strong>
                    </div>
                    <div class="card-body">            
                        <table class="table table-bordered" id="tblVectorWP">
                            <thead>
                                <th>ID Alternatif</th>
                                <th>Nama Alternatif</th>
                                <th>Nilai Vektor S WP</th>
                                <th>Nilai Vektor V WP</th>
                            </thead>
                        </table>            
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Tabel Vektor WightedProduct</strong>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered" id="tblVectorSAW">
                            <thead>
                                <th>ID Alternatif</th>
                                <th>Nama Alternatif</th>
                                <th>Nilai Vektor V SAW</th>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
@section('jsAjax')
<script>
$(document).ready(function(){
    loadEvaluasi()
    loadMatriks()
    loadWP()
    loadSAW()
});
$(document).on('click','.editEvaluasi',function(){
    var id = $(this).attr('data-id');
    $.post("{{ url('evaluasi/get') }}", {
        "_token": "{{ csrf_token() }}",
        "id_alternatif": id
    },
    function (response) {
        var alternatif = response.alternatif;
        var evaluasi = response.evaluasi;
        var bodyInput = "";
        $('#namaEvaluasiAlternatif').val(alternatif.nama_alternatif);
        $('#bodyEditKriteria').empty();
        $.each(evaluasi,function(i,item){
            no = i + 1;
            bodyInput = "";
            bodyInput += "<tr>";
            bodyInput += "<td><center>"+no+"</center></td>";
            bodyInput += "<td><input type='hidden' name='id_kriteria[]' value='"+item.id_kriteria+"'>";
            bodyInput += "<input type='hidden' name='id_evaluasi[]' value='"+item.id_evaluasi+"'>";
            bodyInput += "<input type='hidden' name='id_alternatif[]' value='"+item.id_alternatif+"'>";
            bodyInput += item.nama_kriteria + "</td>";
            bodyInput += "<td><input type='number' class='form-control' name='nilai[]' value='"+item.nilai+"'></td>";
            bodyInput += "</tr>";
            $('#bodyEditKriteria').append(bodyInput);
        });
    }, "json").done(function(){
        $('#formEditEvaluasi').fadeIn();
    });
});
$(document).on('click','#saveEvaluasi',function(){
    var data = $('#formEvaluasiAlternatif').serialize();
    $.ajax({
        url:"{{ url('evaluasi/update') }}",
        data:data,
        cache:false,
        dataType:'json',
        type:'post',
        success:function(response){
            $.toast({
                heading: 'Information',
                text: response.message,
                position: 'bottom-right',
                stack: false,
                showHideTransition: 'slide',
                icon: response.status
            }); 
            $('#formEditEvaluasi').fadeOut();            
            loadEvaluasi()
        },
        complete:function(){
            loadMatriks()
            $("#tblVectorSAW").DataTable().ajax.reload();
            $("#tblVectorWP").DataTable().ajax.reload();
        }
    });
});
$(document).on('click','#cancelEvaluasi',function(){
    $('#formEditEvaluasi').fadeOut();
});
function loadEvaluasi(){
    $.ajax({
        url:"{{ url('evaluasi/list') }}",
        cache:false,
        dataType:'json',
        type:'get',
        success:function(response){
            var heading = "";
            var rows = "";
            $('#tableHeading').empty();
            $('#tableBody').empty();
            heading += '<tr><th><center>Nama Alternatif</center></th>';
            var alternatif = response.alternatif;
            var kriteria = response.kriteria;
            var evaluasi = response.evaluasi;
            $.each(kriteria,function(i,item){
                heading += '<th><center>'+ item.nama_kriteria +'</center></th>';
            });
            $.each(alternatif,function(i,item){ 
                rows = "";
                rows += '<tr><td>'+item.nama_alternatif+'</td>';
                for(e=0;e<evaluasi[i].length;e++){
                    rows += '<td><center>'+evaluasi[i][e]+'</center></td>';
                }
                rows += '<td><button class="btn btn-sm btn-primary editEvaluasi" data-id="'+ item.id_alternatif +'"><i class="fa fa-cogs"></i> Edit</button></td>';
                rows += '</tr>';
                $('#tableBody').append(rows);
            });
            heading += '<th width="7%"><center>Action</center></th></tr>';
            $('#tableHeading').append(heading);
            console.log(response);
        }
    });
}
function loadMatriks(){
    $.ajax({
        url:"{{ url('evaluasi/mat') }}",
        cache:false,
        dataType:'json',
        type:'get',
        success:function(response){
            var heading = "";
            var rows = "";
            $('#tableHeadingMatriks').empty();
            $('#tableBodyMatriks').empty();
            heading += '<tr><th><center>Nama Alternatif</center></th>';
            var alternatif = response.alternatif;
            var kriteria = response.kriteria;
            var evaluasi = response.evaluasi;
            $.each(kriteria,function(i,item){
                heading += '<th><center>'+ item.nama_kriteria +'</center></th>';
            });
            $.each(alternatif,function(i,item){ 
                rows = "";
                rows += '<tr><td>'+item.nama_alternatif+'</td>';
                for(e=0;e<evaluasi[i].length;e++){
                    rows += '<td><center>'+evaluasi[i][e]+'</center></td>';
                }
                rows += '</tr>';
                $('#tableBodyMatriks').append(rows);
            });
            heading += '</tr>';
            $('#tableHeadingMatriks').append(heading);
            console.log(response);
        }
    });
}
function loadWP(){
    var table = $("#tblVectorSAW").DataTable({
        processing: true,
        serverSide: true,
        ordering:false,
        autoWidth: false,
        ajax: "{{ url('table/saw')}}",
        language: {
            "emptyTable":"Tidak Ada Data SAW Tersimpan"
        },
        columns: [
            {data: 'id_alternatif',
                render:function(data,type,row){
                    return data;
                },'width':'13%'
            },
            {data: 'nama_alternatif'},
            {data: 'nilai_vektor_saw'}
        ]
    });
}
function loadSAW(){
    var table = $("#tblVectorWP").DataTable({
        processing: true,
        serverSide: true,
        ordering:false,
        autoWidth: false,
        ajax: "{{ url('table/wp')}}",
        language: {
            "emptyTable":"Tidak Ada Data WP Tersimpan"
        },
        columns: [
            {data: 'id_alternatif',
                render:function(data,type,row){
                    return data;
                },'width':'13%'
            },
            {data: 'nama_alternatif'},
            {data: 'nilai_vektor_s'},
            {data: 'nilai_vektor_v'}
        ]
    });
}
</script>
@endsection