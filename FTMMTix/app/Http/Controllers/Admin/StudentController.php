<?php
namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function index() {
        $students = Student::all();
        return view('students.index', compact('students'));
    }

    public function create() {
        return view('students.create');
    }

    public function store(Request $request) {
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

        return redirect()->route('students.index')->with('success', 'Mahasiswa berhasil ditambahkan');
    }

    public function edit(Student $student) {
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, Student $student) {
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

        return redirect()->route('students.index')->with('success', 'Mahasiswa berhasil diperbarui');
    }

    public function destroy(Student $student) {
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Mahasiswa berhasil dihapus');
    }
}
