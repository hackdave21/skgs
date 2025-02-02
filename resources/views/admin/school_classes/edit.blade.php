@extends('admin.home_page')
@section('title', 'Modifier une Classe')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Modifier une Classe</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Détails de la classe</h4>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('admin.school_classes.update', $school_classe->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label">Nom de la classe <span style="color: red;">*</span></label>
                            <input type="text" class="form-control" id="name" name="name"
                                   value="{{ old('name', $school_classe->name) }}" required>
                        </div>
                        <button type="submit" class="btn btn-success">Mettre à jour la classe</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
