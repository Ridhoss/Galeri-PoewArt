<?php

namespace App\Http\Controllers;

use App\Models\follow;
use App\Models\komentar;
use App\Models\likefoto;
use Illuminate\Http\Request;

class likecommentcontroller extends Controller
{
    // like
    public function aksilike(Request $request)
    {
        likefoto::create([
            'fotoId' => $request->idfoto,
            'userId' => $request->iduser,
            'tanggallike' => date('Y-m-d')
        ]);

        return back();
    }
    // unlike
    public function aksiunlike(Request $request)
    {
        $unlike = likefoto::select('*')
            ->where('fotoId', $request->idfoto)
            ->where('userId', $request->iduser)
            ->first();

        $unlike->delete();

        return back();
    }
    // aksi comment
    public function aksicomment(Request $request)
    {
        komentar::create([
            'fotoId' => $request->idfoto,
            'userId' => $request->iduser,
            'isikomentar' => $request->comment,
            'tanggalkomentar' => date('Y-m-d')
        ]);

        return back();
    }
    // delete comment 
    public function aksideletecomment(Request $request)
    {
        $hapus = komentar::find($request->id);

        $hapus->delete();

        return back()->with('berhasil', 'Your comment has been deleted!');
    }

    // follow
    public function aksifollow(Request $request)
    {
        follow::create([
            'who' => $request->idwho,
            'to' => $request->idto,
            'tanggalfollow' => date('Y-m-d')
        ]);

        return back();
    }
    // unfollow
    public function aksiunfollow(Request $request)
    {
        $unfollow = follow::find($request->idfollow);

        $unfollow->delete();

        return back();
    }
}
