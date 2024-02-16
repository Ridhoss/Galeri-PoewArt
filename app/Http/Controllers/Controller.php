<?php

namespace App\Http\Controllers;

use App\Models\album;
use App\Models\follow;
use App\Models\foto;
use App\Models\keranjang;
use App\Models\komentar;
use App\Models\likefoto;
use App\Models\User;
use GuzzleHttp\Promise\Create;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

use function Laravel\Prompts\select;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;


    // halaman

    // login
    public function halamanlogin()
    {
        return view('login');
    }
    // register
    public function halamanregister()
    {
        return view('register');
    }
    // home
    public function halamanhome()
    {
        $foto = foto::inRandomOrder();

        $today = date('Y-m-d');

        $currentTime = date('Y-m-d H:i:s');

        $new = foto::select('*')
            ->where('tanggalfoto', $today)
            ->whereRaw("TIMESTAMPDIFF(MINUTE, created_at, '$currentTime') < 10")
            ->orderBy('id', 'desc');

        return view('page.home', [
            'user' => Auth::user(),
            'foto' => $foto->get(),
            'new' => $new->get(),
            'countnew' => $new->count()
        ]);
    }

    // halaman like
    public function halamanlike()
    {
        $like = likefoto::select('likefotos.*', 'fotos.*')
            ->join('fotos', 'fotos.id', '=', 'likefotos.fotoId')
            ->where('likefotos.userId', Auth::user()->id);

        return view('page.like', [
            'user' => Auth::user(),
            'like' => $like->get(),
            'countlike' => $like->count()
        ]);
    }

    // upload
    public function halamanupload()
    {
        $datakeranjang = keranjang::select('*')
            ->where('userId', Auth::user()->id);

        $dataalbum = album::select('*')
            ->where('userId', Auth::user()->id);

        return view('page.upload', [
            'user' => Auth::user(),
            'keranjang' => $datakeranjang->get(),
            'album' => $dataalbum->get(),
            'countkeranjang' => $datakeranjang->count()
        ]);
    }

    // profile
    public function halamanprofile($username)
    {

        $user = user::select('*')
            ->where('username', $username)
            ->first();

        $infofollow = follow::select('*')
            ->where('who', Auth::user()->id)
            ->where('to', $user->id)
            ->first();

        // count 
        $countfoto = foto::select('*')
            ->where('userId', $user->id)->count();
        $countalbum = album::select('*')
            ->where('userId', $user->id)->count();
        $countlike = likefoto::select('*')
            ->where('userId', $user->id)->count();
        $followers = follow::select('*')
            ->where('to', $user->id);
        $following = follow::select('*')
            ->where('who', $user->id);

        $foto = foto::select('*')
            ->where('userId', $user->id)
            ->orderBy('created_at', 'desc');

        return view('page.profile.profile-photos', [
            'user' => Auth::user(),
            'userprofile' => $user,
            'datafoto' => $foto->get(),
            'countlike' => $countlike,
            'countfoto' => $countfoto,
            'countalbum' => $countalbum,
            'infofollow' => $infofollow,
            'countfollowers' => $followers->count(),
            'countfollowing' => $following->count(),
        ]);
    }
    // halaman edit profile
    public function editprofile()
    {
        return view('page.profile.editprofile', [
            'user' => Auth::user()
        ]);
    }

    // album
    public function halamanprofilealbum($username)
    {

        $user = user::select('*')
            ->where('username', $username)
            ->first();

        $infofollow = follow::select('*')
            ->where('who', Auth::user()->id)
            ->where('to', $user->id)
            ->first();

        // count 
        $countfoto = foto::select('*')
            ->where('userId', $user->id)->count();
        $countalbum = album::select('*')
            ->where('userId', $user->id)->count();
        $countlike = likefoto::select('*')
            ->where('userId', $user->id)->count();
        $followers = follow::select('*')
            ->where('to', $user->id);
        $following = follow::select('*')
            ->where('who', $user->id);

        $album = Album::select('albums.*', 'fotos.lokasifile AS foto', 'fotos.albumId')
            ->join('fotos', 'albums.id', '=', 'fotos.albumId')
            ->where('albums.userId', $user->id)
            ->get()
            ->groupBy('albumId');

        return view('page.profile.profile-album', [
            'user' => Auth::user(),
            'userprofile' => $user,
            'dataalbum' => $album,
            'countlike' => $countlike,
            'countfoto' => $countfoto,
            'countalbum' => $countalbum,
            'infofollow' => $infofollow,
            'countfollowers' => $followers->count(),
            'countfollowing' => $following->count(),
        ]);
    }

    // like
    public function halamanprofilelike($username)
    {

        $user = user::select('*')
            ->where('username', $username)
            ->first();

        $infofollow = follow::select('*')
            ->where('who', Auth::user()->id)
            ->where('to', $user->id)
            ->first();

        // count 
        $countfoto = foto::select('*')
            ->where('userId', $user->id)->count();
        $countalbum = album::select('*')
            ->where('userId', $user->id)->count();
        $countlike = likefoto::select('*')
            ->where('userId', $user->id)->count();
        $followers = follow::select('*')
            ->where('to', $user->id);
        $following = follow::select('*')
            ->where('who', $user->id);

        $like = likefoto::select('likefotos.*', 'fotos.*')
            ->join('fotos', 'fotos.id', '=', 'likefotos.fotoId')
            ->where('likefotos.userId', $user->id)
            ->orderBy('likefotos.created_at', 'desc');

        return view('page.profile.profile-like', [
            'user' => Auth::user(),
            'userprofile' => $user,
            'datalike' => $like->get(),
            'countlike' => $countlike,
            'countfoto' => $countfoto,
            'countalbum' => $countalbum,
            'infofollow' => $infofollow,
            'countfollowers' => $followers->count(),
            'countfollowing' => $following->count(),
        ]);
    }


    // lihat photo 
    public function halamanphoto(Request $request, $id)
    {
        $kondisi = $request->query('status');

        $pisah = explode('-', $kondisi);

        if ($pisah[0] == "profile") {
            $back = "/" . $kondisi;
        } else if ($pisah[0] == "albums") {
            $back = "/" . $kondisi;
        } else if ($pisah[0] == "like") {
            $back = "/" . $kondisi;
        } else {
            $back = "/home";
        }

        $foto = foto::find($id);

        $user = User::select('*')
            ->where('id', $foto->userId)->first();


        // like

        // apakah user sudah like postingan ini
        $infouserlike = likefoto::select('*')
            ->where('fotoId', $id)
            ->where('userId', Auth::user()->id)
            ->first();
        $infolike = likefoto::select('*')
            ->where('fotoId', $id)
            ->join('users', 'users.id', 'likefotos.userId');


        // comment

        $commentar = komentar::select('komentars.*', 'users.foto', 'users.id AS iduser', 'users.foto', 'users.username', 'users.nama')
            ->where('FotoId', $id)
            ->join('users', 'komentars.UserId', '=', 'users.id');

        return view('page.photo', [
            'user' => Auth::user(),
            'foto' => $foto,
            'userdata' => $user,
            'infouserlike' => $infouserlike,
            'totallike' => $infolike->count(),
            'peoplelike' => $infolike->get(),
            'totalcomment' => $commentar->count(),
            'comment' => $commentar->get(),
            'back' => $back

        ]);
    }

    // lihat album
    public function halamanalbum(Request $request, $id)
    {

        $kondisi = $request->query('status');

        $pisah = explode('-', $kondisi);

        if ($pisah[0] == "albums") {
            $back = "/" . $kondisi;
        } else {
            $back = "/home";
        }

        $album = album::find($id);

        $albumuser = user::select('*')
            ->where('id', $album->userId)
            ->first();

        $fotoalbum = foto::select('*')
            ->where('albumId', $id);

        return view('page.album', [
            'user' => Auth::user(),
            'back' => $back,
            'album' => $album,
            'foto' => $fotoalbum->get(),
            'countfoto' => $fotoalbum->count(),
            'albumuser' => $albumuser

        ]);
    }

    // halaman analytic
    public function halamananalytic()
    {

        $user = Auth::user();

        $datafoto = foto::select('*')
            ->selectRaw('(SELECT COUNT(*) FROM likefotos WHERE likefotos.fotoId = fotos.id) AS total_like')
            ->selectRaw('(SELECT COUNT(*) FROM komentars WHERE komentars.fotoId = fotos.id) AS total_komen')
            ->where('userId', $user->id)
            ->orderByDesc('total_like')
            ->orderByDesc('total_komen');


        return view('page.analytic', [
            'user' => Auth::user(),
            'datafoto' => $datafoto->get(),
            'countfoto' => $datafoto->count()
        ]);
    }


    // halaman search
    public function halamansearch(Request $request)
    {

        $user = User::select('*')
            ->where('username', 'like', '%' . $request->search . '%')
            ->orWhere('nama', 'like', '%' . $request->search . '%');

        $foto = foto::select('*')
            ->where('judul', 'like', '%' . $request->search . '%');

        return view('page.search', [
            'user' => Auth::user(),
            'oldsearch' => $request->search,
            'datauser' => $user->get(),
            'countdatauser' => $user->count(),
            'datafoto' => $foto->get(),
            'countdatafoto' => $foto->count()
        ]);
    }
}
