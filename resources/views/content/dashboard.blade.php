@extends('template') 
@section('breadcrumb')
<ol class="breadcrumb">
    <li class="breadcrumb-item">Home</li>
    <li class="breadcrumb-item active">Dashboard</li>
    
    <li class="breadcrumb-menu d-md-down-none">
        <div class="btn-group" role="group" aria-label="Button group">
            <a class="btn" href="{{ url('/grafik') }}"><i class="icon-graph"></i> &nbsp;Grafik</a>
        </div>
    </li>
</ol>
@endsection 

@section('content')
<div class="container-fluid">
    <div class="animated fadeIn">

        <div class="row">
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body p-3 clearfix">
                        <i class="fa fa-users bg-success p-3 font-2xl mr-3 float-left"></i>
                        <div class="h5 text-primary mb-0 mt-2">{{ $alternatif }}</div>
                        <div class="text-muted text-uppercase font-weight-bold font-xs">Total Alternatif</div>
                    </div>
                    <div class="card-footer px-3 py-2">
                        <a class="font-weight-bold font-xs btn-block text-muted" href="{{ url('/alternatif') }}">Detail <i class="fa fa-angle-right float-right font-lg"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body p-3 clearfix">
                        <i class="fa fa-tasks bg-warning p-3 font-2xl mr-3 float-left"></i>
                        <div class="h5 text-primary mb-0 mt-2">{{ $kriteria }}</div>
                        <div class="text-muted text-uppercase font-weight-bold font-xs">Total Kriteria</div>
                    </div>
                    <div class="card-footer px-3 py-2">
                        <a class="font-weight-bold font-xs btn-block text-muted" href="{{ url('/kriteria') }}">Detail <i class="fa fa-angle-right float-right font-lg"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body p-3 clearfix">
                        <i class="fa fa-line-chart bg-danger p-3 font-2xl mr-3 float-left"></i>
                        <div class="text-primary mb-0 mt-2">{{ $wp }}</div>
                        <div class="text-muted text-uppercase font-weight-bold font-xs">Rank Tertinggi WP</div>
                    </div>
                    <div class="card-footer px-3 py-2">
                        <a class="font-weight-bold font-xs btn-block text-muted" href="{{ url('/grafik') }}">Detail <i class="fa fa-angle-right float-right font-lg"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body p-3 clearfix">
                        <i class="fa fa-area-chart bg-danger p-3 font-2xl mr-3 float-left"></i>
                        <div class="text-primary mb-0 mt-2">{{ $saw }}</div>
                        <div class="text-muted text-uppercase font-weight-bold font-xs">Rank Tertinggi SAW</div>
                    </div>
                    <div class="card-footer px-3 py-2">
                        <a class="font-weight-bold font-xs btn-block text-muted" href="{{ url('/grafik') }}">Detail <i class="fa fa-angle-right float-right font-lg"></i></a>
                    </div>
                </div>
            </div>

        </div>
        <div class="row">

            <div class="col-sm-12 col-md-12">
                <div class="card border-primary">
                    <div class="card-header">
                        Komparasi Metode DSS Weighted Product & Simple Additive Weighting
                    </div>
                    <div class="card-body">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce nisi nisi, consequat sed nisi nec,
                            euismod laoreet orci. Quisque commodo nec metus eu laoreet. Vivamus non tempor ligula. Donec
                            ut odio at arcu dictum fermentum in molestie eros. Suspendisse dignissim tellus erat, vel efficitur
                            massa vehicula sit amet. Nulla pretium ex quam, ac porta ex tinciduntnec. Morbi id suscipit nibh.
                            Aliquam rutrum congue lacus, quis tristique dui suscipit in. Sed ut nisi eros. Duis vestibu lum
                            malesuada metus ac tempus. Integer placerat nisi nec arcu placerat, eget tempus nisi feugiat.
                            In hac habitasse platea dictumst. Phasellus auctor congue mi, in egestas nulla ornare non. Aenean
                            faucibus pellentesque eleifend. Nullam tortor neque, sagittis sed sollicitudin mollis, volutpat
                            a lectus. Vestibulum ex nulla, tempor eu mauris at, iaculis lobortis nisi.
                        </p>


                        <p>Quisque ut elit id tellus consectetur blandit. Praesent sed ex tincidunt, pellentesque ipsum sit
                            amet, posuere eros. Nulla viverra eget purus nec lacinia. Aliquam pulvinar ipsum ac libero volutpat,
                            vel auctor felis interdum. Vivamus rhoncus at leo id blandit. Vivamus lobortis lacus ut nisl
                            facilisis lobortis. Nam mi mi, faucibus eget ullamcorper vitae, feugiat in lorem. Proin augue
                            ex, dignissim non sem quis, tempor volutpat odio. Donec efficitur et massa sed ornare. Nam posuere,
                            orci eu imperdiet elementum, erat ante malesuada sapien, a venenatis turpis velit id odio. Nam
                            eget elit sed arcu feugiat elementum.</p>

                        <p>Phasellus finibus pellentesque purus, vel dapibus neque vulputate et. Donec venenatis orci id porttitor
                            eleifend. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras ut metus ut nisl iaculis
                            mattis sit amet a orci. Nunc sed justo sed turpis dictum vulputate at ut tellus. Sed lacinia
                            ex nibh, ac ultricies diam sagittis ut. Vestibulum eu facilisis sapien. Praesent consequat erat
                            in arcu tempor hendrerit id sit amet velit. Donec eu massa ac quam porta ultricies ac vitae orci.
                            Nam in tellus nisl.</p>

                        <p>Integer a augue nisi. Vivamus sed diam vitae leo sagittis consequat. Vestibulum at justo sed est
                            sodales pharetra at id nisi. Mauris efficitur, nulla ac posuere faucibus, dolor mauris consectetur
                            massa, et iaculis erat lacus ac erat. Donec ultrices rhoncus turpis accumsan consectetur. Nunc
                            dictum lacus lectus, vel rutrum lacus pharetra eget. Donec euismod enim sed risus aliquam, sed
                            porta magna auctor. Quisque egestas nec massa vel sodales. Sed pretium, neque vitae congue convallis,
                            massa sem sagittis massa, sed ornare quam justo non neque. Donec fermentum ipsum at mattis porta.</p>

                        <p>Nulla vitae est leo. Maecenas venenatis cursus arcu, eget congue magna commodo tincidunt. Nam maximus
                            augue velit, non efficitur orci pretium in. Sed mollis at purus convallis auctor. Pellentesque
                            fringilla velit velit, a gravida nisi facilisis eget. Cras vitae rutrum est. Aliquam at interdum
                            neque. In maximus, lorem commodo fringilla molestie, eros turpis accumsan risus, vel cursus massa
                            purus eu justo. Cras malesuada feugiat leo. Sed dignissim finibus risus ac vehicula. Fusce vulputate
                            augue egestas fermentum lobortis. Vestibulum porta, libero in commodo dignissim, enim nisl commodo
                            erat, quis volutpat eros dolor et odio.</p>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
@endsection