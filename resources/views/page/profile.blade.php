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
            <p>{{ $countfoto }} Posts, {{ $countfollowers }} Followers, {{ $countfollowing }} Following</p>
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
@endsection
