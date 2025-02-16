<style>
    .user-panel img {
        height: 35px;
        width: 35px;
        object-fit: cover;
    }
</style>
@php
$role = auth()->user()->role;
@endphp
<aside class="main-sidebar sidebar-dark-primary elevation-4 ">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" style="margin-top: 0px" class="brand-link">
        <img src="{{ asset('img/logov2.png') }}" alt="AdminLTE Logo" width="250px" style="">
    </a>

    <!-- Sidebar -->
    <div class="sidebar pt-4">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image ">
                <img src="{{ asset('/img' . auth()->user()->photo) }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div>
                <div class="info">
                    <a href={{ route('profil', auth()->user()->id) }} class="d-block">{{ auth()->user()->nom }}
                        {{ auth()->user()->prenom }}</a>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        @php
        $role = $role;
        @endphp
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                <li class="nav-item menu-open">
                    <a href="{{ route($role . '.dashboard') }}" class="nav-link active">
                        <i class="mx-2 fa-solid fa-house"></i>
                        <p>
                            Dashboard
                            <i class=""></i>
                        </p>
                    </a>
                </li>

                @if ($role == 'professeur')
                <li class="nav-item">
                    <a href={{ route('professeur.etudiants.list') }} class="nav-link ">
                        <i class="mx-2 fa-solid fa-user"></i>
                        <p>Students</p>
                    </a>
                </li>
                @endif

                @if ($role == 'admin')
                <li class="nav-item ">
                    <a href="#" class="nav-link ">
                        <i class="mx-2 fa-solid fa-user-tie"></i>
                        <p>
                            Teachers
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href={{ url('admin/list/professeurs') }} class="nav-link ">
                                <i class="mx-3 fa-solid fa-caret-right"></i>
                                <p>List Teachers</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href={{ url('admin/create/professeur') }} class="nav-link">
                                <i class="mx-3 fa-solid fa-caret-right"></i>
                                <p>Add Teacher</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item ">
                    <a href="#" class="nav-link ">
                        <i class="mx-2 fa-solid fa-user"></i>
                        <p>
                            Students
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href={{ url('admin/list/etudiants') }} class="nav-link ">
                                <i class="mx-3 fa-solid fa-caret-right"></i>
                                <p>List Students</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href={{ url('admin/create/etudiant') }} class="nav-link">
                                <i class="mx-3 fa-solid fa-caret-right"></i>
                                <p>Add Student</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item ">
                    <a href="#" class="nav-link ">
                        <span class="mx-2 material-symbols-outlined">family_restroom</span>
                        <p>
                            Parents
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href={{ url('admin/list/tuteurs') }} class="nav-link ">
                                <i class="mx-3 fa-solid fa-caret-right"></i>
                                <p>List Parents</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href={{ url('admin/create/tuteur') }} class="nav-link">
                                <i class="mx-3 fa-solid fa-caret-right"></i>
                                <p>Add Parent</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.listInvites') }}" class="nav-link">
                        <i class="fa fa-user-plus mx-2" aria-hidden="true"></i>
                        <p>New User</p>
                    </a>
                </li>
                @endif

                @if ($role == 'professeur')
                <li class="nav-item ">
                    <a href="#" class="nav-link ">
                        <i class="fa-solid fa-graduation-cap mx-2"></i>
                        <p>
                            Homeworks
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('professeur/tp/create') }}" class="nav-link">
                                <i class="mx-3 fa-solid"></i>
                                <p>Add Homework</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('tp.formList') }}" class="nav-link">
                                <i class="mx-3 fa-solid"></i>
                                <p>List Of Homeworks</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('professeur.listGroup') }}" class="nav-link">
                                <i class="mx-3 fa-solid"></i>
                                <p>List Responses</p>
                            </a>
                        </li>

                    </ul>
                </li>
                @endif

                @if ($role == 'tuteur')
                <li class="nav-item ">
                    <a href={{ route('tuteur.tp.list', auth()->user()->tuteur->id) }} class="nav-link ">
                        <i class="fa-solid fa-graduation-cap mx-2"></i>
                        <p>
                            Homeworks
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href={{ route('tuteur.tp.list', auth()->user()->tuteur->id) }} class="nav-link">
                                <i class="mx-3 fa-solid"></i>
                                <p>List Of Homeworks</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif

                @if ($role == 'etudiant')
                <li class="nav-item ">
                    <a href="#" class="nav-link ">
                        <i class="fa-solid fa-graduation-cap mx-2"></i>
                        <p>
                            Homeworks
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href={{ route('etudiant.tp.list', auth()->user()->etudiant->groupe->id) }} class="nav-link">
                                <i class="mx-3 fa-solid"></i>
                                <p>List Of Homeworks</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('etudiant.devoir.show') }}" class="nav-link">
                                <i class="mx-3 fa-solid"></i>
                                <p>Homeworks submitted</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item ">
                    <a href='{{ route('etudiant.absences') }}' class="nav-link ">
                        <i class="fa-solid fa-file-pen mx-2"></i>
                        <p>
                            Absences
                            <i class="right"></i>
                        </p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a href='{{ route('etudiant.notes') }}' class="nav-link ">
                        <i class="fa fa-star mx-2"></i>
                        <p>
                            Marks
                        </p>
                    </a>
                </li>
                @endif

                @if ($role == 'tuteur')
                <li class="nav-item ">
                    <a href={{ route('tuteur.absences') }} class="nav-link ">
                        <i class="fa-solid fa-file-pen mx-2"></i>
                        <p>
                            Absences
                            <i class="right"></i>
                        </p>
                    </a>
                </li>
                @endif

                @if ($role == 'admin')
                <li class="nav-item">
                    <a title="Schedules" href="{{ route('admin.emploiDuTemps') }}" class="nav-link ">
                        <i class="fa-solid fa-clipboard-list mx-2"></i>
                        <p>
                            Schedules
                        </p>
                    </a>
                <li>
                    @elseif ($role == 'professeur')
                <li class="nav-item">
                    <a title="Schedules" href="{{ route('professeur.emploiDuTemps') }}" class="nav-link ">
                        <i class="fa-solid fa-clipboard-list mx-2"></i>
                        <p>
                            Schedule
                        </p>
                    </a>
                <li>
                    @elseif ($role == 'etudiant')
                <li class="nav-item">
                    <a title="Schedules" href="{{ route('etudiant.emploiDuTemps') }}" class="nav-link ">
                        <i class="fa-solid fa-clipboard-list mx-2"></i>
                        <p>
                            Schedule
                        </p>
                    </a>
                <li>
                    @else
                <li class="nav-item">
                    <a title="Schedules" href="{{ route('tuteur.emploiDuTemps') }}" class="nav-link ">
                        <i class="fa-solid fa-clipboard-list mx-2"></i>
                        <p>
                            Schedules
                        </p>
                    </a>
                <li>
                    @endif


                    @if ($role == 'professeur')
                <li class="nav-item">
                    <a href="{{ url('/professeur/absences/1/1/' . now()->format('Y-m-d')) }}" class="nav-link">
                        <i class="mx-2 fa-solid fa-book"></i>
                        <p>
                            Absences
                            <i class="right"></i>
                        </p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a href='{{ route('professeur.notes') }}' class="nav-link ">
                        <i class="fa fa-star mx-2"></i>
                        <p>
                            Marks
                        </p>
                    </a>
                </li>
                @endif


                @if ($role == 'tuteur')
                <li class="nav-item ">
                    <a href='{{ route('tuteur.notes') }}' class="nav-link ">
                        <i class="fa fa-star mx-2"></i>
                        <p>
                            Marks
                        </p>
                    </a>
                </li>
                @endif

                <li class="nav-item">
                    <a title="Profil" class="nav-link" href={{ route('profil', auth()->user()->id) }}>
                        <i class="mx-2 fa-solid fa-user" aria-hidden="true"></i>
                        <p>
                            Profil
                        </p>
                    </a>
                </li>

                @auth
                <li class="nav-item">
                    <a title="Logout" class="nav-link" style="cursor: pointer" onclick="document.getElementById('logout-form').submit();">
                        <i class="mx-2 fa-solid fa-right-from-bracket"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                    <form style="cursor: pointer" action="{{ route('logout') }}" method="post" id="logout-form">
                        @csrf
                    </form>
                </li>
                @endauth
    </div>

    <div></div>

    </div>
</aside>