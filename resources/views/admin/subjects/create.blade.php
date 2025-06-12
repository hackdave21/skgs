@extends('admin.home_page')
@section('title', 'Ajouter une Nouvelle Matière')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Ajouter une Nouvelle Matière</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Détails de la matière</h4>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('admin.subjects.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nom de la matière <span style="color: red;">*</span></label>
                            <input type="text" class="form-control" id="name" name="name"
                                   value="{{ old('name') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="coefficient" class="form-label">Coefficient <span style="color: red;">*</span></label>
                            <select class="form-control" id="coefficient" name="coefficient" required>
                                <option value="">Sélectionnez un coefficient</option>
                                @for($i = 1; $i <= 10; $i++)
                                    <option value="{{ $i }}" {{ old('coefficient') == $i ? 'selected' : '' }}>
                                        {{ $i }}
                                    </option>
                                @endfor
                            </select>
                        </div>

                        <button type="submit" class="btn btn-success">Ajouter la matière</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
