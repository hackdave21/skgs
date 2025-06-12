@extends('admin.home_page')

@section('title', 'Liste des Séries')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Liste des Séries disponibles</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Séries</h4>

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                      <!-- Bouton pour ajouter une nouvelle série -->
                      <a href="{{ route('admin.series.create') }}" class="btn btn-primary mb-3">Ajouter une nouvelle série</a>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nom de la série</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($series as $serie)
                                <tr>
                                    <td>{{ $serie->id }}</td>
                                    <td>{{ $serie->nom }}</td>
                                    <td>
                                        <a href="{{ route('admin.series.edit', $serie->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                                        <form action="{{ route('admin.series.delete', $serie->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette série ?')">Supprimer</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
