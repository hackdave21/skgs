@extends('admin.home_page')

@section('title', 'Liste des Enseignants')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Liste des Enseignants disponibles</h4>
            </div>
        </div>
    </div>

    @if (session('success'))
        <div class="row">
            <div class="col-12">
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            </div>
        </div>
    @endif

    {{-- Affichage en cartes --}}
    <div class="row">
        @foreach($users as $user)
            <div class="col-xl-6 col-lg-6 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <h5 class="card-title mb-1">
                                    {{ $user->sex == 'M' ? 'M.' : 'Mme' }} {{ $user->first_name }} {{ $user->last_name }}
                                </h5>
                                <span class="badge badge-info">ID: {{ $user->id }}</span>
                            </div>
                            <div class="d-flex">
                                <a href="{{ route('admin.teachers.edit', $user->id) }}" class="text-success mr-3" title="Modifier">

                                    <div class="border border-green  rounded p-1">
                                         <i class="mdi mdi-pencil mdi-18px"></i>
                                    </div>
                                </a>
                                <form action="{{ route('admin.teachers.delete', $user->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-link text-danger p-0" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet enseignant ?')" title="Supprimer">
                                       <div class="border border-danger  rounded p-1">
                                            <i class="mdi mdi-delete mdi-18px"></i>
                                        </div>
                                    </button>
                                </form>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-2">
                                    <strong>Email:</strong><br>
                                    <small class="text-muted">{{ $user->email }}</small>
                                </div>
                                <div class="mb-2">
                                    <strong>Téléphone:</strong><br>
                                    <small class="text-muted">{{ $user->phone_number }}</small>
                                </div>
                                <div class="mb-2">
                                    <strong>Diplôme:</strong><br>
                                    <small class="text-muted">{{ $user->diplome }}</small>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-2">
                                    <strong>Matières:</strong><br>
                                    @if ($user->subjects && $user->subjects->count() > 0)
                                            {{-- CORRECTION: Utiliser unique() pour éliminer les doublons --}}
                                            {{ $user->subjects->unique('id')->pluck('name')->implode(', ') }}
                                        @else
                                            Aucune matière
                                        @endif
                                </div>
                                <div class="mb-2">
                                    <strong>Classes:</strong><br>
                                     @if ($user->schoolClasses && $user->schoolClasses->count() > 0)
                                            {{-- CORRECTION: Utiliser unique() pour éliminer les doublons --}}
                                            {{ $user->schoolClasses->unique('id')->pluck('name')->implode(', ') }}
                                        @else
                                            Aucune classe
                                        @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Si aucun enseignant --}}
    @if($users->count() == 0)
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="text-muted">Aucun enseignant trouvé</h5>
                        <p class="text-muted">Il n'y a actuellement aucun enseignant enregistré dans le système.</p>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
