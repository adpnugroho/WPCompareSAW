<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="img/favicon.png">
    <title>Sistem Pendukung Keputusan Komparasi Weighted Product dan Simle Additive Weighted</title>
    
    <link href="{{ asset('css/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/simple-line-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery.toast.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dataTables.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .loadingSpinner {
            display:    none;
            position:   fixed;
            z-index:    1000;
            top:        0;
            left:       0;
            height:     100%;
            width:      100%;
            background: rgba( 255, 255, 255, .8 ) 
                        url('./gif/loader.gif') 
                        50% 50% 
                        no-repeat;
        }
        main.loading {
            overflow: hidden;   
        }
        main.loading .loadingSpinner {
            display: block;
        }
    </style>
</head>
<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
    <header class="app-header navbar">
        <button class="navbar-toggler mobile-sidebar-toggler d-lg-none mr-auto" type="button">☰</button>
        <a class="navbar-brand" href="#"></a>
        <button class="navbar-toggler sidebar-minimizer d-md-down-none" type="button">☰</button>

        <ul class="nav navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                    <img src="{{ asset('img/avatars/6.png') }}" class="img-avatar" alt="admin@bootstrapmaster.com">
                </a>
            </li>
        </ul>
        <button class="navbar-toggler" type="button">☰</button>
    </header>
    <div class="app-body">
        <div class="sidebar">
            <nav class="sidebar-nav">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}"><i class="icon-speedometer"></i> Dashboard </a>
                    </li>
                    <li class="nav-title">
                        Data Input
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/alternatif') }}"><i class="icon-people"></i> Alternatif </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/kriteria') }}"><i class="icon-list"></i> Kriteria </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/evaluasi') }}"><i class="icon-calculator"></i> Evaluasi </a>
                    </li>
                    <li class="nav-title">
                        Laporan
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/grafik') }}"><i class="icon-pie-chart"></i> Grafik</a>
                    </li>
                    <li class="divider"></li>
                </ul>
            </nav>
        </div>
        <!-- Main content -->
        <main class="main">
            @yield('breadcrumb')
            @yield('content')
            <div class="loadingSpinner"></div>
        </main>
    </div>
    <footer class="app-footer">
        <a href="#">Decision Support System Comparation WP & SAW</a> © 2017 - 14.01.074.
    </footer>
    <script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('bower_components/popper.js/index.js') }}"></script>
    <script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/DataTablesBS4.js') }}"></script>

    <script src="{{ asset('bower_components/pace/pace.min.js') }}"></script>
    <script src="{{ asset('bower_components/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/jquery.toast.js') }}"></script>
    <script>
        $main = $("main");
        $(document).on({
            ajaxStart: function() { $main.addClass("loading");    },
            ajaxStop: function() { $main.removeClass("loading"); }    
        });
    </script>
    @yield('jsAjax')
</body>
</html>