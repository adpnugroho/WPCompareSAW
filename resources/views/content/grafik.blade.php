@extends('template') 
@section('breadcrumb')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
    <li class="breadcrumb-item active">Grafik</li>
    <li class="breadcrumb-menu d-md-down-none">
        <div class="btn-group" role="group" aria-label="Button group">
            <button class="btn btn-sm btn-default" id="refreshGrafik"><i class="icon-refresh"></i> &nbsp;Refresh</button>
        </div>
    </li>
</ol>
@endsection 

@section('content')
<div class="container-fluid">
    <div class="animated fadeIn">

        <div id="panelChart">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            Grafik WP
                        </div>
                        <div class="card-body">
                            <div class="chart-wrapper" id="wpCanvas">
                                <canvas id="canvas-wp"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            Grafik SAW
                        </div>
                        <div class="card-body">
                            <div class="chart-wrapper" id="sawCanvas">
                                <canvas id="canvas-saw"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="panelWarning" style="display:none;">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            Info
                        </div>
                        <div class="card-body">
                            <h1>Tidak Ada Data Vektor WP dan SAW</h1>
                        </div>
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
    loadChart()
});
$(document).on('click','#refreshGrafik',function(){
    $('#wpCanvas').empty();
    $('#wpCanvas').append('<canvas id="canvas-wp"></canvas>');
    $('#sawCanvas').empty();
    $('#sawCanvas').append('<canvas id="canvas-saw"></canvas>');
    loadChart()
});
function loadChart(){
    $.ajax({
        url:"{{ url('data/grafik') }}",
        cache:false,
        dataType:'json',
        type:'get',
        success:function(response){
            if(response.status){
                var wp = response.wp;
                var saw = response.saw;
                var wpChart = new Chart(document.getElementById('canvas-wp'), {
                    type: 'bar',
                    data: wp,
                    options: {
                        responsive: true
                    }
                });
                var sawChart = new Chart(document.getElementById('canvas-saw'), {
                    type: 'bar',
                    data: saw,
                    options: {
                        responsive: true
                    }
                });
            }else{
                $('#panelWarning').fadeIn();
                $('#panelChart').fadeOut();
            }
        }
    });
}
</script>
@endsection