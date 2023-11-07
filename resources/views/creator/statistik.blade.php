@extends('layouts.creator')
@push('style')
    <style>
        .vstack .card:hover {
            background-color: rgb(254, 242, 241);
        }

        .vstack .card {
            transition: background-color 250ms ease-in;
        }
    </style>
@endpush
@section('content')
    <div class="card border-0 mt-3">
        <div class="card-body p-2">

            <div class="vstack justify-content-center w-100 gap-3">
                <div class="card border-danger flex-grow-1" style="height: 12rem">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <h5>Total All Sales</h5>
                        <h6 class="text-danger fw-bold">Rp. {{ number_format($total_sales) }}</h6>
                    </div>
                </div>
                <div class="card border-danger flex-grow-1" style="height: 12rem">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <h5>Total Earning</h5>
                        <h6 class="text-danger fw-bold">Rp. {{ number_format($total_earning, 0) }}</h6>
                    </div>
                </div>
                <div class="card border-danger flex-grow-1" style="height: 12rem">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <h5>Total Products Sales</h5>
                        <h6 class="text-danger fw-bold">{{ $total_product_sales }} Products</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
