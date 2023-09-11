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
            background-color: #2696ff;
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
        input.form-control:focus{
            /* border: 1px solid red; */
            box-shadow: none;
        }
        #claim{
            top: 0px;
            right: 6px;
            height: 80%;
            transform: translate(0%,10%);
        }

        @media (max-width: 991.98px) {
            section#hero .title {
                width: 100%;
                text-align: center;
            }

            section#hero .preview {
                display: none;
            }
        }
    </style>
@endpush

@section('content')
    <div class="container mt-5">

        <section id="hero" class="d-flex justify-content-between align-items-center">
            <div class="title">
                <h1>Gank is the simplest way to earn for content creators</h1>
                <p class="mt-3">Gank helps content creators accept donations, manage membership and sell merch, for free.</p>
                <p>Claim your page now!</p>

                <div class="position-relative mb-3">
                    <input type="text" class="form-control border-danger w-100 pe-2 py-3" placeholder="lynkclone.id/username" aria-label="Recipient's username" aria-describedby="button-addon2">
                    <button id="claim" class="btn btn-md btn-danger fw-bold position-absolute" style="width: 120px;" type="button" id="button-addon2">Claim</button>
                </div>

            </div>
            <div class="preview flex-grow-1">
                <img src="{{ asset('assets/valorant.jpg') }}" class="object-fit-contain" style="width: 100%; height: 600px;"
                    alt="" srcset="">
            </div>
        </section>

        <section id="benefit" class="mt-5">
            <h2 class="text-center">How creators using FGID</h2>
            <div class="row row-cols-1 row-cols-md-3 g-4 mt-3">
                @for ($i = 0; $i < 6; $i++)
                    <div class="col">
                        <div class="card h-100" id="card-benefit">
                            <div class="card-body">
                                <h5 class="card-title">Digital Product</h5>
                                <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim,
                                    architecto.
                                </p>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>

        </section>

        <section id="creators" class="mt-5">
            <h2>Featured Streamers & Gamers</h2>
            <span>Discover the best streaming entertaiment</span>

            <div class="row row-cols-1 row-cols-md-5 g-4 mt-3">
                @for ($i = 1; $i <= 6; $i++)
                    <div class="col">
                        <div class="card h-100 bg-dark border-0">
                            <img src="{{ asset('assets/user' . $i . '.jpg') }}" style="width: 100%; height: 120px;"
                                class="card-img-top object-fit-cover" alt="...">
                            <div class="card-body position-relative">
                                <img id="avatar" src="{{ asset('assets/user' . $i . '.jpg') }}"
                                    class="rounded-circle object-fit-cover border border-white border-3"
                                    style="width: 96px; height: 96px;" alt="creator-avatar" srcset="">
                                <h5 class="card-title mt-5 text-bg-dark">Creator {{ $i }}</h5>
                                <p class="card-text text-bg-dark">Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                                    Sunt, aspernatur!</p>
                                <span class="badge rounded-pill px-2">Singer</span>
                            </div>
                        </div>

                    </div>
                @endfor
            </div>
        </section>
    </div>
@endsection
