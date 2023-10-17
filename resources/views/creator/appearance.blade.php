@extends('layouts.master')
@push('style')
    <style>
        .form-group > span{
            user-select: none;
        }
        .form-group label{
            display: block;
        }

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
        img.profile-img{
            width: 150px;
            height: 150px;
        }
        .card-body .form-group:not(:nth-child(2)){
            margin-top: 16px;
        }
        label#custom {
            margin-top: 1.25rem;
            padding: 0.5rem 1rem;
            border: 2px dotted #ff7676;
            border-radius: 8px;
            cursor: pointer;
        }
    </style>
@endpush
@section('content')
    <section id="account">
        <div class="card border-0 px-1 mt-3">
            <div class="card-header bg-white">
                <span class="fs-5">Appearance Details</span>
            </div>
            <div class="card-body p-2">
                <form action="" method="post">
                    @csrf
                    <div class="form-group vstack align-items-center">
                        <img src="{{ asset('assets/user1.jpg') }}" style="width: 100%; height: 200px;" class="object-fit-cover card-img-top" alt="Cover profile">
                        <input class="form-control shadow-none mt-2" type="file" name="x" id="cover-image" hidden>
                        <label id="custom" for="cover-image">Upload Cover Profile <i data-feather="image"></i></label>
                    </div>
                    <div class="form-group vstack align-items-center">
                        <img src="{{ asset('assets/user1.jpg') }}" class="profile-img card-img-top rounded-circle border border-secondary-tertiary border-5" alt="Foto profile">
                        <input class="form-control shadow-none" type="file" name="x" id="profile-image" hidden>
                        <label id="custom" for="profile-image">Upload Foto Profile <i data-feather="image"></i></label>
                    </div>
                    <div class="form-group">
                        <label for="x">Deskripsi profile</label>
                        <textarea class="form-control shadow-none" name="x" id="x" cols="30" rows="2"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="theme_profile">Theme profile (*Default: Light)</label>
                        <div class="hstack gap-3 mt-2" id="theme_profile">
                            <label>
                                <input class="form-check-input" type="radio" name="theme" value="light" checked>
                                <img src="{{ asset('assets/light-theme.png') }}" width="164" height="164" alt="light">
                                <span>Light</span>
                            </label>
                            <label>
                                <input class="form-check-input" type="radio" name="theme" value="dark">
                                <img src="{{ asset('assets/dark-theme.png') }}" width="164" height="164" alt="dark">
                                <span>Dark</span>
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
