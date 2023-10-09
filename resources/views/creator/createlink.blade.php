@extends('layouts.master')
@push('style')
    <style>
        #theme_profile span{
            display: block;
            text-align: center;
            margin-top: 0.5rem;
        }
        [type=radio] { 
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }

        /* IMAGE STYLES */
        [type=radio] + img {
            cursor: pointer;
        }

        /* CHECKED STYLES */
        [type=radio]:checked ~ span{
            font-weight: 700;
        }
        [type=radio]:checked + img {
            padding: 8px;
            background-color: #fff;
            outline: 1px solid #3e9f72;
            border-radius: 8px;
            box-shadow: 0 0 8px #53cb93;
        }
        input.form-control:focus{
            /* border: 1px solid #3c3c3c; */
            box-shadow: none;
        }
        label#custom {
            /* margin-top: 1.25rem; */
            padding: 0.5rem 1rem;
            border: 2px dotted #ff7676;
            border-radius: 8px;
            cursor: pointer;
            text-align: center;
        }
        .form-group svg{
            height: 3rem;
            width: 3rem;
        }
    </style>
@endpush
@section('content')
    <section id="create-link" class="">
        <div class="card border-0">
            <div class="card-body">
                <h3>Create Link</h3>
                <form action="" method="post">
                    @csrf
                    <div class="form-group hstack gap-3 justify-content-between align-items-center">
                        {{-- <img src="{{ asset('assets/user1.jpg') }}" width="140" height="120" alt="" srcset=""> --}}
                        <label id="custom" for="foto_produk"><i data-feather="image"></i>Upload</label>
                        <input type="file" name="foto_produk" id="foto_produk" hidden>
                        <div class="form-input gap-2 w-100">
                            <input type="text" class="form-control" placeholder="Judul Link" name="" id="">
                            <input type="url" class="form-control mt-2" placeholder="http://" name="" id="">
                        </div>
                    </div>
                    <div class="form-group my-3">
                        <label for="theme_profile">Layout</label>
                        <div class="hstack gap-3 mt-2" id="theme_profile">
                            <label>
                                <input class="form-check-input" type="radio" name="theme" value="light" checked>
                                <img src="{{ asset('assets/default-col.png') }}" width="164" height="164" alt="light">
                                <span>Small</span>
                            </label>
                            <label>
                                <input class="form-check-input" type="radio" name="theme" value="dark">
                                <img src="{{ asset('assets/large-image.png') }}" width="164" height="164" alt="dark">
                                <span>Large image</span>
                            </label>
                        </div>
                    </div>
                    <div class="vstack gap-2">
                        <button class="btn btn-md bg-danger bg-gradient text-white fw-semibold text-uppercase w-100 mt-3">Simpan</button>
                        <a href="{{ route('admin') }}" class="btn w-100 fw-medium">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </section>

@endsection
