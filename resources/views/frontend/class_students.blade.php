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
                                <th>Note 1</th>
                                <th>Note 2</th>
                                <th>Devoir</th>
                                <th>Compos</th>
                                <th>Actions</th>
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
                                   note1
                                </td>
                                <td>
                                   note2
                                </td>
                                <td>
                                   Devoir
                                </td>
                                <td>
                                   Composition
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-outline-info"
                                            data-bs-toggle="modal"
                                            data-bs-target="#gradesModal{{ $student->id }}">
                                        Voir/Modifier
                                    </button>
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

<!-- Modals pour chaque étudiant -->
@foreach($students as $student)
<div class="modal fade" id="gradesModal{{ $student->id }}" tabindex="-1" aria-labelledby="gradesModalLabel{{ $student->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="gradesModalLabel{{ $student->id }}">
                    Notes de {{ $student->first_name }} {{ $student->last_name }} - {{ $subject->name }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @php
                    $studentGrades = $student->grades->where('subject_id', $subject->id)->where('school_classe_id', $class->id);
                @endphp

                <!-- Affichage des notes existantes -->
                <div class="mb-4">
                    <h6>Notes existantes :</h6>
                    @if($studentGrades->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Note</th>
                                        <th>Date</th>
                                        <th>Professeur</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($studentGrades as $grade)
                                    <tr>
                                        <td><span class="badge bg-primary">{{ $grade->note }}/20</span></td>
                                        <td>{{ $grade->created_at->format('d/m/Y') }}</td>
                                        <td>{{ $grade->user->name ?? 'N/A' }}</td>
                                        <td>
                                            <form method="POST" action="{{ route('teacher.grade.delete', $grade->id) }}"
                                                  style="display: inline;"
                                                  onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette note ?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="alert alert-info">
                            <strong>Moyenne :</strong> {{ round($studentGrades->avg('note'), 2) }}/20
                        </div>
                    @else
                        <div class="alert alert-warning">
                            Aucune note enregistrée pour cet élève dans cette matière.
                        </div>
                    @endif
                </div>

                <!-- Formulaire d'ajout de note -->
                <div class="border-top pt-3">
                    <h6>Ajouter une nouvelle note :</h6>
                    <form method="POST" action="{{ route('teacher.grade.store') }}">
                        @csrf
                        <input type="hidden" name="student_id" value="{{ $student->id }}">
                        <input type="hidden" name="subject_id" value="{{ $subject->id }}">
                        <input type="hidden" name="school_classe_id" value="{{ $class->id }}">

                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="note{{ $student->id }}" class="form-label">Note (sur 20) :</label>
                                    <input type="number"
                                           class="form-control"
                                           id="note{{ $student->id }}"
                                           name="note"
                                           min="0"
                                           max="20"
                                           step="0.5"
                                           required>
                                </div>
                            </div>
                            <div class="col-md-4 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fa fa-plus"></i> Ajouter
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection
