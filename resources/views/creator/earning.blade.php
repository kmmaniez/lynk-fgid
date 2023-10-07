@extends('layouts.master')

@section('content')
    <section id="earning">
        <div class="card border-0 mt-3">
            <div class="card-body p-2">
    
                <div class="hstack justify-content-between mb-2">
                    <h4>Earnings</h4>
                    <a href="/history" title="Manage Rekening Pembayaran" class="text-decoration-none text-success fw-medium"><i
                            data-feather="clock" style="width: 16px; height:16px;"></i> Settlement History</a>
                </div>
    
                <div class="vstack gap-2">
                    <div class="card">
                        <div class="card-body text-center">
                            <h5 class="text-secondary text-uppercase">Earnings</h5>
                            <h5 class="text-success fw-bold">Rp. 2.150.000</h5>
                        </div>
                    </div>
    
                    <div class="card">
                        <div class="card-body text-center pt-3 pb-0 px-0">
                            <h5 class="text-secondary text-uppercase">Estimate Payout</h5>
                            <h5 class="text-success fw-bold">Rp. 2.150.000</h5>
    
                            <div class="hstack justify-content-evenly border border-end py-3 mt-3 w-100">
                                <div class="last-payment">
                                    <span class="d-block text-secondary">Last Payment</span>
                                    <span class="fw-semibold">Rp. 500.000</span>
                                </div>
                                <div class="next-payment">
                                    <span class="d-block text-secondary">Next Payment</span>
                                    <span class="fw-semibold">30 Sep 2023</span>
                                </div>
                            </div>
    
                            <div class="fees w-100 py-2" style="background-color: lightblue">
                                <small class="text-success">Pemotongan 5% dari total transaksi penarikan</small>
                            </div>
    
                            <div class="manual-withdraw py-2" style="background-color: lightcyan">
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
                                <span class="fs-5">Rekening Pembayaran</span>
                                <a href="{{ route('manage-rekening') }}" title="Manage Rekening Pembayaran"
                                    class="text-decoration-none text-success fw-medium"><i data-feather="credit-card"
                                        style="width: 16px; height:16px;"></i> Manage Rekening</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <small class="text-secondary">anda belum mengatur rekening pembayaran</small>
                        </div>
                    </div>
    
                </div>
    
            </div>
        </div>
    </section>
@endsection
