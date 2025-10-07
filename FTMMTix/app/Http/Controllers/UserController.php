<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    public function editSelf()
    {
        $user = Auth::guard('user')->user();
        return view('account.edit', ['user' => $user, 'type' => 'user']);
    }

    public function updateSelf(Request $request)
    {
        $user = Auth::guard('user')->user();
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'nullable|min:6',
        ]);
        $user->name = $data['name'];
        $user->email = $data['email'];
        if (!empty($data['password'])) {
            $user->password = bcrypt($data['password']);
        }
        $user->save();
    return redirect('/')->with('success', 'Akun berhasil diupdate!');
    }

    public function destroySelf(Request $request)
    {
        $user = Auth::guard('user')->user();
        Auth::guard('user')->logout();
        $user->delete();
        return redirect('/')->with('success', 'Akun berhasil dihapus.');
    }
}
