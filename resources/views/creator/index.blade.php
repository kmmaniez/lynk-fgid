@extends('layouts.creator')
@push('style')
    <style>
        @media (max-width: 768px) {
            #previewMockup{
                display: none;
            }
        }
    </style>
@endpush
@section('content')
    <div class="tab-content mt-3" id="myTabContent">
        <div class="tab-pane {{  (Request::routeIs('admin')) ? 'show active' : '' }}" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
            <div class="row">
                <div class="col-lg-5">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-outline-success w-100" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Add new block
                    </button>

                </div>
                <div class="col" id="previewMockup">
                    <div class="card" style="height: 32rem;">
                        <div class="card-body bg-secondary">
                            {{-- <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quas, non?</p> --}}
                        </div>
                    </div>
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
    </div>

@endsection
