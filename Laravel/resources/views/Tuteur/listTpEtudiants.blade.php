<!DOCTYPE html>
<html style="background-color: white;" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Google Font: Source Sans Pro -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
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
        }

        .card-img {
            /* background-color: #ffcaa6; */
            border-radius: .5rem;
            transition: .3s ease;
        }

        /*Hover*/
        .card-img:hover {
            transform: translateY(-8%);
        }
    </style>

    <title>Homeworks</title>
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
            <!-- Content Header (Page header) -->
            <div class="content-header mt-5">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">List Homeworks </h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="#">Homeworks</a></li>
                                <li class="breadcrumb-item active">List Homeworks
                                </li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <h1 class="mt-2">List Homeworks:
            </h1>

            <section class="content">
                @foreach ($enfants as $enfant)
                    <h1 class="mt-2" style="text-align: center">
                        <span style="font-weight: bolder">{{ ucfirst($enfant['prenom']) }}
                            {{ ucfirst($enfant['nom']) }}</span>
                    </h1>
                    <div class="container-fluid">
                        <!-- Small boxes (Stat box) -->
                        <div class="container">
                            <div class="row mt-4">
                                @foreach ($enfant['listTp'] as $tp)
                                    <div class="col-md-4 justify-content-center">
                                        <div class="p-3 d-flex align-content-start flex-wrap">
                                            <div style="
                                            background-color: rgb(184, 228, 245); box-shadow: 0px 9px 13px 0px rgb(0 0 0 / 53%);border-radius: 20px; min-width: 335px;"
                                                class="position-relative p-3 card1 overflow-hidden sm:rounded-lg layer"
                                                style="width: 250px;">
                                                @if (in_array($tp->id, $enfant['tp_Done']))
                                                    <div class="ribbon-wrapper">
                                                        <div class="ribbon bg-success">
                                                            Done
                                                        </div>
                                                    </div>
                                                @endif
                                                <!-- Set a fixed width, for example, 250px -->
                                                <div class="mt-1">
                                                    <b> Subject:</b> {{ $tp->sujet }}
                                                </div>
                                                <div class="mt-3">
                                                    <b>Module:</b> {{ $tp->module->designation }}
                                                </div>
                                                <div class="mt-3">
                                                    <b>Deadline:</b> <span
                                                        style="color: rgb(204, 5, 5)">{{ $tp->dateFin }}</span> <br>
                                                </div>
                                                <div style="text-align: center;">
                                                    <a href="{{ asset('img' . $tp->description) }}" target="_blank"
                                                        class="btn btn_discover mt-2">
                                                        Description
                                                    </a><br>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <div style="margin-bottom: 30px"></div>
                                <!-- ./col -->
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->
                    <!-- Main row -->
                @endforeach
            </section>
            <!-- /.content -->
        </div>

        <!-- REQUIRED SCRIPTS -->
        <!-- jQuery -->
        <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
        <!-- Bootstrap -->
        <script src="{{ asset('Template/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
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

        <script>
            //For Select Multiple Students
            $(document).ready(function() {
                $('#etudiant_id').select2();

                $('form.form_customized').on('reset', function() {
                    // Reset Select2 elements
                    setTimeout(function() {
                        console.log($('.select2').select2().val());
                    }, 100);
                });
            });

            function submitForm(tpId) {
                var fileInput = document.getElementById('devoir' + tpId);

                if (fileInput.files.length === 0) {
                    alert('Please select a file.');
                } else {
                    document.getElementById('upload_form' + tpId).submit();
                }
            }
        </script>


</body>

</html>
