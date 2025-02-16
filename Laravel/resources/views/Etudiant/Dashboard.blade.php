@extends('DashboardTemplate')
@section('title', 'Student')
@section('content')

    <head>

        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome Icons -->
        <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
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
    </head>

    <!-- Field-->
    <div class="grid grid-col-1 text-[#152259] text-4xl font-semibold">
        Field
    </div>
    <div class="grid lg:grid-cols-4 grid-cols-2 gap-10 mt-3">
        <a href="{{route('etudiant.tp.list',auth()->user()->etudiant->groupe_id)}}">
            <div class="bg-yellow-100 rounded-2xl p-4 cursor-pointer">
                <div class="mb-12 text-lg text-gray-700 font-medium">
                    TPs
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="text-gray-700 text-lg font-medium">{{ $countTps }}</div>
                    </div>
                    <div class="col-6 text-right">
                        <i class="fa fa-book text-xl text-yellow-700" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </a>
        <a href="{{route('etudiant.devoir.show')}}">
            <div class="bg-green-100 rounded-2xl p-4 cursor-pointer">
                <div class="mb-12 text-lg text-gray-700 font-medium">Your Respnses</div>
                <div class="row">
                    <div class="col-6">
                        <div class="text-gray-700 text-lg font-medium">{{ $countReponses }}</div>
                    </div>
                    <div class="col-6 text-right">
                        <i class="fa fa-wifi text-xl text-green-700" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </a>
        <a href="{{route('etudiant.absences')}}">
            <div class="bg-purple-100 rounded-2xl p-4 cursor-pointer">
                <div class="mb-12 text-lg text-gray-700 font-medium">Absences</div>
                <div class="row">
                    <div class="col-6">
                        <div class="text-gray-700 text-lg font-medium">{{ $countAbsences }}</div>
                    </div>
                    <div class="col-6 text-right">
                        <i class="fa fa-table text-xl text-purple-700" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </a>
        <a href="{{route('etudiant.notes')}}">
            <div class="bg-pink-100 rounded-2xl p-4 cursor-pointer">
                <div class="mb-12 text-lg text-gray-700 font-medium">Marks</div>
                <div class="row">
                    <div class="col-6">
                        <div class="text-gray-700 text-lg font-medium">{{ $countNotes }}</div>
                    </div>
                    <div class="col-6 text-right">
                        <i class="fa fa-database text-xl text-pink-700" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <!-- ./Field-->

    <!-- TPs-->
    <div class="grid grid-col-1 text-[#152259] text-4xl mt-3 mb-3">
        Tps
    </div>
    <div class="grid lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 gap-4 text-gray-800 font-medium ml-3 row1 mb-2"
        style="overflow-x: scroll ! important;">
        @foreach ($tps as $tp)
            <div class="layer">
                <h1 class="mb-4">{{ $tp->module->designation }}</h1>
                <h4>{{ $tp->sujet }}</h4>
                {{-- <p class="mt-4">Réaliser par: <span>Réaliser par</span></p> --}}
                <p class="mt-2 text-red"><span>Deadline:
                        {{ $tp->dateFin }}</span></p>
                <div><a href="{{ asset('img' . $tp->description) }}" target="_blank" class="btn btn_discover mt-2">
                        Description
                    </a>
                </div>
            </div>
        @endforeach
    </div>
    <div class="grid grid-col-1 text-blue-800 text-center underline cursor-pointer mt-3 mb-3">
        <a href="{{ route('etudiant.tp.list', auth()->user()->etudiant->groupe_id) }}">View More</a>
    </div>
    <!-- ./TPs-->
    <div class="grid grid-col-1 text-[#152259] text-4xl mt-3 mb-3">
        Absences of today
    </div>
    <div class="grid sm:grid-cols-1 gap-4 text-gray-800 font-medium" style="text-align: center;">
        <div class="container-fluid">
            <div class="justify-content-center">
                <div class="table-wrapper">
                    <table style="width: 100%">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Full Name</th>
                                <th>08:00 -> 10:00</th>
                                <th>10:00 -> 12:00</th>
                                <th>13:00 -> 15:00</th>
                                <th>15:00 -> 17:00</th>
                            </tr>
                        </thead>

                        @if (count($absences) > 0)
                            @foreach ($absences as $absence)
                                <tbody>
                                    @php
                                        $created_at = new DateTime($absence->created_at);
                                        $date = $created_at->format('Y-M-d');
                                    @endphp
                                    <th>
                                        {{ $date }}
                                    </th>
                                    <th>
                                        {{ $absence->module->designation }}
                                    </th>
                                    <th>
                                        <label for="dates1" class="menuButton">
                                            <input id="dates1" type="checkbox" name="dates[]"
                                                {{ $absence->seance1 ? 'checked' : '' }} onclick="return false;" />
                                            <span class="top"></span>
                                            <span class="mid"></span>
                                            <span class="bot"></span>
                                        </label>
                                    </th>
                                    <th>
                                        <label for="dates2" class="menuButton">
                                            <input id="dates2" type="checkbox" name="dates[]"
                                                {{ $absence->seance2 ? 'checked' : '' }} onclick="return false;" />
                                            <span class="top"></span>
                                            <span class="mid"></span>
                                            <span class="bot"></span>
                                        </label>
                                    </th>
                                    <th>
                                        <label for="dates3" class="menuButton">
                                            <input id="dates3" type="checkbox" name="dates[]"
                                                {{ $absence->seance3 ? 'checked' : '' }} onclick="return false;" />
                                            <span class="top"></span>
                                            <span class="mid"></span>
                                            <span class="bot"></span>
                                        </label>
                                    </th>
                                    <th>
                                        <label for="dates4" class="menuButton">
                                            <input id="dates4" type="checkbox" name="dates[]"
                                                {{ $absence->seance4 ? 'checked' : '' }} onclick="return false;" />
                                            <span class="top"></span>
                                            <span class="mid"></span>
                                            <span class="bot"></span>
                                        </label>
                                    </th>
                                </tbody>
                            @endforeach
                        @endif
                    </table>
                </div>
            </div>
        </div>

    </div>
    <div class="grid grid-col-1 text-blue-800 text-center underline cursor-pointer mt-3 mb-3">
        <a href="{{ route('etudiant.absences') }}">View More</a>
    </div>
    <!-- ./Parents-->


@endsection
