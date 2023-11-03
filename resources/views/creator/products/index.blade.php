@extends('layouts.products')
@push('styles')
    <style>
        .header span{
            user-select: none;
            color: #fff;
            text-shadow: 0 0 10px rgb(38, 38, 38);
        }
        #coverprofile{
            /* content: ''; */
            /* background: url('{{ asset("assets/user6.jpg") }}'); */
            /* object-fit: contain; */
            /* background-size: 100%; */
            /* background-position: center; */
            /* background-repeat: no-repeat; */
            position: absolute;
            width: 800px;
            height: 100px; 
            left: -6px;
            z-index: -1;
            /* size cover 800 x 200 */
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
        .item.large .card{
            /* height: 100%; */
        }
        .item.large .card .card-body > img{
            /* width: 100%; */
            /* height: 200px; */
        }
        .item.grid{
            /* flex: 0 0 calc(100%); */
            flex: 0 0 48%;
            /* background-color: bisque; */
        }
        @media screen and (max-width: 800px){
            .list-products{
                width: 100%;
            }
            .item.grid{
                flex: 0 0 calc(100%);
            }
            .item{
                flex: 0 0 48%; 
                /* background-color: green; */
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
                                <img src="{{ Storage::url('tes/'.$product->thumbnail) }}" style="width: 100%; {{ ($product->layout->value == 'large') ? 'height:300px' : 'height:120px'  }};" class="rounded-1 object-fit-cover">
                                {{-- <img src="{{ Storage::url('tes/'.$product->thumbnail) }}" style="width: 100%; height: 120px;" class="rounded-1 object-fit-cover"> --}}
                                @else
                                <img src="{{ ($user->theme == 'light') ? asset('assets/cover-white.png') : asset('assets/cover-dark.png') }}" style="width: 100%; height: 120px;" class="rounded-1 object-fit-cover">
                                @endif
                                <h6 class="mt-3">{{ $product->name }} {{ $product->type->value }}</h6>
                                {{-- <h6 class="{{ ($product->thumbnail) ? 'mt-3' : '' }}">{{ $product->name }} {{ $product->type->value }}</h6> --}}
                                <span><strong>Rp. {{ $product->min_price }} | {{ $product->layout->value }}</strong></span>
                            @endif
                            {{-- <small>{{ $product->id }}</small> --}}
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