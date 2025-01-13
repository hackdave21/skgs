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
        ]);

        Subject::create($request->only('name'));

        return redirect()->route('admin.subjects.index')->with('success', 'Subject added successfully');
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
        ]);

        $subject = Subject::findOrFail($id);
        $subject->update($request->only('name'));

        return redirect()->route('admin.subjects.index')->with('success', 'Subject updated successfully');
    }

    public function destroy($id)
    {
        Subject::findOrFail($id)->delete();
        return redirect()->route('admin.subjects.index')->with('success', 'Subject deleted successfully');
    }
}
