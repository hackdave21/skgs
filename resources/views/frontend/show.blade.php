@extends('frontend.layout')

@section('title', 'Liste de la Classe')

@section('content')
    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">{{ $schoolClasse->name }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="about-info">
                                        <h4>Informations de la classe</h4>

                                        <!-- Nombre d'élèves -->
                                        <div class="student-count mb-4">
                                            <h5>Effectif total : {{ $schoolClasse->students->count() }} élèves</h5>
                                        </div>

                                        <!-- Liste des élèves -->
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>N°</th>
                                                        <th>Nom</th>
                                                        <th>Prénom</th>
                                                        <th>Matricule</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($schoolClasse->students as $key => $student)
                                                        <tr>
                                                            <td>{{ $key + 1 }}</td>
                                                            <td>{{ $student->last_name }}</td>
                                                            <td>{{ $student->first_name }}</td>
                                                            <td>{{ $student->matricule_number }}</td>
                                                            <td>
                                                                <a href="#"
                                                                    class="btn btn-sm btn-primary btn-add-notes"
                                                                    data-student-id="{{ $student->id }}">
                                                                    Ajouter ses notes
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Gestion du clic sur le bouton "Ajouter ses notes"
        $('.btn-add-notes').on('click', function(e) {
            e.preventDefault();
            const studentId = $(this).data('student-id');
            const schoolClassId = {{ $schoolClasse->id }};

            // Récupérer les matières et les notes existantes
            $.ajax({
                url: `/notes/get-subjects/${schoolClassId}/${studentId}`,
                type: 'GET',
                success: function(response) {
                    // Afficher le nom de l'élève
                    $('#studentName').text(`Notes de ${response.student.first_name} ${response.student.last_name}`);

                    // Vider le conteneur des matières
                    $('#subjectsContainer').empty();

                    // Ajouter les champs pour chaque matière
                    response.subjects.forEach(function(subject) {
                        const existingNote = subject.studentNotes.length > 0 ? subject.studentNotes[0].pivot.note : '';

                        $('#subjectsContainer').append(`
                            <div class="mb-3">
                                <label for="note-${subject.id}" class="form-label">${subject.name}</label>
                                <input type="number" class="form-control" id="note-${subject.id}"
                                    name="notes[${subject.id}][value]" min="0" max="20" step="0.25"
                                    value="${existingNote}">
                                <input type="hidden" name="notes[${subject.id}][subject_id]" value="${subject.id}">
                            </div>
                        `);
                    });

                    // Configurer le bouton d'enregistrement
                    $('#saveNotes').off('click').on('click', function() {
                        const formData = {
                            student_id: studentId,
                            school_class_id: schoolClassId,
                            subject_id: response.subjects[0].id, // On prend la première matière comme référence
                            notes: []
                        };

                        // Récupérer toutes les notes
                        response.subjects.forEach(function(subject) {
                            const value = $(`#note-${subject.id}`).val();
                            if (value) {
                                formData.notes.push({
                                    subject_id: subject.id,
                                    value: value
                                });
                            }
                        });

                        // Envoyer les données
                        $.ajax({
                            url: '{{ route("notes.store") }}',
                            type: 'POST',
                            data: formData,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                // Fermer le modal
                                $('#notesModal').modal('hide');
                                // Afficher un message de succès
                                alert('Notes enregistrées avec succès');
                            },
                            error: function(error) {
                                console.error(error);
                                alert('Erreur lors de l\'enregistrement des notes');
                            }
                        });
                    });

                    // Afficher le modal
                    $('#notesModal').modal('show');
                },
                error: function(error) {
                    console.error(error);
                    alert('Erreur lors de la récupération des matières');
                }
            });
        });
    });
</script>
@endsection
