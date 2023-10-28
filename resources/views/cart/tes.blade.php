<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap5/css/bootstrap.min.css') }}">

    <script src="{{ asset('assets/feather-icons/dist/feather.min.js') }}"></script>
</head>

<body>

    <div class="container mt-5">
        @dump($cartitems)
        <div class="row">
            <div class="col-8">
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Minimal Pric</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->min_price }}</td>
                                <td style="width: 500px">
                                    @if ($product->type->value == "digital")
                                    <form action="{{ route('addcart') }}" method="post">
                                        @csrf
                                        <div class="hstack gap-2">
                                            <input type="hidden" name="id" value="{{ $product->id }}">
                                            <input style="width: 100px" type="number" value="1" name="quantity" id="quantity" class="form-control shadow-none">
                                            <input type="number" style="width: 300px" placeholder="Mau Bayar berapa? Min {{ $product->min_price }}" name="user_pay" id="user_pay" class="form-control shadow-none">
                                            <button class="btn btn-sm btn-primary">Add</button>
                                        </div>
                                    </form>
                                    @endif
                                  </td>
                            </tr>
                        @endforeach
                    </tbody>
                  </table>
            </div>
            <div class="col">
                <h5>Total Items : {{ $quantity }}</h5>
                <h6>Total Price : {{ $subtotal }}</h6>
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Price</th>
                        <th scope="col">Total Price</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($cartitems as $cart)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $cart->name }}</td>
                                <td>{{ $cart->quantity }}</td>
                                <td>{{ $cart->price }}</td>
                                <td>{{ $cart->price * $cart->quantity }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                  </table>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/vendor/bootstrap5/js/bootstrap.bundle.min.js') }}"></script>
    
    <script src="{{ asset('assets') }}/vendor/jquery/jquery.min.js"></script>
    <script src="{{ asset('assets') }}/vendor/jquery-easing/jquery.easing.min.js"></script>
    
    @stack('scripts')
    
</body>

</html>
