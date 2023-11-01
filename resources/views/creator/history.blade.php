@extends('layouts.master')

@section('content')
    <section id="history">
        <div class="card border-0 mt-3">
            <div class="card-body p-2">
                <h4>Settlements History</h4>

                <div class="vstack gap-3 mt-3">
                    @foreach ($settlements as $data)
                    <div class="card border-0">
                        <div class="card-body  p-2 border-start border-danger border-5">
                            <span class="d-block fw-semibold">{{ \Carbon\Carbon::parse($data->payout_date)->translatedFormat('l') }}, {{ $data->payout_date }}</span>
                            <span>Rp. {{ number_format($data->payout_amount,0) }}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
