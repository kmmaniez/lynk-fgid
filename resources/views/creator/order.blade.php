@extends('layouts.master')

@section('content')
    <section id="order" class="mt-3">
        <div class="card border-0 mt-3">
            <div class="card-body p-2">
                <h5>History Order</h5>
                <div class="vstack w-100 gap-2">
                    @for ($i=0; $i < 10; $i++)
                    <div class="card">
                        <div class="card-body">
                            <div class="detail">
                                {{-- <span class="fw-semibold">Tanggal : 24/10/2023</span> --}}
                                <div class="list-item">
                                    <span class="">Detail Item :</span>
                                    <span>Joki Valorant ({{ rand(1,10) }}x) | Rp. {{ rand(1,10) }}0.000</span>
                                    <ul class="m-0">
                                        {{-- <li>Joki Valorant ({{ rand(1,10) }}x) | Rp. {{ rand(1,10) }}0.000</li> --}}
                                        {{-- @if ($i%3===0)
                                        <li>Jasa Social Media (4x) | Rp. 5.000</li>
                                        @endif --}}
                                    </ul>
                                </div>
                                <span class="d-block"><strong>Total : Rp. 25.000</strong></span>
                                <span><strong>Email pelanggan : {{ Str::random(5) }}@gmail.com</strong></span>
                                {{-- <span><i data-feather="copy" class="fa-24 text-primary"></i></span> --}}
                            </div>
                        </div>
                    </div>
                    @endfor
                </div>
            </div>
        </div>
    </section>
@endsection
