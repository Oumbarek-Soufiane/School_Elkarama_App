@extends('DashboardTemplate')
@section('title', 'Parent')
@section('content')

    <!-- Field-->
    <div class="grid grid-col-1 text-[#152259] text-4xl font-semibold">
        Field
    </div>
    <div class="grid lg:grid-cols-4 grid-cols-2 gap-10 mt-3">
        <a href="{{ route('tuteur.tp.list', auth()->user()->tuteur->id)}}">
            <div class="bg-yellow-100 rounded-2xl p-4 cursor-pointer">
                <div class="mb-12 text-lg text-gray-700 font-medium">
                    TPs
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="text-gray-700 text-lg font-medium">{{$countTps}}</div>
                    </div>
                    <div class="col-6 text-right">
                        <i class="fa fa-book text-xl text-yellow-700" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </a>
        <a href="#">
            <div class="bg-green-100 rounded-2xl p-4 cursor-pointer">
                <div class="mb-12 text-lg text-gray-700 font-medium">Responses</div>
                <div class="row">
                    <div class="col-6">
                        <div class="text-gray-700 text-lg font-medium">{{$countReponses}}</div>
                    </div>
                    <div class="col-6 text-right">
                        <i class="fa fa-wifi text-xl text-green-700" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </a>
        <a href="{{route('tuteur.absences')}}">
            <div class="bg-purple-100 rounded-2xl p-4 cursor-pointer">
                <div class="mb-12 text-lg text-gray-700 font-medium">Absences</div>
                <div class="row">
                    <div class="col-6">
                        <div class="text-gray-700 text-lg font-medium">{{$countAbsences}}</div>
                    </div>
                    <div class="col-6 text-right">
                        <i class="fa fa-table text-xl text-purple-700" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </a>
        <a href="{{ route('tuteur.notes') }}">
            <div class="bg-pink-100 rounded-2xl p-4 cursor-pointer">
                <div class="mb-12 text-lg text-gray-700 font-medium">Notes</div>
                <div class="row">
                    <div class="col-6">
                        <div class="text-gray-700 text-lg font-medium">{{$countNotes}}</div>
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
        Children
    </div>
    <div class="grid lg:grid-cols-2 sm:grid-cols-1 gap-4 text-gray-800 font-medium">
    @foreach ($enfants as $id => $enfant)
    <a href={{ route('profil', $enfant['etudiant']->user->id) }}>
            <div class="p-3 bg-light-blue-50 rounded-2xl cursor-pointer">
                <div class="row">
                    <div class="col-3 h-24">
                        <img src="{{ url('img/invite1.png') }}" style="width: 100%;height:100%"
                            class="rounded-2xl object-cover">
                    </div>
                    <div class="col-9">
                        <div class="row">
                            <div class="col-6 p-1 bg-light-blue-600 rounded-full text-white text-center mb-1">{{$enfant['filiere']}}
                            </div>
                            <div class="col-6 p-1 text-green-600 text-right">{{ ucfirst($enfant['groupe']) }}
                            </div>
                            <div class="col-12 leading-7">{{ $enfant['nom'] }} {{ $enfant['prenom'] }}</div>
                            <div class="col-12 leading-7">Its Parents :
                                @foreach ($enfant['parents'] as $parent)
                                {{-- <dd>{{$parent->tuteur->user->nom}}</dd> --}}
                                    {{ $parent->tuteur->user->nom }} {{ $parent->tuteur->user->prenom }}
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </a>
            @endforeach
        </div>

    <div class="grid grid-col-1 text-blue-800 text-center underline cursor-pointer mt-3 mb-3">
        <a href="#">View More</a>
    </div>
    <!-- ./Student-->
    <!-- Absences of today-->
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
                                <th>Full Name</th>
                                <th>Date</th>
                                <th>Module</th>
                                <th>08:00 -> 10:00</th>
                                <th>10:00 -> 12:00</th>
                                <th>13:00 -> 15:00</th>
                                <th>15:00 -> 17:00</th>
                            </tr>
                        </thead>
                        @if (count($absences) > 0)
                            <tbody>
                                @foreach ($absences as $absence)
                                    <tr>
                                        <th>
                                            {{ $absence->etudiant->user->nom . ' ' . $absence->etudiant->user->prenom }}
                                        </th>
                                        <th>
                                            {{ $absence->created_at }}
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
                                    </tr>
                                @endforeach
                            </tbody>
                        @endif
                    </table>

                </div>
            </div>
        </div>

    </div>
    <div class="grid grid-col-1 text-blue-800 text-center underline cursor-pointer mt-3 mb-3">
        <a href="{{ route('tuteur.absences') }}">View More</a>
    </div>
    <!-- ./Parents-->
@endsection
