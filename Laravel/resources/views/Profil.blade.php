<!DOCTYPE html>
<html style="background-color: white;" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin</title>

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
    <link rel="stylesheet" href={{ url('css/Profil.css') }} />
</head>

<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img src="{{ asset('img/logo.png') }}" alt="AIM_Logo" style="max-width: 100%; height: auto;">
        </div>


        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="index3.html" class="nav-link">Home</a>
                </li>
            </ul>

        </nav>

        <!-- Sidebar -->
        @include('layout.sidebar')
        <!-- /Sidebar -->

        <div class="content-wrapper bg-white">
            <div class="content-header mt-5">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0" style="color: black"></h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href={{ route('profil', auth()->user()->id) }}>Profil</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div style="color: black"
                            class="col-lg-6 col-md-12 d-flex align-items-center justify-content-center">
                            <div class="row text-center d-flex justify-content-center">
                                <div style="color: black;" class="col-12">
                                    <img class="profil-img" src="{{ url('img/user1.png') }}" alt=""
                                        srcset="">
                                </div>
                                <div style="margin-top:23px;margin-bottom:20px" class="col-12 infos">
                                    {{ $user->email }}
                                </div>
                                <div style="" class="col-12 infos">
                                    {{ $user->nom . ' ' . $user->prenom }}
                                </div>

                                @if ($user->role == 'professeur')
                                    <div style="color: #A7A7A7;margin-bottom:25px;font-weight:normal"
                                        class="col-12 infos">
                                        @foreach ($user->professeur->modules as $module)
                                            <span>{{ $module->designation }}</span>
                                        @endforeach
                                    </div>
                                @endif
                                @if ($user->role == 'admin')
                                    <div style="color: #A7A7A7;margin-bottom:25px;font-weight:normal"
                                        class="col-12 infos">
                                        {{ $user->numeroTelephone }}
                                    </div>
                                @endif

                                <div class="col-1 infos phone-logo">
                                    <i class="fa-solid fa-phone"></i>
                                </div>
                            </div>
                        </div>
                        <div style="color: black;"
                            class="col-lg-6 col-md-12 d-flex align-items-center justify-content-center">
                            <div class="row">
                                @if ($user->role == 'admin')
                                    <div class="gea text-center col-12">
                                        <span style="color:#1d48ff">AIM</span> DIRECTOR
                                    </div>
                                @endif

                                <div style="color: #A7A7A7;margin-bottom:20px" class="col-12 text-center">
                                    <span class="infos">About</span>
                                </div>
                                <div style="color: #A7A7A7;margin-bottom:35px" class="col-12">
                                    <p class="text-center">Nulla Lorem mollit cupidatat irure. Laborum magna nulla duis
                                        ullamco cillum
                                        dolor. Voluptate exercitation incididunt aliquip deserunt reprehenderit elit
                                        laborum. Nulla Lorem mollit cupidatat irure. Laborum magna nulla duis ullamco
                                        cillum dolor. Voluptate exercitation incididunt aliquip deserunt reprehenderit
                                        elit laborum. </p>
                                </div>
                                @if ($user->role == 'professeur' || $user->role == 'etudiant' || $user->role == 'tuteur')
                                    <div style="color: black" class="col-12">
                                        <table style="width: 100%;color: #757575;" class="text-center">
                                            <thead>
                                                <tr>
                                                    <th>Age</th>
                                                    <th>Gender</th>
                                                    @if ($user->role == 'professeur')
                                                        <th>Diploma</th>
                                                        <th>Hiring Date</th>
                                                    @else
                                                        <th>Role</th>
                                                        <th>Family Situation</th>
                                                    @endif
                                                </tr>
                                            </thead>
                                            <tbody style="color: #9b9b9b;">
                                                <tr>
                                                    @php
                                                        $date = new DateTime($user->dateNaissance);
                                                        $age = date('Y') - $date->format('Y');
                                                        $dateEmbauche = new DateTime($user->dateEmbauche);
                                                        $dateEmbauche = $dateEmbauche->format('Y-m-d');
                                                    @endphp
                                                    <td>{{ $age }}</td>
                                                    <td>{{ $user->genre }}</td>
                                                    @if ($user->role == 'professeur')
                                                        <td>{{ $user->professeur->diplome }}</td>
                                                        <td>{{ $dateEmbauche }}</td>
                                                    @else
                                                        <td>{{ ucFirst($user->role) }}</td>
                                                        <td>{{ ucFirst($user->situationFamiliale) }}</td>
                                                    @endif

                                                </tr>
                                            </tbody>

                                        </table>
                                    </div>
                                @endif

                                @if ($user->role == 'professeur')
                                    <div style="color: #757575;margin-bottom:18px;margin-top:33px;"
                                        class="col-12 d-flex justify-content-center infos">
                                        Its Students
                                    </div>
                                    <div style="color: black" class="col-12 d-flex justify-content-center">
                                        <div class="avatar-stack">
                                            @php
                                                $nbrEtudiants = 0;
                                            @endphp
                                            @foreach ($user->professeur->groupes_details as $groupes_detail)
                                                @php
                                                    $nbrEtudiants += count($groupes_detail->groupe->etudiants);
                                                @endphp
                                                @foreach ($groupes_detail->groupe->etudiants as $index => $etudiant)
                                                    @if ($index == 3)
                                                    @break;
                                                @endif
                                                <div class="avatar">
                                                    <a href={{ route('profil', $etudiant->user->id) }}><img
                                                            src='{{ url('img' . $etudiant->user->photo) }}'
                                                            alt={{ $etudiant->user->nom }}></a>

                                                </div>
                                            @endforeach
                                        @endforeach
                                        <a href={{ route('professeur.etudiants.list') }}
                                            id="viewMore">+{{ $nbrEtudiants - 6 }}
                                            view more</a>
                                    </div>
                                </div>
                            @endif
                            @if ($user->role == 'etudiant')
                                <div style="color: #757575;margin-bottom:18px;margin-top:33px;"
                                    class="col-12 d-flex justify-content-center infos">
                                    Its Parents
                                </div>
                                <div style="color: black" class="col-12 d-flex justify-content-center">
                                    <div class="avatar-stack">
                                        @foreach ($user->etudiant->tuteur_details as $tuteur_detail)
                                            <div class="avatar"><a
                                                    href={{ route('profil', $tuteur_detail->tuteur->user->id) }}><img
                                                        src='{{ url('img' . $tuteur_detail->tuteur->user->photo) }}'
                                                        alt={{ $tuteur_detail->tuteur->user->nom }}></a>
                                            </div>
                                        @endforeach
                                        <a href="#" id="viewMore">View details</a>
                                    </div>
                                </div>
                            @endif
                            @if ($user->role == 'tuteur')
                                <div style="color: #757575;margin-bottom:18px;margin-top:33px;"
                                    class="col-12 d-flex justify-content-center infos">
                                    Its Children
                                </div>
                                <div style="color: black" class="col-12 d-flex justify-content-center">
                                    <div class="avatar-stack">
                                        @foreach ($user->tuteur->tuteur_details as $tuteur_detail)
                                            <div class="avatar"><a
                                                    href={{ route('profil', $tuteur_detail->etudiant->user->id) }}><img
                                                        src='{{ url('img' . $tuteur_detail->etudiant->user->photo) }}'
                                                        alt={{ $tuteur_detail->etudiant->user->nom }}></a>
                                            </div>
                                        @endforeach
                                        <a href="#" id="viewMore">View details</a>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <!-- ./col -->
                </div>

        </section>
    </div>

</div>
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var phoneIcon = document.querySelector('.phone-logo');

        if (phoneIcon) {
            phoneIcon.addEventListener('click', function() {
                // Redirect to the specified phone number
                var phoneNumber = "{{ $user->numeroTelephone }}";
                window.location.href = "tel:" + phoneNumber;
            });
        }
    });
</script>


</body>

</html>
