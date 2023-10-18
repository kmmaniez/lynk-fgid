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

        #recently {
            animation-name: slideFromLeft;
            animation-duration: 3s;
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
        .card{
            /* outline: 2px solid #eaeaea; */
        }
        .card:is(:hover){
            outline: 3px solid salmon;
            cursor: pointer;
        }

        section#hero .title {
            width: 40%;
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
        .card{
            background-color: #191d20;
            color: #fff;
            box-shadow: 0px 0px 24px #191b1e;
            padding-bottom: 16px;
        }
        section{
            color: #fff;
        }
        .bg-darken{
            background-color: #171717;
        }
        #container-wrap{
            width: 100%;
            height: auto;
        }
        .container{
            overflow-x: hidden;
        }
        .card-title{
            margin-top: 48px;
        }

        section#hero{
            height: 480px;
            background-image: url("{{ asset('assets/carousel-1.jpg') }}");
            background-size: 100%;
            background-repeat: no-repeat;
            background-attachment: scroll;
            position: relative;
        }
        section#hero::after{
            width: 100%;
            height: 100%;
            position: absolute;
            content: '';
            background-color: rgba(0, 0, 0, 0.5);
            top: 0;
        }
        section#hero .title{
            position: relative;
            z-index: 2;
            padding-inline-start: 24px;
        }
        section#hero .title h1{
            text-shadow: 0px 8px 16px #191d20;
        }
        @media (max-width: 820px) {
            h5{
                font-size: 1rem;
            }
            section#hero{
                height: max-content;
                background-image: none;
            }
            section#hero::after{
                display: none;
            }
            section#hero .title{
                padding-inline-start: 0px;
            }
            section#hero .title h1{
                font-size: 32px;
            }
            #avatar{
                display: none;
            }
            .card-body span{
                display: none;
            }

            section .card-title{
                margin-top: 0;
            }
            #card-benefit:is(:hover){
                transform: none;
            }
            .card{
                padding-bottom: 0;
            }

            .card-text{
                display: none;
            }
            .row-benefit{
                row-gap: 8px;
            }
        }
    </style>
@endpush

@section('content')
    <div class="container mt-5">

        <section id="hero" class="d-flex justify-content-between align-items-center">
            <div class="title">
                <h1>Discover Creators, Inspire Content </h1>

                <div class="position-relative mt-3 mb-3">
                    <input type="text" class="form-control shadow-none border-danger w-100 pe-2 py-3" placeholder="Search...    " aria-label="Recipient's username" aria-describedby="button-addon2">
                    <button id="claim" class="btn btn-md btn-danger fw-bold position-absolute" style="width: 120px;" type="button" id="button-addon2">Search</button>
                </div>

            </div>
            {{-- <div class="preview flex-grow-1">
                <img src="{{ asset('assets/valorant.jpg') }}" class="object-fit-contain" style="width: 100%; height: 600px;"
                    alt="" srcset="">
            </div> --}}
        </section>

        <section id="creators" class="mt-5">
            <h2>Featured Indonesia Photographer</h2>
            <span>Discover the best streaming entertaiment</span>

            <div class="row row-cols-2 row-cols-lg-5 g-4 mt-3">
                @foreach ($creatorFeatured as $creator)
                <div class="col">
                    <a href="{{ route('public.user', $creator->username) }}" title="{{ $creator->username }}" class="text-decoration-none">
                        <div class="card h-100 rounded-4 border-0">
                            <img src="{{ ($creator->coverimage) ? Storage::url($creator->coverimage) : asset('assets/user1.jpg') }}" loading="lazy" style="width: 100%; height: 120px;"
                                class="card-img-top object-fit-cover rounded-4 rounded-bottom-0" alt="...">
                            <div class="card-body position-relative">
                                <img id="avatar" src="{{ ($creator->photo) ? Storage::url($creator->photo) : asset('assets/user1.jpg') }}"
                                    class="rounded-circle border border-white border-3"
                                    style="width: 96px; height: 96px;" loading="lazy" alt="creator-avatar" srcset="">
                                <h5 class="card-title">{{ $creator->username }}</h5>
                                <p class="card-text">{{ $creator->description }}</p>
                                {{-- <span class="badge rounded-pill px-2">Singer</span> --}}
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </section>

        <section id="recently" class="mt-5 py-4">
            <h2>Recently Joined</h2>
            <div class="row row-cols-2 row-cols-lg-5 g-4 mt-3">

                @foreach ($creatorRecents as $creator)
                <div class="col">
                    <a href="{{ route('public.user', $creator->username) }}" class="text-decoration-none">
                        <div id="card-recent" class="card card-style h-100 rounded-4 border-0">
                            <img src="{{ ($creator->coverimage) ? Storage::url($creator->coverimage) : asset('assets/user1.jpg') }}" loading="lazy" style="width: 100%; height: 120px;"
                                class="card-img-top object-fit-cover rounded-4 rounded-bottom-0" alt="Photo">
                            <div class="card-body position-relative">
                                <img id="avatar" src="{{ ($creator->photo) ? Storage::url($creator->photo) : asset('assets/user1.jpg') }}"
                                    class="rounded-circle object-fit-cover border border-white border-3"
                                    style="width: 96px; height: 96px;" loading="lazy" alt="creator-avatar" srcset="">
                                <h5 class="card-title">{{ $creator->username }}</h5>
                                <p class="card-text">{{ $creator->description }}</p>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </section>
    </div>
@endsection
