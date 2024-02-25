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

        .img-post-beranda {
            width: 15.6rem;
            border-radius: 10px;
        }

        .img-post-beranda:hover {
            opacity: 50%;
            transition: 0.3s;
            scale: 0.95;
        }

        .pre-cntn-home {
            text-decoration: none;
            color: var(--bootstrapsecondary);
        }

        .cntn-home>h6 {
            font-size: 13px;
        }
    </style>
@endsection

@section('content')
    <div class="p-4">
        @if ($countnew > 0)
            <div class="border-bottom pb-4 mb-4">
                <p class="text-secondary text-center mb-4">------ New's Post Today ------</p>
                <div class="new-post-home" data-masonry='{"percentPosition": true }'>
                    @foreach ($new as $imgnew)
                        <a href="/photo{{ $imgnew->id }}?status=home" class="me-2 mb-2 pre-cntn-home">
                            <div class="cntn-home">
                                <img src="{{ Storage::url('public/photo/' . $imgnew->lokasifile) }}"
                                    class="img-post-beranda border border-2">
                                <h6 class="text-end me-3 mt-2">{{ $imgnew->total_like }} <i
                                        class="fa-solid fa-heart me-2"></i>{{ $imgnew->total_komen }} <i
                                        class="fa-solid fa-comment"></i></h6>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
        <div class="">
            <p class="text-secondary text-center mb-4">------ Explore Gallery Content ------</p>
            <div class="" data-masonry='{"percentPosition": true }'>
                @foreach ($foto as $photo)
                    <a href="/photo{{ $photo->id }}?status=home" class="me-2 mb-2 pre-cntn-home">
                        <div class="cntn-home">
                            <img src="{{ Storage::url('public/photo/' . $photo->lokasifile) }}"
                                class="img-post-beranda border border-2">
                            <h6 class="text-end me-3 mt-2">{{ $photo->total_like }} <i
                                    class="fa-solid fa-heart me-2"></i>{{ $photo->total_komen }} <i
                                    class="fa-solid fa-comment"></i></h6>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endsection
