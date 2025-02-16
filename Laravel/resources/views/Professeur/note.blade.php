<!DOCTYPE html>
<html style="background-color: white;" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Google Font: Source Sans Pro -->
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

    <title>Select Group and Subject</title>
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
                            <h1 class="m-0">Select Group and Subject</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('professeur.dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item active">Notes</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="container">
                            <h1 class="mt-2">Select Group and Subject
                                {{-- <span style="font-weight: bolder"> {{ ucfirst($currentGroupe->designation) }} </span> --}}
                            </h1>
                            <form method="post"
                                action="
                            {{ url('professeur/note') }}
                            "
                                class="form_customized needs-validation" autocomplete="off" novalidate
                                enctype="multipart/form-data">
                                @csrf
                                @method('post')
                                <div class="container mt-5">
                                    <div class="row justify-content-center">
                                        <div class="col-12 col-md-6">
                                            <div class="row g-2">
                                                <div class="col-6">
                                                    <label for="groupe_id" class="form-label"
                                                        style="text-align: center">Group</label>
                                                    <select required name="groupe_id" id="groupe_id"
                                                        class="form-control select3" style="width: 100%;">
                                                        <option value="" disabled selected="selected">Select The
                                                            Group
                                                        </option>
                                                        @foreach ($groupes as $groupe)
                                                            <option value="{{ $groupe->id }}">
                                                                {{ $groupe->designation }}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="valid-feedback">
                                                        Looks good!
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        Please select the Group.
                                                    </div>
                                                </div>


                                                <div class="col-6">
                                                    <label for="module_id" class="form-label"
                                                        style="text-align: center">Subject</label>
                                                    <select required name="module_id" id="module_id"
                                                        class="form-control select3" style="width: 100%;">
                                                        <option value="" disabled selected="selected">Select The
                                                            Subject
                                                        </option>
                                                        @foreach ($modules as $module)
                                                            <option value="{{ $module->id }}">
                                                                {{ $module->designation }}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="valid-feedback">
                                                        Looks good!
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        Please select the Subject.
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>


                                </div>

                                <div class="row justify-content-end mt-2">
                                    <button type="submit" class="btn_submit btn btn-primary mr-2"
                                        style="border-radius: 40px;padding-right:30px;padding-left:30px;">Search</button>
                                </div>
                            </form>
                            <div style="margin-bottom: 30px"></div>
                            <!-- ./col -->
                        </div>
                        <!-- /.row -->
                        <!-- Main row -->
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

</body>

</html>
