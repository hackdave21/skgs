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
                                <th>Moyenne</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($students as $student)
                            @php
                                $studentGrade = $student->grades->where('subject_id', $subject->id)->where('school_classe_id', $class->id)->first();
                            @endphp
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $student->last_name }}</td>
                                <td>{{ $student->first_name }}</td>
                                <td>{{ $student->matricule_number }}</td>
                                <td>
                                    @if($studentGrade && $studentGrade->note1)
                                        <span class="badge bg-info">{{ $studentGrade->note1 }}/20</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    @if($studentGrade && $studentGrade->note2)
                                        <span class="badge bg-info">{{ $studentGrade->note2 }}/20</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    @if($studentGrade && $studentGrade->devoir)
                                        <span class="badge bg-warning">{{ $studentGrade->devoir }}/20</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    @if($studentGrade && $studentGrade->compos)
                                        <span class="badge bg-success">{{ $studentGrade->compos }}/20</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    @if($studentGrade)
                                        @php
                                            $notes = collect([$studentGrade->note1, $studentGrade->note2, $studentGrade->devoir, $studentGrade->compos])->filter();
                                            $moyenne = $notes->count() > 0 ? round($notes->avg(), 2) : null;
                                        @endphp
                                        @if($moyenne)
                                            <span class="badge bg-primary">{{ $moyenne }}/20</span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
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
@php
    $studentGrade = $student->grades->where('subject_id', $subject->id)->where('school_classe_id', $class->id)->first();
@endphp
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
                <!-- Affichage et modification des notes -->
                <div class="mb-4">
                    <h6>Gestion des notes :</h6>

                    @if($studentGrade)
                        <!-- Formulaire de modification des notes existantes -->
                        <div class="row">
                            <!-- Note 1 -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Note 1 (sur 20) :</label>
                                <div class="input-group">
                                    <form method="POST" action="{{ route('teacher.grade.update', $studentGrade->id) }}" class="d-flex w-100">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="note_type" value="note1">
                                        <input type="number" class="form-control" name="note_value"
                                               value="{{ $studentGrade->note1 }}" min="0" max="20" step="0.25">
                                        <button type="submit" class="btn btn-outline-primary btn-sm">
                                            <i class="fa fa-save"></i>
                                        </button>
                                        @if($studentGrade->note1)
                                        <form method="POST" action="{{ route('teacher.grade.delete-specific', $studentGrade->id) }}" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="note_type" value="note1">
                                            <button type="submit" class="btn btn-outline-danger btn-sm">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                        @endif
                                    </form>
                                </div>
                            </div>

                            <!-- Note 2 -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Note 2 (sur 20) :</label>
                                <div class="input-group">
                                    <form method="POST" action="{{ route('teacher.grade.update', $studentGrade->id) }}" class="d-flex w-100">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="note_type" value="note2">
                                        <input type="number" class="form-control" name="note_value"
                                               value="{{ $studentGrade->note2 }}" min="0" max="20" step="0.25">
                                        <button type="submit" class="btn btn-outline-primary btn-sm">
                                            <i class="fa fa-save"></i>
                                        </button>
                                        @if($studentGrade->note2)
                                        <form method="POST" action="{{ route('teacher.grade.delete-specific', $studentGrade->id) }}" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="note_type" value="note2">
                                            <button type="submit" class="btn btn-outline-danger btn-sm">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                        @endif
                                    </form>
                                </div>
                            </div>

                            <!-- Devoir -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Devoir (sur 20) :</label>
                                <div class="input-group">
                                    <form method="POST" action="{{ route('teacher.grade.update', $studentGrade->id) }}" class="d-flex w-100">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="note_type" value="devoir">
                                        <input type="number" class="form-control" name="note_value"
                                               value="{{ $studentGrade->devoir }}" min="0" max="20" step="0.25">
                                        <button type="submit" class="btn btn-outline-primary btn-sm">
                                            <i class="fa fa-save"></i>
                                        </button>
                                        @if($studentGrade->devoir)
                                        <form method="POST" action="{{ route('teacher.grade.delete-specific', $studentGrade->id) }}" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="note_type" value="devoir">
                                            <button type="submit" class="btn btn-outline-danger btn-sm">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                        @endif
                                    </form>
                                </div>
                            </div>

                            <!-- Composition -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Composition (sur 20) :</label>
                                <div class="input-group">
                                    <form method="POST" action="{{ route('teacher.grade.update', $studentGrade->id) }}" class="d-flex w-100">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="note_type" value="compos">
                                        <input type="number" class="form-control" name="note_value"
                                               value="{{ $studentGrade->compos }}" min="0" max="20" step="0.25">
                                        <button type="submit" class="btn btn-outline-primary btn-sm">
                                            <i class="fa fa-save"></i>
                                        </button>
                                        @if($studentGrade->compos)
                                        <form method="POST" action="{{ route('teacher.grade.delete-specific', $studentGrade->id) }}" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="note_type" value="compos">
                                            <button type="submit" class="btn btn-outline-danger btn-sm">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                        @endif
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Affichage de la moyenne -->
                        @php
                            $notes = collect([$studentGrade->note1, $studentGrade->note2, $studentGrade->devoir, $studentGrade->compos])->filter();
                            $moyenne = $notes->count() > 0 ? round($notes->avg(), 2) : null;
                        @endphp
                        @if($moyenne)
                            <div class="alert alert-info">
                                <strong>Moyenne actuelle :</strong> {{ $moyenne }}/20
                            </div>
                        @endif

                        <!-- Bouton pour supprimer toutes les notes -->
                        <div class="mt-3">
                            <form method="POST" action="{{ route('teacher.grade.delete', $studentGrade->id) }}"
                                  onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer toutes les notes de cet élève ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger">
                                    <i class="fa fa-trash"></i> Supprimer toutes les notes
                                </button>
                            </form>
                        </div>
                    @else
                        <!-- Formulaire pour ajouter la première note -->
                        <div class="alert alert-warning">
                            Aucune note enregistrée pour cet élève dans cette matière.
                        </div>

                        <div class="border-top pt-3">
                            <h6>Ajouter une première note :</h6>
                            <form method="POST" action="{{ route('teacher.grade.store') }}">
                                @csrf
                                <input type="hidden" name="student_id" value="{{ $student->id }}">
                                <input type="hidden" name="subject_id" value="{{ $subject->id }}">
                                <input type="hidden" name="school_classe_id" value="{{ $class->id }}">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Type de note :</label>
                                            <select name="note_type" class="form-control" required>
                                                <option value="">Sélectionner...</option>
                                                <option value="note1">Note 1</option>
                                                <option value="note2">Note 2</option>
                                                <option value="devoir">Devoir</option>
                                                <option value="compos">Composition</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Note (sur 20) :</label>
                                            <input type="number" class="form-control" name="note_value"
                                                   min="0" max="20" step="0.25" required>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-plus"></i> Ajouter la note
                                </button>
                            </form>
                        </div>
                    @endif
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
