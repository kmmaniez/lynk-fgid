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
        section#creators .card:is(:hover), section#recently .card:is(:hover){
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
        section#creators .card, section#recently .card{
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
        section#creators .card-title, section#recently .card-title{
            margin-top: 48px;
        }

        section#hero{
            height: 480px;
            background-image: url("{{ asset('assets/carousels/carousel-1.jpg') }}");
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
            section#creators .card-body span, section#recently .card-body span{
                display: none;
            }

            section#creators .card-title, section#recently .card-title{
                margin-top: 0;
            }
            #card-benefit:is(:hover){
                transform: none;
            }
            section#creators .card, section#recently .card{
                padding-bottom: 0;
            }

            .card-text{
                display: none;
            }
            .row-benefit{
                row-gap: 8px;
            }
        }
        /* Hide scrollbar for Chrome, Safari and Opera */
        .searchbox::-webkit-scrollbar{
            display: none;
        }

        /* Hide scrollbar for IE, Edge and Firefox */
        .searchbox {
            -ms-overflow-style: none; 
            scrollbar-width: none; 
        }
        .searchbox{
            width: 100%;
            /* height: 180px; */
            min-height: 100%;
            max-height: 180px;
            /* display: none; */
            visibility: hidden;
            /* height: 180px; */
            overflow-y: scroll;
            /* scroll-snap-align: x mandatory; */
            position: absolute;
            /* bottom: -11.5rem; */
            transform: translateY(0.5rem);
            left: 0;
        }
    </style>
@endpush

@section('content')
    <div class="container mt-5">

        <section id="hero" class="d-flex justify-content-between align-items-center">
            <div class="title">
                <h1>Discover Creators, Inspire Content </h1>

                <div class="position-relative mt-3 mb-3">
                    <input id="search-input" type="text" class="form-control shadow-none border-danger w-100 pe-2 py-3" placeholder="Search..." aria-label="Recipient's username" aria-describedby="button-addon2">
                    <button id="claim" class="btn btn-md btn-danger fw-bold position-absolute" style="width: 120px;" type="button" id="button-addon2">Search</button>
                    <div class="searchbox vstack gap-2 p-2 bg-white rounded-1">
                    </div>
                </div>

            </div>
        </section>

        <section id="creators" class="mt-5">
            <h2>Featured Indonesia Photographer</h2>
            <span>Discover the best photographer entertaiment</span>

            <div class="row row-cols-2 row-cols-lg-5 g-4 mt-3">
                @foreach ($creatorFeatured as $creator)
                <div class="col">
                    <a href="{{ route('public.user', $creator->username) }}" title="{{ $creator->username }}" class="text-decoration-none">
                        <div class="card h-100 rounded-4 border-0">
                            <img src="{{ ($creator->coverimage) ? Storage::url($creator->coverimage) : asset('assets/cover-white.png') }}" loading="lazy" style="width: 100%; height: 120px;"
                                class="card-img-top object-fit-cover rounded-4 rounded-bottom-0" alt="...">
                            <div class="card-body position-relative">
                                <img id="avatar" src="{{ ($creator->photo) ? Storage::url($creator->photo) : asset('assets/profile-default.png') }}"
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

        <section id="recently" class="mt-5 py-4">
            <h2>Recently Joined</h2>
            <div class="row row-cols-2 row-cols-lg-5 g-4 mt-3">

                @foreach ($creatorRecents as $creator)
                <div class="col">
                    <a href="{{ route('public.user', $creator->username) }}" class="text-decoration-none">
                        <div id="card-recent" class="card card-style h-100 rounded-4 border-0">
                            <img src="{{ ($creator->coverimage) ? Storage::url($creator->coverimage) : asset('assets/cover-white.png') }}" loading="lazy" style="width: 100%; height: 120px;"
                                class="card-img-top object-fit-cover rounded-4 rounded-bottom-0" alt="Photo">
                            <div class="card-body position-relative">
                                <img id="avatar" src="{{ ($creator->photo) ? Storage::url($creator->photo) : asset('assets/profile-default.png') }}"
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
@push('scripts')
    <script>
        const btn = document.querySelector('#claim');
        const searchbox = document.querySelector('.searchbox');

        $('#search-input').on('keyup', (e) => {
            $.ajax({
                url: "{{ route('public.search') }}?username="+e.target.value,
                method: 'GET',
                success: (res) => {
                    const {user} = res;
                    $('.searchbox').css('visibility', 'visible');
                    let listUsers = [];
                    $('.searchbox').empty()
                    if (user.length > 0 ) {
                        listUsers.push(...user)
                        listUsers.forEach(item => {
                            let url, photoUrl;
                            if (item.photo) {
                                url = item.photo;
                                photoUrl = url.replace('public','storage');
                            }
                            let card = `
                            <div class="card result-item">
                                <div class="card-body hstack gap-3">
                                    <img src="${(photoUrl) ? photoUrl : 'assets/profile-default.png' }"
                                    class="rounded-2 object-fit-cover"
                                    style="width: 48px; height: 48px;" loading="lazy" alt="" srcset="">
                                    <a href="/@${item.username}" class="text-decoration-none">${item.username}</a>
                                </div>
                            </div>
                            `;
                            $('.searchbox').append(card);
                        });
                    }else{
                        $('.searchbox').html(`
                            <div class="card empty">
                                <div class="card-body">
                                    <span>${res.messages}</span>
                                </div>
                            </div>
                        `);
                    }
                    if (e.target.textLength === 0) {
                        listUsers = [];
                        $('.searchbox').html(`
                            <div class="card empty">
                                <div class="card-body">
                                    <span>${res.messages}</span>
                                </div>
                            </div>
                        `);
                    };
                },
                error: (err) => {
                    console.log(err);
                }
            })
        })


        $('.searchbox').on('mouseleave', (e) => {
            $('.searchbox').css('visibility', 'hidden');
        });
    </script>
@endpush