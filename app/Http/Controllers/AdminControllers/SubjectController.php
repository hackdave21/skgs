<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::all();
        return view('admin.subjects.index', compact('subjects'));
    }

    public function create()
    {
        return view('admin.subjects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:subjects',
            'coefficient' => 'required|integer|min:1|max:20',
        ]);

        Subject::create($request->only('name', 'coefficient'));

        return redirect()->route('admin.subjects.index')->with('success', 'La matière a été ajoutée avec succès');
    }

    public function edit($id)
    {
        $subject = Subject::findOrFail($id);
        return view('admin.subjects.edit', compact('subject'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:subjects,name,' . $id,
            'coefficient' => 'required|integer|min:1|max:20',
        ]);

        $subject = Subject::findOrFail($id);
        $subject->update($request->only('name', 'coefficient'));

        return redirect()->route('admin.subjects.index')->with('success', 'La matière a été mise à jour avec succès');
    }

    public function delete($id)
    {
        Subject::findOrFail($id)->delete();
        return redirect()->route('admin.subjects.index')->with('success', 'La matière a été supprimée avec succès');
    }
}
