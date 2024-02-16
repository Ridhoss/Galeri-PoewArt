@extends('layout.layout')

@section('style')
    <style>
        /* packed */
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

        @font-face {
            font-family: poppins;
            src: url(assets/icon/Poppins-Regular.ttf);
        }

        * {
            font-family: var(--poppins);
        }

        /* endpacked */

        .foto-pemilik-postingan {
            width: 40px;
            height: 40px;
            object-fit: cover;
            border-radius: 50%;
        }

        .img-content {
            width: 100%;
            height: 100%;
            object-fit: contain;
            border-radius: 10px;
        }

        .inner-content-photo {
            height: 69vh;
        }

        .comment-photo {
            width: 30px;
            height: 30px;
            object-fit: cover;
            border-radius: 50%;
        }

        .inner-caption {
            overflow: auto;
            width: 100%;
            height: 90%;
            padding-bottom: 10px;
        }

        .inner-comment {
            height: 10%;
            padding-top: 1.3rem;
        }

        .send {
            color: var(--bootstrapsecondary);
            margin-top: 0.2rem
        }

        .send:hover {
            color: var(--secondary);
            transition: 0.2s;
            cursor: pointer;
        }

        .icon {
            border: 2px solid var(--bootstrapsecondary);
            color: var(--bootstrapsecondary);
        }

        .bliked:hover {
            color: var(--redpastel);
            border: 2px solid var(--redpastel);
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

        .bback:hover {
            color: var(--black);
            border: 2px solid var(--black);
            cursor: pointer;
            transition: 0.2s;
            scale: 0.95;
        }

        .info-like {
            text-decoration: none;
            color: var(--bootstrapsecondary);

        }

        .info-like:hover {
            text-decoration: underline;
            cursor: pointer;
            color: var(--black);
        }

        .likesubmit {
            text-decoration: none;
            background: none;
            border: none;
        }

        .liked {
            color: var(--redpastel);
            border: 2px solid var(--redpastel);
        }

        .liked:hover {
            color: var(--bootstrapsecondary);
            border: 2px solid var(--bootstrapsecondary);
            cursor: pointer;
            transition: 0.2s;
        }

        .dcomment {
            color: var(--bootstrapsecondary);
        }

        .dcomment:hover {
            color: var(--redpastel);
            transition: 0.2s;
            cursor: pointer;
        }

        .drother {
            text-decoration: none;
            border: none;
            margin: 0;

        }

        .tgl-post-photopage {
            font-size: 14px;
            margin: 0;
            color: var(--bootstrapsecondary);
        }

        .tgl-comment-photopage {
            font-size: 14px;
            margin: 0;
            color: var(--bootstrapsecondary);
        }

        .info-pemilik-postingan-atas {
            text-decoration: none;
            color: var(--primary);
        }

        .info-pemilik-postingan-atas:hover {
            text-decoration: underline;
            cursor: pointer;
        }

        .p-desk-content {
            word-wrap: break-word;
            overflow-wrap: break-word;
        }

        .people-like-img {
            width: 35px;
            height: 35px;
            object-fit: cover;
            border-radius: 50%;

        }

        .people-like-user {
            font-size: 18px;
        }

        .sem-acc {
            text-decoration: none;
            color: var(--primary);
        }

        .sem-acc:hover {
            text-decoration: underline;
            color: var(--secondary);
            cursor: pointer;
        }

        .a-jdl-photo {
            text-decoration: none;
            color: var(--primary);
            font-weight: bold;
        }
    </style>
@endsection

@section('content')
    {{-- alert --}}

    @error('title')
        <div class="alert alert-danger alert-dismissible fade show position-absolute top-0 end-0 me-4 mt-4" role="alert">
            <strong>Data Failed!</strong> {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @enderror

    {{-- endalert --}}

    <div class="p-4">
        <div class="content-photo border rounded p-2">
            <div class="border-bottom pb-2 d-flex align-items-center justify-content-between">
                <a href="/profile-{{ $userdata->username }}" class="info-pemilik-postingan-atas">
                    <div class="d-flex align-items-center">
                        @if ($userdata->foto == 'default.png')
                            <img src="assets/default/default.png" alt="" class="foto-pemilik-postingan me-2">
                        @else
                            <img src="{{ Storage::url('public/users/' . $userdata->foto) }}" alt=""
                                class="foto-pemilik-postingan me-2">
                        @endif
                        <h1 class="fs-6 mt-2">{{ $userdata->username }}</h1>
                    </div>
                </a>
                <div class="d-flex align-items-center">
                    @if ($infouserlike == null)
                        <form action="/like" method="POST" id="likeform">
                            @csrf
                            <input type="hidden" name="idfoto" value="{{ $foto->id }}">
                            <input type="hidden" name="iduser" value="{{ $user->id }}">
                            <button type="submit" class="likesubmit" id="likebtn"
                                onclick="this.disabled=true;this.form.submit();"><i
                                    class="icon fa-regular fa-heart bliked p-2 rounded fs-5"></i></button>
                        </form>
                    @else
                        <form action="/unlike" method="POST" id="unlikeform">
                            @csrf
                            <input type="hidden" name="idfoto" value="{{ $foto->id }}">
                            <input type="hidden" name="iduser" value="{{ $user->id }}">
                            <button type="submit" class="likesubmit" id="unlikebtn"><i
                                    class="icon liked fa-solid fa-heart p-2 rounded fs-5"></i></button>
                        </form>
                    @endif
                    <div class="d-flex">
                        <div class="dropdown">
                            <a href="" class=" drother" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="icon fa-solid fa-bars bbars p-2 rounded fs-5 mx-1"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="d-flex align-items-center p-2"><a
                                        class="dropdown-item text-secondary text-decoration-none rounded"
                                        href="/profile-{{ $userdata->username }}"><i class="fa-solid fa-user me-3"></i>Open
                                        this account's profile</a></li>
                                @if ($foto->userId == $user->id)
                                    <li class="d-flex align-items-center p-2"><a
                                            class="dropdown-item text-secondary text-decoration-none rounded"
                                            data-bs-toggle="modal" data-bs-target="#editpost"><i
                                                class="fa-solid fa-pencil me-3"></i>Edit this post</a></li>
                                    <li class="d-flex align-items-center p-2"><a
                                            class="dropdown-item text-secondary text-decoration-none rounded"
                                            data-bs-toggle="modal" data-bs-target="#deletepost"><i
                                                class="fa-solid fa-trash me-3"></i>Delete this post</a></li>
                                @endif
                            </ul>
                        </div>
                        <a href="{{ $back }}"><i class="icon fa-solid fa-xmark bback p-2 rounded fs-5 mx-2"></i></a>
                    </div>
                </div>
            </div>
            <div class="inner-content-photo d-flex p-2">
                <div class="col-7 border-end">
                    <img src="{{ Storage::url('public/photo/' . $foto->lokasifile) }}" class="img-content">
                </div>
                <div class="col-5 p-4">
                    <div class="inner-caption pe-3">
                        <div class="pb-2 border-bottom">
                            <h6 class="fs-5"><span class="fw-bold"><a href="/profile-{{ $userdata->username }}" class="a-jdl-photo">{{ $userdata->username }}</a>
                                </span>{{ $foto->judul }}</h6>
                            <p class="tgl-post-photopage mb-1">
                                {{ \Carbon\Carbon::createFromFormat('Y-m-d', $foto->tanggalfoto)->format('d F Y') }}</p>
                            <a href="" data-bs-toggle="modal" data-bs-target="#peoplelike"
                                class="info-like">{{ $totallike }} people liked this post <i
                                    class="fa-solid fa-heart"></i></a>
                        </div>
                        @if ($foto->deskripsi == null)
                            <p class="text-secondary border-bottom py-2 text-center">There isn't any description.</p>
                        @else
                            <p class="text-secondary border-bottom py-2 p-desk-content">{{ $foto->deskripsi }}</p>
                        @endif
                        <h5>{{ $totalcomment }} Comment</h5>

                        @foreach ($comment as $komentar)
                            <div class="mt-2 border rounded p-2">
                                <div class="d-flex justify-content-between align-items-center text-wrap">
                                    <div class="d-flex">
                                        @if ($komentar->foto == 'default.png')
                                            <img src="assets/default/default.png"
                                                class="comment-photo me-2 align-items-center">
                                        @else
                                            <img src="{{ Storage::url('public/users/' . $komentar->foto) }}"
                                                class="comment-photo me-2 align-items-center">
                                        @endif
                                        <p class="text-secondary mt-1 text-break"><span
                                                class="fw-bold">{{ $komentar->username }}
                                            </span>{{ $komentar->isikomentar }}</p>
                                    </div>
                                    @if ($komentar->userId == $user->id)
                                        <i class="fa-solid fa-trash px-3 dcomment" data-bs-toggle="modal"
                                            data-bs-target="#hapuskomen{{ $komentar->id }}"></i>
                                    @endif
                                </div>
                                <p class="tgl-comment-photopage ms-2">
                                    {{ Carbon\Carbon::createFromFormat('Y-m-d', $komentar->tanggalkomentar)->format('d F Y') }}
                                </p>
                            </div>
                        @endforeach

                    </div>
                    <div class="inner-comment">
                        <form action="/comment" method="POST">
                            @csrf
                            <div class="d-flex align-items-center">
                                <input type="hidden" name="idfoto" value="{{ $foto->id }}">
                                <input type="hidden" name="iduser" value="{{ $user->id }}">
                                <input type="text" class="form-control" name="comment" placeholder="Comment here">
                                <button type="submit" class="likesubmit"
                                    onclick="this.disabled=true;this.form.submit();"><i
                                        class="send fa-solid fa-paper-plane p-2 rounded fs-5"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @foreach ($comment as $komentar)
        <!-- Modal hapus komen -->
        <div class="modal fade" id="hapuskomen{{ $komentar->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Your Comment?</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="/deletecomment" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $komentar->id }}">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach


    <!-- Modal edit post -->
    <div class="modal fade" id="editpost" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit your post</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/updatepost" method="POST">
                    @csrf
                    <input type="hidden" name="idpost" value="{{ $foto->id }}">
                    <div class="modal-body p-4">
                        <div class="w-100 mb-3">
                            <h6>Post title (Max 50 Char)</h6>
                            <input type="text" class="form-control" name="title" placeholder="Post Title"
                                value="{{ $foto->judul }}" maxlength="50" required>
                        </div>
                        <div class="w-100">
                            <h6>Description</h6>
                            <textarea name="description" cols="30" rows="3" placeholder="Add Description" class="form-control">{{ $foto->deskripsi }}</textarea>
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
    <div class="modal fade" id="deletepost" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Delete this post?</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/deletepost" method="POST">
                    @csrf
                    <input type="hidden" name="idpost" value="{{ $foto->id }}">
                    <input type="hidden" name="username" value="{{ $user->username }}">
                    <input type="hidden" name="idalbum" value="{{ $foto->albumId }}">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal lihat like -->
    <div class="modal fade" id="peoplelike" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">People like your post</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    @foreach ($peoplelike as $ppllk)
                        <a href="/profile-{{ $ppllk->username }}" class="sem-acc">
                            <div class="pb-1 mb-1 border-bottom d-flex align-items-center">
                                @if ($ppllk->foto == 'default.png')
                                    <img src="assets/default/default.png" class="people-like-img">
                                @else
                                    <img src="{{ Storage::url('public/users/' . $ppllk->foto) }}" class="people-like-img">
                                @endif
                                <h1 class="people-like-user mt-2 ms-2">{{ $ppllk->username }}</h1>
                            </div>
                        </a>
                    @endforeach

                </div>
            </div>
        </div>
    </div>


    <script>
        if (!sessionStorage.getItem('previousUrl')) {
            sessionStorage.setItem('previousUrl', document.referrer);
        }
    </script>
@endsection
