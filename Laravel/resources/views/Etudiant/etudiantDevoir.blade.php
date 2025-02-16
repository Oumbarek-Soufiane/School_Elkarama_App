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
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link
        rel="stylesheet"href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <style>
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            background: #ebebeb;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #a2d5ff;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #6dbcfd;
        }
    </style>

    <title>Admin</title>
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
            @if (!empty($results))
                <div class="content-header mt-5">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="mt-4 mx-4" style="color: black">Homeworks :</h1>
                            </div><!-- /.col -->
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                                    <li class="breadcrumb-item active">Homeworks</li>
                                </ol>
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
                <!-- /.content-header -->

                <!-- Main content -->
                <section class="content">
                    <div class="row1 mb-5 " style="overflow-x: scroll ! important;">
                        @foreach ($results as $result)
                            @foreach ($result as $element)
                                <div class="layer ">
                                    <h1 class="mb-4">{{ $element->tp->module->designation }}</h1>
                                    <h4>{{ $element->tp->sujet }}</h4>
                                    {{-- <p class="mt-4">Réaliser par: <span>{{ $element->etudiant->user->nom }}
                                            {{ $element->etudiant->user->prenom }}</span></p> --}}
                                    <p class="mt-2 text-red"><span>Deadline
                                            {{ (new DateTime($element->tp->dateFin))->format('Y-m-d H:i') }}</span></p>
                                    <div><a href="{{ asset('img' . $element->tp->description) }}" target="_blank"
                                            class="btn btn_description mt-2">
                                            Description
                                        </a></div>
                                    <div><a href="{{ asset('img' . $element->reponses) }}" target="_blank"
                                            class="btn btn_discover mt-2">
                                            Answer
                                        </a>
                                    </div>
                                    <div>
                                        <form method="POST"
                                            action="{{ url('etudiant/devoir/delete/' . $element->id) }}"
                                            class="btn" id="upload_form">
                                            @csrf
                                            @method('DELETE')
                                            <div style="margin-right: auto;margin-left: auto;">
                                                <div class="btn-group w-100">
                                                    <button id="submit{{ $element->id }}" class="btn_delete"
                                                        >
                                                        Delete
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        @endforeach
                    </div>

            @endif
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
        <!-- jQuery Mapael -->
        <script src="{{ asset('plugins/jquery-mousewheel/jquery.mousewheel.js') }}"></script>
        <script src="{{ asset('plugins/raphael/raphael.min.js') }}"></script>
        <script src="{{ asset('plugins/jquery-mapael/jquery.mapael.min.js') }}"></script>

        <!-- AdminLTE for demo purposes -->
        <script src="{{ asset('dist/js/demo.js') }}"></script>
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="{{ asset('dist/js/pages/dashboard2.js') }}"></script>

</body>

</html>
