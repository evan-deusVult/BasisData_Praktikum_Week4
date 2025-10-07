<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lecturer;
use Illuminate\Support\Facades\Hash;

class LecturerController extends Controller
{
    // Edit akun sendiri
    public function editSelf()
    {
        if (!auth('lecturer')->check()) {
            return redirect()->route('login');
        }
        $lecturer = auth('lecturer')->user();
        return view('lecturers.edit', compact('lecturer'));
    }

    // Update akun sendiri
    public function updateSelf(Request $request)
    {
        if (!auth('lecturer')->check()) {
            return redirect()->route('login');
        }
        $lecturer = auth('lecturer')->user();
        $request->validate([
            'nip' => 'required|unique:lecturers,nip,' . $lecturer->id,
            'name' => 'required',
        ]);
        $lecturer->update([
            'nip' => $request->nip,
            'name' => $request->name,
            'password' => $request->password ? Hash::make($request->password) : $lecturer->password,
        ]);
        return redirect('/')->with('success', 'Akun berhasil diperbarui.');
    }

    // Hapus akun sendiri
    public function destroySelf(Request $request)
    {
        if (!auth('lecturer')->check()) {
            return redirect()->route('login');
        }
        $lecturer = auth('lecturer')->user();
        $lecturer->delete();
        auth('lecturer')->logout();
        return redirect('/')->with('success', 'Akun Anda berhasil dihapus.');
    }
}