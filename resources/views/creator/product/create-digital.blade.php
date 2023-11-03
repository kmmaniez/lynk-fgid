@extends('layouts.master')
@push('style')
    <style>
        span#remove-list {
            cursor: pointer;
        }

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


        #layout span {
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
        [type=radio]+img {
            cursor: pointer;
        }

        /* CHECKED STYLES */
        [type=radio]:checked~span {
            font-weight: 700;
        }

        [type=radio]:checked+img {
            padding: 8px;
            background-color: #fff;
            outline: 1px solid #3e9f72;
            border-radius: 8px;
            box-shadow: 0 0 12px #53cb93;
        }

        svg.fa-2 {
            width: 14px;
            height: 14px;
            color: #fff;
        }

        .box {
            width: max-content;
            height: max-content;
            display: none;
            /* padding: 4px; */
            background-color: #eaeaea;
        }

        /* label#custom {
                margin-top: 1.25rem;
                padding: 2rem;
                border: 2px dotted #ff7676;
                border-radius: 8px;
                cursor: pointer;
                text-align: center;
            } */
        label#custom {
            width: 116px;
            /* height: 118px; */
            height: 118px;
            padding: 1rem;
            border: 2px dotted #ff7676;
            border-radius: 8px;
            cursor: pointer;
            text-align: center;
            display: flex;
            flex-flow: column wrap;
            justify-content: center;
            align-items: center;
            gap: 0.5rem;
            flex-shrink: 0;
        }

        #titlethumb {
            position: absolute;
            bottom: 0;
            width: 100%;
        }

        #list-images {
            width: max-content;
            position: relative;
            height: max-content;
            /* padding: 8px; */
        }

        #form-image {
            height: max-content;
            display: flex;
            gap: 2rem;
        }

        @media (max-width: 820px) {
            input.form-control {
                width: 100%;
            }

            #form-image {
                height: max-content;
                display: flex;
                flex-direction: column;
                justify-content: center;
                /* align-items: center; */
                gap: 8px;
            }

            #list-images {
                width: 100%;
                position: relative;
                height: max-content;
            }

            label#custom {
                order: 2;
            }
        }
    </style>
