@extends('DashboardTemplate')
@section('title', 'Admin')
@section('content')
    <!-- Field-->
    <div class="grid grid-col-1 text-[#152259] text-4xl font-semibold">
        Field
    </div>
    <div class="grid lg:grid-cols-4 grid-cols-2 gap-10 mt-3">
        @foreach ($filieres as $filiere)
            @php
                $nbrEtudiantParFiliere = count($filiere->groupes[0]->etudiants) + count($filiere->groupes[1]->etudiants);
                $icon = '';
                $bg = '';
                switch ($filiere->designation) {
                    case 'Mathematics':
                        $icon = 'fa fa-book text-xl text-yellow-700';
                        $bg = 'yellow';
                        break;

                    case 'Network':
                        $icon = 'fa fa-wifi text-xl text-green-700';
                        $bg = 'green';
                        break;

                    case 'Data Engineering':
                        $icon = 'fa fa-table text-xl text-purple-700';
                        $bg = 'purple';
                        break;

                    case 'Data Science':
                        $icon = 'fa fa-database text-xl text-pink-700';
                        $bg = 'pink';
                        break;
                }
            @endphp
            <div class="bg-{{ $bg }}-100 rounded-2xl p-4 cursor-pointer">
                <div class="mb-12 text-lg text-gray-700 font-medium">
                    {{ $filiere->designation }}
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="text-gray-700 text-lg font-medium">{{ $nbrEtudiantParFiliere }}</div>
                    </div>
                    <div class="col-6 text-right">
                        <i class="{{ $icon }}" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <!-- ./Field-->

    <!-- Professeur-->
    <div class="grid grid-col-1 text-[#152259] text-4xl mt-3 mb-3">
        Professeurs
    </div>
    <div class="grid lg:grid-cols-2 sm:grid-cols-1 gap-4 text-gray-800 font-medium">
        @foreach ($professeurs as $professeur)
            <a href={{ route('profil', $professeur->user->id) }}>
                <div class="p-3 bg-light-blue-50 rounded-2xl cursor-pointer">
                    <div class="row">
                        <div class="col-3 h-24">
                            <img src="{{ url('img/' . $professeur->user->photo) }}" style="width: 100%;height:100%"
                                class="rounded-2xl object-cover">
                        </div>
                        <div class="col-9">
                            <div class="row">
                                <div class="col-6 p-1 bg-light-blue-600 rounded-full text-white text-center mb-1">
                                    {{ $professeur->modules[0]->filiere->designation }}
                                </div>
                                <div class="col-6 p-1 text-green-600 text-right">{{ $professeur->salaire }} DHS</div>
                                <div class="col-12 leading-7">{{ $professeur->user->nom . ' ' . $professeur->user->prenom }}
                                </div>
                                <div class="col-12 leading-7">Diplome : {{ ucfirst($professeur->diplome) }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
    <div class="grid grid-col-1 text-blue-800 text-center underline cursor-pointer mt-3 mb-3">
        <a href="{{ route('list', $professeur->user->role . 's') }}">
            View More
        </a>
    </div>
    <!-- ./Professeur-->

    <!-- Student-->
    <div class="grid grid-col-1 text-[#152259] text-4xl mt-3 mb-3">
        Students
    </div>
    <div class="grid lg:grid-cols-2 sm:grid-cols-1 gap-4 text-gray-800 font-medium">
        @foreach ($etudiants as $etudiant)
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
                                <div class="col-12 leading-7">{{ $etudiant->user->nom . ' ' . $etudiant->user->prenom }}
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
        @endforeach
    </div>
    <div class="grid grid-col-1 text-blue-800 text-center underline cursor-pointer mt-3 mb-3">
        <a href="{{ route('list', $etudiant->user->role . 's') }}">
            View More
        </a>
    </div>
    <!-- ./Student-->
    <!-- Parents-->
    <div class="grid grid-col-1 text-[#152259] text-4xl mt-3 mb-3">
        Parents
    </div>
    <div class="grid lg:grid-cols-2 sm:grid-cols-1 gap-4 text-gray-800 font-medium" href="#">
        @foreach ($parents as $parent)
            <div class="p-3 bg-light-blue-50 rounded-2xl cursor-pointer">
                <a href={{ route('profil', $parent->user->id) }}>
                    <div class="row">
                        <div class="col-3 h-24">
                            <img src="{{ url('img/' . $parent->user->photo) }}" style="width: 100%;height:100%"
                                class="rounded-2xl object-cover">
                        </div>
                        <div class="col-9">
                            <div class="row d-flex mt-3">
                                <div class="col-12 leading-7">{{ $parent->user->nom . ' ' . $parent->user->prenom }}</div>
                                <div class="col-12 leading-7">Its Students : @foreach ($parent->tuteur_details as $parent->tuteur_detail)
                                        {{ $parent->tuteur_detail->etudiant->user->nom . ', ' }}
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </a>

            </div>
        @endforeach
    </div>
    <div class="grid grid-col-1 text-blue-800 text-center underline cursor-pointer mt-3 mb-3">
        <a href="{{ route('list', $parent->user->role . 's') }}">
            View More
        </a>
    </div>
    <!-- ./Parents-->
@endsection
