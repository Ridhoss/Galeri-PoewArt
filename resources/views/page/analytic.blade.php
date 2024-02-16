@extends('layout.layout')

@section('style')
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

        .pre-main-content-analytic {
            width: 100%;
        }

        .pre-r-content {
            overflow: auto;
            height: 59vh;
        }

        .r-content {
            width: 100%;
            height: 100px;
            border: 2px solid var(--bootstrapsecondary);
            border-radius: 10px;
        }

        .img-r-content {
            width: 80px;
            height: 80px;
            border-radius: 10px;
            object-fit: cover;
        }

        .like-r-content {
            margin: 0;
            color: var(--bootstrapsecondary);
            font-size: 18px;
        }

        .btn-r-content {
            width: 100px;
            height: 50px;
            border: 2px solid var(--primary);
            background-color: white;
            border-radius: 10px;
        }

        .btn-r-content:hover {
            background-color: var(--secondary);
            border: 2px solid var(--secondary);
            cursor: pointer;
            color: var(--white);
            transition: 0.3s;
            scale: 0.95;
        }

        .img-l-content {
            width: 100%;
            height: 45vh;
            object-fit: contain;
        }

        .semi-l-content {
            border: 2px solid var(--bootstrapsecondary);
            border-radius: 10px;
            height: 100%;
            border-style: dashed;
        }

        .desk-l {
            overflow-wrap: break-word;
            word-wrap: break-word;
        }

        .l-content {
            overflow: auto;
            height: 67vh;
        }
    </style>
@endsection

@section('content')
    <div class="p-4">
        <h1 class="fs-3">Analyze your content</h1>
        <div class=" d-flex pre-main-content-analytic border-top p-3 mt-3">

            <div class="col-7">

                <div class="semi-l-content d-flex align-items-center justify-content-center" id="semi-l">
                    <h2>Choose Your Content</h2>
                </div>

                <div class="l-content d-none" id="l-content">
                    <div class="">
                        <img src="assets/foto/background.jpg" class="img-l-content" id="l-foto">
                    </div>
                    <div class="mt-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h3 id="l-juful">Judul gambar 1</h3>
                            <div class="d-flex me-5 align-items-center">
                                <i class="fa-solid fa-heart me-1 like-r-content "></i>
                                <p class="like-r-content me-3" id="l-like">6 Like</p>
                                <i class="fa-solid fa-comment me-1 like-r-content"></i></i>
                                <p class="like-r-content" id="l-comment">6
                                    Comment</p>
                            </div>
                        </div>
                        <p class="desk-l p-3" id="l-deskripsi">Deskripsi gambar Lorem ipsum dolor sit amet consectetur adipisicing elit.
                            Deleniti
                            a, voluptates
                            impedit nobis ratione hic assumenda porro ex iure reiciendis, ab provident quibusdam asperiores
                            quae
                            aspernatur perspiciatis cupiditate veniam dignissimos.</p>
                    </div>
                </div>


            </div>

            <div class="col-5 border-start ps-4">
                <h4>Your Content ({{ $countfoto }})</h4>
                <div class="pre-r-content mt-4 pe-3">

                    @foreach ($datafoto as $foto)
                        <div class="r-content d-flex align-items-center p-2 mb-3 justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="">
                                    <img src="{{ Storage::url('public/photo/' . $foto->lokasifile) }}"
                                        class="img-r-content">
                                </div>
                                <div class="p-3">
                                    <h4>{{ $foto->judul }}</h4>
                                    <div class="d-flex ms-1">
                                        <p class="like-r-content"><i
                                                class="fa-solid fa-heart me-1"></i>{{ $foto->total_like }}
                                            Like</p>
                                        <p class="like-r-content ms-3"><i
                                                class="fa-solid fa-comment me-1"></i></i>{{ $foto->total_komen }} Comment
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <input type="button" class="btn-r-content" value="Detail" data-judul="{{ $foto->judul }}"
                                data-deskripsi="{{ $foto->deskripsi }}"
                                data-gambar="{{ Storage::url('public/photo/' . $foto->lokasifile) }}"
                                data-like="{{ $foto->total_like }} Likes" data-comment="{{ $foto->total_komen }} Comments">
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>


    <script>
        // Menangani klik pada tombol "Lihat"
        var buttons = document.querySelectorAll('.btn-r-content');
        buttons.forEach(function(button) {
            button.addEventListener('click', function() {

                document.getElementById('l-content').classList.remove('d-none');
                document.getElementById('semi-l').classList.add('d-none');

                // Mengambil nilai atribut dari tombol "Lihat"
                var judul = this.getAttribute('data-judul');
                var deskripsi = this.getAttribute('data-deskripsi');
                var gambar = this.getAttribute('data-gambar');
                var like = this.getAttribute('data-like');
                var comment = this.getAttribute('data-comment');

                // Memasukkan nilai atribut ke dalam elemen HTML yang sesuai
                document.getElementById('l-foto').src = gambar;
                document.getElementById('l-juful').textContent = judul;
                document.getElementById('l-deskripsi').textContent = deskripsi;
                document.getElementById('l-like').textContent = like;
                document.getElementById('l-comment').textContent = comment;
            });
        });
    </script>
@endsection
