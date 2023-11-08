@extends('layouts.products')

@section('produk')
    <section id="checkout" class="">

        <div class="card border-0 h-100" style="border-radius: 0">
            <div class="card-body">
                <h2>Transaction is </h2>
                {{-- @dump($transactionStatus) --}}
                {{-- @dump($increment) --}}
                PAGE REFRESH {{ $viewsCount[0]->views }}
                @dump($transaction)

                {{-- @if ($transaction[0]->payment_status === 'pending')
                    <span>{{ $transaction[0]->payment_status }}</span>
                @elseif ($transaction[0]->payment_status === 'paid')
                @foreach ($transaction as $item)
                    <span>{{ $item->product_file_url }}</span>
                @endforeach
                @endif --}}
                <div class="card">
                    <div class="card-body">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Blanditiis, dolorem.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
