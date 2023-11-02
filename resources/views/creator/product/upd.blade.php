@extends('layouts.master')
{{-- @php 
use App\Enums\CtaEnum; 
use App\Enums\LayoutEnum; 
@endphp --}}
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
        label#custom {
        /* color: white; */
        /* padding: 0.5rem; */
        /* font-family: sans-serif;
        border-radius: 0.3rem; */
        /* cursor: pointer;
        margin-top: 1rem; */
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
            /* margin-top: 1.25rem; */
            padding: 2rem;
            border: 2px dotted #ff7676;
            border-radius: 8px;
            cursor: pointer;
            text-align: center;
        }
        #displayimg{
            cursor: pointer;
        }
    </style>
@endpush
@section('content')
    <section id="digital-produk">
        <div class="card border-0 pb-0">
            <div class="card-body">
                <h3>update produk new broo</h3>
                @dump($errors)
                <form action="{{ route('products.digitalupdate', $product->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    {{-- <div class="form-group hstack gap-3 justify-content-between align-items-center">
                        <div class="box position-relative rounded-2">
                            <img id="displaythumbnail" src="{{ asset('assets/user2.jpg') }}" class="position-relative rounded-1" style="width: 120px; height: 100px;">
                            <a href="#" id="removeimg" class="position-absolute top-0 start-100 translate-middle badge  border-light border-2 rounded-circle bg-danger p-2" style="z-index: 1"><i data-feather="x" class="fa-2"></i></a>
                        </div> 
                        <div class="form-upload">
                            <label id="custom" class="position-relative" for="thumbnail"><i data-feather="image"></i>Upload</label>
                            <input type="file" name="thumbnail" id="thumbnail" accept="image/*" multiple hidden>
                        </div>
                    </div> --}}

                    {{-- <div class="text">
                        @dump($product->images) --}}
                    </div>
                    <div class="form-group hstack mb-3">
                        <div id="list-images" class="mb-2 hstack flex-wrap gap-1">
                            {{-- @if ($product->images)
                                @foreach ($product->images as $key => $image)
                                <div class="item position-relative rounded-2" data-item="{{ $key }}" style="width: max-content;">
                                    <img id="displayimg" title="delete" data-img="{{ $key }}" src="{{ Storage::url('tes/'. $image) }}" width="116" height="118" alt="" srcset="">
                                    <span id="remove-list" title="delete" data-img="{{ $key }}" class="remove-list position-absolute top-0 start-100 translate-middle badge border-light border-2 rounded-circle bg-danger" style="z-index: 1">X</span>
                                    <input name="img[]" value="{{ $image }}" hidden>    
                                </div>
                                @endforeach
                            @endif --}}
                        </div>
                        <label for="images">Upload Images <i data-feather="image"></i></label>
                        <input type="file" name="images[]" id="images" accept="image/*" multiple hidden>
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
                        {{-- @dump($product->cta_text)
                        @foreach(CtaEnum::cases() as $cta)
                                @if ($cta == $product->cta_text)
                                    <p>oke {{ $cta }}</p>
                                @else
                                    <p>no</p>
                                @endif
                        @endforeach --}}
                        <select class="form-control mt-2 shadow-none" name="cta_text" id="cta_text">
                            {{-- <option value="0" {{ ($product->cta_text->value === App\Enums\CtaEnum::CTA_NO_OPTION->value) ? 'selected' : ''}}>I Want this</option>
                            <option value="1" {{ ($product->cta_text->value === App\Enums\CtaEnum::CTA_OPTION_1->value) ? 'selected' : ''}}>Support Creator</option>
                            <option value="2" {{ ($product->cta_text->value === App\Enums\CtaEnum::CTA_OPTION_2->value) ? 'selected' : ''}}>Beli Sekarang</option>
                            <option value="3" {{ ($product->cta_text->value === App\Enums\CtaEnum::CTA_OPTION_3->value) ? 'selected' : ''}}>Book Now</option> --}}
                            {{-- @foreach(CtaEnum::cases() as $cta)
                                <option value="{{ $cta }}" {{ ($product->cta_text === $cta) ? 'selected' : '' }}>{{ $cta }}</option>
                            @endforeach --}}
                            </select>
                        @if (session()->has('cta_text'))
                            <small class="text-danger">{{ session()->get('cta_text') }}</small>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="layout">Layout</label>
                        <div class="hstack gap-3 mt-2" id="layout">
                            <label>
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
                            </label>
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
    {{-- <script src="{{ asset('assets/vendor/bootstrap-5.3.1/js/dist/popover.js') }}"></script> --}}
    <script>
        const popoverCustomMessage = document.getElementById('popover-custom-message');
        const contentMessage = document.getElementById('popover-custom-content');

        const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
        const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))
        const thumbnailFile = document.getElementById('thumbnail');
        const imagesFile = document.getElementById('images');
        const listimage = document.getElementById('list-images');
        const removeList = document.querySelectorAll('#remove-list');

        popoverCustomMessage.addEventListener('click', (e) => {
            contentMessage.classList.toggle('d-block')
        })
        const popover = new bootstrap.Popover(popoverCustomMessage, {
            html: true,
            content: contentMessage,
        })

        $(document).ready(function(){
            $('#images').change(function(e) {
                e.preventDefault()
                const imageFiles = e.target.files;
                for (let index = 0; index < imageFiles.length; index++) {
                    const reader = new FileReader();
                    reader.readAsDataURL(imageFiles[index]);
                    reader.addEventListener('load', () => {
                        const img = `
                        <div class="item position-relative rounded-2" data-item="${index + 1}" style="width: max-content;">
                            <img id="displayimg" src="${reader.result}" width="116" height="118" alt="" srcset="">
                            <span data-img="${index + 1}" id="remove-list" class="remove-list position-absolute top-0 start-100 translate-middle badge border border-light border-2 rounded-circle bg-danger" style="z-index: 1">X</span>
                            <input name="img[]" value="${reader.result}" hidden>
                        </div>
                        `;
                        // <img id="displayimg" data-img="${index + 1}" src="${reader.result}" width="116" height="118" alt="" srcset="">
                        $('#list-images').append(img);
                        // console.log(reader.result);
                        // $('.text').append(`<p>${reader.readAsDataURL(imageFiles[index])}</p>`)
                        // const wrapper = document.createElement('div');
                        // wrapper.classList.add('item','position-relative','rounded-2')
                        // wrapper.style.width = 'max-content';
                        
                        // const img = document.createElement('img');
                        // img.setAttribute('id','displayimg')
                        // img.setAttribute('src',`${reader.result}`)
                        // img.setAttribute('width','116')
                        // img.setAttribute('height','118')
        
                        // const href = document.createElement('a');
                        
                        // href.textContent = 'X'
                        // href.setAttribute('id','remove-list')
                        // href.setAttribute('data-img',`${index + 1}`)
                        // href.classList.add('remove-list','position-absolute','top-0','start-100','translate-middle', 'badge' ,'border', 'border-light', 'border-2', 'rounded-circle', 'bg-danger','position-relative','rounded-2')
                        // href.setAttribute('href','www.google.com');
                        // href.style.zIndex = '1';
        
                        // wrapper.appendChild(img)
                        // wrapper.appendChild(href)
                        // listimage.appendChild(wrapper)
                    });
                }
            })
        })

         // DELETE LINK
         $('.btn-delete').on('click', (e) => {
            e.preventDefault();
            if(confirm("Are you sure you want to delete this?")){
                $('#form-delete').submit();
            }
        })
        function deleteImage(parent, image) {
            // if(confirm("Are you sure you want to delete this?")){
                parent.removeChild(image)
            // }
        }

        $('#list-images').on('click', (e) => {
            e.preventDefault();

            console.log('e');
            // $(this).on('click', (ev) => {
            //     // ev.preventDefault();
            //     // ev.stopImmediatePropagation();
            //     const dataImg = ev.target.dataset.img;
            //     if (dataImg) {
            //         if (listimage.hasChildNodes) {
            //             deleteImage(listimage, ev.target.parentElement);
            //             console.log('ok');
            //         }
            //     }
            // })
        })

    </script>
@endpush