@extends('layouts.creator')

@section('content')
    <section id="earning">
        <div class="card border-0 mt-3">
            <div class="card-body p-2">

                <div class="hstack justify-content-between mb-2">
                    <h4>Earnings</h4>
                    <a href="{{ route('creator.settlementhistory') }}" title="Manage Rekening Pembayaran"
                        class="text-decoration-none text-success fw-medium"><i data-feather="clock"
                            style="width: 16px; height:16px;"></i> Settlement History</a>
                </div>
                {{-- @dump($data) --}}
                <div class="vstack gap-2">
                    <div class="card">
                        <div class="card-body text-center">
                            <h5 class="text-secondary text-uppercase">Earnings</h5>
                            <h5 class="text-success fw-bold">Rp. {{ number_format($total_earning, 0, 0, '.') }}</h5>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body text-center pt-3 pb-0 px-0">
                            <h5 class="text-secondary text-uppercase">Last Payment</h5>
                            <h5 class="text-success fw-bold">Rp.
                                {{ !isset($settlements->payout_amount) ? 0 : number_format($settlements->payout_amount, 0, 0, '.') }}
                            </h5>

                            <div class="hstack justify-content-evenly border border-end py-3 mt-3 w-100">
                                <div class="last-payment">
                                    <span class="d-block text-secondary">Estimate Payout</span>
                                    <span class="fw-semibold">Rp. {{ number_format($estimate_payout, 0, 0, '.') }}</span>
                                </div>
                                <div class="next-payment">
                                    <span class="d-block text-secondary">Next Payment</span>
                                    <span class="fw-semibold">{{ $date->format('d') }}
                                        {{ $date->addMonth()->shortMonthName }} {{ $date->year }}</span>
                                </div>
                            </div>

                            <div class="fees w-100 py-2 bg-danger-subtle">
                                <small class="text-dark">Fee 5% from total withdrawal.</small>
                                <button type="button" class="btn btn-sm border-0" data-bs-container="body"
                                    data-bs-toggle="popover" data-bs-placement="top"
                                    data-bs-content="Example: If your request withdrawal Rp 50.000, fee is Rp 2.500. You'll receive Rp 47.500">
                                    <i data-feather="info"></i>
                                </button>
                            </div>

                            <div class="manual-withdraw py-2">
                                <span class="d-block">Dont't wait until next payment?</span>
                                <a href="#" class="text-decoration-none">Withdraw manual</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="vstack mt-3">
                    <div class="card">
                        <div class="card-header bg-transparent">
                            <div class="hstack justify-content-between">
                                <span>Bank Withdrawal</span>
                                <a href="{{ route('profile.manage-rekening') }}" title="Manage Rekening Pembayaran"
                                    class="text-decoration-none text-success fw-medium"><i data-feather="credit-card"
                                        style="width: 16px; height:16px;"></i> Manage Withdrawal Accounts</a>
                            </div>
                        </div>
                        <div class="card-body">
                            @if ($user->banks)
                                <p><strong>{{ $user->banks->bank_name }}</strong> | {{ $user->banks->bank_number }} A/n
                                    {{ $user->banks->bank_account_name }}</p>
                            @else
                                <small class="text-secondary fw-semibold">We only process your withdrawal if you already settings bank account.</small>
                            @endif
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]');
        const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl));
    </script>
@endpush
