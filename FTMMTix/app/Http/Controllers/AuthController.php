<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $type = $request->input('register_type');
        if ($type === 'student') {
            $data = $request->validate([
                'nim' => 'required|unique:students,nim',
                'name' => 'required',
                'password' => 'required|min:6',
            ]);
            $student = new \App\Models\Student();
            $student->nim = $data['nim'];
            $student->name = $data['name'];
            $student->password = \Hash::make($data['password']);
            $student->role = 'user';
            $student->save();
            return redirect()->route('login')->with('success', 'Registrasi mahasiswa berhasil, silakan login!');
        } elseif ($type === 'lecturer') {
            // Register dosen ke tabel lecturers
            $data = $request->validate([
                'name' => 'required',
                'nip' => 'required|unique:lecturers,nip',
                'password' => 'required|min:6',
            ]);

            $lecturer = new \App\Models\Lecturer();
            $lecturer->name = $data['name'];
            $lecturer->nip = $data['nip'];
            $lecturer->password = \Hash::make($data['password']);
            $lecturer->save();

            return redirect()->route('login')->with('success', 'Registrasi dosen berhasil, silakan login!');
        } elseif ($type === 'user') {
            $data = $request->validate([
                'email' => 'required|email|unique:users,email',
                'name' => 'required',
                'password' => 'required|min:6',
            ]);
            $user = new \App\Models\User();
            $user->email = $data['email'];
            $user->name = $data['name'];
            $user->password = \Hash::make($data['password']);
            $user->role = 'user';
            $user->save();
            return redirect()->route('login')->with('success', 'Registrasi user berhasil, silakan login!');
        }
        return back()->withErrors(['register_type' => 'Tipe register tidak valid']);
    }
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $type = $request->input('login_type');
        $password = $request->input('password');
        if ($type === 'student') {
            $data = $request->validate([
                'nim' => 'required',
                'password' => 'required',
            ]);
            $student = \App\Models\Student::where('nim', $data['nim'])->first();
            if ($student && Hash::check($data['password'], $student->password)) {
                Auth::guard('web')->login($student);
                session(['is_admin' => $student->role === 'admin']);
                return redirect()->route('home');
            }
            return back()->withErrors(['nim' => 'NIM atau password salah']);
        } elseif ($type === 'lecturer') {
            $data = $request->validate([
                'nip' => 'required',
                'password' => 'required',
            ]);
            $lecturer = \App\Models\Lecturer::where('nip', $data['nip'])->first();
            if ($lecturer && Hash::check($data['password'], $lecturer->password)) {
                Auth::guard('lecturer')->login($lecturer);
                return redirect()->route('home');
            }
            return back()->withErrors(['nip' => 'NIP atau password salah']);
        } elseif ($type === 'user') {
            $data = $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);
            $user = \App\Models\User::where('email', $data['email'])->first();
            if ($user && Hash::check($data['password'], $user->password)) {
                Auth::guard('user')->login($user);
                $request->session()->regenerate();
                return redirect()->route('home')->with('success', 'Login berhasil sebagai pengguna umum.');
            }
            return back()->withErrors(['email' => 'Email atau password salah']);
        }
        return back()->withErrors(['login_type' => 'Tipe login tidak valid']);
    }

    public function logout()
    {
        // Logout all guards to prevent session leakage
        if (Auth::guard('lecturer')->check()) {
            Auth::guard('lecturer')->logout();
        }
        if (Auth::guard('user')->check()) {
            Auth::guard('user')->logout();
        }
        if (Auth::guard('web')->check()) {
            Auth::guard('web')->logout();
        }
        session()->forget('is_admin'); // hapus status admin
        return redirect('/');
    }
}
