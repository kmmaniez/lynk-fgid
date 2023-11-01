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
        .item{
            flex: 0 0 48%;
            height: max-content;
        }
        .item.grid{
            flex: 0 0 calc(100%);
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
    {{-- <section id="wrap" class="bg-dark">
            <div class="header" style="">
                <div class="card bg-dark-cover rounded-0 border-0 text-center position-relative" style="z-index: 1">
                    <div id="coverprofile"></div>
                    <div class="card-body vstack gap-3 align-items-center">
                        <img src="{{ asset('assets/user6.jpg') }}" style="width: 5rem; height: 5rem;" 
                            class="rounded-circle border border-secondary-subtle border-3 object-fit-cover" alt="...">
                        <span><strong>@username</strong></span>
                        <span>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Atque, adipisci?</span>
                    </div>
                </div>
            </div>

            <div class="list-products mt-2">
                <div class="row gap-2">
                    <div class="col-12">
                        <a href="/awkarin/detail" class="text-decoration-none">
                            <div class="card bg-dark-cover text-center">
                                <div class="card-body">
                                    <span>Lorem ipsum adipisicing elit. Repellat!</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-12">
                        <a href="/awkarin/detail" class="text-decoration-none">
                            <div class="card bg-dark-cover ">
                                <div class="card-body d-flex flex-start align-items-center gap-3">
                                    <img src="{{ asset('assets/user1.jpg') }}" style="width: 4rem; height: 4rem;" class="card-img-top" alt="...">
                                    <span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellat!</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-12">
                        <div class="row">
                            <div class="col">
                                <a href="/awkarin/detail" class="text-decoration-none">
                                    <div class="card bg-dark-cover  h-100">
                                        <img src="{{ asset('assets/user1.jpg') }}" style="width: 100%; height: 120px;"
                                            class="card-img-top object-fit-cover" alt="...">
                                        <div class="card-body">
                                            <h6>Judul</h6>
                                            <span><strong>Rp. 5.000</strong></span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col">
                                <a href="/awkarin/detail" class="text-decoration-none">
                                    <div class="card bg-dark-cover h-100">
                                        <img src="{{ asset('assets/user3.jpg') }}" style="width: 100%; height: 120px;"
                                            class="card-img-top object-fit-cover" alt="...">
                                        <div class="card-body">
                                            <h6>Judul</h6>
                                            <span><strong>Rp. 5.000</strong></span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <a href="/awkarin/detail" class="text-decoration-none">
                            <div class="card bg-dark-cover  h-100">
                                <img src="{{ asset('assets/user2.jpg') }}" style="width: 100%; height: 240px;"
                                    class="card-img-top object-fit-cover" alt="...">
                                <div class="card-body">
                                    <h6>Judul</h6>
                                    <span><strong>Rp. 5.000</strong></span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-12">
                        <a href="/awkarin/detail" class="text-decoration-none">
                            <div class="card bg-dark-cover  text-center">
                                <div class="card-body">
                                    <span>Lorem ipsum adipisicing elit. Repellat!</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-12">
                        <div class="row">
                            <div class="col-6">
                                <a href="/awkarin/detail" class="text-decoration-none">
                                    <div class="card bg-dark-cover h-100">
                                        <img src="{{ asset('assets/user6.jpg') }}" style="width: 100%; height: 120px;"
                                            class="card-img-top object-fit-cover" alt="...">
                                        <div class="card-body">
                                            <h6>Judul</h6>
                                            <span><strong>Rp. 5.000</strong></span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <a href="/awkarin/detail" class="text-decoration-none">
                            <div class="card bg-dark-cover  h-100">
                                <img src="{{ asset('assets/user2.jpg') }}" style="width: 100%; height: 240px;"
                                    class="card-img-top object-fit-cover" alt="...">
                                <div class="card-body">
                                    <h6>Judul</h6>
                                    <span><strong>Rp. 5.000</strong></span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-12">
                        <a href="/awkarin/detail" class="text-decoration-none">
                            <div class="card bg-dark-cover  text-center">
                                <div class="card-body">
                                    <span>Lorem ipsum adipisicing elit. Repellat!</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-12">
                        <div class="row">
                            <div class="col-6">
                                <a href="/awkarin/detail" class="text-decoration-none">
                                    <div class="card bg-dark-cover h-100">
                                        <img src="{{ asset('assets/user6.jpg') }}" style="width: 100%; height: 120px;"
                                            class="card-img-top object-fit-cover" alt="...">
                                        <div class="card-body">
                                            <h6>Judul</h6>
                                            <span><strong>Rp. 5.000</strong></span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    </section> --}}
    <section id="wrap" class="">
        <div class="header" style="">
            <div class="card card-cover rounded-0 border-0 text-center position-relative" style="z-index: 1">
                <img id="tes" src="{{ ($user->coverimage) ? Storage::url($user->coverimage) : asset('assets/cover-default.jpg') }}" alt="" srcset="">
                {{-- <div id="coverprofile" style="background: url('{{ ($user->coverimage) ? Storage::url($user->coverimage) : asset('assets/user6.jpg') }}')"></div> --}}
                <div class="card-body vstack gap-3 align-items-center">
                    <img src="{{ ($user->photo) ? Storage::url($user->photo) : asset('assets/profile-default.png') }}" style="width: 5rem; height: 5rem;" 
                        class="rounded-circle border border-secondary-subtle border-3 object-fit-cover" alt="...">
                    <span><strong>{{ '@'.$user->username }}</strong></span>
                    <span>{{ $user->description }}</span>
                </div>
            </div>
        </div>

        <div class="list-products mt-2">
            <!-- NEW -->
            @foreach ($products as $product)
            <div class="item {{ ($product->layout->value === 'default') ? 'grid' : '' }}">
                <a href="{{ ($product->type->value == 'link') ? $product->url : route('products.detailuser', [$user->username,$product->id]) }}" class="text-decoration-none">
                    <div class="card">
                        <div class="card-body {{ ($product->type->value == 'link') ? 'd-flex gap-2 align-items-center' : '' }}">
                            @if ($product->type->value === 'link')
                                @if ($product->thumbnail)
                                <img src="{{ Storage::url($product->thumbnail) }}" style="width: 64px; height: 64px;" class="card-img-top rounded-2">
                                @endif
                                <h6 class="mt-3 {{ ($product->type->value == 'link') ? 'flex-grow-1 text-center' : '' }}">{{ $product->name }} {{ $product->type->value }}</h6>
                            @else
                                @if ($product->thumbnail)
                                <img src="{{ Storage::url('tes/'.$product->thumbnail) }}" style="width: 100%; height: 120px;" class="rounded-1 object-fit-cover">
                                @endif
                                <h6 class="{{ ($product->thumbnail) ? 'mt-3' : '' }}">{{ $product->name }} {{ $product->type->value }}</h6>
                                <span><strong>Rp. {{ $product->min_price }}</strong></span>
                            @endif
                            {{-- <small>{{ $product->id }}</small> --}}
                        </div>
                    </div>
                </a>
            </div>
                
            @endforeach
            {{-- <div class="row lists gap-2"> --}}
                {{-- @foreach ($products as $product)
                <div 
                class="{{ ($product->layout->value == "default" || $product->layout->value == "grid") ? 'col-12' : 'col-6' }}">
                    <a href="{{ ($product->slug) ? $product->slug : $product->url }}" title="{{ $product->name }}" class="text-decoration-none">

                        <div class="card {{ ($user->theme == "light") ? 'bg-white' : 'bg-dark text-white' }} h-100">

                            @if ($product->type->value === "link")
                                <div class="card-body">

                                    @if ($product->thumbnail)
                                    <img src="{{ Storage::url($product->thumbnail) }}" style="width: 64px; height: 64px;" class="card-img-top rounded-2" alt="...">
                                        <span>bergambar</span>
                                    @endif
                                    <span class="fw-bold">LINK - {{ $product->layout->value }}</span>
                                </div>
                            @else
                                <div class="card-body">
                                    @if ($product->thumbnail)
                                        <span>bergambar</span>
                                    @endif
                                    <span class="fw-bold">DIGITAL - {{ $product->layout->value }}</span>

                                </div>
                            @endif
                        @if ($product->layout->value == "large")

                            @if ($product->thumbnail)
                            <img src="{{ Storage::url($product->thumbnail) }}" style="width: 100%; height: 240px;" class="card-img-top" alt="...">
                            @endif
                            <img src="{{ ($product->thumbnail) ? Storage::url($product->thumbnail) : asset('assets/user2.jpg') }}" style="width: 100%; height: 240px;" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h6>{{ $product->name }} | LARGE</h6>
                                <span><strong>RP. {{ $product->min_price }}</strong></span>
                            </div>

                        @elseif ($product->layout === "grid")
                        <span>GRID</span>

                        @else
                            <div class="card-body text-center">
                                <span>{{ $product->name }} | {{ $product->layout->value }}</span>
                            </div>
                        @endif
                        </div>
                    </a>
                </div>
                @endforeach --}}


                {{-- <div class="col-12">
                    <a href="/awkarin/detail" class="text-decoration-none">
                        <div class="card">
                            <div class="card-body d-flex flex-start align-items-center gap-3">
                                <img src="{{ asset('assets/user1.jpg') }}" style="width: 4rem; height: 4rem;" class="card-img-top" alt="...">
                                <span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellat!</span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-12">
                    <div class="row">
                        <div class="col">
                            <a href="/awkarin/detail" class="text-decoration-none">
                                <div class="card h-100">
                                    <img src="{{ asset('assets/user1.jpg') }}" style="width: 100%; height: 120px;"
                                        class="card-img-top object-fit-cover" alt="...">
                                    <div class="card-body">
                                        <h6>Judul</h6>
                                        <span><strong>Rp. 5.000</strong></span>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col">
                            <a href="/awkarin/detail" class="text-decoration-none">
                                <div class="card h-100">
                                    <img src="{{ asset('assets/user3.jpg') }}" style="width: 100%; height: 120px;"
                                        class="card-img-top object-fit-cover" alt="...">
                                    <div class="card-body">
                                        <h6>Judul</h6>
                                        <span><strong>Rp. 5.000</strong></span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <a href="/awkarin/detail" class="text-decoration-none">
                        <div class="card bg-dark-cover h-100">
                            <img src="{{ asset('assets/user2.jpg') }}" style="width: 100%; height: 240px;"
                                class="card-img-top object-fit-cover" alt="...">
                            <div class="card-body">
                                <h6>Judul</h6>
                                <span><strong>Rp. 5.000</strong></span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-12">
                    <a href="/awkarin/detail" class="text-decoration-none">
                        <div class="card bg-dark-cover  text-center">
                            <div class="card-body">
                                <span>Lorem ipsum adipisicing elit. Repellat!</span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-12">
                    <div class="row">
                        <div class="col-6">
                            <a href="/awkarin/detail" class="text-decoration-none">
                                <div class="card bg-dark-cover h-100">
                                    <img src="{{ asset('assets/user6.jpg') }}" style="width: 100%; height: 120px;"
                                        class="card-img-top object-fit-cover" alt="...">
                                    <div class="card-body">
                                        <h6>Judul</h6>
                                        <span><strong>Rp. 5.000</strong></span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div> --}}
            {{-- </div> --}}
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