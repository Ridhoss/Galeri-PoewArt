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
            --poppins: poppins;
        }

        .outer-card {
            width: 200px;
            height: 250px;
            border: 2px solid var(--bootstrapsecondary);
            border-radius: 10px;
        }

        .img-profile-card {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 50%;
        }

        .username-card {
            font-size: 20px;
            color: var(--primary);
        }

        .info-card-user {
            font-size: 14px;
            margin: 0;
            color: var(--bootstrapsecondary);
        }

        .btn-view-card {
            text-decoration: none;
            color: var(--primary);
            border: 1px solid var(--primary);
            padding: 5px 10px;
            border-radius: 10px;
        }

        .btn-view-card:hover {
            color: var(--white);
            border: 1px solid var(--secondary);
            background-color: var(--secondary);
            cursor: pointer;
            scale: 0.95;
            transition: 0.2s;
        }

        .img-post-beranda {
            width: 15.6rem;
            border-radius: 10px;
        }

        .img-post-beranda:hover {
            opacity: 50%;
            transition: 0.3s;
            scale: 0.95;
        }
    </style>
@endsection

@section('content')
    <div class="p-4">
        <div class="pb-4 border-bottom">
            <p class="text-center">--- Account ---</p>
            @if ($countdatauser == 0)
                <h1 class="text-center mt-4 fs-3 text-secondary"><i class="fa-solid fa-user me-3"></i>Can't find user with
                    name {{ $oldsearch }}</h1>
            @else
                <div class="mt-3 d-flex justify-content-start">
                    @foreach ($datauser as $cariusers)
                        <div class="outer-card d-flex flex-column align-items-center me-3 mb-3">
                            @if ($cariusers->foto == 'default.png')
                                <img src="assets/default/default.png" class="img-profile-card mt-3">
                            @else
                                <img src="{{ Storage::url('public/users/' . $cariusers->foto) }}"
                                    class="img-profile-card mt-3">
                            @endif
                            <h6 class="mt-2 username-card">{{ $cariusers->username }}</h6>
                            <p class="info-card-user">{{ $cariusers->nama }}</p>
                            <a href="/profile-{{ $cariusers->username }}" class="mt-3 btn-view-card">View Profile</a>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
        <div class="mt-4">
            <p class="text-center">--- Post ---</p>
            @if ($countdatafoto == 0)
                <h1 class="text-center mt-4 fs-3 text-secondary"><i class="fa-solid fa-images me-3"></i>Can't find photo with name {{ $oldsearch }}</h1>
            @else
                <div class="mt-4" data-masonry='{"percentPosition": true }'>
                    @foreach ($datafoto as $photo)
                        <a href="/photo{{ $photo->id }}?status=home" class="me-2 mb-2"><img
                                src="{{ Storage::url('public/photo/' . $photo->lokasifile) }}"
                                class="img-post-beranda border border-2"></a>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection
