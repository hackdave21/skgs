@extends('frontend.layout')

@section('title', 'Saisie des notes')

@section('content')
    <h1>Saisie des notes pour {{ $subject->name }}</h1>
    <h2>Classe : {{ $schoolClass->name }}</h2>

    <form action="{{ route('notes.store') }}" method="POST">
        @csrf
        <table>
            <thead>
                <tr>
                    <th>Élève</th>
                    <th>Note</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $student)
                    <tr>
                        <td>{{ $student->first_name }} {{ $student->last_name }}</td>
                        <td>
                            <input type="number" name="notes[{{ $student->id }}]" min="0" max="20" required>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <button type="submit">Enregistrer les notes</button>
    </form>
@endsection
