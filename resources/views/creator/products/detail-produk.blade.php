{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap5/css/bootstrap.min.css') }}">
    <style>
        .cart-info.show{
            transform: translateY(0px);
            transition: all 500ms ease-in;
            filter: blur(0);
        }
        #card-detail{
            border-radius: 32px 32px 0 0;
        }
        .cart-info{
            width: 100%;
            margin: 0 auto;
            height: max-content;
            overflow: scroll;
            position: absolute;
            z-index: 1; 
            bottom: 0; 
            transform: translateY(500px);
            transition: all 500ms cubic-bezier(0.455, 0.03, 0.515, 0.955);
            filter: blur(4px);
        }
        section#produk{
           top: 4rem; 
           bottom:0; 
           right:0; 
           z-index:-1;
           height: calc(100vh - 4rem);
        }
        @media (max-width: 768px) {
            section#produk{
                width: 100%;
            }
        }
        body{
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #eaeaea;
        }
        #wrapper{
            position: relative;
            overflow: hidden;
            height: 100vh;
            width: 800px;
        }
        .cart{
            padding: 4px 6px;
            /* background-color: blue; */
            cursor: pointer;
        }
    </style>
        <script src="{{ asset('assets/feather-icons/dist/feather.js') }}"></script>

</head>

<body>
    <div id="wrapper" class="bg-white p-0" style="">
        <nav class="navbar border-bottom navbar-expand-lg px-3 d-flex justify-content-between" style="height: 4rem;">
            <a class="navbar-brand" href="{{ route('admin') }}">
                <img src="{{ asset('assets/logo.png') }}" alt="Logo" width="150"
                    class="d-inline-block align-text-top">
            </a>
            <div class="cart">
                <i data-feather="shopping-cart" class="text-success"></i> 
            </div>
        </nav>

        <section id="produk" class="px-3 mt-2">
            <div class="card border-0 h-100">
                <img src="{{ asset('assets/user2.jpg') }}" style="width: 100%; height: 240px;"
                    class="card-img-top" alt="...">
                <div class="card-body">
                        <h2 class="mb-3">Judul Produk</h2>
                        <div class="form-group">
                            <label for=""><small>Berapa yang akan anda bayar</small></label>
                            <input type="number" class="form-control shadow-none" step="200" min="3000" name="" id="">
                        </div>
                        <div class="form-group mt-3">
                            <label for=""><small class="text-secondary fw-semibold">Judul Deskripsi</small></label>
                            <span class="d-block mt-2">Deskripsi produk</span>
                        </div>
                </div>
                <div class="card-footer border-0 mb-3">
                        <a href="#" id="btnAddToCart" class="btn btn-success bg-success bg-gradient w-100">Beli Sekarang</a>

                </div>
            </div>
        </section>

        <div class="cart-info">
            <div id="card-detail" class="card w-100">
                <div class="card-body">
                    <p class="mt-2">Keranjang Belanja</p>
                    <div class="keterangan-order">
                        <div class="list-item vstack mt-2 mb-2 gap-2 px-2" style="height: 11rem; overflow-y: scroll; scroll-behavior: smooth;">
        
                            <div class="card" style="height: 6rem;">
                                <div class="card-body ps-2 pe-2 d-flex justify-content-between align-items-center gap-3">
                                    <img src="{{ asset('assets/user1.jpg') }}" 
                                    style="width: 4rem; height: 4rem;" class="card-img-top" alt="...">
        
                                    <div class="vstack justify-content-between">
                                        <span class="d-block">Judul Produk</span>
                                        <span class="d-block fw-semibold">Rp. 5.000</span>
                                    </div>
                                    
                                    <div id="item-action" class="vstack align-items-end justify-content-between">
                                        <span class="d-block">Qty : 2</span>
        
                                        <span class="button-group">
                                            <a href="#" class="px-2 fs-2">+</a>
                                            <a href="#" class="px-2 fs-2">-</a>
                                        </span>
                                    </div>
                                </div>
                            </div>
        
                            <div class="card" style="height: 6rem;">
                                <div class="card-body ps-2 pe-2 d-flex justify-content-between align-items-center gap-3">
                                    <img src="{{ asset('assets/user1.jpg') }}" 
                                    style="width: 4rem; height: 4rem;" class="card-img-top" alt="...">
        
                                    <div class="vstack justify-content-between">
                                        <span class="d-block">Judul Produk</span>
                                        <span class="d-block fw-semibold">Rp. 5.000</span>
                                    </div>
                                    
                                    <div id="item-action" class="vstack align-items-end justify-content-between">
                                        <span class="d-block">Qty : 2</span>
        
                                        <span class="button-group">
                                            <a href="#" class="px-2 fs-2">+</a>
                                            <a href="#" class="px-2 fs-2">-</a>
                                        </span>
                                    </div>
                                </div>
                            </div>
        
                        </div>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th>Total Item</th>
                                    <td class="text-end">5</td>
                                </tr>
                                <tr>
                                    <th>Total Price</th>
                                    <td class="text-end">Rp. 10.000</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="vstack gap-2">
                        <a href="{{ route('checkout') }}" target="_blank" id="checkoutBtn" class="btn btn-md btn-success bg-gradient w-100">Checkout</a>
                        <a href="#" id="continueBtn" class="btn btn-md btn-outline-success w-100">Continue Shopping</a>
                    </div>
                </div>
            </div>
        </div>
        
    </div>

    <script src="{{ asset('assets/vendor/bootstrap5/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('assets') }}/vendor/jquery/jquery.min.js"></script>
    <script src="{{ asset('assets') }}/vendor/jquery-easing/jquery.easing.min.js"></script>

