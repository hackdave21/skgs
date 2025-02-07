@extends('admin.home_page')

@section('title', 'Ajouter un Enseignant')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Ajouter un Nouveau Enseignant</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Détails de l'enseignant</h4>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.teachers.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="first_name" class="form-label">Prénom <span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" id="first_name" name="first_name"
                                           value="{{ old('first_name') }}" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="last_name" class="form-label">Nom <span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" id="last_name" name="last_name"
                                           value="{{ old('last_name') }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email <span style="color: red;">*</span></label>
                                    <input type="email" class="form-control" id="email" name="email"
                                           value="{{ old('email') }}" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="phone_number" class="form-label">Numéro de téléphone <span style="color: red;">*</span></label>
                                    <input type="number" class="form-control" id="phone_number" name="phone_number"
                                           value="{{ old('phone_number') }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="sex" class="form-label">Sexe <span style="color: red;">*</span></label>
                                    <select class="form-select" id="sex" name="sex" required>
                                        <option value="">Sélectionnez</option>
                                        <option value="M" {{ old('sex') == 'M' ? 'selected' : '' }}>Masculin</option>
                                        <option value="F" {{ old('sex') == 'F' ? 'selected' : '' }}>Féminin</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="diplome" class="form-label">Diplôme <span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" id="diplome" name="diplome"
                                           value="{{ old('diplome') }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Matieres <span style="color: red;">*</span></label>
                                    @foreach($subjects as $subject)
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="subject_{{ $subject->id }}" name="subject_ids[]"
                                                   value="{{ $subject->id }}"
                                                   {{ in_array($subject->id, old('subject_ids', [])) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="subject_{{ $subject->id }}">{{ $subject->name }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Classes <span style="color: red;">*</span></label>
                                    @foreach($schoolClasses as $school_classe)
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="class_{{ $school_classe->id }}" name="school_classe_ids[]"
                                                   value="{{ $school_classe->id }}"
                                                   {{ in_array($school_classe->id, old('school_classe_ids', [])) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="class_{{ $school_classe->id }}">{{ $school_classe->name }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Mot de passe <span style="color: red;">*</span></label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>

                        <button type="submit" class="btn btn-success">Ajouter l'enseignant</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
