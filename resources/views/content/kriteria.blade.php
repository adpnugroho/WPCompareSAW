@extends('template') 
@section('breadcrumb')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
    <li class="breadcrumb-item active">Kriteria</li>
</ol>
@endsection 
@section('content')
<div class="col-md-12 mb-12">
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#data" role="tab" aria-controls="profile"><i class="icon-basket-loaded"></i> Data Alternatif</a>
        </li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane active" id="data" role="tabpanel">
            <div class="col-md-7" id="editKriteria" style="display: none;">
                <div class="card">
                    <div class="card-header">
                        <strong>Edit Data Kriteria</strong>
                    </div>
                    <div class="card-body">
                        {!! Form::open(array('id'=>'formEditKriteria','class'=>'form-horizontal')) !!}
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="editIdKriteria">ID Kriteria</label>
                            <div class="col-md-9">
                                <input type="text" id="editIdKriteria" name="id_kriteria" class="form-control" placeholder="ID Kriteria" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="editNamaKriteria">Nama</label>
                            <div class="col-md-9">
                                <input type="text" id="editNamaKriteria" name="nama_kriteria" class="form-control" placeholder="Nama Kriteria">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="editNilaiKriteria">Nilai</label>
                            <div class="col-md-9">
                                <input type="text" id="editNilaiKriteria" name="nilai_kriteria" class="form-control" placeholder="Nilai Kriteria">
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                    <div class="card-footer">
                        <button id="updateKriteria" type="submit" class="btn btn-sm btn-primary"><i class="icon-plus"></i> Submit</button>
                        <button id="cancelKriteria" type="button" class="btn btn-sm btn-danger"><i class="icon-close"></i> Cancel</button>
                    </div>
                </div>
            </div>

            <table class="table table-bordered" id="tableKriteria">
                <thead>
                    <th>No</th>
                    <th>Nama Kriteria</th>
                    <th>Nilai Kriteria</th>
                    <th>Bobot Kriteria</th>
                    <th>Action</th>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection
@section('jsAjax')
<script>
$(document).ready(function(){
    loadKriteria()
});
$(document).on('click','.editKriteria',function(){
    var id = $(this).attr('data-id');
    $.post("{{ url('kriteria/get') }}", {
        "_token": "{{ csrf_token() }}",
        "id_kriteria": id
    },
    function (response) {
        $('#editIdKriteria').val(response.id_kriteria);
        $('#editNamaKriteria').val(response.nama_kriteria);
        $('#editNilaiKriteria').val(response.nilai_kriteria);
    }, "json").done(function(){
        $('#editKriteria').fadeIn();
    });
});
$(document).on('click','#updateKriteria',function(){
    var data = $('#formEditKriteria').serialize();
    $.ajax({
        url: "{{ url('kriteria/update') }}",
        data: data,
        type: 'post',
        dataType: 'json',
        cache: false,
        success: function (response) {
            $.toast({
                heading: 'Information',
                text: response.message,
                position: 'bottom-right',
                stack: false,
                showHideTransition: 'slide',
                icon: response.status
            });
            $('#formEditKriteria').trigger('reset');
            $('#editKriteria').fadeOut();
            $('#tableKriteria').DataTable().ajax.reload();
        },
        error: function (xhr, ajaxOptions, thrownError) {
            var error = xhr.responseJSON;
            var no = 0;
            var errorArray = [];
            $.each(error, function (key, value) {
                errorArray[no] = value[0];
                no++;
            });
            $.toast({
                heading: 'Kesalahan!',
                text: errorArray,
                icon: 'error',
                position: 'bottom-right'
            });
        }
    });
});
$(document).on('click','#cancelKriteria',function(){
    $('#editKriteria').fadeOut();
});
function loadKriteria(){
    var table = $("#tableKriteria").DataTable({
        processing: true,
        serverSide: true,
        destroy: true,
        autoWidth: false,
        ordering:false,
        ajax: "{{ url('table/kriteria')}}",
        language: {
            "emptyTable":"Tidak Ada Data Kriteria"
        },
        columns: [
            {data: 'id_kriteria',
                render:function(data,type,row){
                    return  '<center>'+data+'</center>';
                },'width':'7%'
            },
            {data: 'nama_kriteria'},
            {data: 'nilai_kriteria',
                render: function (data, type, row) {
                    return  '<center>'+data+'</center>';
                }
            },
            {data: 'nilai_bobot',
                render: function (data, type, row) {
                    return  '<center>'+data+'</center>';
                }
            },
            {data: 'id_kriteria',
                render: function (data, type, row) {
                    return  '<button class="editKriteria btn btn-primary" data-id='+data +'><i class="fa fa-cogs"></i>&nbsp;&nbsp;Edit</button>';
                },'width':'7%'
            }
        ]
    })
;}
</script>
@endsection