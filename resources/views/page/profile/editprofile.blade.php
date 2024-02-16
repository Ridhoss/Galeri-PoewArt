<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Profile - PoewArt</title>
</head>

{{-- bootstrap --}}
<link rel="stylesheet" href="assets/bootstrap/bootstrap.min.css">
<script src="assets/bootstrap/bootstrap.min.js"></script>
<script src="assets/bootstrap/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="assets/bootsrap/masonry-docs.css">
<script src="assets/bootstrap/masonry-docs.min.js"></script>
{{-- icon --}}
<link rel="stylesheet" href="assets/icon/all.min.css">
<script src="assets/icon/all.min.js"></script>
    {{-- logo atas --}}
    <link rel="shortcut icon" type="image/png" href="assets/default/logoatas.png" />

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
        --redpastel: #FF6868;
        --poppins: poppins;

    }

    @font-face {
        font-family: poppins;
        src: url(assets/icon/Poppins-Regular.ttf);
    }

    * {
        font-family: var(--poppins);
    }

    /* endpacked */


    .list-edit {
        color: var(--preprimary);
        text-decoration: none;
        font-size: 18px
    }

    .list-edit:hover {
        color: var(--primary);
        text-decoration: underline;
        cursor: pointer;
    }

    .edit-foto-profile {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        object-fit: cover;
    }

    #tombol-edit-foto-profile {
        font-size: 15px;
        text-decoration: underline;
        color: var(--preprimary);
    }

    #tombol-edit-foto-profile:hover {
        color: var(--secondary);
        transition: 0.2s;
        cursor: pointer;
    }

    .btn-update {
        width: 100%;
        height: 40px;
        background-color: var(--white);
        color: var(--primary);
        border: 2px solid var(--primary);
        font-weight: bold;
        border-radius: 5px;
    }

    .btn-update:hover {
        cursor: pointer;
        background-color: var(--primary);
        border: none;
        color: var(--white);
        font-weight: bold;
        transition: 0.2s ease-in;
    }

    .img-page-profile {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        object-fit: cover;
    }

    .main-content-edit {
        height: 89vh;
    }

    .scroll {
        overflow: auto;
    }
