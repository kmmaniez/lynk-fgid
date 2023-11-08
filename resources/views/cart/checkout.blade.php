@extends('layouts.products')

@section('produk')
    <section id="checkout" class="">

        <div class="card border-0 h-100" style="border-radius: 0">
            <div class="card-body">
                <div class="card">
                    <div class="card-body">
                        <small>Order Summary</small>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Total Item</td>
                                    <td class="text-end" id="totalitem"></td>
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
                                                            <ol class="mt-2" id="cartitems">
                                                                {{-- @foreach ($cartitems as $item)
                                                                <li><span>{{ $item->name }} ({{ $item->quantity }}x)</span></li>
                                                                <li><span>Valorant cheat (2x)</span></li>
                                                                <li><span>Ninja Saga (1x)</span></li>
                                                                @endforeach --}}
                                                            </ol>
    
                                                            <ul class="mt-2" id="cartprice" style="list-style-type: none">
                                                                {{-- @foreach ($cartitems as $item)
                                                                <li><span>Rp. {{ $item->quantity * $item->price }}</span></li>
                                                                <li><span>Rp. 10.000</span></li>
                                                                <li><span>Rp. 30.000</span></li>
                                                                @endforeach --}}
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
                                    <td class="text-end" id="feeplatform"></td>
                                </tr>
                                <tr>
                                    <th>Total</th>
                                    <td class="text-end fw-bold" id="totalprice"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card border-0 mt-2">
                    <div class="card-body card-form-input">
                        
                        <form action="{{ route('transaction.store') }}" method="post">
                            @csrf

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input class="form-control shadow-none @error('email') is-invalid @enderror" type="email" name="email" id="email" required>
                                @error('email')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group mt-2">
                                <label for="name">Name</label>
                                <input class="form-control shadow-none @error('name') is-invalid @enderror" type="text" name="name" id="name" required>
                                @error('name')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror    
                            </div>

                            <div class="payment-method mt-3">
                                <div class="form-group">
                                    <label for="payment">Pilih Pembayaran</label>
                                    <div class="hstack mt-2" id="choose_payment">
                                        <label>
                                            <input class="form-check-input" type="radio" id="payment" name="payment" value="OV">
                                            <img src="{{ asset('assets/payments-icon/ovo.jpg') }}" alt="ovo">
                                        </label>
                                        <label>
                                            <input class="form-check-input" type="radio" id="payment" name="payment" value="SP">
                                            <img src="{{ asset('assets/payments-icon/qris.png') }}" alt="qris">
                                        </label>
                                        <label>
                                            <input class="form-check-input" type="radio" id="payment" name="payment" value="SA">
                                            <img src="{{ asset('assets/payments-icon/shopeepay.png') }}" alt="shopee">
                                        </label>
                                        <label>
                                            <input class="form-check-input" type="radio" id="payment" name="payment" value="BC">
                                            <img src="{{ asset('assets/cover-dark.png') }}" alt="bca">
                                        </label>
                                    </div>
                                </div>
                                @if (session()->has('payment'))
                                <small class="text-danger">{{ session()->get('payment') }}</small>
                                @endif
                            </div>
                            
                            <div class="button-group mt-4">
                                <button id="btnPay" class="btn text-white bg-danger bg-gradient w-100"></button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
            {{-- <div class="card-footer border-0">
                <a href="#" id="btnPay" class="btn text-white bg-danger bg-gradient w-100"></a>
                <a href="{{ route('public.user', $userProduct[0]->username) }}" id="btnAddToCart" class="btn btn-default w-100 mt-1">Back to Shopping</a>
            </div> --}}
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        const btnPayment = $('#btnPay');
        const feePlatform = $('#feeplatform');
        const cartItems = $('#cartitems');
        const cartPrice = $('#cartprice');
        const totalItem = $('#totalitem');
        const totalPrice = $('#totalprice');

        const url = window.location.href;
        let pattern = /order_id=([^&]*)/;
        let match = url.match(pattern)
        $(function(){
            fetchCart()
        })
        $('#btnPay').on('click',(e) => {
            e.preventDefault();
            const link = `<input hidden name="cart" value="${match[1]}">`;
            $('#btnPay').parent().parent().prepend(link)
            $('#btnPay').closest('form').submit()
        })

        $('#choose_payment').children().on('change', (e) =>{
            $.ajax({
                url: window.location.href+'&type='+e.target.value,
                method: 'GET',
                cache: false,
                success: (res) => {
                    const {cart} = res;
                    console.log(res);
                    btnPayment.text('Bayar Sekarang - Rp. '+res.payment_fee)
                    totalPrice.text(res.payment_fee)
                    feePlatform.text(res.fees)
                },
                error: (res) => {
                    console.log(res);
                }
            })
        })

        function fetchCart() {
            $.ajax({
                url: "{{  route('cart.getitems')  }}?user_id="+match[1],
                method: 'GET',
                success: (res) => {
                    // console.log(res);
                    const {cart} = res.data;
                    btnPayment.text('Bayar Sekarang - Rp. '+res.data.total_price)
                    totalItem.text(res.data.total_item)
                    totalPrice.text(res.data.total_price)
                    feePlatform.text(res.data.payment_fee)
                    
                    for (const product in cart) {
                        const listItems = `<li><span>${cart[product].name} (${cart[product].quantity}x)</span></li>`;
                        const listPrice = `<li><span>Rp. ${cart[product].price}</span></li>`;

                        cartPrice.append(listPrice)
                        cartItems.append(listItems)
                    }
                },
                error: (res) => {
                    console.log(res);
                }
            })
        }
    </script>
@endpush