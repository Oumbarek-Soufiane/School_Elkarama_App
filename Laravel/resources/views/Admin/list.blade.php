<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/Lists.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <title>List
    @if ($role == 'etudiant')
        Students
    @elseif($role == 'tuteur')
        Parents
    @elseif($role == 'professeur')
        Teachers
    @endif</title>
</head>

<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img src="{{ asset('img/logo.png') }}" alt="AIM_Logo" style="max-width: 100%; height: auto;">
        </div>

        <!-- Main content -->
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="index3.html" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Admin</a>
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
                @if (session()->has('success'))
                    <div class=" alert alert-success alert-dismissible fade show pb-3 mx-4 mt-3" role="alert">
                        <h5 class="fw-bold pt-2">{{ session('success') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0" style="color: black">List
                                @if ($role == 'etudiant')
                                    Students
                                @elseif($role == 'tuteur')
                                    Parents
                                @elseif($role == 'professeur')
                                    Teachers
                                @endif
                            </h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="/">Home</a></li>
                                <li class="breadcrumb-item active">List
                                    @if ($role == 'etudiant')
                                        Students
                                    @elseif($role == 'tuteur')
                                        Parents
                                    @elseif($role == 'professeur')
                                        Teachers
                                    @endif
                                </li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="d-flex justify-content-center">
                        <div class="table-wrapper">
                            <table>
                                <thead>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Gender</th>
                                    @if ($role == 'professeur')
                                        <th>Date of Hiring</th>
                                        <th>Diploma</th>
                                        <th>Salary</th>
                                    @elseif ($role == 'etudiant')
                                        <th>Student ID</th>
                                        <th>Group</th>
                                    @endif
                                    <th>Age</th>
                                    <th>Phone Number</th>
                                    @if ($roleAuth == 'admin')
                                        <th>Action</th>
                                    @endif
                                </thead>
                                <tbody>
                                    @foreach ($lists as $list)
                                        <tr>
                                            <td><img class="user-logo" src="{{ asset('img/user.jpg') }}" /><a
                                                    href={{ route('profil', $list->user->id) }}
                                                    class="profil-link">{{ $list->nom }} {{ $list->prenom }}</a></td>
                                            <td>{{ $list->email }}</td>
                                            <td>
                                                @if ($list->genre == 'M')
                                                    Male
                                                @elseif($list->genre == 'F')
                                                    Female
                                                @endif
                                            </td>
                                            @if ($role == 'professeur')
                                                <td>{{ $list->dateEmbauche }}</td>
                                                <td>{{ $list->diplome }}</td>
                                                <td>{{ $list->salaire }}</td>
                                            @elseif ($role == 'etudiant')
                                                <td>{{ $list->id }}</td>
                                                <td>{{ $list->groupe->designation }}</td>
                                            @endif
                                            @php
                                                $age = now()->diffInYears($list->dateNaissance);

                                            @endphp
                                            <td>{{ $age }}</td>
                                            <td>{{ $list->numeroTelephone }}</td>
                                            @if ($roleAuth == 'admin')
                                                <td> <a href="{{ route('destroy', [$role, $list->id]) }}"
                                                        style="color:red">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" fill="currentColor" class="bi bi-trash-fill"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0" />
                                                        </svg>
                                                    </a>
                                                    <a href="{{ route('edit', [$role, $list->id]) }}"
                                                        style="color:rgb(253, 144, 18)">
                                                        <i class=" ml-2 fa-solid fa-pen-to-square"></i> </a>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
            <div>
                {{ $lists->onEachSide(1)->links() }}
            </div>
            <!-- /.content -->
        </div>
    </div>


    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->

    <!-- Add this script block after including jQuery -->
    <script>
        $(document).ready(function() {
            // Set background color of pagination to white
            $('.pagination').css({
                backgroundColor: '#fff',
                padding: '1rem', // Adjust as needed
                borderRadius: '0.25rem',
            });

            // Set styles for anchor elements
            $('.pagination a').css({
                display: 'block',
                padding: '0.5rem 0.75rem',
                backgroundColor: '#fff', // Set background color for non-active elements
                color: '#1A81D8', // Set text color for non-active elements
                textDecoration: 'none',
                borderRadius: '0.25rem'
            });

            $('[aria-label="Next »"]').css({
                'background-color': 'rgb(156, 156, 156)',
                'color': 'black'
            });

            $('[aria-label="« Previous"]').css({
                'background-color': 'rgb(156, 156, 156)',
                'color': 'black'
            });

            $('[aria-disabled="true"]').css({
                'background-color': 'rgb(156, 156, 156)',
                'color': 'black'
            });
        });
    </script>


    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('Template/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
</body>

</html>
