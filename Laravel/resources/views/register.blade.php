@extends('layout.footer')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <title>AIM</title>
</head>

<body>
    <!-- Navigation Bar -->
    <div class="Landing_Up">
        <div class="container-fluid" style="margin-bottom:-6%;">
            <nav class="navbar navbar-expand-lg bg-transparent-tertiary" style=" margin-top: -3%;">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation" style="position:absolute; right:0; top:35px; ">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent" style="text-align: center;">

                    <a class="nav-link" href="{{ route('home') }}" style="margin-right: auto">
                        <img class="logo" width="250px" src="{{ asset('img/logo.png') }}" alt="image" />
                    </a>

                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}">Annoncements</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link " href="{{ route('home') }}">About Us</a>
                        </li>
                        <li class="nav-item About">
                            <a class="nav-link" href="{{ route('home') }}">Contact</a>
                        </li>
                    </ul>

                    <div class="d-flex login" id="login_button" class="log">
                        <a href="{{ route('login') }}" class="button1" style="margin-left: auto; margin-right: auto;"
                            class="nav-link">Login</a>
                        </li>
                    </div>

                </div>
            </nav>
        </div>
    </div>

    <!-- Body Bar -->
    <div class="content-wrapper bg-white">
        <!-- Content Header (Page header) -->
        <div class="content-header mt-5">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 style="margin-top: 6%;color:#152259;margin-right: 5%;margin-left: 5%;">Register</h1>
                    </div>
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content" style="margin-right: 5%;margin-left: 5%;">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="container" {{-- style="margin-right: 5%;margin-left: 5%;" --}}>
                        <form method="post" action="{{ route('register') }}" class="form_customized needs-validation"
                            autocomplete="on" novalidate enctype="multipart/form-data">
                            @csrf
                            @method('post')
                            <div class="row g-3">
                                <div class="col-6 col-md-4">
                                    <label for="email" class="form-label" style="text-align: center">
                                        Email Adress</label>
                                    <input required name="email" id="email" type="email" class="form-control">
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <div class="invalid-feedback">
                                        Please enter the Email Adress.
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

                                <div class="col-6 col-md-4">
                                    <label for="major" class="form-label" style="text-align: center">
                                        Major</label>
                                    <input required name="filiereActuelle" id="major" type="text"
                                        class="form-control">
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <div class="invalid-feedback">
                                        Please enter your Major.
                                    </div>
                                </div>
                                <div class="col-6 col-md-4">
                                    <label for="nextMajor" class="form-label">Major Requested</label>
                                    <select required name="filiere_id" id="nextMajor" class="form-control select3"
                                        style="width: 100%;">
                                        <option value="" disabled selected>
                                            Please Select Major Requested
                                        </option>
                                        @foreach ($filieres as $filiere)
                                            <option value={{ $filiere->id }}>{{ $filiere->designation }}</option>
                                        @endforeach
                                    </select>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <div class="invalid-feedback">
                                        Please Select a Major Requested.
                                    </div>
                                </div>

                                <div class="col-6 col-md-4">
                                    <label for="lastYearScore" class="form-label" style="text-align: center">
                                        Last Year Score</label>
                                    <input type="number" required name="moyenneDernierAnnee" min="0"
                                        max="20" step="0.01" id="lastYearScore" class="form-control">
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <div class="invalid-feedback">
                                        Please enter Last Year Score.
                                    </div>
                                </div>

                                <div class="col-6 col-md-4 ">
                                    <label for="couvertureMedicale" class="form-label">Couverture Medicale</label>
                                    <input required name="couvertureMedicale" id="couvertureMedicale"
                                        class="form-control" type="text">
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <div class="invalid-feedback">
                                        Please pick a Couverture Medicale.
                                    </div>
                                </div>

                                <div class="col-6 col-md-4 ">
                                    <label for="photo" class="form-label">Picture</label>
                                    <input required name="photo" id="photo" class="form-control"
                                        type="file">
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <div class="invalid-feedback">
                                        Please pick a Picture.
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end mt-3">
                                <button type="submit" class="btn_submit btn btn-primary mr-2"
                                    style="border-radius: 40px;padding-right:30px;padding-left:30px;;margin-right:9px;">ADD</button>
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
    @yield('footer')

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-element-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>

    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('Template/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    {{-- <script src="{{ asset('dist/js/adminlte.js') }}"></script> --}}

    <!-- PAGE PLUGINS -->
    <!-- Select2 -->
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- jQuery Mapael -->
    <script src="{{ asset('plugins/jquery-mousewheel/jquery.mousewheel.js') }}"></script>
    <script src="{{ asset('plugins/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-mapael/jquery.mapael.min.js') }}"></script>
    <script src="{{ asset('js/errors_triger_bootstrap.js') }}"></script>


    <script>
        // For Select Multiple Students
        $(function() {
            $('form.form_customized').on('reset', function() {
                // Reset Select2 elements
                setTimeout(function() {
                    console.log($('.select2').select2().val());
                }, 100);
            });

        })
    </script>


</body>

</html>
