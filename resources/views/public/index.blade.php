@extends('layouts.public')
@push('style')
    <style>
        h1,
        h2,
        h3,
        h4,
        h5 {
            font-family: Arial, Helvetica, sans-serif;
            font-weight: 600;
            user-select: none;
        }

        #avatar {
            position: absolute;
            top: 0;
            left: 16px;
            transform: translate(0%, -50%);
        }

        #card-benefit:is(:hover) {
            transform: translateY(8px);
            /* background-color: #2696ff; */
            background-color: salmon;
            color: #fff;
        }

        #benefit {
            animation-name: slideFromLeft;
            animation-duration: 1.5s;
            animation-timing-function: cubic-bezier(0.215, 0.610, 0.355, 1);
        }

        #creators {
            animation-name: slideFromRight;
            animation-duration: 2s;
            animation-timing-function: cubic-bezier(0.215, 0.610, 0.355, 1);
        }

        @keyframes slideFromLeft {
            0% {
                transform: translateX(-180px);
                filter: blur(8px);
            }

            100% {
                transform: translateX(0);
            }
        }

        @keyframes slideFromRight {
            0% {
                transform: translateX(400px);
                opacity: 0;
                filter: blur(8px);
            }

            100% {
                transform: translateX(0);
                opacity: 1;
            }
        }

        #card-benefit {
            cursor: pointer;
            transition: all 200ms ease-out;
        }

        p {
            font-size: 12px;
        }

        #hero p {
            font-size: 16px;
        }

        span.badge {
            border: 0.5px solid #ffffff5d;
            font-size: 12px;
            font-weight: normal;
        }

        section#hero .title {
            width: 40%;
        }

        input.form-control:focus {
            /* border: 1px solid red; */
            box-shadow: none;
        }

        #claim {
            top: 0px;
            right: 6px;
            height: 80%;
            transform: translate(0%, 10%);
        }

        .faq-item:is(:hover) {
            cursor: pointer;
        }

        .faq-list .faq-item {
            width: 75%;
            user-select: none;
        }
        .bg-glass{
            background: rgba(255, 255, 255, 0.3);
            border-radius: 16px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.25);
        }

        @media (max-width: 991.98px) {
            section#hero .title {
                width: 100%;
                text-align: center;
            }

            section#hero .preview {
                display: none;
            }

            .faq-list .faq-item {
                width: 100%;
            }

            .faq-item {
                user-select: none;
            }
        }
        section{
            color: #fff;
        }
        .card-style{
            background-color: #191d20;
            /* background-color: blueviolet; */
            padding-bottom: 16px;
            color: #fff;
            box-shadow: 0px 0px 24px #191b1e;
        }
        .card-style:is(:hover){
            outline: 3px solid salmon;
            cursor: pointer;
        }
        .row-benefit{
            row-gap: 16px;
        }
        section#creators .card-title{
            margin-top: 48px;
        }
        @media (max-width: 820px) {
            #avatar{
                display: none;
            }

            section#creators .card-title{
                margin-top: 0;
            }
            #card-benefit:is(:hover){
                transform: none;
            }
            .card-style{
                padding-bottom: 0;
            }
            section#creators .card-text{
                display: none;
            }
            .row-benefit{
                row-gap: 8px;
            }
            
        }
        #write_username{
            color: #989898;
        }
    </style>
@endpush

