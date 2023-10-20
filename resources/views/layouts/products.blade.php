
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap5/css/bootstrap.min.css') }}">
    <style>
        /* Hide scrollbar for Chrome, Safari and Opera */
        .wrapper::-webkit-scrollbar, main::-webkit-scrollbar {
            display: none;
        }

        /* Hide scrollbar for IE, Edge and Firefox */
        .wrapper, main {
            -ms-overflow-style: none; 
            scrollbar-width: none; 
        }
        body{
            display: flex;
            /* background-color: #121212; */
            justify-content: center;
        }
        .bg-light-cover{
            background-color: rgb(227, 226, 255);
        }
        .bg-dark-cover{
            background-color: #121212;
            color: #fff;
        }
        @media (max-width: 820px) {

            .wrapper{
                border: none !important;
                /* width: 100vw; */
            }
            footer{
                /* width: 100vw !important; */
                display: none;
            }
            .list-products{
                padding: 0 8px;
            }
            section{
                padding-left: 0 !important; 
                padding-right: 0 !important; 
                padding-bottom: 24px !important;
            }
            /* SECTION CHECKOUT */
            .card-form-input{
                padding: 8px 0px;
            }
            .payment-method .form-group .hstack{
                justify-content: space-between;
            }
        }
        .wrapper{
            width: 820px;
            /* height: 100vh; */
            min-height: 100vh;
            max-height: max-content;
            /* border: 1px solid #e1e1e1; */
            /* background-color: #fff; */
            margin: 0 auto;
            /* overflow: hidden; */
            /* overflow-y: scroll; 
            overflow-x: hidden; */
            position: relative;
        }
        footer{
            width: inherit;
            height: max-content;
            background-color: #fff;
            /* opacity: 0.5; */
            position: fixed;
            bottom: 0;
            padding: 8px 0;
        }
        section{
            padding: 0px 16px 48px 16px;
        }
        
        /* SECTION CHECKOUT */
        [type=radio] { 
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }
        /* IMAGE STYLES */
        [type=radio] + img {
            cursor: pointer;
            width: 96px;
            height: 48px;
        }

        /* CHECKED STYLES */
        [type=radio]:checked + img {
            background-color: #fff;
            outline: 1px solid #3e9f72;
            border-radius: 4px;
        }
        .payment-method .form-group .hstack{
            justify-content: flex-start;
            gap: 1.5rem;
        }
        section#produk-detail{
            position: relative;
            padding-bottom: 0;
            height: 93vh;
            /* overflow: hidden; */
        }
        section#produk-detail .card-body{
            padding: 0.5rem 1rem 0 1rem;
        }

        .cart{
            padding: 4px 6px;
            /* background-color: blue; */
            cursor: pointer;
        }
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
            /* overflow: scroll; */
            overflow: hidden;
            position: absolute;
            z-index: 1; 
            bottom: 0; 
            transform: translateY(500px);
            transition: all 500ms cubic-bezier(0.455, 0.03, 0.515, 0.955);
            filter: blur(4px);
        }
    </style>
        <script src="{{ asset('assets/feather-icons/dist/feather.js') }}"></script>
    @stack('styles')
</head>

<body 
    class="{{ ($user->theme == "light") ? 'bg-light-cover' : 'bg-dark'}}">

    <div class="wrapper {{ ($user->theme == "light") ? 'bg-white' : 'bg-dark-cover' }}" style="">

        <nav class="navbar px-4 bg-primary sticky-top bg-body-tertiary">
              <a class="navbar-brand" href="{{ route('admin') }}">
                <img src="{{ asset('assets/logo.png') }}" alt="Logo" width="150"
                    class="d-inline-block align-text-top">
            </a>
            @if (Request::routeIs('public.userproduct'))
            <div class="cart">
                <i data-feather="shopping-cart" class="text-success"></i> 
            </div>
            @endif
        </nav>

        @yield('produk')

        @if (Request::routeIs('public.userproduct'))
        <div class="cart-info">
            <div id="card-detail" class="card w-100">
                <div class="card-body">
                    <p class="mt-2">Shopping Cart</p>
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
                        <a href="{{ route('checkout') }}" target="_blank" id="checkoutBtn" class="btn btn-md btn-danger bg-gradient w-100">Checkout</a>
                        <a href="#" id="continueBtn" class="btn btn-md btn-outline-danger w-100">Continue Shopping</a>
                    </div>
                </div>
            </div>
        </div>
        @endif

        @if (Request::routeIs('public.user') || Request::routeIs('light'))
        <footer class="text-dark bg-white text-center text-uppercase fw-semibold">
            <span>FGID Community</span>
        </footer>
            
        @endif
        
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
</html>
