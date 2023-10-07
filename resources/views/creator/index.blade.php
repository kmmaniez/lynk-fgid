@extends('layouts.master')
@push('style')
    <style>
        @media (max-width: 768px) {
            #previewMockup{
                display: none;
            }
        }
        .list-produk{
            /* width: 100%; */
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
            <div class="row">
                <div class="col">
                    <div class="card border-0 p-0" style="height: 10rem;">
                        <div class="card-body">
                            <a href="/createlink" class="btn btn-outline-success h-100 d-flex flex-column align-items-center justify-content-center gap-3 fw-bold"><i id="product" data-feather="link"></i> Link</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card border-0 p-0" style="height: 10rem;">
                        <div class="card-body">
                            <a href="/digitalproduk" class="btn btn-outline-success h-100 d-flex flex-column align-items-center justify-content-center gap-3 fw-bold"><i id="product" data-feather="shopping-bag"></i> Digital Product</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="list-produk">
            <div class="card border-0">
                <div class="card-body">
                    <span class="fs-3">List produk</span>

                    <div class="vstack gap-2 mt-3">
                        @for ($i=0; $i < 12; $i++)
                        <div class="card">
                            <a href="/awkarin" class="text-decoration-none text-dark">
                                <div class="card-body d-flex flex-start align-items-center gap-3">
                                    @if ($i%4 === 0)
                                    <img src="{{ asset('assets/user1.jpg') }}" 
                                    style="width: 4rem; height: 3rem;" 
                                    class="card-img-top" alt="...">
                                    @endif
                                    <span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellat!</span>
                                </div>
                            </a>
                        </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
