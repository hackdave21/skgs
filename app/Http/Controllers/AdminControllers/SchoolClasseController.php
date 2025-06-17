<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\SchoolClasse;
use Illuminate\Http\Request;

class SchoolClasseController extends Controller
{
    public function index()
    {
        $school_classes = SchoolClasse::all();
        return view('admin.school_classes.index', compact('school_classes'));
    }

    public function create()
    {
        return view('admin.school_classes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        SchoolClasse::create($request->only(['name']));

        return redirect()->route('admin.school_classes.index')->with('success', 'Classe ajoutée avec succès');
    }

    public function edit($id)
    {
        $school_classe = SchoolClasse::findOrFail($id);
        return view('admin.school_classes.edit', compact('school_classe'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:school_classes,name,' . $id,
        ]);

        $school_classe = SchoolClasse::findOrFail($id);
        $school_classe->update($request->only(['name']));

        return redirect()->route('admin.school_classes.index')->with('success', 'Classe mise à jour avec succès');
    }

    public function destroy($id)
    {
        SchoolClasse::findOrFail($id)->delete();
        return redirect()->route('admin.school_classes.index')->with('success', 'Classe supprimée avec succès');
    }
}
