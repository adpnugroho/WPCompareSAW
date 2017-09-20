@extends('template') 
@section('breadcrumb')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
    <li class="breadcrumb-item active">Alternatif</li>
</ol>
@endsection 
@section('content')

<div class="col-md-12 mb-12">
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#input" role="tab" aria-controls="home"><i class="icon-calculator"></i> Input Alternatif</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#data" role="tab" aria-controls="profile"><i class="icon-basket-loaded"></i> Data Alternatif</a>
        </li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane active" id="input" role="tabpanel">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header">
                        <strong>Input Data Alternatif Form</strong>
                    </div>
                    <div class="card-body">
                        {!! Form::open(array('id'=>'formAlternatif','class'=>'form-horizontal')) !!}
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="nama_alternatif">Nama</label>
                            <div class="col-md-9">
                                <input type="text" id="nama_alternatif" name="nama_alternatif" class="form-control" placeholder="Nama Alternatif">
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                    <div class="card-footer">
                        <button id="saveAlternatif" type="submit" class="btn btn-sm btn-primary"><i class="icon-plus"></i> Submit</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="data" role="tabpanel">
            <div class="col-md-7" id="EditAlt" style="display: none;">
                <div class="card">
                    <div class="card-header">
                        <strong>Edit Data Alternatif Form</strong>
                    </div>
                    <div class="card-body">
                        {!! Form::open(array('id'=>'formEditAlternatif','class'=>'form-horizontal')) !!}
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="editIdAlternatif">ID Alternatif</label>
                            <div class="col-md-9">
                                <input type="text" id="editIdAlternatif" name="id_alternatif" class="form-control" placeholder="ID Alternatif" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="editNamaAlternatif">Nama</label>
                            <div class="col-md-9">
                                <input type="text" id="editNamaAlternatif" name="nama_alternatif" class="form-control" placeholder="Nama Alternatif">
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                    <div class="card-footer">
                        <button id="updateAlternatif" type="submit" class="btn btn-sm btn-primary"><i class="icon-plus"></i> Submit</button>
                        <button id="cancelAlternatif" type="button" class="btn btn-sm btn-danger"><i class="icon-close"></i> Cancel</button>
                    </div>
                </div>
            </div>

            <table class="table table-bordered" id="tableAlternatif">
                <thead>
                    <th>No</th>
                    <th>Nama Alternatif</th>
                    <th>Action</th>
                </thead>
            </table>
        </div>
    </div>
</div>

@endsection 
@section('jsAjax')
<script>
    $(document).ready(function () {
        loadAlternatif()
    });
    function loadAlternatif(){
        var table = $("#tableAlternatif").DataTable({
            processing: true,
            serverSide: true,
            ordering:false,
            autoWidth: false,
            ajax: "{{ url('table/alternatif')}}",
            language: {
                "emptyTable":"Tidak Ada Data Alternatif Tersimpan"
            },
            columns: [
                {data: 'id_alternatif',
                    render:function(data,type,row){
                        return data;
                    },'width':'7%'
                },
                {data: 'nama_alternatif'},
                {data: 'id_alternatif',
                    render: function (data, type, row) {
                        return  '<button class="editAlternatif btn btn-sm btn-primary" data-id='+data +'><i class="fa fa-wrench"></i></button>' +
                                '<button class="deleteAlternatif btn btn-sm btn-danger" data-title="Hapus Admin ?" data-btn-ok-label="Ya" data-btn-cancel-label="Tidak" data-toggle="confirmation" data-placement="left" data-id='+data + '><i class="fa fa-trash-o"></i></button>';
                    },'width':'7%'
                }
            ]
        });
    }
    $(document).on('click', '#saveAlternatif', function () {
        var data = $('#formAlternatif').serialize();
        $.ajax({
            url: "{{ url('alternatif/save') }}",
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
                $('#formAlternatif').trigger('reset');
                $('#tableAlternatif').DataTable().ajax.reload();
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
    $(document).on('click', '#updateAlternatif', function () {
        var data = $('#formEditAlternatif').serialize();
        $.ajax({
            url: "{{ url('alternatif/update') }}",
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
                $('#formEditAlternatif').trigger('reset');
                $('#EditAlt').fadeOut();
                $('#tableAlternatif').DataTable().ajax.reload();
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
    $(document).on('click', '.editAlternatif', function () {
        var id = $(this).attr('data-id');
        $.post("{{ url('alternatif/get') }}", {
            "_token": "{{ csrf_token() }}",
            "id_alternatif": id
        },
        function (response) {
            $('#editIdAlternatif').val(response.id_alternatif);
            $('#editNamaAlternatif').val(response.nama_alternatif);
        }, "json").done(function(){
            $('#EditAlt').fadeIn();
        });
    });
    $(document).on('click','#cancelAlternatif',function(){
        $('#EditAlt').fadeOut();
    });
    $(document).on('click', '.deleteAlternatif', function () {
        var id = $(this).attr('data-id');
        $.post("{{ url('alternatif/delete') }}", {
            "_token": "{{ csrf_token() }}",
            "id_alternatif": id
        },
        function (response) {
            $.toast({
                heading: 'Information',
                text: response.message,
                position: 'bottom-right',
                stack: false,
                showHideTransition: 'slide',
                icon: response.status
            });
        }, "json").done(function(){
            $('#tableAlternatif').DataTable().ajax.reload();
        });
    });
</script>
@endsection