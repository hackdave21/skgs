@extends('admin.home_page')

@section('title', 'Modifier un Enseignant')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Modifier un Enseignant</h4>
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

                    <form action="{{ route('admin.teachers.update', $users->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="first_name" class="form-label">Prénom <span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" id="first_name" name="first_name"
                                           value="{{ old('first_name', $users->first_name) }}" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="last_name" class="form-label">Nom <span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" id="last_name" name="last_name"
                                           value="{{ old('last_name', $users->last_name) }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email <span style="color: red;">*</span></label>
                                    <input type="email" class="form-control" id="email" name="email"
                                           value="{{ old('email', $users->email) }}" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="phone_number" class="form-label">Numéro de téléphone <span style="color: red;">*</span></label>
                                    <input type="number" class="form-control" id="phone_number" name="phone_number"
                                           value="{{ old('phone_number', $users->phone_number) }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="sex" class="form-label">Sexe <span style="color: red;">*</span></label>
                                    <select class="form-select" id="sex" name="sex" required>
                                        <option value="">Sélectionnez</option>
                                        <option value="M" {{ old('sex', $users->sex) == 'M' ? 'selected' : '' }}>Masculin</option>
                                        <option value="F" {{ old('sex', $users->sex) == 'F' ? 'selected' : '' }}>Féminin</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="diplome" class="form-label">Diplôme <span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" id="diplome" name="diplome"
                                           value="{{ old('diplome', $users->diplome) }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Matières <span style="color: red;">*</span></label>
                                    @foreach($subjects as $subject)
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="subject_{{ $subject->id }}"
                                                   name="subject_ids[]" value="{{ $subject->id }}"
                                                   {{ in_array($subject->id, old('subject_ids', $users->subjects->pluck('id')->toArray())) ? 'checked' : '' }}>
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
                                            <input type="checkbox" class="form-check-input" id="class_{{ $school_classe->id }}"
                                                   name="school_classe_ids[]" value="{{ $school_classe->id }}"
                                                   {{ in_array($school_classe->id, old('school_classe_ids', $users->schoolClasses->pluck('id')->toArray())) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="class_{{ $school_classe->id }}">{{ $school_classe->name }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success">Mettre à jour l'enseignant</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
