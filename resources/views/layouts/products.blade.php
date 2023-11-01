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
        span#total-cart{
            position: absolute;
            font-size: 12px;
            width: 1.5rem;
            height: 1.5rem;
            background-color: salmon;
            /* border: 1.5px solid #000; */
            /* padding: 4px; */
            color: #000;
            border-radius: 50%;
            right: -6px;
            top: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
        <script src="{{ asset('assets/feather-icons/dist/feather.js') }}"></script>
    @stack('styles')
</head>

<body 
    class="{{ ($user->theme == "light" || Request::routeIs('cart.checkout')) ? 'bg-light-cover' : 'bg-dark'}}">

    <div class="wrapper {{ ($user->theme == "light" || Request::routeIs('cart.checkout')) ? 'bg-white' : 'bg-dark-cover' }}" style="">

        <nav class="navbar {{ (Request::routeIs('products.detailuser')) ? 'ps-2 pe-4' : 'px-4' }} bg-primary sticky-top bg-body-tertiary">
            @if (!Request::routeIs('products.detailuser'))
                @guest
                    <a class="navbar-brand" href="{{ route('public.index') }}">
                @endguest
                @auth
                    <a class="navbar-brand" href="{{ route('admin') }}">
                @endauth
                    <img src="{{ asset('assets/logo.png') }}" alt="Logo" width="150" class="d-inline-block align-text-top">
                </a>
            @else
                <a class="navbar-brand" href="{{ route('public.user', request()->route()->originalParameters()['user']) }}">
                    <i data-feather="arrow-left" class="text-danger"></i> {{ '@'.request()->route()->originalParameters()['user'] }} | {{ $user->id }}
                </a>
                <div class="cart position-relative">
                    <i data-feather="shopping-cart" class="text-danger"></i> 
                    <span id="total-cart"></span>
                </div>
            @endif
        </nav>

        @yield('produk')

        @if (Request::routeIs('products.detailuser'))
        <div class="cart-info">
            <div id="card-detail" class="card w-100">
                <div class="card-body">
                    <span class="mt-2">Shopping Cart</span>
                    <div class="keterangan-order mt-3">
                        <div class="list-item vstack mt-2 mb-2 gap-2 p-2" style="overflow-y: scroll; scroll-behavior: smooth;">

                            {{-- @forelse ($cartitems as $key => $item)
                            <div class="card" style="height: 6rem;">
                                <div class="card-body ps-2 pe-2 d-flex justify-content-between align-items-center gap-3">
                                    <img src="{{ asset('assets/user1.jpg') }}" 
                                    style="width: 4rem; height: 4rem;" class="card-img-top" alt="...">
        
                                    <div class="vstack justify-content-between">
                                        <span class="d-block">{{ $item->getDetails()->get('title') }}</span>
                                        <span class="d-block fw-semibold">Rp. {{ $item->getDetails()->get('price') }}</span>
                                    </div>
                                    
                                    <div id="item-action" class="vstack align-items-end justify-content-between">
                                        <span class="d-block">Qty : {{ $item->getDetails()->get('quantity') }}</span>
        
                                        <span class="button-group">
                                            <a href="#" id="btnIncreaseQty" data-id="{{ $key }}" class="px-2 fs-2">+</a>
                                            <a href="#" id="btnDescreaseQty" class="px-2 fs-2">-</a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="card" style="">
                                <div class="card-body ps-2 pe-2">
                                    <span>Your cart is empty!</span>
                                </div>
                            </div>
                            @endforelse --}}
        
                            {{-- <div class="card" style="height: 6rem;">
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
                            </div> --}}
        
                        </div>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th>Total Item</th>
                                    <td class="text-end"></td>
                                </tr>
                                <tr>
                                    <th>Total Quantity</th>
                                    <td class="text-end"></td>
                                </tr>
                                <tr>
                                    <th>Total Price</th>
                                    <td class="text-end"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="vstack gap-2" id="btnGroup">
                        {{-- <a href="{{ route('cart.checkout') }}" target="_blank" id="checkoutBtn" class="btn btn-md btn-danger bg-gradient w-100">Checkout</a> --}}
                        <a href="#" id="btnContinue" class="btn btn-md btn-outline-danger w-100">Continue Shopping</a>
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
        const BtnContinue = $('#btnContinue');
        const listItem = $('.list-item');
        const iconCart = $('.icon-cart');
        const userPayVal = $('#user_pay_product');
        const userPayError = $('#user_pay_error');
        const productId = $('#productId');
        const quantity = $('#quantity');
        const btnIncreaseQty = $('#btnIncreaseQty');
        const btnDecreaseQty = $('#btnDecreaseQty');
        const cart = $('.cart');

        $(document).ready(function(){

            $.ajax({
                url: "{{ route('cart.getitems') }}",
                method: 'GET',
                data:{
                    _token: '{{ csrf_token() }}',
                    user_id: '{{ $user->id }}'
                },
                success: (res) => {
                    const {data} = res;
                    // console.log('awal');
                    // console.log(res);
                    $('#total-cart').text(data.total_item)
                }
            })

            cart.on('click', (e) => {
                let show = $('.cart-info').hasClass('show');
                // console.log($('.list-item').children());
                if (!show) {
                    $('.cart-info').addClass('show')
                    if (!listItem.children().length > 0) {
                        showCartItems();
                    }
                }else{
                    $('.cart-info').removeClass('show')
                    $('.list-item').children().remove()
                    // console.log($('.list-item > div.card'));
                }
            })
            BtnContinue.on('click', (e) => {
                e.preventDefault();
                // const link = `
                // <a href="{{ route('cart.checkout') }}" target="_blank" id="checkoutBtn" class="btn btn-md btn-danger bg-gradient w-100">Checkout</a>
                // `;
                $('.cart-info').removeClass('show')
                $('.list-item').children().remove()
                userPayVal.val('')
            })

        })
        // $('body').on('click', '.list-item > .card > .card-body #item-action > .button-group > #btnIncreaseQty', function(e){
        $('body').on('click', '.list-item > .card > .card-body #item-action > .button-group > #btnRemoveItem', function(e){
            e.preventDefault()
            if (confirm('Delete this item from your cart ?')) {
                removeCartItem($(this).data('id'))
                $('#total-cart').text('0')
            }
        })

        $('body').on('click', '.list-item > .card > .card-body #item-action > .button-group > #btnIncreaseQty', function(e){
            e.preventDefault()
            if (confirm('Add item again in your cart ?')) {
                $.ajax({
                    url: "{{ route('cart.update') }}",
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        _method: 'PATCH',
                        id: $(this).data('id'),
                        user_id: '{{ $user->id }}',
                        type: 'increase'
                    },
                    success: (res) => {
                        $('.list-item').children().remove()
                        showCartItems();
                    }
                })
            }
        })

        $('body').on('click', '.list-item > .card > .card-body #item-action > .button-group > #btnDecreaseQty', function(e){
            e.preventDefault()
            if (confirm('Update your cart ?')) {
                $.ajax({
                    url: "{{ route('cart.update') }}",
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        _method: 'PATCH',
                        id: $(this).data('id'),
                        user_id: '{{ $user->id }}',
                        type: 'decrease'
                    },
                    success: (res) => {
                        // console.log('decrease');
                        // console.log(res);
                        $('.list-item').children().remove()
                        showCartItems();
                        $('#btnGroup').children('a:first').remove()

                    }
                })
            }
        })

        let showError = false;

        BtnAddToCart.on('click', (e) => {
            e.preventDefault();
            console.log({{ $user->id }});
            $('.list-item').children().remove()
            addToCart();
            showCartItems();

            // $.ajax({
            //     url: "{{ route('cart.getitems') }}",
            //     method: 'GET',
            //     success: (res) => {
            //         const data = JSON.parse(res.data);
            //         const {items} = data;
            //         // console.log(data);
            //         const itemCount = JSON.parse(res.data);

            //         if (Object.keys(items).length > 0) {
            //             // filled cart
            //             console.log(data);
            //             $.each(items, function(idx, product){
            //             console.log(product);
            //             const card = `
            //             <div class="card" style="height: 6rem;">
            //                 <div class="card-body ps-2 pe-2 d-flex justify-content-between align-items-center gap-3">
            //                     <img src="{{ asset('assets/user1.jpg') }}" 
            //                     style="width: 4rem; height: 4rem;" class="card-img-top" alt="...">
    
            //                     <div class="vstack justify-content-between">
            //                         <span class="d-block">${product.title}</span>
            //                         <span class="d-block fw-semibold">Rp. ${product.price}</span>
            //                     </div>
                                
            //                     <div id="item-action" class="vstack align-items-end justify-content-between">
            //                         <span class="d-block">Qty : ${product.quantity}</span>
    
            //                         <span class="button-group">
            //                             <a href="#" id="btnIncreaseQty" data-id="${product.hash}" class="px-2 fs-2">+</a>
            //                             <a href="#" id="btnDescreaseQty" class="px-2 fs-2">-</a>
            //                         </span>
            //                     </div>
            //                 </div>
            //             </div>
            //             `;
            //             listItem.append(card)
            //             $('.keterangan-order > table > tbody > tr > td:nth(0)').text(data.items_count)
            //             $('.keterangan-order > table > tbody > tr > td:nth(1)').text(data.quantities_sum)
            //             $('.keterangan-order > table > tbody > tr > td:nth(3)').text(data.subtotal)
            //         })
            //         }else{
            //             const card = `
            //              <div class="card card-empty" style="">
            //                  <div class="card-body ps-2 pe-2">
            //                      <span>Your cart is empty!</span>
            //                  </div>
            //              </div>
            //              `;
            //             listItem.css({
            //                 'height':'5rem',
            //             }).append(card)
            //         }
            //         console.log(Object.keys(items).length);
            //         console.log($('.keterangan-order > table > tbody > tr > td:nth(1)').text());
            //     },
            //     err: (err) => {
            //         console.log(err);
            //     }
            // })
        })
        
        
        feather.replace();

        function addToCart() {
            $.ajax({
                url: "{{ route('addcart') }}",
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: productId.val(),
                    user_id: '{{ $user->id }}',
                    quantity: quantity.val(),
                    user_pay: userPayVal.val(),
                    creator_id: '{{ $user->id }}'
                },
                success: (res) => {
                    // console.log('add cart');
                    // console.log(res);
                    if (res.code == 201) {
                        userPayError.text(res.messages)
                        userPayError.css('display','block');
                    }else{
                        userPayVal.val('')
                        userPayError.text('')
                        userPayError.css('display','none');
                        $('.cart-info').addClass('show');
                    }
                },
                err: (err) => {
                    console.log(err);
                }
            })
        }

        function removeCartItem(id) {
            $.ajax({
                url: "{{ route('cart.removeitem') }}",
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    user_id: '{{ $user->id }}',
                    cart_id: id,
                },
                success: (res) => {
                    // console.log(res);
                    $('.list-item').children().remove()
                    showCartItems();
                }
            })
        }

        function showCartItems(){
            $.ajax({
                url: "{{ route('cart.getitems') }}",
                // method: 'GET',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    user_id: '{{ $user->id }}',
                },
                success: (res) => {
                    const {data} = res;
                    console.log(res);
                    // console.log('show');
                    // console.log(res);
                    // console.log(data.cart);
                    if (Object.keys(data.cart).length > 0) {
                        // filled cart
                        listItem.css({
                            'height':'11rem',
                        })
                        $.each(data.cart, function(idx, product){
                            let card = `
                            <div class="card" style="height: 6rem;">
                                <div class="card-body ps-2 pe-2 d-flex justify-content-between align-items-center gap-3">
                                    
                                    <img src='/${(product.attributes.image) ? product.attributes.image : "assets/profile-default.png"}' style="width: 4rem; height: 4rem;" class="card-img-top" alt="image">
        
                                    <div class="vstack justify-content-between">
                                        <span class="d-block">${product.name}</span>
                                        <span class="d-block fw-semibold">Rp. ${product.price}</span>
                                    </div>
                                    
                                    <div id="item-action" class="vstack align-items-end justify-content-between">
                                        <span class="d-block">Qty : ${product.quantity}</span>
        
                                        <span class="button-group">
                                            <a href="#" id="btnIncreaseQty" title="increase" data-id="${product.id}" class="px-2 fs-2 text-decoration-none">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus text-success"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>    
                                            </a>
                                            <a href="#" id="btnDecreaseQty" title="decrease" data-id="${product.id}" class="px-2 fs-2 text-decoration-none">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus text-success"><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                            </a>
                                            <a href="#" id="btnRemoveItem" title="remove" data-id="${product.id}" class="px-2 fs-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash text-danger"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                            </a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            `;
                            // listItem.remove('.card')
                            listItem.append(card)
                            $('.keterangan-order > table > tbody > tr > td:nth(0)').text(data.total_item)
                            $('.keterangan-order > table > tbody > tr > td:nth(1)').text(data.total_quantity)
                            $('.keterangan-order > table > tbody > tr > td:nth(2)').text(`Rp ${data.total_price}`)
                            $('#total-cart').text(data.total_item)
                        })

                        const link = `
                        <a href="{{ route('cart.checkout') }}" target="_blank" id="checkoutBtn" class="btn btn-md btn-danger bg-gradient w-100">Checkout</a>
                        `;
                        if ($('#btnGroup').children().length < 2) {
                            $('#btnGroup').prepend(link)
                        }
                    }else{
                        const card = `
                         <div class="card card-empty" style="">
                             <div class="card-body ps-2 pe-2">
                                 <span>Your cart is empty!</span>
                             </div>
                         </div>
                        `;
                        $('#total-cart').text(data.cart.length)
                        $('.keterangan-order > table > tbody > tr > td:nth(0)').text('0')
                        $('.keterangan-order > table > tbody > tr > td:nth(1)').text('0')
                        $('.keterangan-order > table > tbody > tr > td:nth(2)').text('0')
                        listItem.css({
                            'height':'5rem',
                        }).append(card)
                        
                        // console.log($('#btnGroup').children('a:first:has(#checkoutBtn)'));
                    }
                },
                err: (err) => {
                    console.log(err);
                }
            })
        }
        
    </script>
    @stack('scripts')
</html>
