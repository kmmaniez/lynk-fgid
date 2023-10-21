@extends('layouts.master')
@push('style')
    <style>
        input.form-control {
            margin: 0;
            border: none;
            border-bottom: 1px solid #3c3c3c5c;
            border-radius: 0px;
        }

        textarea.form-control {
            width: auto;
            border: 1px solid #3c3c3c5c;
        }

        textarea.form-control:focus {
            border: none;
            border: 1px solid #198754;
            box-shadow: none;
        }

        input.form-control:focus {
            border: none;
            border-bottom: 1px solid #198754;
            box-shadow: none;
        }

        label {
            margin-bottom: 0;
        }

        input.form-control {
            width: 100%;
        }

        .input-group-text {
            border: none;
            padding: 0 8px 0 0;
            user-select: none;
        }

        textarea.form-control {
            width: 100%;
        }

        .input-group {
            /* padding: 9px; */
            /* width: 240px; */
            /* background-color: lightblue; */
        }

        #popover-custom-content {
            display: none;
        }
        label#custom {
        /* color: white; */
        padding: 0.5rem;
        /* font-family: sans-serif;
        border-radius: 0.3rem; */
        cursor: pointer;
        margin-top: 1rem;
        }


        @media (max-width: 768px) {
            input.form-control {
                width: 100%;
            }

            /* textarea.form-control{
                    width: 100%;
                } */

            /* .input-group {
                    width: 100%;
                } */
        }
        #layout span{
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
            box-shadow: 0 0 12px #53cb93;
        }
    </style>
@endpush
@section('content')
    <section id="digital-produk">
        <div class="card border-0 pb-0">
            <div class="card-body">
                <h3>Add digital produk</h3>
                @dump($errors)
                <form action="{{ route('products.digitalstore') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-3">
                        <label id="custom" for="thumbnail">Upload Thumbnail <i data-feather="image"></i></label>
                        <input type="file" name="thumbnail" id="thumbnail" hidden>
                    </div>
                    
                    <div class="form-group mb-3">
                        <label id="custom" for="images">Upload gambar <i data-feather="image"></i></label>
                        <input type="file" name="images" multiple id="images">
                    </div>
    
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Produk</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Nama Produk">
                    </div>
    
                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi Produk</label>
                        <input type="text" class="form-control" name="description" id="description" placeholder="Deskripsi Produk">
                    </div>
    
                    <div class="mb-3 py-2">
                        <label for="url" class="form-label">Link File/Produk</label>
                        <input type="url" class="form-control" name="url" id="url" placeholder="drive.google.com/file/fgid">
                    </div>
    
                    <div class="form-group mb-3">
                        <div class="row">
                            <div class="col-sm-12">
                                <label for="min_price" class="form-label">Price Minimal</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text text-secondary">Rp</span>
                                    <input type="number" name="min_price" id="min_price" class="form-control" placeholder="1000"
                                        aria-label="min_price">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <label for="max_price" class="form-label">Price Rekomendasi</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text text-secondary">Rp</span>
                                    <input type="number" name="max_price" id="max_price" class="form-control" placeholder="1500"
                                        aria-label="max_price">
                                </div>
                            </div>
                        </div>
                        <small style="font-size: 14px;" class="text-success"><em>Harga rekomendasi <strong>harus lebih besar
                                    dari minimal harga</strong></em></small>
                    </div>

                    <div class="mb-3">
                        <div class="popover-group">
                            <label for="messages" class="form-label">Pesan Customer</label>
                            <button type="button" id="popover-custom-message" class="btn btn-sm border-0"
                                data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top">
                                <i data-feather="info"></i>
                            </button>
                            <div id="popover-custom-content">
                                <img src="{{ asset('assets/user1.jpg') }}" class="w-100">
                                <span class="">Pesan ini akan dikirim ke customer, setelah melakukan pembayaran.</span>
                            </div>
                        </div>
                        <textarea class="form-control" name="messages" id="messages" rows="3"></textarea>
                    </div>
    
                    <div class="mb-3">
                        <div class="popover-group">
                            <label for="cta_text">Kalimat Call To Action</label>
                            <button type="button" class="btn btn-sm border-0" data-bs-container="body" data-bs-toggle="popover"
                                data-bs-placement="top" data-bs-content="Kalimat ini untuk mengajak membeli produk anda">
                                <i data-feather="info"></i>
                            </button>
                        </div>
                        <select class="form-control mt-2 shadow-none" name="cta_text" id="cta_text">
                            <option class="d-none" value="">Pilih Kalimat CTA</option>
                            <option value="0">I Want this</option>
                            <option value="1">Support Creator</option>
                            <option value="2">Beli Sekarang</option>
                            <option value="6">Book Now</option>
                        </select>
                        @if (session()->has('cta_text'))
                            <small class="text-danger">{{ session()->get('cta_text') }}</small>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="layout">Layout</label>
                        <div class="hstack gap-3 mt-2" id="layout">
                            <label>
                                <input class="form-check-input" type="radio" name="layout" value="default" checked>
                                <img src="{{ asset('assets/default-col.png') }}" width="164" height="164" alt="light">
                                <span>Default</span>
                            </label>
                            <label>
                                <input class="form-check-input" type="radio" name="layout" value="grid">
                                <img src="{{ asset('assets/grid.png') }}" width="164" height="164" alt="grid">
                                <span>Grid Image</span>
                            </label>
                            <label>
                                <input class="form-check-input" type="radio" name="layout" value="large">
                                <img src="{{ asset('assets/large-image.png') }}" width="164" height="164" alt="large">
                                <span>Large Image</span>
                            </label>
                        </div>
                    </div>
    
                    <div class="vstack mt-3 gap-2 w-100">
                        <button class="btn bg-danger fw-semibold text-uppercase bg-gradient text-white w-100">Add Product</button>
                        <a href="{{ route('admin') }}" class="btn w-100 fw-medium">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script src="{{ asset('assets/vendor/bootstrap-5.3.1/js/dist/popover.js') }}"></script>
    <script>
        const popoverCustomMessage = document.getElementById('popover-custom-message');
        const contentMessage = document.getElementById('popover-custom-content');

        const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
        const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))

        popoverCustomMessage.addEventListener('click', (e) => {
            contentMessage.classList.toggle('d-block')
        })
        const popover = new bootstrap.Popover(popoverCustomMessage, {
            html: true,
            content: contentMessage,
        })
    </script>
@endpush
