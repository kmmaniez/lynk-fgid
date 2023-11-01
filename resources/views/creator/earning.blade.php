@extends('layouts.master')

@section('content')
    <section id="earning">
        <div class="card border-0 mt-3">
            <div class="card-body p-2">
    
                <div class="hstack justify-content-between mb-2">
                    <h4>Earnings</h4>
                    <a href="{{ route('creator.settlementhistory') }}" title="Manage Rekening Pembayaran" class="text-decoration-none text-success fw-medium"><i
                            data-feather="clock" style="width: 16px; height:16px;"></i> Settlement History</a>
                </div>
                {{-- @dump($data) --}}
                <div class="vstack gap-2">
                    <div class="card">
                        <div class="card-body text-center">
                            <h5 class="text-secondary text-uppercase">Earnings</h5>
                            <h5 class="text-success fw-bold">Rp. {{ number_format($total_earning,0,0,'.') }}</h5>
                        </div>
                    </div>
    
                    <div class="card">
                        <div class="card-body text-center pt-3 pb-0 px-0">
                            <h5 class="text-secondary text-uppercase">Last Payment</h5>
                            <h5 class="text-success fw-bold">Rp. {{ number_format($settlements->payout_amount,0,0,'.') }}</h5>
    
                            <div class="hstack justify-content-evenly border border-end py-3 mt-3 w-100">
                                <div class="last-payment">
                                    <span class="d-block text-secondary">Estimate Payout</span>
                                    <span class="fw-semibold">Rp. {{ number_format($estimate_payout,0,0,'.') }}</span>
                                    {{-- <span class="fw-semibold">Rp. 200.000</span> --}}
                                    {{-- <span class="fw-semibold">Rp. {{ 200000 - (200000 * 0.05)  }}</span> --}}
                                </div>
                                <div class="next-payment">
                                    <span class="d-block text-secondary">Next Payment</span>
                                    {{-- <span class="fw-semibold">30 Sep 2023</span> --}}
                                    <span class="fw-semibold">{{ \Carbon\Carbon::now()->addMonth()->translatedFormat('d M Y') }}</span>
                                </div>
                            </div>
    
                            <div class="fees w-100 py-2 bg-danger-subtle">
                                <small class="text-dark">Fee 5% from total withdrawal.</small>
                            </div>
    
                            <div class="manual-withdraw py-2">
                                <span class="d-block">Dont't wait until next payment?</span>
                                <a href="" class="text-decoration-none">Withdraw manual</a>
                            </div>
                        </div>
                    </div>
                </div>
    
                <div class="vstack mt-3">
                    <div class="card">
                        <div class="card-header bg-transparent">
                            <div class="hstack justify-content-between">
                                <span>Rekening Pembayaran</span>
                                <a href="{{ route('profile.manage-rekening') }}" title="Manage Rekening Pembayaran"
                                    class="text-decoration-none text-success fw-medium"><i data-feather="credit-card"
                                        style="width: 16px; height:16px;"></i> Manage Rekening</a>
                            </div>
                        </div>
                        <div class="card-body">
                            @if ($user->banks)
                                <p><strong>{{ $user->banks->bank_name }}</strong> | {{ $user->banks->bank_number }} A/n {{ $user->banks->bank_account_name }}</p>
                                {{-- @dump($user->banks) --}}
                            @else
                                <small class="text-secondary">anda belum mengatur rekening pembayaran</small>
                            @endif
                        </div>
                    </div>
    
                </div>
    
            </div>
        </div>
    </section>
@endsection
