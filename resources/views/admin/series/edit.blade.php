@extends('admin.home_page')
@section('title', 'Modifier une Série')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Modifier une Série</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Détails de la série</h4>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('admin.series.update', $serie->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom de la série <span style="color: red;">*</span></label>
                            <input type="text" class="form-control" id="nom" name="nom"
                                   value="{{ old('nom', $serie->nom) }}" required>
                        </div>
                        <button type="submit" class="btn btn-success">Mettre à jour la série</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
