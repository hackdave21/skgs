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
                                                @foreach($schoolClasse->students as $key => $student)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $student->last_name }}</td>
                                                    <td>{{ $student->first_name }}</td>
                                                    <td>{{ $student->matricule_number }}</td>
                                                    <td>
                                                        <a href="#" class="btn btn-sm btn-primary">
                                                           ajouter ses notes
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
    $('.table').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/fr-FR.json'
        }
    });
});
</script>
@endsection
