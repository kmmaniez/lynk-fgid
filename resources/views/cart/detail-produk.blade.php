@extends('layouts.products')
@section('TITLE', 'Detail Product '.$user->username)
@push('styles')
    <style>
        .wrapper {
            overflow-y: hidden;
        }
    </style>
@endpush
@section('produk')
    <section id="produk-detail" class="">
        <div class="card border-0 h-100">
            <!-- CAROUSEL -->
            @if ($product->images)
                <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach ($product->images as $key => $image)
                            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}" data-bs-interval="5000">
                                <img src="{{ Storage::url('products/digital/' . $image) }}" class="d-block object-fit-cover"
                                    style="width: 100%; height: 300px;" alt="Product Image" loading="lazy">
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <img src="{{ asset('assets/bg-3.jpg') }}" style="width: 100%; height: 240px;" class="rounded-none"
                    alt="...">
            @endif

            <div class="card-body">
                <h2 class="mb-3">{{ $product->name }}</h2>
                <div class="form-group">
                    <label for="user_pay_product"><small>How much you will pay the product</small></label>
                    <input type="number" class="form-control shadow-none" step="100"
                        placeholder="Recomendation Rp {{ number_format($product->recommend_price,0,0,'.') }}" min="{{ $product->recommend_price }}" name="user_pay_product"
                        id="user_pay_product">
                    <small class="text-danger" id="user_pay_error"></small>
                </div>
                <div class="form-group mt-3">
                    <label for=""><small class="text-secondary fw-semibold">Description</small></label>
                    <span class="d-block mt-2">{{ $product->description }}</span>
                </div>
            </div>
            <div class="card-footer bg-white border-0">
                <input type="hidden" name="productId" id="productId" value="{{ $product->id }}">
                <input type="hidden" name="quantity" id="quantity" value="1" class="form-control shadow-none">
                <button class="btn bg-danger text-white fw-semibold bg-gradient w-100" id="btnAddToCart">{{ $product->cta_text->value }}</button>
                <a href="{{ route('public.user',request()->route()->originalParameters()['user']) }}" class="btn mt-2 w-100">Back</a>
            </div>
        </div>
    </section>
    
@endsection
