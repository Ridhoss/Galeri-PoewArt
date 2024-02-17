@extends('layout.layout')

@section('style')
    <style>
        :root {
            /* color */

            --primary: #333c4b;
            --preprimary: #4a4c5c;
            --bootstrapsecondary: #6c577d;
            --secondary: #d4a056;
            --black: #000;
            --white: #fff;
            --redpastel: #ff6868;
            --greenpastel: #74E291;
            --poppins: poppins;
        }

        .album-title-albumpage {
            font-size: 35px;
            color: var(--primary);
        }

        .album-description-albumpage {
            font-size: 15px;
            color: var(--bootstrapsecondary)
        }

        .info-albumpage {
            font-size: 16px;
            font-weight: bold;
            color: var(--primary);
        }

        .info-albumpage>a {
            text-decoration: none;
            color: var(--primary);
        }

        .info-albumpage>a:hover {
            text-decoration: underline;
            color: var(--secondary);
        }

        .img-info-albumbpage {
            width: 30px;
            height: 30px;
            object-fit: cover;
            border-radius: 50%;
        }

        .img-post-album {
            width: 15.7rem;
            /* object-fit: cover; */
            border-radius: 10px;
        }

        .img-post-album:hover {
            opacity: 50%;
            transition: 0.3s;
            scale: 0.95;
        }

        .icon-edit-album-albumpage {
            color: var(--primary);
            border: 2px solid var(--primary);
            border-radius: 10px;
        }

        .icon-edit-album-albumpage:hover {
            color: var(--greenpastel);
            border: 2px solid var(--greenpastel);
            transition: 0.3s;
            scale: 0.9;
            cursor: pointer;
        }

        .bback {
            border: 2px solid var(--bootstrapsecondary);
            color: var(--bootstrapsecondary);
        }

        .bbars {
            border: 2px solid var(--bootstrapsecondary);
            color: var(--bootstrapsecondary);
        }

        .bback:hover {
            color: var(--black);
            border: 2px solid var(--black);
            cursor: pointer;
            transition: 0.2s;
            scale: 0.95;
        }

        .bbars:hover {
            color: var(--secondary);
            border: 2px solid var(--secondary);
            cursor: pointer;
            transition: 0.2s;
            scale: 0.95;
        }
    </style>
@endsection

@section('content')
    <div class="p-4">
        <div class="border-bottom">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="album-title-albumpage">{{ $album->nama }} Album</h1>
                <div class="d-flex align-items-center">
                    <div class="dropdown">
                        <a href="" class=" drother" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="icon fa-solid fa-bars bbars p-2 rounded fs-5 mx-1"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="d-flex align-items-center p-2"><a
                                    class="dropdown-item text-secondary text-decoration-none rounded"
                                    href="/profile-{{ $albumuser->username }}"><i class="fa-solid fa-user me-3"></i>Open
                                    this account's profile</a></li>
                            @if ($album->userId == $user->id)
                                <li class="d-flex align-items-center p-2"><a href="/upload?status={{ $album->id }}" class="dropdown-item text-secondary text-decoration-none rounded"><i
                                            class="fa-solid fa-plus me-3"></i>Add Photo to this album</a>
                                </li>
                                <li class="d-flex align-items-center p-2"><a
                                        class="dropdown-item text-secondary text-decoration-none rounded"
                                        data-bs-toggle="modal" data-bs-target="#editalbum"><i
                                            class="fa-solid fa-pencil me-3"></i>Edit this album</a>
                                </li>
                                <li class="d-flex align-items-center p-2"><a
                                        class="dropdown-item text-secondary text-decoration-none rounded"
                                        data-bs-toggle="modal" data-bs-target="#deletealbum"><i
                                            class="fa-solid fa-trash me-3"></i>Delete this album</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                    <a href="{{ $back }}"><i class="icon fa-solid fa-xmark bback p-2 rounded fs-5 mx-2"></i></a>
                </div>
            </div>
            @if ($albumuser->foto == 'default.png')
                <h2 class="info-albumpage"><a href="/profile-{{ $albumuser->username }}" class="p-2"><img
                            src="assets/default/default.png"
                            class="img-info-albumbpage me-2">{{ $albumuser->username }}</a>, <span>{{ $countfoto }}
                        Photo</span></h2>
            @else
                <h2 class="info-albumpage"><a href="/profile-{{ $albumuser->username }}" class="p-2"><img
                            src="{{ Storage::url('public/users/' . $albumuser->foto) }}"
                            class="img-info-albumbpage me-2">{{ $albumuser->username }}</a>, <span>{{ $countfoto }}
                        Photo</span></h2>
            @endif

            @if ($album->deskripsi == null)
                <P class="album-description-albumpage px-2">There isn't any description.</P>
            @else
                <p class="album-description-albumpage px-2">{{ $album->deskripsi }}</p>
            @endif
        </div>
        <div class="mt-4" data-masonry='{"percentPosition": true }'>
            @foreach ($foto as $isi)
                <a href="/photo{{ $isi->id }}?status=albums-{{ $albumuser->username }}" class="me-2 mb-2"><img
                        src="{{ Storage::url('public/photo/' . $isi->lokasifile) }}"
                        class="img-post-album border border-2"></a>
            @endforeach
        </div>
    </div>

    <!-- Modal edit post -->
    <div class="modal fade" id="editalbum" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit your album</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/updatealbum" method="POST">
                    @csrf
                    <input type="hidden" name="idalbum" value="{{ $album->id }}">
                    <div class="modal-body p-4">
                        <div class="w-100 mb-3">
                            <h6>Album title (Max 50 Char)</h6>
                            <input type="text" class="form-control" name="title" placeholder="Post Title"
                                value="{{ $album->nama }}" maxlength="50" required>
                        </div>
                        <div class="w-100">
                            <h6>Description</h6>
                            <textarea name="description" cols="30" rows="3" placeholder="Add Description" class="form-control">{{ $album->deskripsi }}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal hapus post -->
    <div class="modal fade" id="deletealbum" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Delete this album?</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/deletealbum" method="POST">
                    @csrf
                    <input type="hidden" name="idalbum" value="{{ $album->id }}">
                    <input type="hidden" name="username" value="{{ $user->username }}">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
