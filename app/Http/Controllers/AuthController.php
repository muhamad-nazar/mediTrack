<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    //Jalankan fungsi Login
    public function login(Request $request) {
        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            // Jika Berhasil
            Session::flash('success', 'Selamat Datang!');
            return redirect()->route('dashboard');
        } else {
            // Jika otentikasi gagal
            return redirect()->back()->withErrors(['error' => 'Email atau Password Salah']);
        }
    }

    //Update Profile
    public function updateProfile(Request $request)
    {
        $request->validate([
        'name' => 'required|string|max:100',
        'email' => 'required|email|max:100|unique:users,email,' . auth()->id(),
        // Password optional, tapi jika diisi harus minimal 6 karakter dan cocok dengan konfirmasi
        'password' => 'nullable|min:6|confirmed',
        ]);

        $user = auth()->user();
        $user->name = $request->name;
        $user->email = $request->email;

        // Jika password diisi, hash dan simpan
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->update();

        return redirect()->route('profile')->with('success', 'Profil berhasil diperbarui.');
    }


    //Logout
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
