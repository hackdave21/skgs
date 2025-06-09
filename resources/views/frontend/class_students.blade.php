@extends('frontend.layout')

@section('content')
<section class="course-section spad">
    <div class="container">
        <div class="section-title mb-0">
            <h2>Liste des Élèves - {{ $class->name }} ({{ $subject->name }})</h2>
            <p>Gestion des élèves et saisie des notes pour cette classe</p>
        </div>
    </div>

    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="header-title">{{ $class->name }} - {{ $subject->name }}</h4>
                    <span class="badge bg-primary">{{ $students->count() }} élèves</span>
                </div>

                @if($students->isNotEmpty())
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Matricule</th>
                                <th>Notes</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($students as $student)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $student->last_name }}</td>
                                <td>{{ $student->first_name }}</td>
                                <td>{{ $student->matricule_number }}</td>

                                <td>
                                    <a href="#" class="btn btn-sm btn-outline-info">Voir</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="alert alert-info">
                    Aucun élève n'est inscrit dans cette classe.
                </div>
                @endif
            </div>
        </div>

    </div>
</section>
@endsection