</body>
    <script>
        const BtnAddToCart = $('#btnAddToCart');
        const cart = $('.cart');
        cart.on('click', () => {
            let show = $('.cart-info').hasClass('show');
            if (!show) {
                $('.cart-info').addClass('show')
            }else{
                $('.cart-info').removeClass('show')
            }
        })

        BtnAddToCart.on('click', (e) => {
            e.preventDefault();
            $('.cart-info').addClass('show');
        })
        $('#continueBtn').on('click', () => {
            $('.cart-info').removeClass('show')
        })
        feather.replace();

    </script>
</html> --}}
@extends('layouts.products')
@push('styles')
    <style>
        .wrapper{
            overflow-y: hidden;
        }
    </style>
@endpush
@section('produk')
    <section id="produk-detail" class="">
        <div class="card border-0 h-100">
            <img src="{{ asset('assets/bg-3.jpg') }}" style="width: 100%; height: 240px;"
                class="rounded-none" alt="...">
            <div class="card-body">
                <h2 class="mb-3">Joki Game Valorant</h2>
                <div class="form-group">
                    <label for=""><small>How much you will pay the product</small></label>
                    <input type="number" class="form-control shadow-none" step="200" min="3000" name="" id="">
                </div>
                <div class="form-group mt-3">
                    <label for=""><small class="text-secondary fw-semibold">Description</small></label>
                    <span class="d-block mt-2">Deskripsi produk</span>
                </div>
            </div>
            <div class="card-footer bg-white border-0">
                <a href="#" id="btnAddToCart" class="btn bg-danger text-white fw-semibold bg-gradient w-100">Buy Now</a>
                <a href="{{ route('public.user', request()->route()->originalParameters()['user']) }}" id="" class="btn mt-2 w-100">Back</a>
            </div>
        </div>
    </section>
    {{-- <section id="produk" class="px-2 mt-2">

        <div class="card border-0 h-100">
            <img src="{{ asset('assets/user2.jpg') }}" style="width: 100%; height: 240px;"
                class="card-img-top" alt="...">
            <div class="card-body px-2">
                <h2 class="mb-3">Judul Produk</h2>
                <div class="form-group">
                    <label for=""><small>Berapa yang akan anda bayar</small></label>
                    <input type="number" class="form-control shadow-none" step="200" min="3000" name="" id="">
                </div>
                <div class="form-group mt-3">
                    <label for=""><small class="text-secondary fw-semibold">Judul Deskripsi</small></label>
                    <span class="d-block mt-2">Deskripsi produk</span>
                </div>
            </div>
            <div class="card-footer border-0 mb-3">
                    <a href="#" id="btnAddToCart" class="btn bg-danger text-white fw-semibold bg-gradient w-100">Beli Sekarang</a>
                    <a href="{{ route('owner') }}" id="" class="btn mt-2 w-100">Kembali</a>

            </div>
        </div>
    </section> --}}
@endsection