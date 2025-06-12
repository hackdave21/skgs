<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use Illuminate\Http\Request;

class SerieController extends Controller
{
      public function index()
    {
        $series = Serie::all();
        return view('admin.series.index', compact('series'));
    }

    public function create()
    {
        return view('admin.series.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255|unique:series',
        ]);

        Serie::create($request->only('nom'));

        return redirect()->route('admin.series.index')->with('success', 'Série ajoutée avec succès');
    }

    public function edit($id)
    {
        $serie = Serie::findOrFail($id);
        return view('admin.series.edit', compact('serie'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required|string|max:255|unique:series,nom,' . $id,
        ]);

        $serie = Serie::findOrFail($id);
        $serie->update($request->only('nom'));

        return redirect()->route('admin.series.index')->with('success', 'Série mise à jour avec succès');
    }

    public function destroy($id)
    {
        Serie::findOrFail($id)->delete();
        return redirect()->route('admin.series.index')->with('success', 'Série supprimée avec succès');
    }
}
