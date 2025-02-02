@extends('admin.home_page')

@section('title', 'Ajouter un Nouvel Elève')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Ajouter un Nouvel Elève</h4>
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

                    <form action="{{ route('admin.students.store') }}" method="POST">
                        @csrf

                        <!-- Champ Prénom -->
                        <div class="mb-3">
                            <label for="first_name" class="form-label">Prénom de l'élève <span
                                    style="color: red;">*</span></label>
                            <input type="text" class="form-control" id="first_name" name="first_name"
                                value="{{ old('first_name') }}" required>
                        </div>

                        <!-- Champ Nom -->
                        <div class="mb-3">
                            <label for="last_name" class="form-label">Nom de l'élève <span
                                    style="color: red;">*</span></label>
                            <input type="text" class="form-control" id="last_name" name="last_name"
                                value="{{ old('last_name') }}" required>
                        </div>

                        <!-- Champ Matricule -->
                        <div class="mb-3">
                            <label for="matricule_number" class="form-label">Numéro de matricule <span
                                    style="color: red;">*</span></label>
                            <input type="text" class="form-control" id="matricule_number" name="matricule_number"
                                value="{{ old('matricule_number') }}" required>
                        </div>

                        <!-- Sélection de la classe -->
                        <div class="mb-3">
                            <label for="school_classe_id" class="form-label">Classe de l'élève <span
                                    style="color: red;">*</span></label>
                            <select class="form-control" id="school_classe_id" name="school_classe_id" required>
                                <option value="" disabled selected>Sélectionnez une classe</option>
                                @foreach ($school_classes as $class)
                                    <option value="{{ $class->id }}"
                                        {{ old('school_classe_id') == $class->id ? 'selected' : '' }}>
                                        {{ $class->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Bouton de soumission -->
                        <button type="submit" class="btn btn-success">Enregistrer l'élève</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