@endpush
@section('content')
    <section id="digital-produk">
        <div class="card border-0 pb-0">
            <div class="card-body">
                <h3>Add product digital</h3>

                <form action="{{ route('products.digitalstore') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div id="form-image" class="form-group mt-3 mb-3 p-1">
                        <label id="custom" for="images">Upload Images <i data-feather="image"></i></label>
                        <input type="file" name="images[]" id="images" accept="image/*" multiple hidden>
                        <div id="list-images" class="mb-2 hstack flex-wrap gap-1">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Product Name</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Nama Produk">
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Product Description</label>
                        <input type="text" class="form-control" name="description" id="description"
                            placeholder="Deskripsi Produk">
                    </div>

                    <div class="mb-3 py-2">
                        <label for="url" class="form-label">Link File/Product</label>
                        <input type="url" class="form-control" name="url" id="url"
                            placeholder="drive.google.com/file/fgid">
                    </div>

                    <div class="form-group mb-3">
                        <div class="row">
                            <div class="col-sm-12">
                                <label for="min_price" class="form-label">Minimal Price</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text text-secondary">Rp</span>
                                    <input type="number" name="min_price" id="min_price" class="form-control"
                                        placeholder="1000" aria-label="min_price">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <label for="max_price" class="form-label">Recomendation Price</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text text-secondary">Rp</span>
                                    <input type="number" name="max_price" id="max_price" class="form-control"
                                        placeholder="1500" aria-label="max_price">
                                </div>
                            </div>
                        </div>
                        <small style="font-size: 14px;" class="text-success"><em>Harga rekomendasi <strong>harus lebih besar
                                    dari minimal harga</strong></em></small>
                    </div>

                    <div class="mb-3">
                        <div class="popover-group">
                            <label for="messages" class="form-label">Customer Message</label>
                            <button type="button" id="popover-custom-message" class="btn btn-sm border-0"
                                data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top">
                                <i data-feather="info"></i>
                            </button>
                            <div id="popover-custom-content">
                                <img src="{{ asset('assets/user1.jpg') }}" class="w-100">
                                <span class="">Pesan ini akan dikirim ke customer, setelah melakukan
                                    pembayaran.</span>
                            </div>
                        </div>
                        <textarea class="form-control" name="messages" id="messages" rows="3"></textarea>
                    </div>

                    <div class="mb-3">
                        <div class="popover-group">
                            <label for="cta_text">Kalimat Call To Action</label>
                            <button type="button" class="btn btn-sm border-0" data-bs-container="body"
                                data-bs-toggle="popover" data-bs-placement="top"
                                data-bs-content="Kalimat ini untuk mengajak membeli produk anda">
                                <i data-feather="info"></i>
                            </button>
                        </div>
                        <select class="form-control mt-2 shadow-none" name="cta_text" id="cta_text">
                            <option class="d-none" value="">Pilih Kalimat CTA</option>
                            @foreach (App\Enums\CtaEnum::values() as $key => $enum)
                                <option value="{{ $key }}">{{ $key }}</option>
                            @endforeach
                        </select>
                        @if (session()->has('cta_text'))
                            <small class="text-danger">{{ session()->get('cta_text') }}</small>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="layout">Layout</label>
                        <div class="hstack gap-3 mt-2" id="layout">
                            @php
                                $arrAsset = ['assets/default-col.png', 'assets/grid.png', 'assets/large-image.png'];
                                $index = 0;
                            @endphp
                            @foreach (App\Enums\LayoutEnum::values() as $key => $layout)
                                {{-- <option value="{{ $key }}">{{ $key }}</option> --}}
                                <label>
                                    <input class="form-check-input" type="radio" name="layout"
                                        value="{{ $key }}" {{ $index === 0 ? 'checked' : '' }}>
                                    <img src="{{ asset($arrAsset[$index++]) }}" width="164" height="164"
                                        alt="Layout">
                                    <span>{{ Str::ucfirst($key) }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="vstack mt-3 gap-2 w-100">
                        <button class="btn bg-danger fw-semibold text-uppercase bg-gradient text-white w-100">Add
                            Product</button>
                        <a href="{{ route('creator') }}" class="btn w-100 fw-medium">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        const popoverCustomMessage = document.getElementById('popover-custom-message');
        const contentMessage = document.getElementById('popover-custom-content');

        const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
        const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))
        const thumbnailFile = document.getElementById('thumbnail');
        const imagesFile = document.getElementById('images');
        const listimage = document.getElementById('list-images');
        const removeList = document.querySelectorAll('#remove-list');

        const label = `<small id="titlethumb" class="bg-danger rounded-2 text-white text-center p-1">Thumbnail</small>`;

        popoverCustomMessage.addEventListener('click', (e) => {
            contentMessage.classList.toggle('d-block')
        })
        const popover = new bootstrap.Popover(popoverCustomMessage, {
            html: true,
            content: contentMessage,
        })

        window.onresize = (e) => {
            if (window.innerWidth <= 820) {
                $('#form-image').css('align-items', 'center')
            } else {
                $('#form-image').css('align-items', 'flex-start')
            }
        }

        $(document).ready(function() {

            $('#images').change(function(e) {
                e.preventDefault()
                const imageFiles = e.target.files;
                for (let index = 0; index < imageFiles.length; index++) {
                    const reader = new FileReader();
                    reader.readAsDataURL(imageFiles[index]);
                    reader.addEventListener('load', () => {
                        const img = `
                        <div class="item position-relative" data-item="${index + 1}" style="width: max-content;">
                            <img id="displayimg" class="rounded-2" src="${reader.result}" width="116" height="118" alt="" srcset="">
                            <span data-img="${index + 1}" id="remove-list" class="remove-list position-absolute top-0 start-100 translate-middle badge border border-light border-2 rounded-circle bg-danger" style="z-index: 1">X</span>
                            <input name="img[]" value="${reader.result}" hidden>
                        </div>
                        `;
                        $('#list-images').append(img);
                        // if (index === 0) {
                        //     $('#list-images').children('.item:first:not(:has(small))').append(label)
                        // }
                        $('#list-images').children('.item:first:not(:has(small))').append(label)
                    });
                }
            })
        })

        $('#list-images').on('click', (e) => {
            $(this).on('click', (ev) => {
                // ev.preventDefault();
                ev.stopImmediatePropagation();
                const elemData = ev.target.dataset.img;
                if (elemData) {
                    if (confirm("Delete images ?")) {
                        if (listimage.hasChildNodes) {
                            listimage.removeChild(ev.target.parentElement)
                            $('#list-images').children('.item:first:not(:has(small))').append(label)
                        }
                    }
                }
            })
        })

        $('#removeimg').on('click', (e) => {
            e.preventDefault();
            if (confirm("Are you sure you want to delete this?")) {
                $("#thumbnail").val(null);
                $('#thumbnaildisplay').css('display', 'none');
                $('.box').css('display', 'none');
                $('.form-upload').css('display', 'block');
            }
        })
    </script>
@endpush
