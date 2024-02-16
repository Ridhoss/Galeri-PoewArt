@extends('page.profile')

@section('content-profile')

    @if ($countlike == 0)
        <h1 class="text-center mt-5 fs-3 text-secondary"><i class="fa-solid fa-heart-crack me-3"></i>You haven't liked any photos</h1>
    @else
        <div class="photos p-4 d-flex justify-content-start flex-wrap">
            @foreach ($datalike as $like)
                <a href="/photo{{ $like->id }}?status=like-{{ $userprofile->username }}" class="me-2 mb-2"><img
                        src="{{ Storage::url('public/photo/' . $like->lokasifile) }}"
                        class="img-post-profile border border-2"></a>
            @endforeach
        </div>
    @endif



    <script>
        window.onload = function() {
            var pilih = document.getElementById("likes");
            pilih.classList.add('pilih');
        };
    </script>
@endsection
