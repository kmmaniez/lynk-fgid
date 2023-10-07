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
                <form action="" method="post">
                    @csrf
                    <div class="form-group mb-3">
                        <label id="custom" for="upload">Upload gambar <i data-feather="image"></i></label>
                        <input type="file" id="upload" hidden>
                    </div>
    
                    <div class="mb-3">
                        <label for="formGroupExampleInput" class="form-label">Nama Produk</label>
                        <input type="text" class="form-control" name="title_link" id="title" placeholder="Nama Produk">
                    </div>
    
                    <div class="mb-3">
                        <label for="formGroupExampleInput" class="form-label">Deskripsi Produk</label>
                        <input type="text" class="form-control" name="url_link" id="title"
                            placeholder="Deskripsi Produk">
                    </div>
    
                    <div class="mb-3 py-2">
                        <label for="formGroupExampleInput" class="form-label">Link File/Produk</label>
                        <input type="url" class="form-control" id="formGroupExampleInput"
                            placeholder="drive.google.com/file/fgid">
                    </div>
    
                    <div class="form-group mb-3">
                        <div class="row">
                            <div class="col-sm-12">
                                <label for="formGroupExampleInput" class="form-label">Harga Minimal</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text text-secondary" id="basic-addon1">Rp</span>
                                    <input type="number" min="1000" step="100" class="form-control" placeholder="1000"
                                        aria-label="Username" aria-describedby="basic-addon1">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <label for="formGroupExampleInput" class="form-label">Harga Rekomendasi</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text text-secondary" id="basic-addon1">Rp</span>
                                    <input type="number" min="1500" step="100" class="form-control" placeholder="1500"
                                        aria-label="Username" aria-describedby="basic-addon1">
                                </div>
                            </div>
                        </div>
                        <small style="font-size: 14px;" class="text-success"><em>Harga rekomendasi <strong>harus lebih besar
                                    dari minimal harga</strong></em></small>
                    </div>
                    <div class="mb-3">
                        <div class="popover-group">
                            <label for="exampleFormControlTextarea1" class="form-label">Pesan Customer</label>
                            <button type="button" id="popover-custom-message" class="btn btn-sm border-0"
                                data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top">
                                <i data-feather="info"></i>
                            </button>
                            <div id="popover-custom-content">
                                <img src="{{ asset('assets/user1.jpg') }}" class="w-100">
                                <span class="">Pesan ini akan dikirim ke customer, setelah melakukan pembayaran.</span>
                            </div>
                        </div>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
    
                    <div class="mb-3">
                        <div class="popover-group">
                            <label for="">Kalimat Call To Action</label>
                            <button type="button" class="btn btn-sm border-0" data-bs-container="body" data-bs-toggle="popover"
                                data-bs-placement="top" data-bs-content="Kalimat ini untuk mengajak membeli produk anda">
                                <i data-feather="info"></i>
                            </button>
                        </div>
                        <select class="form-control mt-2 shadow-none" name="" id="">
                            <option class="d-none" value="">Pilih Kalimat CTA</option>
                            <option value="">Beli Sekarang</option>
                            <option value="">Saya mau ini</option>
                            <option value="">Support creator</option>
                        </select>
                    </div>

                    {{-- <div class="mb-3">
                        <label for="" class="d-block">Style</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                            <label class="form-check-label" for="inlineRadio1">1</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                            <label class="form-check-label" for="inlineRadio2">2</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3" disabled>
                            <label class="form-check-label" for="inlineRadio3">3 (disabled)</label>
                          </div>
                    </div> --}}

                    <div class="mb-2 pb-2">
                        <span class="d-block mb-2">Pilih Layout Produk</span>

                        <div class="hstack gap-3">
                            <label>
                                <input class="form-check-input" type="radio" name="test" value="small">
                                <img src="{{ asset('assets/default-col.png') }}" width="164" height="164" alt="Option 1">
                              </label>
                              
                              <label>
                                <input class="form-check-input" type="radio" name="test" value="big">
                                <img src="{{ asset('assets/grid.png') }}" width="164" height="164" alt="Option 2">
                              </label>
                              
                              <label>
                                <input class="form-check-input" type="radio" name="test" value="big">
                                <img src="{{ asset('assets/large-image.png') }}" width="164" height="164" alt="Option 2">
                              </label>

                        </div>
                    </div>
    
                    <div class="vstack w-100">
                        <button class="btn bg-success bg-gradient text-white w-100">Tambah Produk</button>
                        <a href="{{ route('admin') }}" class="btn w-100 fw-medium">Cancel</a>
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
