<?php
$roleOfCurrentPage = explode('/', request()->path())[2];
$roleDisplayed = '';
if ($roleOfCurrentPage == 'etudiant') {
    $roleDisplayed = 'Student';
} elseif ($roleOfCurrentPage == 'tuteur') {
    $roleDisplayed = 'Parent';
} elseif ($roleOfCurrentPage == 'professeur') {
    $roleDisplayed = 'Teacher';
}

?>
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

    <title>Add {{ $roleDisplayed }}</title>
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
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link">Admin</a>
                </li>
            </ul>

        </nav>
        <!-- /.navbar -->
        @include('layout.sidebar')
        <div class="content-wrapper bg-white">
            <!-- Content Header (Page header) -->
            <div class="content-header mt-5">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Add {{ $roleDisplayed }}</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="#">{{ $roleDisplayed }}</a></li>
                                <li class="breadcrumb-item active">Add {{ $roleDisplayed }}</li>
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
                            <h1 class="mt-2">Add {{ $roleDisplayed }}</h1>
                            <form method="post" action="{{ url('admin/' . $roleOfCurrentPage) }}"
                                class="form_customized needs-validation" autocomplete="off" novalidate
                                enctype="multipart/form-data">
                                @csrf
                                @method('post')
                                <div class="row g-3">
                                    <div class="col-6 col-md-4">
                                        <label for="prenom" class="form-label" style="text-align: center">
                                            First Name</label>
                                        <input required name="prenom" id="prenom" type="text"
                                            class="form-control" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                            Please enter the First Name.
                                        </div>
                                    </div>

                                    <div class="col-6 col-md-4">
                                        <label for="nom" class="form-label">Last Name</label>
                                        <input required name="nom" id="nom" type="text"
                                            class="form-control">
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                            Please enter the Last Name.
                                        </div>
                                    </div>

                                    <div class="col-6 col-md-4 form-group">
                                        <label for="genre" class="form-label">Gender</label>
                                        <select required name="genre" id="genre" class="form-control select3"
                                            style="width: 100%;">
                                            <option value="" disabled selected="selected">Select The Gender
                                            </option>
                                            <option value="M">Male</option>
                                            <option value="F">Female</option>
                                        </select>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                            Please select the Gender.
                                        </div>
                                    </div>

                                    <div class="col-6 col-md-4">
                                        <label for="email" class="form-label" style="text-align: center">
                                            Email Adress</label>
                                        <input required name="email" id="email" type="email"
                                            class="form-control">
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                            Please enter the Email Adress.
                                        </div>
                                    </div>

                                    <div class="col-6 col-md-4">
                                        <label for="password" class="form-label">Password</label>
                                        <input required name="password" id="password" type="password"
                                            class="form-control">
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                            Please enter the Password.
                                        </div>
                                    </div>

                                    <div class="col-6 col-md-4">
                                        <label for="numeroTelephone" class="form-label">Phone Number</label>
                                        <input required name="numeroTelephone" id="numeroTelephone" type="tel"
                                            class="form-control">

                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                            Please enter the Phone Number.
                                        </div>
                                    </div>
                                    @if ($roleOfCurrentPage == 'etudiant' || $roleOfCurrentPage == 'professeur')
                                        <div class="col-6 col-md-4">
                                            <label for="filiere_id" class="form-label" style="text-align: center">
                                                Major </label>
                                            <select required name="filiere_id" id="filiere_id"
                                                class="form-control select3" style="width: 100%;">
                                                <option value="" disabled selected="selected">Select Major
                                                </option>
                                                @foreach ($filieres as $filiere)
                                                    <option value={{ $filiere->id }}>{{ $filiere->designation }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                            <div class="invalid-feedback">
                                                Please select the Major.
                                            </div>
                                        </div>
                                        @if ($roleOfCurrentPage == 'etudiant')
                                            <div class="col-6 col-md-4">
                                                <label for="couvertureMedicale" class="form-label"
                                                    style="text-align: center">
                                                    Couverture Medicale</label>
                                                <input required name="couvertureMedicale" id="couvertureMedicale"
                                                    type="text" class="form-control" required>
                                                <div class="valid-feedback">
                                                    Looks good!
                                                </div>
                                                <div class="invalid-feedback">
                                                    Please enter the Diploma.
                                                </div>
                                            </div>
                                        @endif
                                    @endif

                                    <div class="col-6 col-md-4">
                                        <label for="dateNaissance" class="form-label">Birth Date</label>
                                        <input required name="dateNaissance" id="dateNaissance" type="date"
                                            class="form-control">
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                            Please enter the Birth Date.
                                        </div>
                                    </div>

                                    <div class="col-6 col-md-4">
                                        <label for="situationFamiliale" class="form-label">Family Situation</label>
                                        <select required name="situationFamiliale" id="situationFamiliale"
                                            class="form-control select3" style="width: 100%;">
                                            <option value="" disabled selected="selected">Select Family
                                                Situation
                                            </option>
                                            <option value="celibataire">Single</option>
                                            <option value="marier">Married</option>
                                            <option value="divorcer">Divorced</option>
                                        </select>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                            Please select the Family Situation.
                                        </div>
                                    </div>

                                    @if ($roleOfCurrentPage == 'professeur')
                                        <div class="col-6 col-md-4">
                                            <label for="diplome" class="form-label" style="text-align: center">
                                                Diploma</label>
                                            <input required name="diplome" id="diplome" type="text"
                                                class="form-control" required>
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                            <div class="invalid-feedback">
                                                Please enter the Diploma.
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-4">
                                            <label for="dateEmbauche" class="form-label" style="text-align: center">
                                                Hiring Date</label>
                                            <input required name="dateEmbauche" id="dateEmbauche" type="date"
                                                class="form-control" required>
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                            <div class="invalid-feedback">
                                                Please enter the Hiring Date.
                                            </div>
                                        </div>

                                        <div class="col-6 col-md-4">
                                            <label for="salaire" class="form-label" style="text-align: center">
                                                Salary</label>
                                            <input required name="salaire" id="salaire" type="number"
                                                step="0.01" class="form-control" required>
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                            <div class="invalid-feedback">
                                                Please enter the Salary.
                                            </div>
                                        </div>
                                    @elseif($roleOfCurrentPage == 'tuteur')
                                        <div class="col-6 col-md-4">
                                            <label for="etudiant_id" class="form-label">Student</label>
                                            <div class="form-group">
                                                <select name="etudiant_id[]" id="etudiant_id"
                                                    class="form-control select2" multiple="multiple"
                                                    data-placeholder="Select Students" style="width: 100%;" required>
                                                    @foreach ($etudiants as $etudiant)
                                                        <option value="{{ $etudiant->id }}">
                                                            {{ $etudiant->user->prenom }} {{ $etudiant->user->nom }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <div class="valid-feedback">
                                                    Looks good!
                                                </div>
                                                <div class="invalid-feedback">
                                                    Please select at least one student.
                                                </div>
                                            </div>

                                        </div>
                                    @endif

                                    <div class="col-6 col-md-4 ">
                                        <label for="photo" class="form-label">Picture</label>
                                        <input required name="photo" id="photo" class="form-control"
                                            type="file" accept="image/*">
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                            Please pick a Picture.
                                        </div>
                                    </div>
                                </div>

                                <div class="row d-flex justify-content-end mt-2">

                                    <input type="text" name="role" id="role"
                                        value={{ $roleOfCurrentPage }} hidden>
                                    <button type="submit" class="btn_submit btn btn-primary mr-2"
                                        style="border-radius: 40px;padding-right:30px;padding-left:30px;">ADD</button>
                                    <button type="reset" class="btn_reset btn btn-secondary"
                                        style="border-radius: 40px;padding-right:30px;padding-left:30px;">Reset</button>
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
        </script>
</body>

</html>
