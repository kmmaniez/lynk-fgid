@extends('layouts.creator')
@push('style')
    <style>
        input[type="text"]{
            border: 1px solid transparent;
            border-radius: 4px;
        }
        input.form-control:focus{
            border: 1px solid #3c3c3c;
            box-shadow: none;
        }
    </style>
@endpush
@section('content')
    <div class="tab-content mt-3" id="myTabContent">
        <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
            <div class="card-body">
                <form action="" method="post">
                    <div class="form-group">
                        <input type="file">
                        <i data-feather="image"></i>
                    </div>
                </form>
                <div class="">
                    <input type="text" class="form-control w-auto" name="title_link" id="title" placeholder="Title Here">
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control w-auto" name="url_link" id="title" placeholder="URL Here">
                </div>
            </div>
        </div>
    </div>

@endsection
