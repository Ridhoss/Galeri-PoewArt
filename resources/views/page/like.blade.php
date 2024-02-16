@extends('layout.layout')

@section('style')
    <style>
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
        <h1 class="fs-2 pb-4 mb-5 border-bottom">Photos That You Like</h1>
        @if ($countlike == 0)
            <p class="text-center">--- You haven't liked any photos ---</p>
        @else
            <div class="" data-masonry='{"percentPosition": true }'>
                @foreach ($like as $likes)
                    <a href="/photo{{ $likes->id }}?status=home" class="me-2 mb-2"><img
                            src="{{ Storage::url('public/photo/' . $likes->lokasifile) }}"
                            class="img-post-beranda border border-2"></a>
                @endforeach
            </div>
        @endif
    </div>
@endsection
