<?php

namespace App\Http\Controllers;

use App\Models\album;
use App\Models\foto;
use App\Models\keranjang;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class uploadcontroller extends Controller
{
    // upload keranjang
    public function uploadkeranjang(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'photo' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('/upload')
                ->withErrors($validator);
        }

        foreach ($request->file('photo') as $foto) {
            $foto->storeAs('public/photo', $foto->hashName());
            $namafoto = $foto->hashName();

            keranjang::create([
                'photo' => $namafoto,
                'userId' => $request->iduser
            ]);
        }

        if (isset($request->idalbum)) {
            return redirect('/upload?status=' . $request->idalbum)->with('berhasil', 'Your post has been uploaded!');
        } else {
            return redirect('/upload')->with('berhasil', 'Your post has been uploaded!');
        }
    }
    // hapus keranjang
    public function hapuskeranjang(Request $request)
    {
        // menghapus gambar lama

        $data = keranjang::find($request->id);

        Storage::delete('public/photo/' . $data->photo);

        $data->delete();

        if (isset($request->idalbum)) {
            return redirect('/upload?status=' . $request->idalbum)->with('gagal', 'Your post has been deleted!');
        } else {
            return redirect('/upload')->with('gagal', 'Your post has been deleted!');
        }
    }
    // cancel keranjang
    public function cancelkeranjang(Request $request)
    {
        $id = $request->id;

        $data = keranjang::select('*')
            ->where('userId', $id);

        $data->delete();

        $album = album::select('*')
            ->where('userId', $id)
            ->get();

        $user = User::find($id);

        foreach ($album as $lbm) {
            $fotocount = foto::select('*')
                ->where('albumId', $lbm->id)
                ->count();

            if ($fotocount <= 0) {
                $hapusalbm = album::find($lbm->id);
                $hapusalbm->delete();
            }
        }

        if (isset($request->idalbum)) {
            return redirect('/seealbums' . $request->idalbum . "?status=albums-" . $user->username);
        } else {
            return redirect('/profile-' . $user->username);
        }
    }

    // upload foto
    public function uploadphoto(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'photo' => 'required',
            'choosealbum' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('/upload')
                ->withErrors($validator);
        }

        // ambil id album
        $idalbum = $request->choosealbum;

        // ambil data album sesuai id
        $album = album::select('*')
            ->where('id', $idalbum)
            ->first();

        // ambil nama album
        $namaalbum = $album->nama;
        $no = 1;

        foreach ($request->photo as $key => $foto) {
            $title = $request->title[$key];
            $title = strlen($title) > 50 ? substr($title, 0, 50) : $title;

            $caption = $request->caption[$key];


            if (is_null($title)) {
                $title = $namaalbum . " " . $no;

                while (foto::where('judul', $title)->where('albumId', $idalbum)->exists()) {
                    $no++;
                    $title = $namaalbum . " " . $no;
                }
            }

            foto::create([
                'judul' => $title,
                'deskripsi' => $caption,
                'tanggalfoto' => now(),
                'lokasifile' => $foto,
                'albumId' => $idalbum,
                'userId' => Auth::user()->id
            ]);
        }

        $ker = keranjang::select('*')
            ->where('userId', Auth::user()->id);

        $ker->delete();

        return redirect('/profile-' . Auth::user()->username)->with('berhasil', 'Your post has been successfully published!');
    }

    // create album
    public function createalbum(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'album_name' => 'required|max:50',
        ]);

        if ($validator->fails()) {
            return redirect('/upload')
                ->withErrors($validator);
        }

        album::create([
            'nama' => $request->album_name,
            'deskripsi' => $request->album_description,
            'tanggalalbum' => date('Y-m-d'),
            'userId' => Auth::user()->id
        ]);

        return redirect('/upload')->with('berhasil', 'Album added successfully!');
    }


    // update delete postingan and album

    // edit postingan
    public function updatepost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'idpost' => 'required',
            'title' => 'required|max:50',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator);
        }

        $foto = foto::find($request->idpost);

        $foto->update([
            'judul' => $request->title,
            'deskripsi' => $request->description
        ]);

        return back()->with('berhasil', 'Your post has been updated!');
    }

    // hapus postingan
    public function deletepost(Request $request)
    {
        $foto = foto::find($request->idpost);
        Storage::delete('public/photo/' . $foto->lokasifile);

        $foto->delete();

        $count = foto::select('*')
            ->where('albumId', $request->idalbum)
            ->count();

        $album = album::find($request->idalbum);

        if ($count <= 0) {
            $album->delete();
        }

        return redirect('/profile-' . $request->username)->with('berhasil', 'Your post has been successfully deleted!');
    }

    // edit album
    public function updatealbum(Request $request)
    {
        $album = album::find($request->idalbum);

        $album->update([
            'nama' => $request->title,
            'deskripsi' => $request->description
        ]);

        return back()->with('berhasil', 'Your album has been updated!');
    }

    // hapus album
    public function deletealbum(Request $request)
    {
        $album = album::find($request->idalbum);

        $foto = foto::select('lokasifile')
            ->where('albumId', $request->idalbum)
            ->get();

        foreach ($foto as $photo) {
            Storage::delete('public/photo/' . $photo->lokasifile);
        }

        $album->delete();

        return redirect('/albums-' . $request->username)->with('berhasil', 'Your album has been successfully deleted!');
    }
}
