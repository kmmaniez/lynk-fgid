{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap5/css/bootstrap.min.css') }}">
    <style>
        body{
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #eaeaea;
        }
        .shopping{
            padding: 4px 6px;
            cursor: pointer;
        }
        #wrapper{
            width: 800px;
            position: relative;
        }
        footer{
            width: 800px;
            height: max-content;
            margin: 0 auto;
            border-top: 0.5px solid rgba(36, 35, 35, 0.1);
        }
    </style>
    <script src="{{ asset('assets/feather-icons/dist/feather.js') }}"></script>

</head>
<body>
    <div id="wrapper" class="container p-0 bg-white">
        <nav class="navbar border-bottom navbar-expand-lg px-3 d-flex justify-content-between" style="height: 4rem;">
            <a class="navbar-brand" href="{{ route('admin') }}">
                <img src="{{ asset('assets/logo.png') }}" alt="Logo" width="150"
                    class="d-inline-block align-text-top">
            </a>
            <div class="shopping">
                <i data-feather="shopping-cart"></i> 
            </div>
        </nav>

        <section id="wrap" class="pb-3 px-3">
            <div class="header" style="">
                <div class="card rounded-0 border-0 text-center">
                    <div class="card-body vstack gap-3 align-items-center">
                        <img src="{{ asset('assets/user6.jpg') }}" style="width: 5rem; height: 5rem;" 
                            class="rounded-circle object-fit-cover" alt="...">
                        <span><strong>@username</strong></span>
                        <span>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Atque, adipisci?</span>
                    </div>
                </div>
            </div>

            <div class="list-products mt-2 mb-5">
                <div class="row gap-3">
                    <div class="col-12">
                        <a href="/awkarin/detail" class="text-decoration-none">
                            <div class="card text-center">
                                <div class="card-body">
                                    <span>Lorem ipsum adipisicing elit. Repellat!</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-12">
                        <a href="/awkarin/detail" class="text-decoration-none">
                            <div class="card">
                                <div class="card-body d-flex flex-start align-items-center gap-3">
                                    <img src="{{ asset('assets/user1.jpg') }}" style="width: 4rem; height: 4rem;" class="card-img-top" alt="...">
                                    <span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellat!</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-12">
                        <div class="row">
                            <div class="col">
                                <a href="/awkarin/detail" class="text-decoration-none">
                                    <div class="card h-100">
                                        <img src="{{ asset('assets/user1.jpg') }}" style="width: 100%; height: 120px;"
                                            class="card-img-top object-fit-cover" alt="...">
                                        <div class="card-body">
                                            <h6>Judul</h6>
                                            <span><strong>Rp. 5.000</strong></span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col">
                                <a href="/awkarin/detail" class="text-decoration-none">
                                    <div class="card h-100">
                                        <img src="{{ asset('assets/user3.jpg') }}" style="width: 100%; height: 120px;"
                                            class="card-img-top object-fit-cover" alt="...">
                                        <div class="card-body">
                                            <h6>Judul</h6>
                                            <span><strong>Rp. 5.000</strong></span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <a href="/awkarin/detail" class="text-decoration-none">
                            <div class="card h-100">
                                <img src="{{ asset('assets/user2.jpg') }}" style="width: 100%; height: 240px;"
                                    class="card-img-top object-fit-cover" alt="...">
                                <div class="card-body">
                                    <h6>Judul</h6>
                                    <span><strong>Rp. 5.000</strong></span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-12">
                        <a href="/awkarin/detail" class="text-decoration-none">
                            <div class="card text-center">
                                <div class="card-body">
                                    <span>Lorem ipsum adipisicing elit. Repellat!</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-12">
                        <div class="row">
                            <div class="col-6">
                                <a href="/awkarin/detail" class="text-decoration-none">
                                    <div class="card h-100">
                                        <img src="{{ asset('assets/user6.jpg') }}" style="width: 100%; height: 120px;"
                                            class="card-img-top object-fit-cover" alt="...">
                                        <div class="card-body">
                                            <h6>Judul</h6>
                                            <span><strong>Rp. 5.000</strong></span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>

    </div>

    <script src="{{ asset('assets/vendor/bootstrap5/js/bootstrap.bundle.min.js') }}"></script>
    <script>
        feather.replace();
    </script>
