@extends('layouts.products')
@section('TITLE', 'Transaction Status')
@section('produk')
    <section id="checkout">

        <div class="card border-0 h-100" style="border-radius: 0">
            <div class="card-body">
                
                @if ($transactionStatus['statusCode'] == '00')
                <h2 class="mt-3">Your transactions is <strong>{{ Str::upper($transactionStatus['statusMessage']) }}</strong></h2>
                    @foreach ($transaction as $item)
                        <div class="alert alert-success mt-3">
                            <h6 class="fw-bold">Product : {{ $item->products->name }}</h6>
                            <a href="{{ $item->product_file_url }}" target="_blank" id="productUrl">{{ $item->product_file_url }}</a>
                        </div>
                    @endforeach
                    <p class="text-danger fw-semibold">Please, copy or save the results link, we didn't guarantee if you losing access to products link. Thankyou!</p>
                
                @elseif ($transactionStatus['statusCode'] == '01')
                    <h2 class="mt-3">Your transactions is <strong>PENDING</strong></h2>
                    <span>Please complete your payment, the links waiting for you!. <strong>After complete payment refresh browser to get your link.</strong></span>
                
                @else
                    <span><strong>Your payment is {{ Str::lower($transactionStatus['statusMessage']) }}</strong>, please make other <a href="{{ route('public.discover') }}">transactions here!</a></span>
                @endif
            </div>
        </div>
    </section>
@endsection