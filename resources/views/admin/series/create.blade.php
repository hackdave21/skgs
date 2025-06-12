@extends('admin.home_page')
@section('title', 'Ajouter une Nouvelle Série')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Ajouter une Nouvelle Série</h4>
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
                    <form action="{{ route('admin.series.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom de la série <span style="color: red;">*</span></label>
                            <input type="text" class="form-control" id="nom" name="nom"
                                   value="{{ old('nom') }}" required>
                        </div>
                        <button type="submit" class="btn btn-success">Ajouter la série</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
