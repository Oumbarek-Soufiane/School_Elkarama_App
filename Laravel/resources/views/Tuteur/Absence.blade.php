<!DOCTYPE html>
<html style="background-color: white;" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="{{ asset('css/Lists.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Checkbox.css') }}">

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <style>
        .row .col-6 {
            margin-top: 13px
        }

        .form-label {
            color: rgb(87, 85, 85) !important;
        }

        .form-control {
            border-radius: 5px;
            border-color: rgb(180, 177, 177) !important;
            /* Set the border color with !important */
            /* Set the background color to white */
        }

        .form_customized .form-control {
            background-color: white !important;
            color: black !important;
        }

        .form_customized .select3-container .select3-selection--single {
            background-color: #ccc !important;
            border: 1px solid #ced4da !important;
        }

        .form_customized .select3-container--default .select3-selection--single .select3-selection__rendered {
            color: #333 !important;
        }

        .form_customized .select3-container--default .select3-results__option {
            background-color: #ccc !important;
        }


        .select2-container .select2-search input {
            color: black !important;
        }

        .select2-results__message {
            background-color: white !important;
        }
    </style>

    <title>Absences</title>
</head>

<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img src="{{ asset('img/logo.png') }}" alt="AIM_Logo" style="max-width: 100%; height: auto;">
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ route('home') }}" class="nav-link">Home</a>
                </li>
            </ul>

        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4 ">
            @include('layout.sidebar')
        </aside>
        <div class="content-wrapper bg-white">
            <!-- Main content -->
            {{-- <div class="content-wrapper bg-white"> --}}
            <!-- Content Header (Page header) -->
            <div class="content-header mt-5">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0"></h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('etudiant.dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">List Marks</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>

            <section class="content">
                <div class="container-fluid">
                    <div class="table-wrapper" style="width: 100%">
                        <h1 class="text-center">Absences</h1>
                        @if (count($absences) > 0)
                            <table style="width: 100%; margin-bottom: 60px;">
                                <thead>
                                    <th>Full Name</th>
                                    <th>Date</th>
                                    <th>Module</th>
                                    <th>08:00 -> 10:00</th>
                                    <th>10:00 -> 12:00</th>
                                    <th>13:00 -> 15:00</th>
                                    <th>15:00 -> 17:00</th>
                                </thead>
                                <tbody>
                                    @foreach ($absences as $absence)
                                        <tr>
                                            <th>
                                                {{ $absence->etudiant->user->nom . ' ' . $absence->etudiant->user->prenom }}
                                            </th>
                                            <th>
                                                {{ $absence->created_at }}
                                            </th>
                                            <th>
                                                {{ $absence->module->designation }}
                                            </th>
                                            <th>
                                                <label for="dates1" class="menuButton">
                                                    <input id="dates1" type="checkbox" name="dates[]"
                                                        {{ $absence->seance1 ? 'checked' : '' }}
                                                        onclick="return false;" />
                                                    <span class="top"></span>
                                                    <span class="mid"></span>
                                                    <span class="bot"></span>
                                                </label>
                                            </th>
                                            <th>
                                                <label for="dates2" class="menuButton">
                                                    <input id="dates2" type="checkbox" name="dates[]"
                                                        {{ $absence->seance2 ? 'checked' : '' }}
                                                        onclick="return false;" />
                                                    <span class="top"></span>
                                                    <span class="mid"></span>
                                                    <span class="bot"></span>
                                                </label>
                                            </th>
                                            <th>
                                                <label for="dates3" class="menuButton">
                                                    <input id="dates3" type="checkbox" name="dates[]"
                                                        {{ $absence->seance3 ? 'checked' : '' }}
                                                        onclick="return false;" />
                                                    <span class="top"></span>
                                                    <span class="mid"></span>
                                                    <span class="bot"></span>
                                                </label>
                                            </th>
                                            <th>
                                                <label for="dates4" class="menuButton">
                                                    <input id="dates4" type="checkbox" name="dates[]"
                                                        {{ $absence->seance4 ? 'checked' : '' }}
                                                        onclick="return false;" />
                                                    <span class="top"></span>
                                                    <span class="mid"></span>
                                                    <span class="bot"></span>
                                                </label>
                                            </th>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <h3 class="text-center">There's no Absences</h3>
                        @endif


                    </div>
                </div>
            </section>

            <!-- /.content -->
            {{-- </div> <!-- /.content --> --}}
        </div>

        <!-- REQUIRED SCRIPTS -->
        <!-- jQuery -->
        <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
        <!-- overlayScrollbars -->
        <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset('dist/js/adminlte.js') }}"></script>

        <!-- PAGE PLUGINS -->
        <!-- Select2 -->
        <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
        <!-- jQuery Mapael -->
        <script src="{{ asset('plugins/jquery-mousewheel/jquery.mousewheel.js') }}"></script>
        <script src="{{ asset('plugins/raphael/raphael.min.js') }}"></script>
        <script src="{{ asset('plugins/jquery-mapael/jquery.mapael.min.js') }}"></script>
        <script src="{{ asset('js/errors_triger_bootstrap.js') }}"></script>

</body>

</html>
