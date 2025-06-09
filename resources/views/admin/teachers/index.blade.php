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

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Enseignants</h4>
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- Ajouter un bouton pour créer un nouvel enseignant --}}
                    {{-- <a href="{{ route('admin.teachers.create') }}" class="btn btn-primary mb-3">Ajouter un nouvel enseignant</a> --}}

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Email</th>
                                <th>Téléphone</th>
                                <th>Sexe</th>
                                <th>Diplôme</th>
                                <th>Matières</th>
                                <th>Classes</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->last_name }}</td>
                                    <td>{{ $user->first_name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone_number }}</td>
                                    <td>{{ $user->sex == 'M' ? 'Masculin' : 'Féminin' }}</td>
                                    <td>{{ $user->diplome }}</td>

                                    <td>
                                        @if ($user->subjects && $user->subjects->count() > 0)
                                            {{-- CORRECTION: Utiliser unique() pour éliminer les doublons --}}
                                            {{ $user->subjects->unique('id')->pluck('name')->implode(', ') }}
                                        @else
                                            Aucune matière
                                        @endif
                                    </td>

                                    <td>
                                        @if ($user->schoolClasses && $user->schoolClasses->count() > 0)
                                            {{-- CORRECTION: Utiliser unique() pour éliminer les doublons --}}
                                            {{ $user->schoolClasses->unique('id')->pluck('name')->implode(', ') }}
                                        @else
                                            Aucune classe
                                        @endif
                                    </td>

                                    <td>
                                        <a href="{{ route('admin.teachers.edit', $user->id) }}" class="btn btn-warning btn-sm">Modifier</a> <br>
                                        <form action="{{ route('admin.teachers.delete', $user->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet enseignant ?')">Supprimer</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
