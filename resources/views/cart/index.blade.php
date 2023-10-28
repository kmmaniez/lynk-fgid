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

    <div class="container">
        <table class="table">
            {{-- <h2>Total item {{ $cart->items_count }}</h2> --}}
            {{-- @dump($cart) --}}
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Minimal Pric</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
                {{-- @dump($json) --}}
                @foreach ($product as $item)
                <tr>
                  <th scope="row">{{ $loop->iteration }}</th>
                  <td>{{ $item->name }}</td>
                  <td>{{ $item->min_price }}</td>
                  <td style="width: 250px">
                    <form action="{{ route('addcart') }}" method="post">
                        @csrf
                        <div class="hstack">
                            <input type="hidden" name="id" value="{{ $item->id }}">
                            <input type="number" name="jml" id="jml" class="form-control shadow-none">
                            <button class="btn btn-md btn-success">Add</button>
                        </div>
                    </form>
                  </td>
                </tr>
                    
                @endforeach
            </tbody>
          </table>
          <table class="table">
            <h2>Total items {{ $cart->items_count }} | {{ $cart->total }}</h2>
            @dump($cart)
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Quantity</th>
                <th scope="col">Origin Price</th>
                <th scope="col">Total Price</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($cartitems as $key => $item)
                <tr>
                  <th scope="row">{{ $loop->iteration }}</th>
                  <td>{{ $key }}</td>
                  <td>{{ $item->getDetails()->get('title') }}</td>
                  <td>{{ $item->getDetails()->get('quantity') }}</td>
                  <td>{{ $item->getDetails()->get('price') }}</td>
                  <td>{{ $item->getDetails()->get('total_price') }}</td>
                  {{-- <td>{{ $item->min_price }}</td> --}}
                </tr>
                    
                @endforeach
            </tbody>
          </table>
    </div>

    <script src="{{ asset('assets/vendor/bootstrap5/js/bootstrap.bundle.min.js') }}"></script>
    
    <script src="{{ asset('assets') }}/vendor/jquery/jquery.min.js"></script>
    <script src="{{ asset('assets') }}/vendor/jquery-easing/jquery.easing.min.js"></script>

    <script>
        const sidebar = document.getElementsByClassName('sidebar');
        const toggleSidebar = document.querySelector('.toggle-sidebar');

        toggleSidebar.addEventListener('click', (e) => {
            sidebar[0].classList.toggle('hidden');
        })
        feather.replace();
    </script>
    
    @stack('scripts')
    
</body>

</html>
