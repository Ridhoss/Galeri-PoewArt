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
        @if ($countnew > 0)
            <div class="border-bottom pb-4 mb-4">
                <p class="text-secondary text-center mb-4">------ New's Post Today ------</p>
                <div class="new-post-home" data-masonry='{"percentPosition": true }'>
                    @foreach ($new as $imgnew)
                        <a href="/photo{{ $imgnew->id }}?status=home" class="me-2 mb-2"><img
                                src="{{ Storage::url('public/photo/' . $imgnew->lokasifile) }}"
                                class="img-post-beranda border border-2"></a>
                    @endforeach
                </div>
            </div>
        @endif
        <div class="">
            <p class="text-secondary text-center mb-4">------ Explore Gallery Content ------</p>
            <div class="" data-masonry='{"percentPosition": true }'>
                @foreach ($foto as $photo)
                    <a href="/photo{{ $photo->id }}?status=home" class="me-2 mb-2"><img
                            src="{{ Storage::url('public/photo/' . $photo->lokasifile) }}"
                            class="img-post-beranda border border-2"></a>
                @endforeach
            </div>
        </div>
    </div>
@endsection
