@extends('page.profile')

@section('content-profile')

    @if ($countalbum == 0)
        <h1 class="text-center mt-5 fs-3 text-secondary"><i class="fa-solid fa-images me-3"></i>You don't have any albums</h1>
    @else
        <div class="photos p-4 d-flex justify-content-start flex-wrap">
            @foreach ($dataalbum as $album)
                <a href="/seealbums{{ $album[0]->id }}?status=albums-{{ $userprofile->username }}"
                    class="pre-album-content mb-2 me-2">
                    <div class="album-content-main border border-3 rounded d-flex flex-wrap overflow-hidden">
                        @foreach ($album as $inner)
                            <div class="kolom">
                                <img src="{{ Storage::url('public/photo/' . $inner->foto) }}" class="img-inner-album">
                            </div>
                        @endforeach
                    </div>
                    <p class="album-title-main mt-2">{{ $album[0]->nama }} Albums</p>
                </a>
            @endforeach
        </div>
    @endif





    <script>
        window.onload = function() {
            var pilih = document.getElementById("albums");
            pilih.classList.add('pilih');
        };
    </script>
@endsection
