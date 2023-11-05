@extends('layouts.master')
@push('style')
    <style>
        .list-produk{
            /* width: 100%; */
        }
        .produk-action .card{
            height: 10rem;
        }
        .bg-danger-dark{
            background-color: #fd6060;
        }
        .produk-detail:is(:hover){
            background-color: #fff5f5;
        }
        @media (max-width: 820px) {
            .card{
                height: max-content;
            }
            .list-produk .card-body .icon{
                display: none;
            }

        }
        .copied{
            display: none;
        }
        .copied.show{
            display: block;
            padding: 4px 8px;
            width: max-content;
            height: max-content;
            font-size: 12px;
            background-color: salmon;
            position: absolute;
            border-radius: 6px;
            z-index: 2;
            top: -2.2rem;
            right: 0;
        }
        .copied.show::after{
            content: '';
            width: 14px;
            height: 14px;
            background-color: salmon;
            border-radius: 4px;
            position: absolute;
            bottom: -6px;
            right: 35%;
            transform: rotate(45deg);
        }
    </style>
@endpush
@section('content')
    <section id="content" class="mt-3">

        <div class="produk-action">
            <div class="text-end pe-3 position-relative" id="link-group">
                <a href="#" class="text-decoration-none" id="user-link">{{ route('public.user', auth()->user()->username) }}</a>
                <a href="#" id="btnCopy" title="copy link"><i data-feather="copy" class="fa-24 text-danger"></i></a>
            </div>
            <div class="row g-0">
                <div class="col-xl-4 col-12">
                    <div class="card border-0 p-0">
                        {{-- style="height: 10rem;" --}}
                        <div class="card-body">
                            <a href="{{ route('profile.appearance') }}" class="btn btn-outline-danger h-100 d-flex flex-column align-items-center justify-content-center gap-3 fw-bold"><i id="product" data-feather="layout"></i> Appearance</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-12">
                    <div class="card border-0 p-0">
                        {{-- style="height: 10rem;" --}}
                        <div class="card-body">
                            <a href="{{ route('products.linkindex') }}" class="btn btn-outline-danger h-100 d-flex flex-column align-items-center justify-content-center gap-3 fw-bold"><i id="product" data-feather="link"></i> Link</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-12">
                    <div class="card border-0 p-0">
                        {{-- style="height: 10rem;" --}}
                        <div class="card-body">
                            <a href="{{ route('products.digitalindex') }}" class="btn btn-outline-danger h-100 d-flex flex-column align-items-center justify-content-center gap-3 fw-bold"><i id="product" data-feather="shopping-bag"></i> Digital Product</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="list-produk">
            <div class="card border-0">
                <div class="card-body px-2">
                    <span class="fs-3 fw-semibold">Product Lists ({{ $total_product }})</span>
                    {{-- @dump($pag) --}}
                    <div class="vstack gap-2 mt-3">
                        @forelse ($products as $product)
                        <div class="card produk-detail">
                            
                                <a 
                                @if ($product->type->value === "link")
                                    href="{{ route('products.linkedit', $product->id) }}" 
                                @else
                                    href="{{ route('products.digitaledit', $product->slug) }}" 
                                @endif
                                    title="{{ $product->name }}" class="text-decoration-none text-dark"
                                >
                                
                                <div class="card-body ps-3 d-flex flex-start align-items-center gap-3">
                                    @if ($product->thumbnail)
                                        <img 
                                        @if ($product->type->value == "link")
                                            src="{{ Storage::url($product->thumbnail) }}" 
                                        @else
                                            @if ($product->images)
                                                src="{{ Storage::url('products/digital/'. $product->images[0]) }}" 
                                            @else
                                                src="{{ Storage::url($product->thumbnail) }}" 
                                            @endif
                                        @endif
                                            style="width: 4rem; height: 3rem;" class="card-img-top object-fit-fill rounded-1" alt="Thumbnail"
                                            >
                                    @endif
                                    <div class="hstack w-100">
                                        <div class="vstack gap-1">
                                            <span class="title">{{ $product->name }}</span>
                                            <span class="badge bg-danger-dark rounded-0" style="width: max-content">{{ Str::upper($product->type?->value) }}</span>

                                            {{-- @if ($product->images)
                                                @foreach (json_decode($product->images) as $image)
                                                    <img src="{{ Storage::url('tes/'.$image) }}" width="48" height="48" alt="" srcset="">
                                                @endforeach
                                            @endif --}}
                                        </div>
                                        <i id="icon" class="icon text-secondary" data-feather="arrow-up-right"></i>
                                    </div>
                                </div>
                        </div>
                        @empty
                        <span>Daftar produk digital atau link akan muncul di sini!</span>
                        @endforelse
                        {{-- @for ($i=0; $i < 3; $i++)
                        <div class="card produk-detail">
                            <a href="/awkarin" target="_blank" class="text-decoration-none text-dark">
                                <div class="card-body ps-3 d-flex flex-start align-items-center gap-3">
                                    @if ($i%4 === 0)
                                    <img src="{{ asset('assets/user1.jpg') }}" 
                                    style="width: 4rem; height: 3rem;" 
                                    class="card-img-top" alt="...">
                                    @endif
                                    <div class="hstack justify-content-between w-100">
                                        <span class="title">Lorem ipsum dolor sit amet consectetur adipisicing elit. Iure, blanditiis.</span>
                                        <i id="icon" class="icon text-secondary" data-feather="arrow-up-right"></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endfor --}}
                    </div>
                </div>
            </div>
        </div>
        
    </section>
@endsection
@push('scripts')
    <script>
        $('#btnCopy').on('click', (e) => {
            e.preventDefault();
            try {
                $('#link-group').append('<div class="copied">copied</div>');
                navigator.clipboard.writeText($('#user-link').text())
                $('.copied').addClass('show')
                    setTimeout(() => {
                        $('.copied').remove()
                    }, 1500);
            } catch (error) {
                console.error('Failed to copy');
            }
        })
    </script>
@endpush