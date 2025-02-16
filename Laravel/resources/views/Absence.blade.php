<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/Lists.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Checkbox.css') }}">
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

    <title>Absence</title>
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <!-- Preloader -->
    <div class="preloader dark-mode flex-column justify-content-center align-items-center">
        <img src="{{ asset('img/logo.png') }}" alt="AIM_Logo" style="max-width: 100%; height: auto;">
    </div>

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="index3.html" class="nav-link">Home</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="#" class="nav-link">Professeur</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href={{ url('/professeur/absences/1/1') }} class="nav-link">Absences</a>
            </li>
        </ul>
    </nav>

    @include('layout.sidebar')
    <div class="content-wrapper bg-white">
        <!-- Content Header (Page header) -->
        <div class="content-header mt-1 ml-3">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="mt-2 mb-3">Absences</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                            <li class="breadcrumb-item active">Absences</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container">
                {{-- ----------------------------Selects filters---------------------------------------------- --}}
                @if ($role == 'professeur')
                    <form method="GET" class="absence-filter" 
                        class="form_customized needs-validation">
                        @csrf
                        @method('POST')
                        <div class="row col-12">
                            <div class="col-4 col-md-4">
                                <label for="module_id" class="form-label" style="text-align: center">
                                    Subject</label>
                                {{-- @dd($modules); --}}
                                <select required name="module_id" id="module_id" class="form-control">
                                    <option value="" disabled selected>Select a Subject</option>
                                    @foreach ($modules as $module_select)
                                        <option value="{{ $module_select->id }}">{{ $module_select->designation }}
                                        </option>
                                    @endforeach
                                </select>
                                {{-- @dd($module->id) --}}
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    Please select a Subject.
                                </div>
                            </div>

                            <div class="col-4 col-md-4">
                                <label for="groupe_id" class="form-label">Group</label>
                                <select required name="groupe_id" id="groupe_id" class="form-control">
                                    <option value="" disabled selected>Select a Group</option>
                                    @foreach ($groupes as $group_select)
                                        <option value="{{ $group_select->id }}">{{ $group_select->designation }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    Please select a Group.
                                </div>
                            </div>

                            <div class="col-4 col-md-4 form-group">
                                <label for="date">Date</label>
                                <input required type="date" name="date" id="date" class="form-control"
                                    value="{{ now()->format('Y-m-d') }}">
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    Please select a Date.
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-end">
                            <button type="button" onclick="redirect()" class="btn_submit btn btn-primary mr-2 "
                                style="border-radius: 40px; padding-right: 30px; padding-left: 30px;">Search</button>
                        </div>
                    </form>
                @endif
                {{-- -------------------------------------------------------------------------- --}}
            </div>
            @if (isset($absences) && !empty($absences))

                <form method="POST" action="{{ route('professeur.createAbsence', [$module, $groupe, $date]) }}">
                    @csrf
                    <div class="container-fluid">
                        <div class="justify-content-center">
                            <div class="table-wrapper">
                                <table style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Full Name</th>
                                            <th>08:00 -> 10:00</th>
                                            <th>10:00 -> 12:00</th>
                                            <th>13:00 -> 15:00</th>
                                            <th>15:00 -> 17:00</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($absences as $absence)
                                            <tr>
                                                @php
                                                    $dateTime = new DateTime($absence->created_at);
                                                    $created_at = $dateTime->format('Y-m-d');

                                                @endphp
                                                <th>{{ $absence->idEtudiant }}</th>
                                                <th>{{ $absence->nom }} {{ $absence->prenom }}</th>
                                                <th>
                                                    <label for="dates1{{ $absence->idEtudiant }}" class="menuButton">
                                                        <input type="checkbox" id="dates1{{ $absence->idEtudiant }}"
                                                            name="dates[]"
                                                            {{ $created_at == $date && $absence->module_id == $module && $absence->seance1 ? 'checked' : '' }}
                                                            value="{{ $created_at == $date && $absence->module_id == $module && $absence->seance1 ? '' : json_encode(['module_id' => $module, 'etudiant_id' => $absence->idEtudiant, 'seance1' => true]) }}" />
                                                        <span class="top"></span>
                                                        <span class="mid"></span>
                                                        <span class="bot"></span>
                                                    </label>

                                                </th>
                                                <th>
                                                    <label for="dates2{{ $absence->idEtudiant }}" class="menuButton">
                                                        <input id="dates2{{ $absence->idEtudiant }}" type="checkbox"
                                                            name="dates[]"
                                                            {{ $created_at == $date && $absence->module_id == $module && $absence->seance2 ? 'checked' : '' }}
                                                            value="{{ $created_at == $date && $absence->module_id == $module && $absence->seance2 ? '' : json_encode(['module_id' => $module, 'etudiant_id' => $absence->idEtudiant, 'seance2' => true]) }}" />
                                                        <span class="top"></span>
                                                        <span class="mid"></span>
                                                        <span class="bot"></span>
                                                    </label>

                                                </th>
                                                <th>
                                                    <label for="dates3{{ $absence->idEtudiant }}" class="menuButton">
                                                        <input id="dates3{{ $absence->idEtudiant }}" type="checkbox"
                                                            name="dates[]"
                                                            {{ $created_at == $date && $absence->module_id == $module && $absence->seance3 ? 'checked' : '' }}
                                                            value="{{ $created_at == $date && $absence->module_id == $module && $absence->seance3 ? '' : json_encode(['module_id' => $module, 'etudiant_id' => $absence->idEtudiant, 'seance3' => true]) }}" />
                                                        <span class="top"></span>
                                                        <span class="mid"></span>
                                                        <span class="bot"></span>
                                                    </label>
                                                </th>
                                                <th>
                                                    <label for="dates4{{ $absence->idEtudiant }}" class="menuButton">
                                                        <input id="dates4{{ $absence->idEtudiant }}" type="checkbox"
                                                            name="dates[]"
                                                            {{ $created_at == $date && $absence->module_id == $module && $absence->seance4 ? 'checked' : '' }}
                                                            value="{{ $created_at == $date && $absence->module_id == $module && $absence->seance4 ? '' : json_encode(['module_id' => $module, 'etudiant_id' => $absence->idEtudiant, 'seance4' => true]) }}" />
                                                        <span class="top"></span>
                                                        <span class="mid"></span>
                                                        <span class="bot"></span>
                                                    </label>
                                                </th>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-end mt-2">
                        <button type="submit" class="btn_submit btn btn-primary mr-2"
                            style="border-radius: 40px;padding-right:30px;padding-left:30px;">Submit</button>
                        <button type="reset" class="btn_reset btn btn-secondary"
                            style="border-radius: 40px;padding-right:30px;padding-left:30px;">Reset</button>
                    </div>
                </form>
            @endif

            <div style="margin-bottom: 30px"></div>
        </section>
        <!-- /.content -->
    </div>


    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap -->
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
        function redirect() {
            var module_id = document.getElementsByName("module_id")[0].value;
            var groupe_id = document.getElementsByName("groupe_id")[0].value;
            var date = document.getElementsByName("date")[0].value;
    
            // Use Blade to generate the route
            var url = "{{ route('professeur.absenceView', [':module_id',':groupe_id',':date']) }}";
            
            // Replace placeholders with actual values
            url = url.replace(':module_id', module_id);
            url = url.replace(':groupe_id', groupe_id);
            url = url.replace(':date', date);
    
            // Redirect to the generated URL
            window.location.href = url;
        }
    </script>
    

</html>