@section('content')
    <div class="container mt-5">

        <section id="carousels" class="mb-3">
            <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active" data-bs-interval="5000">
                        <img src="{{ asset('assets/carousel-1.jpg') }}" class="d-block object-fit-cover" style="width: 100%; height: 600px;" alt="...">
                        <div class="carousel-caption rounded d-none d-md-block bg-glass">
                            <h2>Best platform for sellers</h2>
                            <p class="fs-5">Create your own product and share it through social media</p>
                        </div>
                    </div>
                    <div class="carousel-item" data-bs-interval="3000">
                        <img src="{{ asset('assets/carousel-2.jpg') }}" class="d-block object-fit-cover" style="width: 100%; height: 600px;" alt="...">
                        <div class="carousel-caption rounded d-none d-md-block bg-glass">
                            <h2>Best platform for communty</h2>
                            <p class="fs-5">Build for photographers community in indonesia and for everyone</p>
                        </div>
                    </div>
                    <div class="carousel-item" data-bs-interval="4000">
                        <img src="{{ asset('assets/carousel-3.jpg') }}" class="d-block object-fit-cover" style="width: 100%; height: 600px;" alt="...">
                        <div class="carousel-caption rounded d-none d-md-block bg-glass">
                            <h2>Be the best creator</h2>
                            <p class="fs-5">Build your own product characteristics and be the best</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="hero" class="d-flex justify-content-between align-items-center text-white">
            <div class="title">
                <h1>FGID is the simplest way to earn for content creators</h1>
                <p class="mt-3">FGID helps content creators accept donations, manage membership and sell merch, for free.
                </p>
                <p>Claim your page now!</p>

                <div class="position-relative mb-3">
                    <input type="text" class="form-control border-danger w-100 pe-2 py-3"
                        placeholder="lynkclone.id/username" value="lynkclone.id/" id="write_username" aria-label="Recipient's username"
                        aria-describedby="button-addon2">
                    <button id="claim" class="btn btn-md btn-danger fw-bold position-absolute" style="width: 120px;"
                        type="button" id="button-addon2">Claim</button>
                </div>

            </div>
        </section>

        <section id="benefit" class="mt-5">
            <h2 class="text-center">How creators using FGID</h2>
            <div class="row row-cols-1 row-cols-md-3 mt-3 row-benefit">
                {{-- @for ($i = 0; $i < 8; $i++) --}}
                    <div class="col">
                        <div class="card h-100" id="card-benefit">
                            <div class="card-body">
                                <h5 class="card-title">Digital Product</h5>
                                <p class="card-text">Sell your e-book/presets/itinerary to your audience, Through lynk.id secured system</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card h-100" id="card-benefit">
                            <div class="card-body">
                                <h5 class="card-title">Consolidate Links</h5>
                                <p class="card-text">Let your audience knows what are you up to in other platforms. You can put any link here.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card h-100" id="card-benefit">
                            <div class="card-body">
                                <h5 class="card-title">Donations</h5>
                                <p class="card-text">Receive one-off support from fans who may not be able to make a monthly commitment.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card h-100" id="card-benefit">
                            <div class="card-body">
                                <h5 class="card-title">Customize Interface</h5>
                                <p class="card-text">Customize your products theme for your customer</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card h-100" id="card-benefit">
                            <div class="card-body">
                                <h5 class="card-title">Lower Fee</h5>
                                <p class="card-text">Our platform using lower fees for withdrawal and make anytime withdrawal request as you want.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card h-100" id="card-benefit">
                            <div class="card-body">
                                <h5 class="card-title">Community</h5>
                                <p class="card-text">We grow and we listen our community to make our platform better for creator and customers.</p>
                            </div>
                        </div>
                    </div>
                {{-- @endfor --}}
            </div>

        </section>

        <section id="creators" class="mt-5">
            <h2>Featured Streamers & Gamers</h2>
            <span>Discover the best streaming entertaiment</span>
            <div class="row row-cols-2 row-cols-lg-5 g-4 mt-3">
                {{-- row-cols-md-5 --}}
                @foreach ($creators as $creator)
                <div class="col">
                    <a href="{{ route('public.user', $creator->username) }}" class="text-decoration-none">
                        <div class="card card-style rounded-4 border-0 h-100">
                            <img id="img-cover" src="{{ ($creator->coverimage) ? Storage::url($creator->coverimage) : asset('assets/cover-white.png') }}"" style="width: 100%; height: 120px;"
                                class="card-img-top object-fit-cover rounded-4 rounded-bottom-0" alt="...">
                            <div class="card-body position-relative">
                                <img id="avatar" src="{{ ($creator->photo) ? Storage::url($creator->photo) : asset('assets/profile-default.png') }}"
                                    class="rounded-circle object-fit-cover border border-white border-3"
                                    style="width: 96px; height: 96px;" alt="creator-avatar" srcset="">
                                <h5 class="card-title">{{ $creator->username }}</h5>
                                <p class="card-text text-dark-subtle">{{ $creator->description }}</p>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </section>

        <section id="faq" class="mt-5 mb-5 py-5">
            <h2 class="text-center">Frequently Asked Question</h2>

            <div class="faq-list vstack gap-2 mt-4">
                <div class="faq-item mx-auto ps-3 p-3 bg-secondary rounded" data-bs-toggle="collapse" data-bs-target="#data1"
                    aria-expanded="false" aria-controls="data1">
                    <a class="fw-bold fs-5 text-start rounded-0 text-white text-decoration-none">Apa itu FGID ?</a>
                    <div class="collapse" id="data1">
                        <div class="card rounded-0 border-0 bg-secondary text-white p-0 py-3 card-body text-left">FGID adalah
                            sebuah layanan yang membantu Fotografer Sunmori terutama Kopeng sekitarnya dan Mempermudah
                            Supporter untuk mencari Fotografer dengan fitur Explore kami.</div>
                    </div>
                </div>
                <div class="faq-item mx-auto ps-3 p-3 bg-secondary rounded" data-bs-toggle="collapse" data-bs-target="#data2"
                    aria-expanded="false" aria-controls="data2">
                    <a class="fw-bold fs-5 text-start rounded-0 text-white text-decoration-none">Apakah saya dapat
                        menggunakan FGID ?</a>
                    <div class="collapse" id="data2">
                        <div class="card rounded-0 border-0 bg-secondary text-white p-0 py-3 card-body text-left">Sejauh ini
                            semua orang dapat menggunakan FGID dengan syarat dan ketentuan yang berlaku, baik itu Fotografer
                            tanpa Badge maupun Akun Guest.</div>
                    </div>
                </div>
                <div class="faq-item mx-auto ps-3 p-3 bg-secondary rounded" data-bs-toggle="collapse" data-bs-target="#data3"
                    aria-expanded="false" aria-controls="data3">
                    <a class="fw-bold fs-5 text-start rounded-0 text-white text-decoration-none">Saya bukan seorang
                        Fotografer yang dikenal. apakah saya bisa menggunakan FGID ?</a>
                    <div class="collapse" id="data3">
                        <div class="card rounded-0 border-0 bg-secondary text-white p-0 py-3 card-body text-left">Tentu saja
                            bisa, Bergabunglah dengan kami dan berkembang bersama, anda akan mendapatkan benefit dengan
                            fitur Explore kami</div>
                    </div>
                </div>
                <div class="faq-item mx-auto ps-3 p-3 bg-secondary rounded" data-bs-toggle="collapse" data-bs-target="#data4"
                    aria-expanded="false" aria-controls="data4">
                    <a class="fw-bold fs-5 text-start rounded-0 text-white text-decoration-none">Bagaimana saya dapat
                        menggunakan FGID ?</a>
                    <div class="collapse" id="data4">
                        <div class="card rounded-0 border-0 bg-secondary text-white p-0 py-3 card-body text-left">
                            <ol>
                                <li>Registrasi dirimu di halaman https://fgid.xyz/register</li>
                                <li>Isi formulir sesuai data yang diminta</li>
                                <li>Verifikasi data dengan teliti.</li>
                                <li>Baca dan Terima Terms of Service</li>
                                <li>Buat halaman lalu Share halamanmu ke sosial media</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="faq-item mx-auto ps-3 p-3 bg-secondary rounded" data-bs-toggle="collapse" data-bs-target="#data5"
                    aria-expanded="false" aria-controls="data5">
                    <a class="fw-bold fs-5 text-start rounded-0 text-white text-decoration-none">Registrasi akun gagal
                        ?</a>
                    <div class="collapse" id="data5">
                        <div class="card rounded-0 border-0 bg-secondary text-white p-0 py-3 card-body text-left">Pastikan
                            username dan email memenuhi syarat dan tidak terpakai oleh user lain.</div>
                    </div>
                </div>
                <div class="faq-item mx-auto ps-3 p-3 bg-secondary rounded" data-bs-toggle="collapse" data-bs-target="#data6"
                    aria-expanded="false" aria-controls="data6">
                    <a class="fw-bold fs-5 text-start rounded-0 text-white text-decoration-none">Apakah dana yang sudah
                        dikirimkan bisa ditarik kembali ?</a>
                    <div class="collapse" id="data6">
                        <div class="card rounded-0 border-0 bg-secondary text-white p-0 py-3 card-body text-left">Tidak bisa.
                            Dana yang telah berhasil dikirim tidak dapat ditarik kembali dengan alasan apapun.</div>
                    </div>
                </div>
                <div class="faq-item mx-auto ps-3 p-3 bg-secondary rounded" data-bs-toggle="collapse" data-bs-target="#data7"
                    aria-expanded="false" aria-controls="data7">
                    <a class="fw-bold fs-5 text-start rounded-0 text-white text-decoration-none">Berapa Minimal dukungan
                        dan berapa lama dana dapat dicairkan ?</a>
                    <div class="collapse" id="data7">
                        <div class="card rounded-0 border-0 bg-secondary text-white p-0 py-3 card-body text-left">Dukungan
                            minimal yang dapat diterima adalah 3.000. Pencairan minimal di platform kami adalah 100.000
                        </div>
                    </div>
                </div>

                {{-- PENCAIRAN DANA --}}
                <div class="faq-item mx-auto ps-3 p-3 bg-secondary rounded" data-bs-toggle="collapse" data-bs-target="#data8"
                    aria-expanded="false" aria-controls="data8">
                    <a class="fw-bold fs-5 text-start rounded-0 text-white text-decoration-none">Berapa minimal
                        Pencairan?</a>
                    <div class="collapse" id="data8">
                        <div class="card rounded-0 border-0 bg-secondary text-white p-0 py-3 card-body text-left">Minimal
                            pencairan di platform kami adalah 100.000
                        </div>
                    </div>
                </div>
                <div class="faq-item mx-auto ps-3 p-3 bg-secondary rounded" data-bs-toggle="collapse" data-bs-target="#data9"
                    aria-expanded="false" aria-controls="data9">
                    <a class="fw-bold fs-5 text-start rounded-0 text-white text-decoration-none">Berapa lama Proses
                        pencairan ke Bank / Ewallet saya?</a>
                    <div class="collapse" id="data9">
                        <div class="card rounded-0 border-0 bg-secondary text-white p-0 py-3 card-body text-left">Pencairan dana
                            akan diproses perminggu, perekapan data dilakukan hari jumat, dan pencairan dana dihari sabtu,
                            apabila saldo belum memenuhi syarat penarikan maka akan diikutkan pencairan diminggu
                            selanjutnya.
                        </div>
                    </div>
                </div>
                <div class="faq-item mx-auto ps-3 p-3 bg-secondary rounded" data-bs-toggle="collapse" data-bs-target="#data10"
                    aria-expanded="false" aria-controls="data10">
                    <a class="fw-bold fs-5 text-start rounded-0 text-white text-decoration-none">Kenapa saya gagal dalam
                        mencairkan dana ?</a>
                    <div class="collapse" id="data10">
                        <div class="card rounded-0 border-0 bg-secondary text-white p-0 py-3 card-body text-left">
                            <p class="fs-6">Jika tidak menerima pencairan mingguan, silahkan cek beberapa hal dibawah
                                ini:</p>
                            <ol>
                                <li>Cek halaman Payout. pastikan Nama Bank / Ewallet, nomor rekening/nomor hp, dan nama
                                    rekening kamu sudah benar.</li>
                                <li>Pastikan saldo sudah memenuhi syarat penarikan, yaitu 100.000.</li>
                                <li>Apabila masih mengalami kendala, silahkan langsung hubungi kami melalui DM
                                    Instagram/Telegram.</li>
                            </ol>
                            <span class="fw-bold">Pihak FGID tidak bertanggungjawab apabila pencairan berhasil terkirim ke
                                rekening/ewallet yang salah.</span>
                        </div>
                    </div>
                </div>


                {{-- BIAYA --}}
                <div class="faq-item mx-auto ps-3 p-3 bg-secondary rounded" data-bs-toggle="collapse" data-bs-target="#data11"
                    aria-expanded="false" aria-controls="data11">
                    <a class="fw-bold fs-5 text-start rounded-0 text-white text-decoration-none">Biaya yang dikenakan
                        kepada Supporter ?</a>
                    <div class="collapse" id="data11">
                        <div class="card rounded-0 border-0 bg-secondary text-white p-0 py-3 card-body text-left">Kami
                            mengenakan biaya platform disetiap transaksi yang berhasil diproses (250 IDR) dan QRIS 0.8%
                        </div>
                    </div>
                </div>
                <div class="faq-item mx-auto ps-3 p-3 bg-secondary rounded" data-bs-toggle="collapse" data-bs-target="#data12"
                    aria-expanded="false" aria-controls="data12">
                    <a class="fw-bold fs-5 text-start rounded-0 text-white text-decoration-none">Biaya yang dikenakan
                        kepada Fotografer </a>
                    <div class="collapse" id="data12">
                        <div class="card rounded-0 border-0 bg-secondary text-white p-0 py-3 card-body text-left">Setiap
                            pencairan mingguan yang berhasil akan terpotong 5% untuk biaya payment gateway dan operasional
                            FGID.</div>
                    </div>
                </div>

            </div>
        </section>
    </div>
@endsection
@push('scripts')
    <script>
        $('#write_username').on('focus keyup mouseenter', function(e) {
            $(this).css({
                'color':'#000'
            })

            $('#claim').on('click', (e) => {
                localStorage.setItem('username', $(this).val())
                window.location.href = "{{ route('register') }}"
            })
        })
    </script>
@endpush