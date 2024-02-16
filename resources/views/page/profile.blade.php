@extends('layout.layout')

@section('style')
    <link rel="stylesheet" href="assets/profile/style.css">

    @yield('style-in')
@endsection

@section('content')
    <div class="d-flex justify-content-center align-items-center p-5">
        <div class="image me-4">
            @if ($userprofile->foto == 'default.png')
                <img src="assets/default/default.png" class="img-page-profile">
            @else
                <img src="{{ Storage::url('public/users/' . $userprofile->foto) }}" class="img-page-profile">
            @endif
        </div>
        <div class="data">
            <div class="d-flex align-items-center">
                <h1 class="me-4">{{ $userprofile->nama }}</h1>
                @if ($userprofile->id == $user->id)
                    <a href="/editprofile" class="btn-edit-profile">Edit Profile</a>
                @else
                    @if ($infofollow == null)
                        <form action="/follow" method="POST" id="likeform">
                            @csrf
                            <input type="hidden" name="idwho" value="{{ $user->id }}">
                            <input type="hidden" name="idto" value="{{ $userprofile->id }}">
                            <button type="submit" class="btn-edit-profile"
                                onclick="this.disabled=true;this.form.submit();">Follow</button>
                        </form>
                    @else
                        <form action="/unfollow" method="POST" id="likeform">
                            @csrf
                            <input type="hidden" name="idfollow" value="{{ $infofollow->id }}">
                            <button type="submit" class="btn-edit-profile following"
                                onclick="this.disabled=true;this.form.submit();">Following</button>
                        </form>
                    @endif
                @endif
            </div>
            <h5>{{ $userprofile->username }}</h5>
            <p>{{ $countfoto }} Posts, <span class="follow-prfl" data-bs-toggle="modal"
                    data-bs-target="#modalfollowers">{{ $countfollowers }} Followers</span>, <span class="follow-prfl"
                    data-bs-toggle="modal" data-bs-target="#modalfollowing">{{ $countfollowing }} Following</span></p>
            {{-- <div class="d-flex align-items-center">
                <div class="d-flex flex-column align-items-center me-4">
                    <h4>40</h4>
                    <h6>Posts</h6>
                </div>
                <div class="d-flex flex-column align-items-center me-4">
                    <h4>40</h4>
                    <h6>Followers</h6>
                </div>
                <div class="d-flex flex-column align-items-center me-4">
                    <h4>40</h4>
                    <h6>Following</h6>
                </div>
            </div> --}}
        </div>
    </div>
    <div class="px-4 py-3 d-flex justify-content-start align-items-center border-bottom">
        <a class="me-4 list-menu-profile" id="photos" href="/profile-{{ $userprofile->username }}">Photos
            {{ $countfoto }}</a>
        <a class="me-4 list-menu-profile" id="likes" href="/like-{{ $userprofile->username }}">Likes
            {{ $countlike }}</a>
        <a class="me-4 list-menu-profile" id="albums" href="/albums-{{ $userprofile->username }}">Albums
            {{ $countalbum }}</a>
    </div>

    @yield('content-profile')


    <!-- Modal -->
    <div class="modal fade" id="modalfollowers" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Followers ({{ $countfollowers }})</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if ($countfollowers == 0)
                        <p class="text-center text-secondary mt-2">---- Doesn't have any followers ----</p>
                    @else
                        @foreach ($datafollowers as $fllwrs)
                            <a href="/profile-{{ $fllwrs->username }}" class="sem-acc">
                                <div class="pb-1 mb-1 border-bottom d-flex align-items-center">
                                    @if ($fllwrs->foto == 'default.png')
                                        <img src="assets/default/default.png" class="people-like-img">
                                    @else
                                        <img src="{{ Storage::url('public/users/' . $fllwrs->foto) }}"
                                            class="people-like-img">
                                    @endif
                                    <h1 class="people-like-user mt-2 ms-2">{{ $fllwrs->username }}</h1>
                                </div>
                            </a>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="modalfollowing" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Following ({{ $countfollowing }})</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    @if ($countfollowing == 0)
                        <p class="text-center text-secondary mt-2">---- Doesn't follow anyone ----</p>
                    @else
                        @foreach ($datafollowing as $fllwing)
                            <a href="/profile-{{ $fllwing->username }}" class="sem-acc">
                                <div class="pb-1 mb-1 border-bottom d-flex align-items-center">
                                    @if ($fllwing->foto == 'default.png')
                                        <img src="assets/default/default.png" class="people-like-img">
                                    @else
                                        <img src="{{ Storage::url('public/users/' . $fllwing->foto) }}"
                                            class="people-like-img">
                                    @endif
                                    <h1 class="people-like-user mt-2 ms-2">{{ $fllwing->username }}</h1>
                                </div>
                            </a>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>


@endsection
