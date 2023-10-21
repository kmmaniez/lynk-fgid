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
    </style>
@endpush
@section('content')
    {{-- <div class="tab-content mt-3" id="myTabContent">
        <div class="tab-pane {{  (Request::routeIs('admin')) ? 'show active' : '' }}" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
            <div class="row">
                <div class="col-lg-5">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-outline-success w-100" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Add new block
                    </button>

                </div>
            </div>
        </div>
    </div>

    <x-public.statistik></x-public.statistik>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambahkan Block Anda</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="card mb-3 d-flex" style="height: 10rem;">
                                <a href="/createlink" class="btn btn-outline-success h-100 d-flex flex-column align-items-center justify-content-center gap-3 fw-bold"><i id="product" data-feather="link"></i> Link</a>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card mb-3 d-flex" style="height: 10rem;">
                                <a href="/digitalproduk" class="btn btn-outline-success h-100 d-flex flex-column align-items-center justify-content-center gap-3 fw-bold"><i id="product" data-feather="shopping-bag"></i>Digital Product</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <section id="content" class="mt-3">

        <div class="produk-action">
            <div class="row g-0">
                <div class="col-xl-4 col-12">
                    <div class="card border-0 p-0">
                        {{-- style="height: 10rem;" --}}
                        <div class="card-body">
                            <a href="/appearance" class="btn btn-outline-danger h-100 d-flex flex-column align-items-center justify-content-center gap-3 fw-bold"><i id="product" data-feather="layout"></i> Appearance</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-12">
                    <div class="card border-0 p-0">
                        {{-- style="height: 10rem;" --}}
                        <div class="card-body">
                            <a href="/createlink" class="btn btn-outline-danger h-100 d-flex flex-column align-items-center justify-content-center gap-3 fw-bold"><i id="product" data-feather="link"></i> Link</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-12">
                    <div class="card border-0 p-0">
                        {{-- style="height: 10rem;" --}}
                        <div class="card-body">
                            <a href="/digitalproduk" class="btn btn-outline-danger h-100 d-flex flex-column align-items-center justify-content-center gap-3 fw-bold"><i id="product" data-feather="shopping-bag"></i> Digital Product</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="list-produk">
            <div class="card border-0">
                <div class="card-body px-2">
                    <span class="fs-3">List produk</span>
                    {{-- @dump($products) --}}
                    <div class="vstack gap-2 mt-3">
                        @forelse ($products as $product)
                        <div class="card produk-detail">
                            
                                <a 
                                @if ($product->type->value === "link")
                                    href="{{ route('products.linkedit', $product->id) }}" 
                                @else
                                    href="{{ route('products.digitaledit', $product->id) }}" 
                                @endif
                                    title="{{ $product->name }}" class="text-decoration-none text-dark"
                                >
                                
                                <div class="card-body ps-3 d-flex flex-start align-items-center gap-3">
                                    @if ($product->thumbnail)
                                        <img 
                                        @if ($product->type->value == "link")
                                            src="{{ Storage::url($product->thumbnail) }}" 
                                        @else
                                            src="{{ Storage::url('tes/'. json_decode($product->images)[0]) }}" 
                                        @endif
                                            style="width: 4rem; height: 3rem;" class="card-img-top" alt="Thumbnail"
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