</body>
</html> --}}
@extends('layouts.products')
@push('styles')
    {{-- <style>
        /* body{
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #eaeaea;
        } */
        #wrapper{
            overflow-y: scroll;
        }
        footer{
            width: 800px;
            height: max-content;
            margin: 0 auto;
            border-top: 0.5px solid rgba(36, 35, 35, 0.1);
        }
        .bg-dark-cover{
            background-color: #121212;
            color: #fff;
        }
        section#wrap{
            padding: 0 1rem;/
        }
        @media (max-width: 820px) {
            section#wrap{
                padding: 0 0.5rem;
            }
        }
        #coverprofile{
            content: '';
            background: url('{{ asset("assets/user6.jpg") }}');
            object-fit: cover;
            background-size: 100%;
            background-position: center;
            background-repeat: no-repeat;
            position: absolute;
            width: 100%;
            height: 100%;
            z-index: -1;
            opacity: 0.3;
        }
        .header span{
            text-shadow: 0 0 10px rgb(38, 38, 38);
        }
    </style> --}}
    <style>
        .header span{
            user-select: none;
            color: #fff;
            text-shadow: 0 0 10px rgb(38, 38, 38);
        }
        #coverprofile{
            /* content: ''; */
            /* background: url('{{ asset("assets/user6.jpg") }}'); */
            /* object-fit: contain; */
            /* background-size: 100%; */
            /* background-position: center; */
            /* background-repeat: no-repeat; */
            position: absolute;
            width: 800px;
            height: 100px; 
            left: -6px;
            z-index: -1;
            /* size cover 800 x 200 */
        }
        #coverprofile::after{
            content: '';
            width: 100%;
            height: 100%;
            position: absolute;
            z-index: 1;
            left: 0;
            background-color: rgba(25, 25, 25, 0.615);
        }
        .card-cover{
            /* background-color: red; */
            overflow: hidden;
        }
        section{
            min-height: calc(100% - 4rem);
        }
        #tes{
            /* 800 x 200 profile */
            /* width: 100%; */
            width: 800px;
            height: 200px;
            position: absolute;
            object-fit: fill;
            z-index: -1;
        }
        .card-cover::after{
            content: '';
            width: 100%;
            height: 100%;
            top: 0;
            position: absolute;
            left: 0;
            background-color: rgba(25, 25, 25, 0.615);
            z-index: -1;
        }
    </style>
