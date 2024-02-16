<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class profilecontroller extends Controller
{
    // edit profile
    public function updateprofile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email,' . $request->id,
            'username' => 'required|unique:users,username,' . $request->id,
            'address' => 'required',
            'photo' => 'image|mimes:jpg,jpeg,png'
        ]);


        if ($validator->fails()) {
            return redirect('/editprofile')
                ->withErrors($validator);
        }

        $name = $request->first_name . " " . $request->last_name;

        if ($request->hasFile('photo')) {

            if ($request->oldphoto != "default.png") {

                // upload gambar
                $photo = $request->file('photo');
                $photo->storeAs('public/users', $photo->hashName());
                // menghapus gambar lama
                Storage::delete('public/users/' . $request->oldphoto);
            } else {

                // upload gambar
                $photo = $request->file('photo');
                $photo->storeAs('public/users', $photo->hashName());
            }

            $users = User::find($request->id);

            $users->update([
                'username' => $request->username,
                'email' => $request->email,
                'nama' => $name,
                'alamat' => $request->address,
                'foto' => $photo->hashName()
            ]);
        } else {

            $users = User::find($request->id);

            $users->update([
                'username' => $request->username,
                'email' => $request->email,
                'nama' => $name,
                'alamat' => $request->address
            ]);
        }

        return redirect('/editprofile')->with('berhasil', 'Biodata has been successfully changed!');
    }


    // edit password user
    public function updatepassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required',
            'newpassword' => 'required',
            'confirmation' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('/editprofile')
                ->withErrors($validator);
        }

        $datauser = User::find($request->id);

        if (Hash::check($request->password, $datauser->password)) {

            if ($request->newpassword == $request->confirmation) {

                // hashing password
                $password = Hash::make($request['newpassword']);

                $datauser->update([
                    'password' => $password
                ]);
            } else {
                return redirect('/editprofile')->with('gagal', 'The confirmation password is incorrect!');
            }
        } else {
            return redirect('/editprofile')->with('gagal', 'The current password is incorrect!');
        }

        return redirect('/editprofile')->with('berhasil', 'The password has been changed!');
    }
}
