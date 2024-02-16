<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Upload - PoewArt</title>

    {{-- bootstrap --}}
    <link rel="stylesheet" href="assets/bootstrap/bootstrap.min.css">
    <script src="assets/bootstrap/bootstrap.min.js"></script>
    <script src="assets/bootstrap/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="assets/bootsrap/masonry-docs.css">
    <script src="assets/bootstrap/masonry-docs.min.js"></script>
    {{-- icon --}}
    <link rel="stylesheet" href="assets/icon/all.min.css">
    <script src="assets/icon/all.min.js"></script>

    <link rel="stylesheet" href="assets/upload/style.css">

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

    @error('photo')
        <div class="alert alert-danger alert-dismissible fade show position-absolute top-0 end-0 me-4 mt-4" role="alert">
            <strong>Data Failed!</strong> {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @enderror

    @error('choosealbum')
        <div class="alert alert-danger alert-dismissible fade show position-absolute top-0 end-0 me-4 mt-4" role="alert">
            <strong>Data Failed!</strong> {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @enderror

    @error('album_name')
        <div class="alert alert-danger alert-dismissible fade show position-absolute top-0 end-0 me-4 mt-4" role="alert">
            <strong>Data Failed!</strong> {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @enderror

    @error('album_description')
        <div class="alert alert-danger alert-dismissible fade show position-absolute top-0 end-0 me-4 mt-4" role="alert">
            <strong>Data Failed!</strong> {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @enderror

    {{-- end alert --}}

    <nav class="navbar border-bottom">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" style="cursor: pointer;" data-bs-toggle="modal"
                data-bs-target="#cancel">PoewArt.</a>
            <form class="d-flex" role="search">
                @if ($user->foto == 'default.png')
                    <img src="assets/default/default.png" class="img-page-profile">
                @else
                    <img src="{{ Storage::url('public/users/' . $user->foto) }}" class="img-page-profile">
                @endif
            </form>
        </div>
    </nav>

    <div class="p-3">
        <h1 class="fs-5">Submit Your Art</h1>

        <div class="containers-upload d-flex mt-3">
            <div class="col-4 border-end p-3">
                <h5>Photo ({{ $countkeranjang }})</h5>


                <form action="/uploadkeranjang" method="POST" enctype="multipart/form-data" id="uploadkeranjang">
                    @csrf
                    <input type="hidden" name="iduser" value="{{ $user->id }}">
                    <input type="file" class="form-control d-none" name="photo[]" id="fileinput" multiple
                        onchange="uploadkeranjang()">
                </form>

                <button class="btn-upload-photo mt-2" id="btnuploadphoto">Upload New Photo</button>

                <div
                    class="d-flex mt-4 justify-content-evenly align-items-center border-top border-bottom p-1 pre-pilihalbum ">
                    <h6 class="pilih-album terpilih" id="btnpilihalbum">Choose Album</h6>
                    <h6 class="pilih-album" id="btnalbumbaru" data-bs-toggle="modal" data-bs-target="#newalbum">New
                        Album</h6>
                </div>

                <form action="/uploadphoto" method="POST">
                    @csrf
                    <div class="my-3">
                        <select name="choosealbum" id="pilihalbum" class="form-control" required>
                            <option value="" disabled selected>Choose Album</option>
                            @foreach ($album as $dataal)
                                <option value="{{ $dataal->id }}" data-name="{{ $dataal->nama }}"
                                    data-description="{{ $dataal->deskripsi }}">{{ $dataal->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="w-100 mb-3 mt-3">
                        <h6>Album name</h6>
                        <input type="text" class="form-control" name="album_name" placeholder="Album Name"
                            id="albumname" readonly disabled>
                    </div>
                    <div class="w-100 mb-3">
                        <h6>Album description</h6>
                        <textarea name="album_description" cols="30" rows="3" placeholder="Album Description"
                            class="form-control" id="descriptionalbum" readonly disabled></textarea>
                    </div>


            </div>

            <div class="col-8 p-3">

                @if ($countkeranjang != 0)
                    <div class="inner-content d-flex flex-wrap justify-content-start align-items-center">
                        @foreach ($keranjang as $data)
                            <div class="card me-3 mb-3">
                                <button type="button"
                                    class="btn btn-danger btn-sm position-absolute top-0 end-0 mt-2 me-2"
                                    data-bs-toggle="modal"
                                    data-bs-target="#hapuskeranjang{{ $data->id }}"><i class="fa-solid fa-trash"></i></button>
                                <img src="{{ Storage::url('public/photo/' . $data->photo) }}" class="card-img-top"
                                    alt="">
                                <div class="card-body">
                                    <input type="hidden" name="photo[]" value="{{ $data->photo }}">
                                    <input type="text" name="title[]" class="form-control mb-3"
                                        placeholder="Title (Max 50 Char)" maxlength="50">
                                    <textarea name="caption[]" cols="30" rows="2" class="form-control mb-3" placeholder="Caption"></textarea>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="inner-content d-flex flex-wrap justify-content-center align-items-center border border-3 rounded"
                        style="border-style: dashed !important;">
                        <h1 id="btnuploadphoto2" class="innerbtnupload">Upload Your Photo</h1>
                    </div>
                @endif


                <div class="footer-inner d-flex justify-content-end align-items-end">
                    <button type="button" class="btn btn-danger me-2" data-bs-toggle="modal"
                        data-bs-target="#cancel">Cancel</button>
                    <button type="submit" class="btn btn-primary" onclick="this.disabled=true;this.form.submit();">Publish</button>
                </div>

                </form>
            </div>
        </div>
    </div>

    <!-- Modal hapus keranjang -->
    @foreach ($keranjang as $data)
        <div class="modal fade" id="hapuskeranjang{{ $data->id }}" data-bs-backdrop="static"
            data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Are You Sure Delete Photo?</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <form action="/hapuskeranjang" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $data->id }}">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    {{-- modal cancel --}}
    <div class="modal fade" id="cancel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Are you sure you want to cancel?</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/cancelkeranjang" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $user->id }}">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Back To Home</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal new album -->
    <div class="modal fade" id="newalbum" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Create New Album</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/createalbum" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{ $user->id }}">
                    <div class="modal-body">
                        <div class="w-100 mb-3">
                            <h6>Album name</h6>
                            <input type="text" class="form-control" name="album_name"
                                placeholder="Album Name (Max 50 Char)" maxlength="50" required>
                        </div>
                        <div class="w-100 mb-3">
                            <h6>Album description</h6>
                            <textarea name="album_description" cols="30" rows="5" placeholder="Album Description"
                                class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" onclick="this.disabled=true;this.form.submit();">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // ambil data

        var albumname = document.getElementById('albumname');
        var descriptionalbum = document.getElementById('descriptionalbum');
        var pilihalbum = document.getElementById('pilihalbum');

        pilihalbum.addEventListener('change', function() {
            const selectedOption = pilihalbum.options[pilihalbum.selectedIndex];

            albumname.value = selectedOption.getAttribute('data-name');
            descriptionalbum.value = selectedOption.getAttribute('data-description');
        });

        // akhir ambil data

        // mengalihkan fungsi tombol menjadi input file
        document.getElementById('btnuploadphoto').addEventListener('click', function() {
            document.getElementById('fileinput').click();
        });
        document.getElementById('btnuploadphoto2').addEventListener('click', function() {
            document.getElementById('fileinput').click();
        });

        // function submit keranjang
        function uploadkeranjang() {
            var form = document.getElementById('uploadkeranjang');
            form.submit();
        }
    </script>

    {{-- close alert --}}
    <script src="assets/js/closealert.js"></script>


</body>

</html>
