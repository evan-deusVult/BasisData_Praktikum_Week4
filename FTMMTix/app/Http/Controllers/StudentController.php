<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;


class StudentController extends Controller
{

    // Edit akun sendiri
    public function editSelf()
    {
        $student = auth()->user();
        return view('students.edit', compact('student'));
    }

    // Update akun sendiri
    public function updateSelf(Request $request)
    {
        $student = auth()->user();
        $request->validate([
            'nim' => 'required|unique:students,nim,' . $student->id,
            'name' => 'required',
        ]);
        $student->update([
            'nim' => $request->nim,
            'name' => $request->name,
            'password' => $request->password ? Hash::make($request->password) : $student->password,
        ]);
    return redirect('/')->with('success', 'Akun berhasil diperbarui.');
    }

    // Hapus akun sendiri
    public function destroySelf(Request $request)
    {
        $user = auth()->user();
        $user->delete();
        auth()->logout();
        return redirect('/')->with('success', 'Akun Anda berhasil dihapus.');
    }


    // Simpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required|unique:students',
            'name' => 'required',
            'email' => 'required|email|unique:students',
            'password' => 'required|min:6',
        ]);

        Student::create([
            'nim' => $request->nim,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('students.index')->with('success', 'Student berhasil ditambahkan.');
    }

    // Form edit
    public function edit($id)
    {
        $student = Student::findOrFail($id);
        return view('students.edit', compact('student'));
    }

    // Update data
    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);

        $request->validate([
            'nim' => 'required|unique:students,nim,' . $student->id,
            'name' => 'required',
            'email' => 'required|email|unique:students,email,' . $student->id,
        ]);

        $student->update([
            'nim' => $request->nim,
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $student->password,
        ]);

        return redirect()->route('students.index')->with('success', 'Student berhasil diperbarui.');
    }

    // Hapus data
    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Student berhasil dihapus.');
    }

    // ...existing code...
}
