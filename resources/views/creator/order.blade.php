@extends('layouts.creator')
@push('style')
    <style>
        .copied::after {
            content: 'Copied';
            width: max-content;
            height: max-content;
            padding: 4px 8px;
            font-size: 12px;
            background-color: salmon;
            border-radius: 6px;
            position: absolute;
            top: -32px;
            left: -8px;
        }

        .copied::before {
            content: '';
            width: 16px;
            height: 16px;
            background-color: salmon;
            border-radius: 4px;
            position: absolute;
            top: -16px;
            transform: rotate(45deg);
        }
    </style>
@endpush
@section('content')
    <section id="order" class="mt-3">
        <div class="card border-0 mt-3">
            <div class="card-body p-2">
                <h5>History Order</h5>

                <div id="list-transaction" class="vstack w-100 gap-2">
                    @forelse ($transactions as $transact)
                        <div class="card">
                            <div class="card-body">
                                <div class="detail">
                                    <span class="fw-semibold">Date : {{ $transact->transaction_created }}</span>
                                    <div class="list-item">
                                        <span class="">Detail Item :</span>
                                        {{-- <span>{{ $transact->products[0]->name }} ({{ $transact->total_item }}x) | Rp. {{ $transact->total_price }}</span> --}}
                                        <ul class="m-0">
                                            <li>{{ $transact->products[0]->name }} ({{ $transact->total_item }}x)</li>
                                            {{-- <li>Joki Valorant ({{ rand(1,10) }}x) | Rp. {{ rand(1,10) }}0.000</li> --}}
                                        </ul>
                                    </div>
                                    <span class="d-block mt-2"><strong>Total : Rp.
                                            {{ number_format($transact->total_price, 0, 0, '.') }}</strong></span>
                                    <div class="customer-field hstack gap-3">
                                        <div id="copy" class="fw-semibold">Customer Email : <span
                                                id="email">{{ $transact->customer_info }}</span></div>
                                        <a href="#" id="btnCopy" title="copy email"
                                            class="position-relative btn border-0"><i data-feather="copy"
                                                data-id="{{ $transact->product_id }}" class="fa-24 text-danger"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="card"></div>
                    @endforelse
                    {{-- {{ $transactions->links() }} --}}
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        const btnCopy = document.querySelectorAll('#btnCopy');
        const email = $('#list-transaction #emailcopy');

        btnCopy.forEach(element => {
            element.addEventListener('click', (e) => {
                e.preventDefault()
                let text = element.previousElementSibling.children[0].textContent;
                try {
                    navigator.clipboard.writeText(text)
                    element.classList.toggle('copied')
                    setTimeout(() => {
                        element.classList.remove('copied')
                    }, 1500);
                } catch (error) {
                    console.error('Failed to copy');
                }
            })
        });
    </script>
@endpush
