@extends('DashboardTemplate')
@section('title', 'Professor')
@section('content')

    <head>
        <link rel="stylesheet" href="{{ asset('css/Checkbox.css') }}">
        <link rel="stylesheet" href="{{ asset('css/Lists.css') }}">
    </head>
    <!-- Field-->
    <div class="grid grid-col-1 text-[#152259] text-4xl font-semibold">
        Field
    </div>
    @php
        $firstGroupeId = auth()->user()->professeur->groupes_details[0]->groupe_id;
        $firstModuleId = auth()->user()->professeur->modules[0]->id;
    @endphp
    <div class="grid lg:grid-cols-4 grid-cols-2 gap-10 mt-3">
        <a href="{{ route('tp.formList') }}">
            <div class="bg-yellow-100 rounded-2xl p-4 cursor-pointer">
                <div class="mb-12 text-lg text-gray-700 font-medium">
                    Tps
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
        <a href="{{route('professeur.listGroup')}}">
            <div class="bg-green-100 rounded-2xl p-4 cursor-pointer">
                <div class="mb-12 text-lg text-gray-700 font-medium">Responses</div>
                <div class="row">
                    <div class="col-6">
                        <div class="text-gray-700 text-lg font-medium">{{ $countDevoir }}</div>
                    </div>
                    <div class="col-6 text-right">
                        <i class="fa fa-wifi text-xl text-green-700" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </a>
        <a href="{{ route('professeur.absenceView', [$firstModuleId, $firstGroupeId, date('Y-m-m')]) }}">
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
        <a href="{{ route('professeur.notes') }}">
            <div class="bg-pink-100 rounded-2xl p-4 cursor-pointer">
                <div class="mb-12 text-lg text-gray-700 font-medium">Notes</div>
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

    <!-- Student-->
    <div class="grid grid-col-1 text-[#152259] text-4xl mt-3 mb-3">
        Students
    </div>
    <div class="grid lg:grid-cols-2 sm:grid-cols-1 gap-4 text-gray-800 font-medium">
        @foreach (auth()->user()->professeur->groupes_details as $groupes_detail)
            @foreach ($groupes_detail->groupe->etudiants as $index => $etudiant)
                @if ($index == 2)
                @break

            @else
                <a href={{ route('profil', $etudiant->user->id) }}>
                    <div class="p-3 bg-light-blue-50 rounded-2xl cursor-pointer">
                        <div class="row">
                            <div class="col-3 h-24">
                                <img src="{{ url('img/' . $etudiant->user->photo) }}" style="width: 100%;height:100%"
                                    class="rounded-2xl object-cover">
                            </div>
                            <div class="col-9">
                                <div class="row">
                                    <div class="col-6 p-1 bg-light-blue-600 rounded-full text-white text-center mb-1">
                                        {{ $etudiant->groupe->filiere->designation }}
                                    </div>
                                    <div class="col-6 p-1 text-green-600 text-right">
                                        {{ ucfirst($etudiant->groupe->designation) }}</div>
                                    <div class="col-12 leading-7">
                                        {{ $etudiant->user->nom . ' ' . $etudiant->user->prenom }}
                                    </div>
                                    <div class="col-12 leading-7">Its Parents : @foreach ($etudiant->tuteur_details as $etudiant->tuteur_detail)
                                            {{ $etudiant->tuteur_detail->tuteur->user->nom . ', ' }}
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            @endif
        @endforeach
    @endforeach
</div>
<div class="grid grid-col-1 text-blue-800 text-center underline cursor-pointer mt-3 mb-3">
    <a href="{{ route('list', $etudiant->user->role . 's') }}">
        View More
    </a>
</div>
<!-- ./Student -->

<!-- Absences -->
<div class="grid grid-col-1 text-[#152259] text-4xl mt-3 mb-3">
    Absences
</div>
<div class="grid sm:grid-cols-1 gap-4 text-gray-800 font-medium" style="text-align: center;">
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
                                <td class="row" style="color: black;"><img class="user-logo"
                                        src="{{ asset('img/user.jpg') }}" />{{ $absence->etudiant->groupe->groupe_details[0]->professeur->user->id }}
                                </td>
                                <th>{{ $absence->etudiant->user->nom . ' ' . $absence->etudiant->user->prenom }}</th>
                                <th>
                                    <label for="dates1" class="menuButton">
                                        <input type="checkbox" id="dates1" name="dates[]"
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
                            </tr>
                        @endforeach

                    </tbody>
                </table>

            </div>
        </div>
    </div>

</div>
<div class="grid grid-col-1 text-blue-800 text-center underline cursor-pointer mt-3 mb-3">
    <a href="{{ route('professeur.absenceView', [$firstModuleId, $firstGroupeId, date('Y-m-m')]) }}">View More</a>
</div>
<!-- ./Absences -->
@endsection
