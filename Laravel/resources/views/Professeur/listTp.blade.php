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
                            <h1 class="m-0">List Homeworks {{ ucfirst($groupe->designation) }} </h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="#">Homeworks</a></li>
                                <li class="breadcrumb-item active">List Homeworks {{ ucfirst($groupe->designation) }}
                                </li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <h1 class="mt-2 ml-3">List Homeworks:
                    <span style="font-weight: bolder">{{ ucfirst($groupe->filiere->designation) }}</span>
                    =>
                    <span style="font-weight: bolder">{{ ucfirst($groupe->designation) }}</span>

                </h1>
                {{-- <div class="container-fluid"> --}}
                    <!-- Small boxes (Stat box) -->
                    {{-- <div class=""> --}}
                        <div class="container-fluid row2 mt-4 mx-auto" style="overflow-x: scroll ! important;">
                            @foreach ($tps as $tp)
                                <div class="col-md-4 justify-content-center">
                                    <div class=" d-flex align-content-start flex-wrap">
                                        <div style="
                                            background-color: rgb(184, 228, 245); box-shadow: 0px 9px 13px 0px rgb(0 0 0 / 53%);border-radius: 20px; min-width: 335px;"
                                            class="p-3 card1 overflow-hidden sm:rounded-lg layer" style="width: 250px;">
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
                                                @if (auth()->user()->role == 'etudiant')
                                                    <form method="POST"
                                                        action="{{ url('etudiant/tp/submit/' . $tp->id) }}"
                                                        class="form_customized needs-validation"
                                                        id="upload_form{{ $tp->id }}" autocomplete="off"
                                                        novalidate enctype="multipart/form-data">
                                                        @csrf
                                                        @method('POST')
                                                        <div class="col-lg-6 mt-2"
                                                            style="margin-right: auto;margin-left: auto;">
                                                            <input type="text" name="tp_id" id="tp_id"
                                                                value="{{ $tp->id }}" hidden>
                                                            <div class="btn-group w-100">
                                                                <label for="devoir{{ $tp->id }}"
                                                                    class="btn btn-success col fileinput-button">
                                                                    <i class="fas fa-plus"></i>
                                                                    {{-- <label for="devoir" style="cursor: pointer">Add files</label> --}}
                                                                    <input required type="file"
                                                                        id="devoir{{ $tp->id }}" name="devoir"
                                                                        hidden>
                                                                </label>

                                                                <label for="submit{{ $tp->id }}"
                                                                    class="btn btn-primary col fileinput-button">
                                                                    <i class="fas fa-upload"></i>
                                                                    {{-- <label for="submit" style="cursor: pointer">Start upload</label> --}}
                                                                    <button type="button"
                                                                        onclick="submitForm('{{ $tp->id }}')"
                                                                        id="submit{{ $tp->id }}" hidden
                                                                        class="btn btn-primary col start">
                                                                    </button>
                                                                </label>


                                                            </div>
                                                        </div>
                                                    </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach


                            <div style="margin-bottom: 30px"></div>
                            <!-- ./col -->
                        </div>
                    {{-- </div> --}}
                {{-- </div> --}}
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
