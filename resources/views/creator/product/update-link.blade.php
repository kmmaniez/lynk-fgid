@extends('layouts.master')
@php 
use App\Enums\LayoutEnum; 
@endphp
@push('style')
    <style>
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
            outline: 1px solid #e16f6f;
            border-radius: 8px;
            box-shadow: 0 0 8px #ff9090;
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
        #thumbnaildisplay{
            display: none;
            position: absolute;
            /* opacity: 0.5; */
        }
        svg.fa-2{
            width: 14px;
            height: 14px;
            color: #fff;
        }
        .box{
            width: max-content;
            height: max-content;
            /* display: none; */
            padding: 4px;
            background-color: #eaeaea;
        }
    </style>
@endpush
@section('content')
    <section id="create-link" class="">
        <div class="card border-0">
            <div class="card-body">
                <h3>Create Link</h3>
                
                <form id="form" action="{{ route('products.linkupdate', $product->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="form-group hstack gap-3 justify-content-between align-items-center">
                        @if ($product->thumbnail)
                        <div class="box position-relative rounded-2">
                            <img id="displaythumbnail" src="{{ Storage::url($product->thumbnail) }}" class="position-relative rounded-1" style="width: 120px; height: 100px;">
                            <a href="#" id="removeimg" class="position-absolute top-0 start-100 translate-middle badge border border-light border-2 rounded-circle bg-danger p-2" style="z-index: 1"><i data-feather="x" class="fa-2"></i></a>
                        </div> 
                        @else
                        <div class="box position-relative rounded-2" style="display: none">
                            <img id="displaythumbnail" class="position-relative rounded-1" style="width: 120px; height: 100px;">
                            <a href="#" id="removeimg" class="position-absolute top-0 start-100 translate-middle badge border border-light border-2 rounded-circle bg-danger p-2" style="z-index: 1"><i data-feather="x" class="fa-2"></i></a>
                        </div> 
                        @endif
                        <div class="form-upload" style="{{ ($product->thumbnail) ? 'display:none;' : 'display:block;' }}">
                            <label id="custom" class="position-relative" for="thumbnail"><i data-feather="image"></i>Upload</label>
                            <input type="file" name="thumbnail" id="thumbnail" accept="image/*" hidden>
                        </div>
                        <img id="thumbnaildisplay" class="" alt="" srcset="">
                        <div class="form-input vstack justify-content-around w-100">
                            <input type="text" class="form-control" value="{{ $product->name }}" name="name" id="name">
                            <input type="url" class="form-control" value="{{ $product->url }}" name="url" id="url">
                        </div>
                    </div>
                    <div class="form-group my-3">
                        <label for="layout">Layout</label>
                        <div class="hstack gap-3 mt-2" id="layout">
                            @php
                                $arrAsset = ['assets/default-col.png','assets/grid.png','assets/large-image.png']
                            @endphp
                            @foreach(LayoutEnum::cases() as $key => $layout)
                            @if ($key != 1)
                                
                            <label>
                                <input class="form-check-input" type="radio" name="layout" value="{{ $layout }}" {{ ($product->layout === $layout) ? 'checked' : '' }}>
                                <img src="{{ asset($arrAsset[$key]) }}" width="164" height="164" alt="default">
                                <span>{{ Str::ucfirst($layout->value) }}</span>
                            </label>
                            @endif
                            @endforeach
                            {{-- <label>
                                <input class="form-check-input" type="radio" name="layout" value="default" {{ ($product->layout == "default") ? 'checked' : '' }}>
                                <img src="{{ asset('assets/default-col.png') }}" width="164" height="164" alt="default">
                                <span>Small</span>
                            </label>
                            <label>
                                <input class="form-check-input" type="radio" name="layout" value="large" {{ ($product->layout == "large") ? 'checked' : '' }}>
                                <img src="{{ asset('assets/large-image.png') }}" width="164" height="164" alt="large">
                                <span>Large image</span>
                            </label> --}}
                        </div>
                    </div>
                    
                    <button class="btn btn-md bg-danger bg-gradient text-white fw-semibold text-uppercase w-100 mt-2">Update Link</button>
                </form>
                
                <div class="vstack gap-2 mt-2">
                    <form id="form-delete" action="{{ route('products.linkdestroy', $product->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <a href="#" class="btn btn-delete btn-md btn-outline-danger fw-semibold text-uppercase w-100">Delete Link</a>
                    </form>
                    <a href="{{ route('admin') }}" class="btn w-100 fw-medium">Back</a>
                </div>
            </div>
        </div>
    </section>

@endsection
@push('scripts')
    <script>
        // REMOVE PREVIEW
        $('#removeimg').on('click', (e) => {
            e.preventDefault();
            if(confirm("Are you sure you want to delete this?")){
                $("#thumbnail").val(null);
                $('#thumbnaildisplay').css('display','none');
                $('.box').css('display','none');
                $('.form-upload').css('display','block');
                console.log('{{ $product->id }}');
                $.ajax({
                    url: '/delete-image/' + '{{ $product->id }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        user_id: '{{ $user->id }}'
                    },
                    success: (res) => {
                        console.log(res);
                    },
                    error: (res) => {
                        console.log(res);
                    }
                })
            }
        })
        // DELETE LINK
        $('.btn-delete').on('click', (e) => {
            e.preventDefault();
            if(confirm("Are you sure you want to delete this?")){
                $('#form-delete').submit();
            }
        })

        // DISPLAY PREVIEW
        $('#thumbnail').change(function() {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('.box').css('display','block');
                $('.form-upload').css('display','none');

                $('#displaythumbnail').attr('src', e.target.result);
                $('#thumbnaildisplay').attr('src', e.target.result);
                $('#thumbnaildisplay').css({
                    'display':'block',
                    'width':'120px',
                    'height':'100px'
                })
            }
            reader.readAsDataURL(this.files[0]);
        });
    </script>
@endpush