<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register - Gallery</title>

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

    {{-- vanilla css --}}
    <link rel="stylesheet" href="assets/register/style.css">


</head>

<body>

    {{-- alert --}}

    @error('first_name')
        <div class="alert alert-danger alert-dismissible fade show position-absolute top-0 end-0 me-4 mt-4" role="alert">
            <strong>Data Failed!</strong> {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @enderror

    @error('last_name')
        <div class="alert alert-danger alert-dismissible fade show position-absolute top-0 end-0 me-4 mt-4" role="alert">
            <strong>Data Failed!</strong> {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @enderror

    @error('email')
        <div class="alert alert-danger alert-dismissible fade show position-absolute top-0 end-0 me-4 mt-4" role="alert">
            <strong>Data Failed!</strong> {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @enderror

    @error('username')
        <div class="alert alert-danger alert-dismissible fade show position-absolute top-0 end-0 me-4 mt-4" role="alert">
            <strong>Data Failed!</strong> {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @enderror

    @error('password')
        <div class="alert alert-danger alert-dismissible fade show position-absolute top-0 end-0 me-4 mt-4" role="alert">
            <strong>Data Failed!</strong> {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @enderror

    {{-- end alert --}}

    <div class="containers d-flex">
        <div class="col-4 content-left">
            {{-- <img src="assets/foto/background.jpg"> --}}
        </div>
        <div class="col-8 content-right d-flex align-items-center flex-column p-5">
            <h1 class="fs-1">Join PoewArt.</h1>
            <p class="fs-6">Already have an account? <a class="btn-join" href="/">Sign In</a></p>


            <form action="/reg" method="post">
                @csrf
                <div class="body w-100 mt-3 p-4">
                    <div class="d-flex mb-3 px-5">
                        <div class="w-100 me-4">
                            <h6>First Name</h6>
                            <input type="text" class="form-control" name="first_name" required>
                        </div>
                        <div class="w-100">
                            <h6>Last Name</h6>
                            <input type="text" class="form-control" name="last_name">
                        </div>
                    </div>

                    <div class="w-100 px-5 mb-4">
                        <h6>Email</h6>
                        <input type="text" class="form-control" name="email" required>
                    </div>

                    <div class="w-100 px-5 mb-4">
                        <h6>Username</h6>
                        <input type="text" class="form-control" name="username" required>
                    </div>

                    <div class="w-100 px-5 mb-4">
                        <h6>Password <span class="text-secondary">(min. 8 char)</span></h6>
                        <input type="password" class="form-control" name="password" required>
                    </div>

                    <div class="w-100 px-5">
                        <button class="btn w-100" type="submit">Sign Up</button>
                    </div>
                </div>

            </form>

            <p class="fs-6">By joining, you agree to the Terms and Privacy Policy</p>

        </div>
    </div>

    {{-- script --}}
    <script>
        const alertElement = document.querySelector('.alert');
        alertElement.classList.add('show');

        // Set timeout untuk menutup alert setelah 1 detik
        setTimeout(() => {
            // Tambahkan animasi fade out
            alertElement.classList.remove('show');
            alertElement.classList.add('fade');

            // Tunggu animasi fade out selesai, lalu hilangkan alert dari DOM
            setTimeout(() => {
                alertElement.remove();
            }, 3000); // Ubah angka timeout sesuai kebutuhan durasi animasi fade out
        }, 2000); // Ubah angka timeout sesuai kebutuhan waktu tampilan alert
    </script>

</body>

</html>
