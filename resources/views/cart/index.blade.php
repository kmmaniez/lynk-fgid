@extends('layouts.products')
@section('TITLE', 'Product '.$user->username)
@push('styles')
    <style>
        .header span{
            user-select: none;
            color: #fff;
            text-shadow: 0 0 10px rgb(38, 38, 38);
        }
        #coverprofile{
            position: absolute;
            width: 800px;
            height: 100px; 
            left: -6px;
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
        .card-cover{
            /* background-color: red; */
            overflow: hidden;
        }
        section{
            min-height: calc(100% - 4rem);
        }
        #tes{
            /* 800 x 200 profile */
            /* width: 100%; */
            width: 800px;
            height: 200px;
            position: absolute;
            object-fit: fill;
            z-index: -1;
        }
        .card-cover::after{
            content: '';
            width: 100%;
            height: 100%;
            top: 0;
            position: absolute;
            left: 0;
            background-color: rgba(25, 25, 25, 0.615);
            z-index: -1;
        }
        .list-products{
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            row-gap: 8px;
        }
        .item.default{
            /* flex: 0 0 48%; */
            flex: 0 0 calc(100%);

            height: max-content;
        }
        .item.large{
            flex-basis: 100%;
            height: 400px;
        }
        .item.grid{
            /* flex: 0 0 calc(100%); */
            flex: 0 0 48%;
            /* background-color: bisque; */
        }
        .list-products .card .card-body{
            padding: 8px;
        }
        .list-products .card .card-body img{
            border-radius: 6px;
        }
        #product-name, #product-price{
            padding: 6px;
        }
        @media screen and (max-width: 800px){
            .list-products{
                width: 100%;
            }
            .list-products .card .card-body{
                padding: 0 0 8px 0;
            }
            .list-products .card .card-body img{
                border-radius: 0px;
            }
            .item.grid{
                flex: 0 0 calc(48%);
            }
            .item{
                flex: 0 0 48%; 
                /* background-color: green; */
            }
            #product-name, #product-price{
                padding: 0 0 0 8px;
            }
        }
    </style>
@endpush
@section('produk')
    <section id="wrap">
        <div class="header">
            <div class="card card-cover rounded-0 border-0 text-center position-relative" style="z-index: 1">
                <img id="tes" src="{{ ($user->coverimage) ? Storage::url($user->coverimage) : asset('assets/cover-default.jpg') }}" alt="" srcset="">
                <div class="card-body vstack gap-3 align-items-center">
                    <img src="{{ ($user->photo) ? Storage::url($user->photo) : asset('assets/profile-default.png') }}" style="width: 5rem; height: 5rem;" 
                        class="rounded-circle border border-secondary-subtle border-3 object-fit-cover" alt="...">
                    <span><strong>{{ '@'.$user->username }}</strong></span>
                    <span>{{ $user->description }}</span>
                </div>
            </div>
        </div>

        <div class="list-products mt-3">
            <!-- NEW -->
            @foreach ($products as $product)
            <div 
            class="item
            @if ($product->layout->value == 'default')
            default
            @elseif ($product->layout->value == 'large')
            large
            @else
            grid
            @endif
            
            ">
            {{-- <div class="item {{ ($product->layout->value === 'default') ? 'grid' : '' }}"> --}}
                <a href="{{ ($product->type->value == 'link') ? $product->url : route('products.detailuser', [$user->username,$product->slug]) }}" class="text-decoration-none">
                    <div class="card">
                        <div class="card-body {{ ($product->type->value == 'link') ? 'd-flex gap-2 align-items-center' : '' }}">
                            @if ($product->type->value === 'link')
                                @if ($product->thumbnail)
                                <img src="{{ Storage::url($product->thumbnail) }}" style="width: 64px; height: 64px;" class="card-img-top rounded-2">
                                @endif
                                <h6 class="mt-3 {{ ($product->type->value == 'link') ? 'flex-grow-1 text-center' : '' }}">{{ $product->name }} {{ $product->type->value }}</h6>
                            @else
                                @if ($product->thumbnail)
                                <img src="{{ Storage::url('products/digital/'.$product->thumbnail) }}" style="width: 100%; {{ ($product->layout->value == 'large') ? 'height:300px' : 'height:120px'  }};" class="object-fit-cover">
                                @else
                                <img src="{{ ($user->theme == 'light') ? asset('assets/cover-white.png') : asset('assets/cover-dark.png') }}" style="width: 100%; height: 120px;" class="rounded-1 object-fit-cover">
                                @endif
                                <h6 class="mt-3 mb-1" id="product-name">{{ $product->name }}</h6>
                                <span id="product-price"><strong>Rp. {{ $product->min_price }}</strong></span>
                            @endif
                        </div>
                    </div>
                </a>
            </div>
                
            @endforeach
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        const body = document.getElementsByTagName('body')[0]
        const card = $('.list-products .card');
        if ($('body').hasClass('bg-dark')) {
            // $('')
            $('.list-products .card').addClass(['bg-dark','text-white'])
        }
        // console.log($('body').hasClass('bg-light-cover'));
        // if (body.classList.contains('bg-dark')) {
        //     card.addClass(['bg-dark','text-white'])
        // }
    </script>
@endpush