@endpush
@section('produk')
    {{-- <section id="wrap" class="bg-dark">
            <div class="header" style="">
                <div class="card bg-dark-cover rounded-0 border-0 text-center position-relative" style="z-index: 1">
                    <div id="coverprofile"></div>
                    <div class="card-body vstack gap-3 align-items-center">
                        <img src="{{ asset('assets/user6.jpg') }}" style="width: 5rem; height: 5rem;" 
                            class="rounded-circle border border-secondary-subtle border-3 object-fit-cover" alt="...">
                        <span><strong>@username</strong></span>
                        <span>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Atque, adipisci?</span>
                    </div>
                </div>
            </div>

            <div class="list-products mt-2">
                <div class="row gap-2">
                    <div class="col-12">
                        <a href="/awkarin/detail" class="text-decoration-none">
                            <div class="card bg-dark-cover text-center">
                                <div class="card-body">
                                    <span>Lorem ipsum adipisicing elit. Repellat!</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-12">
                        <a href="/awkarin/detail" class="text-decoration-none">
                            <div class="card bg-dark-cover ">
                                <div class="card-body d-flex flex-start align-items-center gap-3">
                                    <img src="{{ asset('assets/user1.jpg') }}" style="width: 4rem; height: 4rem;" class="card-img-top" alt="...">
                                    <span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellat!</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-12">
                        <div class="row">
                            <div class="col">
                                <a href="/awkarin/detail" class="text-decoration-none">
                                    <div class="card bg-dark-cover  h-100">
                                        <img src="{{ asset('assets/user1.jpg') }}" style="width: 100%; height: 120px;"
                                            class="card-img-top object-fit-cover" alt="...">
                                        <div class="card-body">
                                            <h6>Judul</h6>
                                            <span><strong>Rp. 5.000</strong></span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col">
                                <a href="/awkarin/detail" class="text-decoration-none">
                                    <div class="card bg-dark-cover h-100">
                                        <img src="{{ asset('assets/user3.jpg') }}" style="width: 100%; height: 120px;"
                                            class="card-img-top object-fit-cover" alt="...">
                                        <div class="card-body">
                                            <h6>Judul</h6>
                                            <span><strong>Rp. 5.000</strong></span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <a href="/awkarin/detail" class="text-decoration-none">
                            <div class="card bg-dark-cover  h-100">
                                <img src="{{ asset('assets/user2.jpg') }}" style="width: 100%; height: 240px;"
                                    class="card-img-top object-fit-cover" alt="...">
                                <div class="card-body">
                                    <h6>Judul</h6>
                                    <span><strong>Rp. 5.000</strong></span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-12">
                        <a href="/awkarin/detail" class="text-decoration-none">
                            <div class="card bg-dark-cover  text-center">
                                <div class="card-body">
                                    <span>Lorem ipsum adipisicing elit. Repellat!</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-12">
                        <div class="row">
                            <div class="col-6">
                                <a href="/awkarin/detail" class="text-decoration-none">
                                    <div class="card bg-dark-cover h-100">
                                        <img src="{{ asset('assets/user6.jpg') }}" style="width: 100%; height: 120px;"
                                            class="card-img-top object-fit-cover" alt="...">
                                        <div class="card-body">
                                            <h6>Judul</h6>
                                            <span><strong>Rp. 5.000</strong></span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <a href="/awkarin/detail" class="text-decoration-none">
                            <div class="card bg-dark-cover  h-100">
                                <img src="{{ asset('assets/user2.jpg') }}" style="width: 100%; height: 240px;"
                                    class="card-img-top object-fit-cover" alt="...">
                                <div class="card-body">
                                    <h6>Judul</h6>
                                    <span><strong>Rp. 5.000</strong></span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-12">
                        <a href="/awkarin/detail" class="text-decoration-none">
                            <div class="card bg-dark-cover  text-center">
                                <div class="card-body">
                                    <span>Lorem ipsum adipisicing elit. Repellat!</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-12">
                        <div class="row">
                            <div class="col-6">
                                <a href="/awkarin/detail" class="text-decoration-none">
                                    <div class="card bg-dark-cover h-100">
                                        <img src="{{ asset('assets/user6.jpg') }}" style="width: 100%; height: 120px;"
                                            class="card-img-top object-fit-cover" alt="...">
                                        <div class="card-body">
                                            <h6>Judul</h6>
                                            <span><strong>Rp. 5.000</strong></span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    </section> --}}
    <section id="wrap" class="">
        <div class="header" style="">
            <div class="card card-cover rounded-0 border-0 text-center position-relative" style="z-index: 1">
                <img id="tes" src="{{ ($user->coverimage) ? Storage::url($user->coverimage) : asset('assets/user6.jpg') }}" alt="" srcset="">
                {{-- <div id="coverprofile" style="background: url('{{ ($user->coverimage) ? Storage::url($user->coverimage) : asset('assets/user6.jpg') }}')"></div> --}}
                <div class="card-body vstack gap-3 align-items-center">
                    <img src="{{ ($user->photo) ? Storage::url($user->photo) : asset('assets/user2.jpg') }}" style="width: 5rem; height: 5rem;" 
                        class="rounded-circle border border-secondary-subtle border-3 object-fit-cover" alt="...">
                    <span><strong>{{ '@'.$user->username }}</strong></span>
                    <span>{{ $user->description }}</span>
                </div>
            </div>
        </div>

        <div class="list-products mt-2">
            <div class="row gap-2">
                {{-- @dump($products) --}}
                @foreach ($products as $product)
                <div class="col-12">
                    <a href="{{ ($product->slug) ? $product->slug : $product->url }}" title="{{ $product->name }}" class="text-decoration-none">

                        @if ($product->layout === "large")
                        <div class="card {{ ($user->theme == "light") ? 'bg-white' : 'bg-dark text-white' }} h-100">
                            <img src="{{ ($product->thumbnail) ? Storage::url($product->thumbnail) : asset('assets/user2.jpg') }}" style="width: 100%; height: 240px;"
                                class="card-img-top" alt="...">
                            <div class="card-body">
                                <h6>{{ $product->name }} | LARGE</h6>
                                <span><strong>RP. {{ $product->min_price }}</strong></span>
                            </div>
                        </div>

                        @elseif ($product->layout === "grid")
                        <span>GRID</span>

                        @else
                        <div class="card {{ ($user->theme == "light") ? 'bg-white' : 'bg-dark text-white' }}">
                            <div class="card-body text-center">
                                <span>{{ $product->name }} | DEFAULT</span>
                            </div>
                        </div>
                        @endif
                        
                    </a>
                </div>
                    {{-- @dump($product->name) --}}
                @endforeach
                {{-- <div class="col-12">
                    <a href="/awkarin/detail" class="text-decoration-none">
                        <div class="card bg-dark-cover">
                            <div class="card-body text-center">
                                <span>Lorem ipsum adipisicing elit. Repellat!</span>
                            </div>
                        </div>
                    </a>
                </div> --}}
                {{-- <div class="col-12">
                    <a href="/awkarin/detail" class="text-decoration-none">
                        <div class="card bg-dark-cover">
                            <div class="card-body d-flex flex-start align-items-center gap-3">
                                <img src="{{ asset('assets/user1.jpg') }}" style="width: 4rem; height: 4rem;" class="card-img-top" alt="...">
                                <span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellat!</span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-12">
                    <div class="row">
                        <div class="col">
                            <a href="/awkarin/detail" class="text-decoration-none">
                                <div class="card bg-dark-cover  h-100">
                                    <img src="{{ asset('assets/user1.jpg') }}" style="width: 100%; height: 120px;"
                                        class="card-img-top object-fit-cover" alt="...">
                                    <div class="card-body">
                                        <h6>Judul</h6>
                                        <span><strong>Rp. 5.000</strong></span>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col">
                            <a href="/awkarin/detail" class="text-decoration-none">
                                <div class="card bg-dark-cover h-100">
                                    <img src="{{ asset('assets/user3.jpg') }}" style="width: 100%; height: 120px;"
                                        class="card-img-top object-fit-cover" alt="...">
                                    <div class="card-body">
                                        <h6>Judul</h6>
                                        <span><strong>Rp. 5.000</strong></span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <a href="/awkarin/detail" class="text-decoration-none">
                        <div class="card bg-dark-cover h-100">
                            <img src="{{ asset('assets/user2.jpg') }}" style="width: 100%; height: 240px;"
                                class="card-img-top object-fit-cover" alt="...">
                            <div class="card-body">
                                <h6>Judul</h6>
                                <span><strong>Rp. 5.000</strong></span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-12">
                    <a href="/awkarin/detail" class="text-decoration-none">
                        <div class="card bg-dark-cover  text-center">
                            <div class="card-body">
                                <span>Lorem ipsum adipisicing elit. Repellat!</span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-12">
                    <div class="row">
                        <div class="col-6">
                            <a href="/awkarin/detail" class="text-decoration-none">
                                <div class="card bg-dark-cover h-100">
                                    <img src="{{ asset('assets/user6.jpg') }}" style="width: 100%; height: 120px;"
                                        class="card-img-top object-fit-cover" alt="...">
                                    <div class="card-body">
                                        <h6>Judul</h6>
                                        <span><strong>Rp. 5.000</strong></span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </section>
@endsection