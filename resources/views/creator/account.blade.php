@extends('layouts.master')
@push('style')
    <style>
        .form-group > span{
            user-select: none;
        }
    </style>
@endpush
@section('content')
    <section id="account">
        <div class="card border-0 mt-3">
            <div class="card-body p-2">
    
                <div class="card">
                    <div class="card-header bg-transparent">
                        <span class="fs-5">Account Details</span>
                    </div>
                    <div class="card-body pb-4">
                        <form action="" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="x">Username</label>
                                <span class="d-block mt-2">@awkarin</span>
                            </div>
                            <div class="form-group mt-3">
                                <label for="x">Email</label>
                                <span class="d-block mt-2">aw@gmail.com</span>
                            </div>
                            <div class="form-group mt-3">
                                <label for="x">Name</label>
                                <input class="form-control shadow-none" value="Ahmad" type="text" name="x"
                                    id="x">
                            </div>
                            <div class="form-group mt-3">
                                <label for="x">Phone</label>
                                <input class="form-control shadow-none" pattern="^0-9" type="number" name="x"
                                    id="x" required>
                            </div>
                            <div class="form-group mt-3 mb-3">
                                <label for="x">Address</label>
                                <input class="form-control shadow-none" placeholder="Alamat anda" value="" type="text" name="x"
                                    id="x">
                            </div>
                            <button class="btn btn-md btn-success w-100">Simpan</button>
                        </form>
                    </div>
                </div>
    
                <div class="vstack mt-3">
                    <div class="card">
                        <div class="card-header bg-transparent">
                            <span class="fs-5">Delete Account</span>
                        </div>
                        <div class="card-body">
                            <small>Jika ingin menghapus akun, klik tombol dibawah. <strong>akun yang sudah dihapus tidak dapat
                                    diregistrasi ulang!</strong></small>
                            {{-- <form action="" method="post">
                                @csrf --}}
                                <a href="#" class="btn btn-outline-danger btn-md w-100 mt-2">Hapus Akun</a>
                            {{-- </form> --}}
                        </div>
                    </div>
    
                </div>
    
            </div>
        </div>
    </section>
@endsection
