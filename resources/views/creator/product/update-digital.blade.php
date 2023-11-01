@extends('layouts.master')
@php 
use App\Enums\CtaEnum; 
use App\Enums\LayoutEnum; 
@endphp
@push('style')
    <style>
        span#remove-list{
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
        svg.fa-2{
            width: 14px;
            height: 14px;
            color: #fff;
        }
        .box{
            width: max-content;
            height: max-content;
            display: none;
            /* padding: 4px; */
            background-color: #eaeaea;
        }
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
        .item > *{
            cursor: pointer;
        }
        #titlethumb{
            position: absolute;
            bottom: 0;
            width: 100%;
        }
        #list-images{
            width: max-content;
            position: relative;
            height: max-content;
            /* padding: 8px; */
        }
        #form-image{
            height: max-content;
            display: flex;
            gap: 8px;
        }

    </style>
@endpush
@section('content')
    <section id="digital-produk">
        <div class="card border-0 pb-0">
            <div class="card-body">
                <h3>Update product</h3>

                <form action="{{ route('products.digitalupdate', $product->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div id="form-image" class="form-group mt-3 mb-3">
                        <label id="custom" for="images">Upload Images <i data-feather="image"></i></label>
                        <input type="file" name="images[]" id="images" accept="image/*" multiple hidden>
                        <div id="list-images" class="list-images mb-2 hstack flex-wrap gap-1">
                            @if ($product->images)
                                @foreach ($product->images as $key => $image)
                                <div class="item position-relative rounded-2" style="width: max-content;">
                                    <img id="displayimg" loading="lazy" alt="images" class="rounded-2" title="delete" src="{{ Storage::url('tes/'. $image) }}" width="116" height="118" alt="" srcset="">
                                    <span id="remove-list" title="delete" class="remove-list position-absolute top-0 start-100 translate-middle badge border-light border-2 rounded-circle bg-danger" style="z-index: 1">X</span>
                                    <input name="img[]" value="{{ $image }}" hidden>  
                                    @if ($key === 0)
                                    <small id="titlethumb" class="bg-danger rounded-2 text-white text-center p-1">Thumbnail</small>  
                                    @endif
                                </div>
                                @endforeach
                            @endif
                        </div>
                        
                        @if (session()->has('error'))
                            <small class="text-danger">{{ session('error') }}</small>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Product Name</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name', $product->name) }}" id="name" placeholder="Nama Produk">
                    </div>
    
                    <div class="mb-3">
                        <label for="description" class="form-label">Product Description</label>
                        <input type="text" class="form-control" name="description" value="{{ old('description', $product->description) }}" id="description" placeholder="Deskripsi Produk">
                    </div>
    
                    <div class="mb-3 py-2">
                        <label for="url" class="form-label">Link File/Product</label>
                        <input type="url" class="form-control" value="{{ old('url', $product->url) }}" name="url" id="url" placeholder="drive.google.com/file/fgid">
                    </div>
    
                    <div class="form-group mb-3">
                        <div class="row">
                            <div class="col-sm-12">
                                <label for="min_price" class="form-label">Minimal Price</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text text-secondary">Rp</span>
                                    <input type="number" value="{{ old('min_price', $product->min_price) }}" name="min_price" id="min_price" class="form-control" placeholder="1000"
                                        aria-label="min_price">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <label for="max_price" class="form-label">Recomendation Price</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text text-secondary">Rp</span>
                                    <input type="number" value="{{ old('max_price', $product->max_price) }}" name="max_price" id="max_price" class="form-control" placeholder="1500"
                                        aria-label="max_price">
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
                                <span class="">Pesan ini akan dikirim ke customer, setelah melakukan pembayaran.</span>
                            </div>
                        </div>
                        <textarea class="form-control" name="messages" id="messages" rows="3">{{ old('messages', $product->messages) }}</textarea>
                    </div>
    
                    <div class="mb-3">
                        <div class="popover-group">
                            <label for="cta_text">Kalimat Call To Actiopn</label>
                            <button type="button" class="btn btn-sm border-0" data-bs-container="body" data-bs-toggle="popover"
                                data-bs-placement="top" data-bs-content="Kalimat ini untuk mengajak membeli produk anda">
                                <i data-feather="info"></i>
                            </button>
                        </div>
                        <select class="form-control mt-2 shadow-none" name="cta_text" id="cta_text">
                            @foreach(CtaEnum::cases() as $cta)
                                <option value="{{ $cta }}" {{ ($product->cta_text === $cta) ? 'selected' : '' }}>{{ $cta }}</option>
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
                                $arrAsset = ['assets/default-col.png','assets/grid.png','assets/large-image.png']
                            @endphp
                            @foreach(LayoutEnum::cases() as $key => $layout)
                            <label>
                                <input class="form-check-input" type="radio" name="layout" value="{{ $layout }}" {{ ($product->layout === $layout) ? 'checked' : '' }}>
                                <img src="{{ asset($arrAsset[$key]) }}" width="164" height="164" alt="default">
                                <span>{{ Str::ucfirst($layout->value) }}</span>
                            </label>
                            @endforeach
                            {{-- <label>
                                <input class="form-check-input" type="radio" name="layout" value="default" {{ ($product->layout === "default") ? 'checked' : '' }}>
                                <img src="{{ asset('assets/default-col.png') }}" width="164" height="164" alt="default">
                                <span>Default</span>
                            </label>
                            <label>
                                <input class="form-check-input" type="radio" name="layout" value="grid" {{ ($product->layout === "grid") ? 'checked' : '' }}>
                                <img src="{{ asset('assets/grid.png') }}" width="164" height="164" alt="grid">
                                <span>Grid Image</span>
                            </label>
                            <label>
                                <input class="form-check-input" type="radio" name="layout" value="large" {{ ($product->layout === "large") ? 'checked' : '' }}>
                                <img src="{{ asset('assets/large-image.png') }}" width="164" height="164" alt="large">
                                <span>Large Image</span>
                            </label> --}}
                        </div>
                    </div>
    
                    <button class="btn bg-danger fw-semibold text-uppercase bg-gradient text-white w-100 mt-3">Update Product</button>
                </form>
                <div class="vstack gap-2 mt-2">
                    <form id="form-delete" action="{{ route('products.digitaldestroy', $product->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <a href="#" class="btn btn-delete btn-md btn-outline-danger fw-semibold text-uppercase w-100">Delete Product</a>
                    </form>
                    <a href="{{ route('admin') }}" class="btn w-100 fw-medium">Back</a>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        const removeList = document.querySelectorAll('#remove-list');
        const listImageChildOld = $('#list-images').children('.item').children('span');
        const listimage = document.getElementById('list-images');

        let deletedImages = []

        $(document).ready(function(){

            $.each(listImageChildOld, function(idx, child){
                child.setAttribute('data-img', idx);
            })


            $.each(removeList, function(idx, item){
                
                $(this).on('click',  (e) => {
                    const label = `<small id="titlethumb" class="bg-danger rounded-2 text-white text-center p-1">Thumbnail</small>`;
                    if(confirm("Are you sure you want to delete this?")){
                        deletedImages.push($(this).data('img'))
                        $.ajax({
                            url: '/delete-image/'+ '{{ $product->id }}',
                            method: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                user_id: '{{ $user->id }}',
                                image: JSON.parse(deletedImages)
                            },
                            success: (res) => {
                                console.log(res);
                            },
                            error: (res) => {
                                console.log(res);
                            }
                        })
                        deletedImages = [];
                        $(this).parent().remove();
                        $('#list-images').children('.item:first:not(:has(small))').append(label)
                        const listImageChildNew = $('#list-images').children('.item').children('span');
                        $.each(listImageChildNew, function(idx, child){
                            child.setAttribute('data-img', idx);
                        })
                    }
                })
            })

        })

        $('#images').change(function(e) {
            e.preventDefault()
            const {files} = e.target;
            for (let index = 0; index < files.length; index++) {
                const reader = new FileReader();
                reader.readAsDataURL(files[index]);
                reader.addEventListener('load', () => {
                    const img = `
                    <div class="item position-relative rounded-2" style="width: max-content;">
                        <img id="displayimg" src="${reader.result}" width="116" height="118" alt="" srcset="">
                        <span data-img="${index + 1}" data-item="${index + 1}" id="remove-list" class="remove-list position-absolute top-0 start-100 translate-middle badge border border-light border-2 rounded-circle bg-danger" style="z-index: 1">X</span>
                        <input name="img[]" value="${reader.result}" hidden>
                    </div>
                    `;
                    $('#list-images').append(img);
                });
            }
        })

        $('#list-images').on('click', '.item > span', function(e) {
            if ($(this).data('item')) {
                if(confirm("Delete new images ?")){
                    $(this).parent().remove()
                }
            }
        })
         // DELETE LINK
         $('.btn-delete').on('click', (e) => {
            e.preventDefault();
            if(confirm("Are you sure you want to delete this?")){
                $('#form-delete').submit();
            }
        })

    </script>
@endpush
