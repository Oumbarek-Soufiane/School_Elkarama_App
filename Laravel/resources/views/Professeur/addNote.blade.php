{{-- @dump($groupe_id)
@dump($module_id) --}}
<!DOCTYPE html>
<html style="background-color: white;" lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/Lists.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Slider_Safe_Mode.css') }}">

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
    {{-- <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}"> --}}
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

    <title>Form Notes {{ $groupe->designation }}</title>
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
                            <h1 class="m-0">Add Notes </h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('professeur.dashboard') }}">Select Group
                                        and Subject</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('professeur.notes') }}">Form Notes
                                        {{ $groupe->designation }}</a></li>
                                <li class="breadcrumb-item active">Add Notes</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                @if (!$notes->isEmpty())
                    <h1 class="mt-2 ml-5 mb-4">Updating Form Marks For<span style="font-weight: bolder">
                            {{ ucfirst($groupe->designation) }} </span> on Subject <span style="font-weight: bolder">
                            {{ ucfirst($module->designation) }} </span> </h1>
                    <div class="switch-container">
                        <label for="checkbox">Safe Mode</label>
                        <label class="switch">
                            <input type="checkbox" id="checkbox" onclick="toggleEditing()">
                            <div class="slider">
                                <span>On</span>
                                <span>Off</span>
                            </div>
                        </label>
                    </div>
                @else
                    <h1 class="mt-2 ml-5 mb-4">Form Marks For<span style="font-weight: bolder">
                            {{ ucfirst($groupe->designation) }} </span> on Subject <span style="font-weight: bolder">
                            {{ ucfirst($module->designation) }} </span> </h1>
                @endif
                <div class="table-wrapper" style="width: 100%">
                    <form method="POST" class="form_customized needs-validation"
                        action="{{ route('professeur.storeNote', ['groupe_id' => $groupe_id, 'module_id' => $module_id]) }}">
                        @method('post')
                        @csrf
                        <div class="container-fluid">
                            <div class="justify-content-center">
                                <div class="table-wrapper">
                                    <table style="width: 100%">
                                        <thead>
                                            <th>Etudiant</th>
                                            <th>Exam 1</th>
                                            <th>Exam 2</th>
                                            <th>Final Exam</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($etudiants as $etudiant)
                                                <tr>
                                                    <td>{{ $etudiant->user->nom }} {{ $etudiant->user->prenom }}</td>
                                                    <td><input name="exams[{{ $etudiant->id }}][controle_1]"
                                                            {{ !$notes->isEmpty() ? 'readonly' : '' }}
                                                            id="exam1{{ $etudiant->id }}" type="number" step="0.01"
                                                            min="0" max="20" class="form-control"
                                                            value="{{ $notes->where('etudiant_id', $etudiant->id)->first()->controle_1 ?? '' }}">
                                                    </td>
                                                    <td><input name="exams[{{ $etudiant->id }}][controle_2]"
                                                            {{ !$notes->isEmpty() ? 'readonly' : '' }}
                                                            id="exam2{{ $etudiant->id }}" type="number" step="0.01"
                                                            min="0" max="20" class="form-control"
                                                            value="{{ $notes->where('etudiant_id', $etudiant->id)->first()->controle_2 ?? '' }}">
                                                    </td>
                                                    <td><input name="exams[{{ $etudiant->id }}][exam]"
                                                            {{ !$notes->isEmpty() ? 'readonly' : '' }}
                                                            id="examFinal{{ $etudiant->id }}" type="number"
                                                            step="0.01" min="0" max="20"
                                                            class="form-control"
                                                            value="{{ $notes->where('etudiant_id', $etudiant->id)->first()->exam ?? '' }}">
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-end mt-2 mr-auto">
                            <input type="text" name="groupe_id" id="groupe_id" value={{ $groupe_id }} hidden>
                            <input type="text" name="module_id" id="module_id" value={{ $module_id }} hidden>
                            <button type="submit" class="btn_submit btn btn-primary mr-2"
                                style="border-radius: 40px;padding-right:30px;padding-left:30px;">ADD</button>
                            <button type="reset" class="btn_reset btn btn-secondary"
                                style="border-radius: 40px;padding-right:30px;padding-left:30px;">Reset</button>
                        </div>
                    </form>
                    <div style="margin-bottom: 30px"></div>
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

        <script>
            function toggleEditing() {
                var inputFields = document.getElementsByClassName('form-control');
                var AllowButton = document.getElementById('saveButton');
                // Convert HTMLCollection to an array inputFields->inputFieldsArray
                var inputFieldsArray = Array.from(inputFields);
                inputFieldsArray.forEach(element => {
                    console.log(element);
                    element.readOnly = !element.readOnly;
                });
                AllowButton.style.display = inputFieldsArray[0].readOnly ? 'none' : 'inline-block';
            }
        </script>

        {{-- <!-- PAGE PLUGINS -->
<!-- Select2 -->
<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
<!-- jQuery Mapael -->
<script src="{{ asset('plugins/jquery-mousewheel/jquery.mousewheel.js') }}"></script>
<script src="{{ asset('plugins/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-mapael/jquery.mapael.min.js') }}"></script>
<script src="{{ asset('js/errors_triger_bootstrap.js') }}"></script> --}}
</body>

</html>
