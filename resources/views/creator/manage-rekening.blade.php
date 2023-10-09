@extends('layouts.master')
{{-- @extends('layouts.creator') --}}
@push('style')
    <style>
        input.form-control {
            margin: 0;
            border: none;
            border-bottom: 1px solid #3c3c3c5c;
            border-radius: 0px;
        }
    </style>
@endpush
@section('content')
    {{-- <div class="card border-0 mt-3">
        <div class="card-body p-2">
            <h4>Manage Earnings</h4>

            <div class="vstack mt-3">
                <div class="card">
                    <div class="card-header bg-transparent">
                        <span class="fs-5 text-secondary">Indonesian Bank Transfer</span>
                    </div>
                    <div class="card-body pb-4">
                        <form action="" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="">Nama Bank</label>
                                <input class="form-control shadow-none" placeholder="BCA/BNI..." type="text" name="" id="">
                            </div>
                            <div class="form-group mt-3">
                                <label for="">Nomor Rekening</label>
                                <input class="form-control shadow-none" placeholder="111111..." min="1" type="number" name="" id="">
                            </div>
                            <div class="form-group mt-3">
                                <label for="">Nama Rekening</label>
                                <input class="form-control shadow-none" placeholder="Dadang.." type="text" name="" id="">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="vstack mt-3 gap-2">
                    <button class="btn btn-md bg-success bg-gradient text-white">Save Change</button>
                    <button class="btn btn-md btn-outline-success">Cancel</button>
                </div>

            </div>

        </div>
    </div> --}}

    {{-- <div class="card">
        <div class="card-body">
            <p>Lorem ipsum dolor sit amet.</p>
        </div>
    </div> --}}
    {{-- <section id="manage-rekening" class="mb-2">

        <div class="card border-0">
            <div class="card-body">
                <h4>Manage Earnings</h4>
                <div class="vstack mt-3">
                    <div class="card">
                        <div class="card-header bg-transparent">
                            <span class="fs-5 text-secondary">Indonesian Bank Transfer</span>
                        </div>
                        <div class="card-body pb-4">
                            <form action="" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="">Nama Bank</label>
                                    <input class="form-control shadow-none" placeholder="BCA/BNI..." type="text" name="" id="">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="">Nomor Rekening</label>
                                    <input class="form-control shadow-none" placeholder="111111..." min="1" type="number" name="" id="">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="">Nama Rekening</label>
                                    <input class="form-control shadow-none" placeholder="Dadang.." type="text" name="" id="">
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="vstack mt-3 gap-2">
                        <button class="btn btn-md bg-success bg-gradient text-white">Save Change</button>
                        <button class="btn btn-md btn-outline-success">Cancel</button>
                    </div>
                </div>
    
            </div>
        </div>
    </section>
    <section id="manage-rekening" class="mb-2">

        <div class="card border-0">
            <div class="card-body">
                <h4>Manage Earnings</h4>
                <div class="vstack mt-3">
                    <div class="card">
                        <div class="card-header bg-transparent">
                            <span class="fs-5 text-secondary">Indonesian Bank Transfer</span>
                        </div>
                        <div class="card-body pb-4">
                            <form action="" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="">Nama Bank</label>
                                    <input class="form-control shadow-none" placeholder="BCA/BNI..." type="text" name="" id="">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="">Nomor Rekening</label>
                                    <input class="form-control shadow-none" placeholder="111111..." min="1" type="number" name="" id="">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="">Nama Rekening</label>
                                    <input class="form-control shadow-none" placeholder="Dadang.." type="text" name="" id="">
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="vstack mt-3 gap-2">
                        <button class="btn btn-md bg-success bg-gradient text-white">Save Change</button>
                        <button class="btn btn-md btn-outline-success">Cancel</button>
                    </div>
                </div>
    
            </div>
        </div>
    </section>
    <section id="manage-rekening" class="mb-2">

        <div class="card border-0">
            <div class="card-body">
                <h4>Manage Earnings</h4>
                <div class="vstack mt-3">
                    <div class="card">
                        <div class="card-header bg-transparent">
                            <span class="fs-5 text-secondary">Indonesian Bank Transfer</span>
                        </div>
                        <div class="card-body pb-4">
                            <form action="" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="">Nama Bank</label>
                                    <input class="form-control shadow-none" placeholder="BCA/BNI..." type="text" name="" id="">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="">Nomor Rekening</label>
                                    <input class="form-control shadow-none" placeholder="111111..." min="1" type="number" name="" id="">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="">Nama Rekening</label>
                                    <input class="form-control shadow-none" placeholder="Dadang.." type="text" name="" id="">
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="vstack mt-3 gap-2">
                        <button class="btn btn-md bg-success bg-gradient text-white">Save Change</button>
                        <button class="btn btn-md btn-outline-success">Cancel</button>
                    </div>
                </div>
    
            </div>
        </div>
    </section>
    <section id="manage-rekening" class="mb-2">

        <div class="card border-0">
            <div class="card-body">
                <h4>Manage Earnings</h4>
                <div class="vstack mt-3">
                    <div class="card">
                        <div class="card-header bg-transparent">
                            <span class="fs-5 text-secondary">Indonesian Bank Transfer</span>
                        </div>
                        <div class="card-body pb-4">
                            <form action="" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="">Nama Bank</label>
                                    <input class="form-control shadow-none" placeholder="BCA/BNI..." type="text" name="" id="">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="">Nomor Rekening</label>
                                    <input class="form-control shadow-none" placeholder="111111..." min="1" type="number" name="" id="">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="">Nama Rekening</label>
                                    <input class="form-control shadow-none" placeholder="Dadang.." type="text" name="" id="">
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="vstack mt-3 gap-2">
                        <button class="btn btn-md bg-success bg-gradient text-white">Save Change</button>
                        <button class="btn btn-md btn-outline-success">Cancel</button>
                    </div>
                </div>
    
            </div>
        </div>
    </section> --}}
    <section id="manage-rekening">

        <div class="card border-0">
            <div class="card-body p-2">
                <h4>Manage Earnings</h4>
                <div class="vstack mt-3">
                    <div class="card">
                        <div class="card-header bg-transparent">
                            <h5 class="text-secondary">Indonesian Bank Transfer</h5>
                        </div>
                        <div class="card-body pb-4">
                            <form action="" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="">Nama Bank</label>
                                    <select class="form-control shadow-none" name="" id="">
                                        <option value="">BCA</option>
                                        <option value="">BRI</option>
                                        <option value="">BNI</option>
                                        <option value="">MANDIRI</option>
                                    </select>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="">Nomor Rekening</label>
                                    <input class="form-control shadow-none" placeholder="111111..." min="1" type="number" name="" id="">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="">Nama Rekening</label>
                                    <input class="form-control shadow-none" placeholder="Dadang.." type="text" name="" id="">
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="vstack mt-3 gap-2">
                        <button class="btn btn-md bg-danger fw-semibold text-uppercase bg-gradient text-white">Save Change</button>
                        <a href="{{ route('admin') }}" class="btn btn-md">Cancel</a>
                    </div>
                </div>
    
            </div>
        </div>
    </section>
@endsection
