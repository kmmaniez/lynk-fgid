@extends('layouts.products')
@push('styles')
<style>
    .header span{
        user-select: none;
        color: #fff;
        text-shadow: 0 0 10px rgb(38, 38, 38);
    }
    #coverprofile{
        content: '';
        /* background: url('{{ asset("assets/user6.jpg") }}'); */
        object-fit: cover;
        background-size: 100%;
        background-position: center;
        background-repeat: no-repeat;
        position: absolute;
        width: 100%;
        height: 100%;
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
</style>
@endpush
@section('produk')
    <section id="wrap" class="">
        <div class="header" style="">
            <div class="card rounded-0 border-0 text-center position-relative" style="z-index: 1">
                <div id="coverprofile" style="background: url('{{ asset('assets/square.PNG') }}')"></div>
                <div class="card-body vstack gap-3 align-items-center">
                    <img src="{{ asset('assets/square.png') }}" style="width: 5rem; height: 5rem;" 
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
                        <div class="card text-center">
                            <div class="card-body">
                                <span>Lorem ipsum adipisicing elit. Repellat!</span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-12">
                    <a href="/awkarin/detail" class="text-decoration-none">
                        <div class="card  ">
                            <div class="card-body d-flex flex-start align-items-center gap-3">
                                <img src="{{ asset('assets/square.png') }}" style="width: 4rem; height: 4rem;" class="card-img-top" alt="...">
                                <span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellat!</span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-12">
                    <div class="row">
                        <div class="col">
                            <a href="/awkarin/detail" class="text-decoration-none">
                                <div class="card   h-100">
                                    <img src="{{ asset('assets/square.png') }}" style="width: 100%; height: 120px;"
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
                                <div class="card  h-100">
                                    <img src="{{ asset('assets/square.png') }}" style="width: 100%; height: 120px;"
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
                        <div class="card   h-100">
                            <img src="{{ asset('assets/square.png') }}" style="width: 100%; height: 240px;"
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
                        <div class="card   text-center">
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
                                <div class="card  h-100">
                                    <img src="{{ asset('assets/square.png') }}" style="width: 100%; height: 120px;"
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
    </section>
@endsection