@extends('layouts.master')

@push('style')
    <style>
        input.form-control {
            margin: 0;
            border: none;
            border-bottom: 1px solid #3c3c3c5c;
            border-radius: 0px;
        }
    </style>
@endpush
@section('content')
    <section id="manage-rekening">

        <div class="card border-0">
            <div class="card-body p-2">
                <h4>Manage Earnings</h4>
                <div class="vstack mt-3">
                    <div class="card">
                        <div class="card-header bg-transparent">
                            <h5 class="text-secondary">Indonesian Bank Transfer</h5>
                        </div>
                        <div class="card-body pb-4">
                            <form action="{{ route('profile.update-rekening') }}" method="post">
                                @csrf
                                @method('PATCH')
                                <div class="form-group">
                                    <label for="bank_name">Bank Name</label>
                                    <select class="form-control shadow-none" name="bank_name" id="bank_name">
                                        <option value="">-- Choose Bank Name --</option>
                                        <option value="BCA" {{ $user->banks?->bank_name === 'BCA' ? 'selected' : '' }}>
                                            BCA</option>
                                        <option value="BRI" {{ $user->banks?->bank_name === 'BRI' ? 'selected' : '' }}>
                                            BRI</option>
                                        <option value="BNI" {{ $user->banks?->bank_name === 'BNI' ? 'selected' : '' }}>
                                            BNI</option>
                                        <option value="MANDIRI"
                                            {{ $user->banks?->bank_name === 'MANDIRI' ? 'selected' : '' }}>MANDIRI
                                        </option>
                                        <option value="OVO" {{ $user->banks?->bank_name === 'OVO' ? 'selected' : '' }}>
                                            OVO</option>
                                        <option value="DANA"
                                            {{ $user->banks?->bank_name === 'DANA' ? 'selected' : '' }}>DANA</option>
                                    </select>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="bank_number">Bank Number</label>
                                    <input class="form-control @error('bank_number') is-invalid @enderror shadow-none"
                                        placeholder="122333" min="1" type="number" name="bank_number"
                                        id="bank_number" value="{{ old('bank_number', $user->banks?->bank_number) }}">
                                    @error('bank_number')
                                        <small class="text-danger d-block">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group mt-3">
                                    <label for="bank_account_name">Bank Account Name</label>
                                    <input class="form-control @error('bank_account_name') is-invalid @enderror shadow-none"
                                        placeholder="Dadang.." type="text" name="bank_account_name"
                                        id="bank_account_name"
                                        value="{{ old('bank_account_name', $user->banks?->bank_account_name) }}">
                                    @foreach ($errors->get('bank_account_name') as $message)
                                        <small class="text-danger">
                                            @if (is_array($message))
                                                @foreach ($message as $error)
                                                    <small class="d-block text-danger mt-1">{{ $error }}</small>
                                                @endforeach
                                            @else
                                                <small class="d-block text-danger mt-1">{{ $message }}</small>
                                            @endif
                                        </small>
                                    @endforeach
                                </div>
                                <div class="vstack mt-3 gap-2">
                                    <button
                                        class="btn btn-md bg-danger fw-semibold text-uppercase bg-gradient text-white">{{ $user->banks ? 'Update Bank Account' : 'Save Bank Account' }}</button>
                                    <a href="{{ route('creator') }}" class="btn btn-md">Back</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
