<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class logincontroller extends Controller
{

    // register
    public function aksiregister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'email' => 'required|unique:users',
            'username' => 'required|unique:users',
            'password' => 'required|min:8'
        ]);

        if ($validator->fails()) {
            return redirect('/register')
                ->withErrors($validator);
        }

        // hashing password
        $password = Hash::make($request['password']);

        $name = $request->first_name . " " . $request->last_name;

        User::create([
            'username' => $request->username,
            'password' => $password,
            'email' => $request->email,
            'nama' => $name,
            'alamat' => null,
            'foto' => 'default.png'
        ]);

        return redirect('/')->with('register', '');
    }


    // login
    public function aksilogin(Request $request)
    {
        $login = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::guard('web')->attempt($login)) {
            $request->session()->regenerate();

            return redirect()->intended('/home');
        }

        return back()->with('gagallogin', '');
    }

    // logout
    public function aksilogout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->intended('/');
    }
}
