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
        <h1 class="fs-2 pb-4 mb-5 border-bottom">Photos of people you follow</h1>
        @if ($countfollowing == 0)
            <p class="text-center">--- You haven't follow any account ---</p>
        @else
            <div class="" data-masonry='{"percentPosition": true }'>
                @foreach ($following as $foll)
                    <a href="/photo{{ $foll->id }}?status=following" class="me-2 mb-2"><img
                            src="{{ Storage::url('public/photo/' . $foll->lokasifile) }}"
                            class="img-post-beranda border border-2"></a>
                @endforeach
            </div>
        @endif
    </div>
@endsection
