@extends('layouts.creator')
@push('style')
    <style>
        .form-group>span {
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
                        <form action="{{ route('profile.update') }}" method="post">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input class="form-control @error('username') is-invalid @enderror shadow-none"
                                    value="{{ old('username', $user->username) }}" type="text" name="username"
                                    id="username">
                                @error('username')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group mt-3">
                                <label for="email">Email</label>
                                <input class="form-control @error('email') is-invalid @enderror shadow-none"
                                    value="{{ $user->email }}" type="email" name="email" id="email">
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group mt-3">
                                <label for="name">Full Name</label>
                                <input class="form-control @error('name') is-invalid @enderror shadow-none"
                                    value="{{ $user->name }}" type="text" name="name" id="name">
                            </div>
                            <div class="form-group mt-3">
                                <label for="phone">Phone Number</label>
                                <input class="form-control @error('phone') is-invalid @enderror shadow-none"
                                    value="{{ old('username', $user->phone) }}" pattern="^0-9" type="number" name="phone"
                                    id="phone" required>
                                @error('phone')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <button
                                class="btn btn-md bg-danger bg-gradient text-white fw-semibold text-uppercase w-100 mt-3">Update
                                Account</button>
                        </form>
                    </div>
                </div>

                <div class="vstack mt-3">
                    <div class="card">
                        <div class="card-header bg-transparent">
                            <span class="fs-5">Delete Account</span>
                        </div>
                        <div class="card-body">
                            <form id="form-delete-account" method="post" action="{{ route('profile.destroy') }}"
                                class="p-6">
                                @csrf
                                @method('delete')
                                <small>If you want delete your account, click button below. <strong>Deleted account can't be
                                        registered again!</strong></small>
                                <a href="#"
                                    class="btn btn-delete-account btn-outline-danger btn-md text-uppercase w-100 mt-2">Delete
                                    Account</a>
                            </form>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        $('.btn-delete-account').on('click', (e) => {
            // e.preventDefault();
            if (confirm("Are you sure to delete your account?")) {
                $('#form-delete-account').submit()
            }
        })
    </script>
@endpush