</style>

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

    @error('first_name')
        <div class="alert z-3 alert-danger alert-dismissible fade show position-absolute top-0 end-0 me-4 mt-4"
            role="alert">
            <strong>Data Failed!</strong> {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @enderror

    @error('last_name')
        <div class="alert z-3 alert-danger alert-dismissible fade show position-absolute top-0 end-0 me-4 mt-4"
            role="alert">
            <strong>Data Failed!</strong> {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @enderror

    @error('email')
        <div class="alert z-3 alert-danger alert-dismissible fade show position-absolute top-0 end-0 me-4 mt-4"
            role="alert">
            <strong>Data Failed!</strong> {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @enderror

    @error('username')
        <div class="alert z-3 alert-danger alert-dismissible fade show position-absolute top-0 end-0 me-4 mt-4"
            role="alert">
            <strong>Data Failed!</strong> {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @enderror

    @error('address')
        <div class="alert z-3 alert-danger alert-dismissible fade show position-absolute top-0 end-0 me-4 mt-4"
            role="alert">
            <strong>Data Failed!</strong> {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @enderror

    @error('photo')
        <div class="alert z-3 alert-danger alert-dismissible fade show position-absolute top-0 end-0 me-4 mt-4"
            role="alert">
            <strong>Data Failed!</strong> {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @enderror


    {{-- end alert --}}

    <nav class="navbar border-bottom">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" style="cursor: pointer;" data-bs-toggle="modal"
                data-bs-target="#modalbackprofile">PoewArt.</a>
            <form class="d-flex" role="search">
                @if ($user->foto == 'default.png')
                    <img src="assets/default/default.png" class="img-page-profile">
                @else
                    <img src="{{ Storage::url('public/users/' . $user->foto) }}" class="img-page-profile">
                @endif
            </form>
        </div>
    </nav>

    <div class="d-flex main-content-edit">
        <div class="col-3 px-4 py-5">
            <h1 class="fs-5 fw-bold">Account setting</h1>
            <div class="d-flex flex-column mt-5">
                <a href="#editprofile" class="list-edit mb-2">Edit Profile</a>
                <a href="#editpassword" class="list-edit">Edit Password</a>
                <button type="button" class="btn btn-secondary mt-5" data-bs-toggle="modal"
                    data-bs-target="#modalbackprofile">Back To Profile</button>
            </div>
        </div>
        <div class="col-9 px-4 py-5 scroll">
            <div class="mb-5" id="editprofile">
                <form action="/updateprofile" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $user->id }}">
                    <div class="content-flow">
                        <h1 class="fs-5 fw-bold">Edit profile</h1>
                        <div class="d-flex mt-5">
                            <div class="col-4 d-flex flex-column justify-content-center align-items-center">
                                @if ($user->foto == 'default.png')
                                    <img src="assets/default/default.png" class="edit-foto-profile"
                                        id="foto-profile-edit">
                                @else
                                    <img src="{{ Storage::url('public/users/' . $user->foto) }}"
                                        class="edit-foto-profile" id="foto-profile-edit">
                                @endif
                                <input type="file" name="photo" id="edit-foto-profile" class="d-none"
                                    onchange="displayImage(event)">
                                <input type="hidden" name="oldphoto" value="{{ $user->foto }}">
                                <p class="mt-2" class="tomboleditfoto" id="tombol-edit-foto-profile">Change profile
                                    image
                                </p>
                            </div>
                            <div class="col-8">
                                <div class="d-flex mb-3 px-5">
                                    @php
                                        $name = $user->nama;
                                        $pisah = explode(' ', $name);

                                        $firstname = $pisah[0];
                                        $lastname = implode(' ', array_slice($pisah, 1));

                                    @endphp

                                    <div class="w-100 me-4">
                                        <h6>First Name</h6>
                                        <input type="text" class="form-control" name="first_name"
                                            placeholder="First name" value="{{ $firstname }}" required>
                                    </div>
                                    <div class="w-100">
                                        <h6>Last Name</h6>
                                        <input type="text" class="form-control" name="last_name"
                                            placeholder="Last name" value="{{ $lastname }}" required>
                                    </div>
                                </div>
                                <div class="w-100 px-5 mb-4">
                                    <h6>Email</h6>
                                    <input type="text" class="form-control" name="email" placeholder="Email"
                                        value="{{ $user->email }}" required>
                                </div>
                                <div class="w-100 px-5 mb-4">
                                    <h6>Username</h6>
                                    <input type="text" class="form-control" name="username"
                                        placeholder="Username" value="{{ $user->username }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <h1 class="fs-5 fw-bold">About</h1>

                            <div class="mt-4">
                                <h6>Address</h6>
                                <textarea name="address" cols="30" rows="5" placeholder="Address (must be filled)" class="form-control"
                                    required>{{ $user->alamat }}</textarea>
                            </div>

                            <button type="submit" class="btn-update mt-4">Update Account</button>

                        </div>
                    </div>
                </form>
            </div>

            <div class="border-top pt-4" id="editpassword">
                <form action="/updatepassword" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $user->id }}">
                    <div class="">
                        <h1 class="fs-5 fw-bold mb-5">Edit password</h1>
                        <div class="w-100 mb-3">
                            <h6>Current Password</h6>
                            <input type="password" class="form-control" name="password"
                                placeholder="Current Password" required>
                        </div>
                        <div class="w-100 mb-3">
                            <h6>New Password</h6>
                            <input type="password" class="form-control" name="newpassword"
                                placeholder="New Password" required>
                        </div>
                        <div class="w-100 mb-4">
                            <h6>Confirmation Password</h6>
                            <input type="password" class="form-control" name="confirmation"
                                placeholder="Confirmation Password" required>
                        </div>
                        <button type="submit" class="btn-update">Update Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Modal kembali ke profile -->
    <div class="modal fade" id="modalbackprofile" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="/profile-{{ $user->username }}" method="GET">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Have you finished changing your profile?
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Back To Profile</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // mengalihkan fungsi tombol menjadi input file
        document.getElementById('tombol-edit-foto-profile').addEventListener('click', function() {
            document.getElementById('edit-foto-profile').click();
        });

        function displayImage(event) {
            var image = document.getElementById('foto-profile-edit');
            image.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>

    {{-- close alert --}}
    <script src="assets/js/closealert.js"></script>

</body>

</html>
