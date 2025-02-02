@extends('admin.home_page')
@section('title', 'Modifier un Élève')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Modifier un Élève</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Détails de l'élève</h4>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('admin.students.update', $student->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Champ Prénom -->
                        <div class="mb-3">
                            <label for="first_name" class="form-label">Prénom <span style="color: red;">*</span></label>
                            <input type="text" class="form-control" id="first_name" name="first_name"
                                   value="{{ old('first_name', $student->first_name) }}" required>
                        </div>

                        <!-- Champ Nom -->
                        <div class="mb-3">
                            <label for="last_name" class="form-label">Nom <span style="color: red;">*</span></label>
                            <input type="text" class="form-control" id="last_name" name="last_name"
                                   value="{{ old('last_name', $student->last_name) }}" required>
                        </div>

                        <!-- Champ Numéro de Matricule -->
                        <div class="mb-3">
                            <label for="matricule_number" class="form-label">Numéro de Matricule <span style="color: red;">*</span></label>
                            <input type="text" class="form-control" id="matricule_number" name="matricule_number"
                                   value="{{ old('matricule_number', $student->matricule_number) }}" required>
                        </div>

                        <!-- Champ Classe -->
                        <div class="mb-3">
                            <label for="school_classe_id" class="form-label">Classe <span style="color: red;">*</span></label>
                            <select class="form-select" id="school_classe_id" name="school_classe_id" required>
                                <option value="" disabled {{ old('school_classe_id') === null ? 'selected' : '' }}>Sélectionnez une classe</option>
                                @foreach ($school_classes as $class)
                                    <option value="{{ $class->id }}"
                                        {{ old('school_classe_id', $student->school_classe_id) == $class->id ? 'selected' : '' }}>
                                        {{ $class->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Bouton de soumission -->
                        <button type="submit" class="btn btn-success">Mettre à jour l'élève</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
