@extends('admin.home_page')

@section('title', 'Liste des Élèves par Classe')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Liste des Élèves par Classe</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Bouton pour ajouter un nouvel élève -->
                    {{-- <a href="{{ route('admin.students.create') }}" class="btn btn-primary mb-3">Ajouter un nouvel élève</a> --}}

                    <!-- Affichage des élèves par classe -->
                    @foreach ($school_classes as $school_classe)
                        <div class="mb-4">
                            <h5 class="header-title">{{ $school_classe->name }} <small>({{ $school_classe->students->count() }} élèves)</small></h5>
                            @if ($school_classe->students->isNotEmpty())
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nom</th>
                                            <th>Prénom</th>

                                            <th>Numéro de Matricule</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($school_classe->students as $student)
                                            <tr>
                                                <td>{{ $student->id }}</td>
                                                <td>{{ $student->last_name }}</td>
                                                <td>{{ $student->first_name }}</td>

                                                <td>{{ $student->matricule_number }}</td>
                                                <td>
                                                    <!-- Lien pour modifier -->
                                                    <a href="{{ route('admin.students.edit', $student->id) }}" class="btn btn-warning btn-sm">Modifier</a>

                                                    <!-- Formulaire pour supprimer -->
                                                    <form action="{{ route('admin.students.delete', $student->id) }}" method="POST" style="display: inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet élève ?')">Supprimer</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p>Aucun élève n'est inscrit dans cette classe.</p>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
