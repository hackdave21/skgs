<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = User::all();
        return view('admin.teachers.index', compact('teachers'));
    }

    public function create()
    {
        return view('admin.teachers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:teachers',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('admin.teachers.index')->with('success', 'Teacher added successfully');
    }

    public function edit($id)
    {
        $teacher = User::findOrFail($id);
        return view('admin.teachers.edit', compact('teacher'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:teachers,email,' . $id,
        ]);

        $teacher = User::findOrFail($id);
        $teacher->update($request->only('name', 'email'));

        return redirect()->route('admin.teachers.index')->with('success', 'Teacher updated successfully');
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->route('admin.teachers.index')->with('success', 'Teacher deleted successfully');
    }
}
