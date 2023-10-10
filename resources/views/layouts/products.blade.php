
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
            background-color: rgb(227, 226, 255);
            justify-content: center;
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
            height: 100vh;
            border: 1px solid #e1e1e1;
            background-color: #fff;
            margin: 0 auto;
            /* overflow: hidden; */
            /* overflow-y: scroll;  */
            /* overflow-x: hidden; */
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
        .header span{
            color: #fff;
            text-shadow: 0 0 10px rgb(38, 38, 38);
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

<body>
    <div class="wrapper" style="">

        <nav class="navbar px-4 bg-primary sticky-top bg-body-tertiary">
              <a class="navbar-brand" href="{{ route('admin') }}">
                <img src="{{ asset('assets/logo.png') }}" alt="Logo" width="150"
                    class="d-inline-block align-text-top">
            </a>
            @if (!Request::routeIs('checkout') && !Request::routeIs('owner'))
            <div class="cart">
                <i data-feather="shopping-cart" class="text-success"></i> 
            </div>
            @endif
        </nav>

        {{-- <main> --}}
        {{-- <section id="wrap" class="bg-dark">
            <div class="header" style="">
                <div class="card rounded-0 border-0 text-center position-relative" style="z-index: 1">
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
                </div>
            </div>
        </section> --}}
        @yield('produk')

        {{-- <section id="checkout" class="">
            <div class="card border-0 h-100">
                <div class="card-body">
    
                    <div class="card">
                        <div class="card-body">
                            <small>Order Summary</small>
    
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>Total Item</td>
                                        <td class="text-end">4 items</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="p-0">
                                            <div class="accordion" id="accordionPanelsStayOpenExample">
                                                <div class="accordion-item border-0">
                                                    <h2 class="accordion-header">
                                                        <button class="accordion-button bg-white shadow-none" type="button"
                                                            data-bs-toggle="collapse"
                                                            data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
                                                            aria-controls="panelsStayOpen-collapseOne">
                                                            List Item
                                                        </button>
                                                    </h2>
                                                    <div id="panelsStayOpen-collapseOne"
                                                        class="accordion-collapse collapse show">
                                                        <div class="accordion-body py-0 px-2">
    
                                                            <div class="hstack justify-content-between">
                                                                <ol class="mt-2">
                                                                    <li><span>Char PB (1x)</span></li>
                                                                    <li><span>Valorant cheat (2x)</span></li>
                                                                    <li><span>Ninja Saga (1x)</span></li>
                                                                </ol>
        
                                                                <ul class="mt-2" style="list-style-type: none">
                                                                    <li><span>Rp. 20.000</span></li>
                                                                    <li><span>Rp. 10.000</span></li>
                                                                    <li><span>Rp. 30.000</span></li>
                                                                </ul>
    
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Fee platform</td>
                                        <td class="text-end">Rp. 10.000</td>
                                    </tr>
                                    <tr>
                                        <th>Total</th>
                                        <td class="text-end fw-bold">Rp. 30.000</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
    
                    <div class="card border-0 mt-2">
                        <div class="card-body card-form-input">
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input class="form-control shadow-none" type="email" name="" id="">
                                </div>
                                <div class="form-group mt-2">
                                    <label for="">Nama</label>
                                    <input class="form-control shadow-none" type="text" name="" id=""
                                        required>
                                </div>
    
                                <div class="payment-method mt-2">
                                    <div class="form-group">
                                        <label for="">Pilih Pembayaran</label>
                                        <div class="hstack mt-2" id="theme_profile">
                                            <label>
                                                <input class="form-check-input" type="radio" name="theme" value="light">
                                                <img src="{{ asset('assets/ovo.jpg') }}" alt="light">
                                            </label>
                                            <label>
                                                <input class="form-check-input" type="radio" name="theme" value="dark">
                                                <img src="{{ asset('assets/qris.png') }}" alt="dark">
                                            </label>
                                            <label>
                                                <input class="form-check-input" type="radio" name="theme" value="dark">
                                                <img src="{{ asset('assets/shopeepay.png') }}" alt="dark">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
    
                </div>
                <div class="card-footer border-0">
                    <a href="#" id="btnAddToCart" class="btn text-white bg-danger bg-gradient w-100">Bayar Sekarang - Rp. 30.0000</a>
                    <a href="{{ route('owner') }}" id="btnAddToCart" class="btn btn-default w-100 mt-1">Kembali Belanja</a>
                </div>
            </div>
        </section> --}}
        {{-- </main> --}}
        {{-- <section id="produk-detail" class="">
            <div class="card border-0 h-100">
                <img src="{{ asset('assets/bg-3.jpg') }}" style="width: 100%; height: 240px;"
                    class="rounded-none" alt="...">
                <div class="card-body">
                    <h2 class="mb-3">Joki Game Valorant</h2>
                    <div class="form-group">
                        <label for=""><small>Berapa yang akan anda bayar</small></label>
                        <input type="number" class="form-control shadow-none" step="200" min="3000" name="" id="">
                    </div>
                    <div class="form-group mt-3">
                        <label for=""><small class="text-secondary fw-semibold">Deskripsi</small></label>
                        <span class="d-block mt-2">Deskripsi produk</span>
                    </div>
                </div>
                <div class="card-footer border-0">
                    <a href="#" id="btnAddToCart" class="btn bg-danger text-white fw-semibold bg-gradient w-100">Beli Sekarang</a>
                    <a href="{{ route('owner') }}" id="" class="btn mt-2 w-100">Kembali</a>
                </div>
            </div>
        </section> --}}

        @if (Request::routeIs('detail'))
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
                        <a href="{{ route('checkout') }}" target="_blank" id="checkoutBtn" class="btn btn-md btn-danger bg-gradient w-100">Checkout</a>
                        <a href="#" id="continueBtn" class="btn btn-md btn-outline-danger w-100">Continue Shopping</a>
                    </div>
                </div>
            </div>
        </div>
        @endif

        @if (Request::routeIs('owner'))
        <footer class="text-dark text-center text-uppercase fw-semibold">
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
