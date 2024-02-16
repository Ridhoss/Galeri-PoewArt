@extends('page.profile')

@section('content-profile')
    @if ($countfoto == 0)
        <h1 class="text-center mt-5 fs-3 text-secondary"><i class="fa-solid fa-image me-3"></i>You haven't posted any photos</h1>
    @else
        <div class="photos p-4 d-flex justify-content-start flex-wrap">
            @foreach ($datafoto as $foto)
                <a href="/photo{{ $foto->id }}?status=profile-{{ $userprofile->username }}" class="me-2 mb-2"><img
                        src="{{ Storage::url('public/photo/' . $foto->lokasifile) }}"
                        class="img-post-profile border border-2"></a>
            @endforeach
        </div>
    @endif



    {{-- <div class="d-flex flex-wrap p-4" data-masonry='{"percentPosition": true }'>
        @foreach ($datafoto as $foto)
            <a href="/photo{{ $foto->id }}?status=profile" class="me-2 mb-2"><img
                    src="{{ Storage::url('public/photo/' . $foto->lokasifile) }}" class="border border-2"
                    style="width: 15rem;"></a>
        @endforeach
    </div> --}}



    <script>
        window.onload = function() {
            var pilih = document.getElementById("photos");
            pilih.classList.add('pilih');
        };
    </script>
@endsection
