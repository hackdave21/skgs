<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\SchoolClasse;
use Illuminate\Http\Request;

class SchoolClasseController extends Controller
{
    public function index()
    {
        $classes = SchoolClasse::all();
        return view('admin.classes.index', compact('classes'));
    }

    public function create()
    {
        return view('admin.classes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:school_classes',
        ]);

        SchoolClasse::create($request->only('name'));

        return redirect()->route('admin.classes.index')->with('success', 'Class added successfully');
    }

    public function edit($id)
    {
        $class = SchoolClasse::findOrFail($id);
        return view('admin.classes.edit', compact('class'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:school_classes,name,' . $id,
        ]);

        $class = SchoolClasse::findOrFail($id);
        $class->update($request->only('name'));

        return redirect()->route('admin.classes.index')->with('success', 'Class updated successfully');
    }

    public function destroy($id)
    {
        SchoolClasse::findOrFail($id)->delete();
        return redirect()->route('admin.classes.index')->with('success', 'Class deleted successfully');
    }
}
