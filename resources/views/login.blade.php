<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login - PoewArt</title>

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
    <link rel="stylesheet" href="assets/login/style.css">

</head>

<body>

    {{-- alert --}}

    @if (session()->has('register'))
        <div class="alert alert-success alert-dismissible fade show position-absolute top-0 end-0 me-4 mt-4 z-2"
            role="alert">
            <strong>Registration is successful!</strong> Please log in with your account!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session()->has('gagallogin'))
        <div class="alert alert-danger alert-dismissible fade show position-absolute top-0 end-0 me-4 mt-4 z-2"
            role="alert">
            <strong>Log in Failed!</strong> Your username or password is incorrect!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- end alert --}}

    <div class="containers d-flex align-items-center justify-content-center">
        <div class="content d-flex align-items-center flex-column p-4">
            <h1>Sign In</h1>
            <p class="fs-5">Welcome Back</p>

            <div class="body w-100 mt-3 border-bottom pb-4">
                <form action="/log" method="post">
                    @csrf
                    <div class="w-100 px-5 mb-3">
                        <h6>Username</h6>
                        <input type="text" class="form-control" name="username" required>
                    </div>

                    <div class="w-100 px-5 mb-4">
                        <h6>Password</h6>
                        <input type="password" class="form-control" name="password" required>
                    </div>

                    <div class="w-100 px-5">
                        <button class="btn w-100" type="submit">Sign In</button>
                    </div>
                </form>
            </div>

            <div class="footer mt-5">
                <p>Don't have an account? <a class="btn-join" href="/register">Join</a></p>
            </div>


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
