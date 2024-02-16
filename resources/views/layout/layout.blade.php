<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>PoewArt</title>

    {{-- bootstrap --}}
    <link rel="stylesheet" href="assets/bootstrap/bootstrap.min.css">
    <script src="assets/bootstrap/bootstrap.min.js"></script>
    <script src="assets/bootstrap/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="assets/bootsrap/masonry-docs.css">
    <script src="assets/bootstrap/masonry-docs.min.js"></script>
    {{-- icon --}}
    <link rel="stylesheet" href="assets/icon/all.min.css">
    <script src="assets/icon/all.min.js"></script>

    {{-- vanilla --}}
    <link rel="stylesheet" href="assets/layout/style.css">

    @yield('style')


</head>

<body>

    {{-- alert --}}

    @if (session()->has('berhasil'))
        <div class="alert z-3 alert-success alert-dismissible fade show position-absolute top-0 end-0 mt-4 me-4"
            role="alert">
            <strong>Data Successfully!</strong> {{ session('berhasil') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session()->has('gagal'))
        <div class="alert z-3 alert-danger alert-dismissible fade show position-absolute top-0 end-0 mt-4 me-4"
            role="alert">
            <strong>Data Failed!</strong> {{ session('gagal') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- end alert --}}
    <nav class="navbar navbar-expand border-bottom ">
        <div class="container-fluid d-flex justify-content-between align-items-center">

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="d-flex align-items-center w-100">
                <a class="navbar-brand fw-bold judulatasnav" href="/home">PoewArt.</a>

                <div class="w-100 me-4">
                    <form action="/search" method="GET">
                        @csrf
                        <input type="search" name="search" class="form-control" placeholder="Search" value="{{ isset($oldsearch) ? $oldsearch : '' }}">
                    </form>
                </div>
            </div>

            <div class="navbar-nav">
                <a class="nav-link" aria-current="page" href="/home">Home</a>
                <a class="nav-link" href="/likes">Like</a>
            </div>

            <div class="navbar-nav ms-4">
                <a href="/upload" class="btn-upload">Submit a Photo</a>
            </div>


            <div class="dropstart ms-4">
                @if ($user->foto == 'default.png')
                    <img class="dropdown-toggle foto-profile" src="assets/default/default.png" data-bs-toggle="dropdown"
                        aria-expanded="false">
                @else
                    <img class="dropdown-toggle foto-profile" src="{{ Storage::url('public/users/' . $user->foto) }}"
                        data-bs-toggle="dropdown" aria-expanded="false">
                @endif
                <ul class="dropdown-menu p-2">
                    <li class="border-bottom pb-2 mb-2"><a class="dropdown-item disabled rounded"
                            href="#">{{ $user->nama }}</a></li>
                    <li><a class="dropdown-item rounded text-secondary" href="/profile-{{ $user->username }}"><i class="fa-solid fa-user me-2"></i>View profile</a></li>
                    <li><a class="dropdown-item rounded text-secondary" href="/likes"><i class="fa-solid fa-heart me-2"></i>Like</a></li>
                    <li><a class="dropdown-item rounded text-secondary" href="/analytic"><i class="fa-solid fa-chart-simple me-2"></i>Analytics</a></li>
                    <li class="border-top pt-2 mt-2"><a class="dropdown-item rounded text-secondary" data-bs-toggle="modal"
                            data-bs-target="#logoutmodal"><i class="fa-solid fa-right-from-bracket me-2"></i>Logout</a></li>
                </ul>
            </div>

        </div>
    </nav>


    @yield('content')


    <!-- Modal logout -->
    <div class="modal fade" id="logoutmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Are you sure you want to log out?</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/logout" method="post">
                    @csrf
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Logout</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- close alert --}}
    <script src="assets/js/closealert.js"></script>


</body>

</html>
