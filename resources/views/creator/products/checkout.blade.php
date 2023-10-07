{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap5/css/bootstrap.min.css') }}">
    <style>
        section#produk{
           top: 4rem; 
           bottom:0; 
           right:0; 
           z-index:-1;
           height: calc(100vh - 4rem);
        }
        @media (max-width: 768px) {
            section#produk{
                width: 100%;
            }
        }
        body{
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #eaeaea;
        }
        #wrapper{
            position: relative;
            height: 100vh;
            width: 800px;
        }
    </style>
</head>

<body>
    <div id="wrapper" class="bg-white p-0" style="">
        <nav class="navbar border-bottom navbar-expand-lg ps-3 d-flex justify-content-between" style="height: 4rem;">
            <a class="navbar-brand" href="{{ route('admin') }}">
                <img src="{{ asset('assets/logo.png') }}" alt="Logo" width="150"
                    class="d-inline-block align-text-top">
            </a>
        </nav>

        <section id="produk" class="">
            <div class="card border-0 h-100">
                <div class="card-body">

                    <div class="card">
                        <div class="card-body">
                            <small>Order Summary</small>

                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>Total Item</td>
                                        <td class="text-end">4 items</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="item">
                                                <span>List Item</span>
                                                <ol class="mt-2">
                                                    <li><span>Char PB (1x)</span></li>
                                                    <li><span>Valorant cheat (2x)</span></li>
                                                    <li><span>Ninja Saga (1x)</span></li>
                                                </ol>
                                            </div>
                                        </td>
                                        <td class="text-end">
                                            <div class="item">
                                                <span class="invisible">4</span>
                                                <ul class="mt-2" style="list-style-type: none;">
                                                    <li><span>Rp. 20.000</span></li>
                                                    <li><span>Rp. 10.000</span></li>
                                                    <li><span>Rp. 30.000</span></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Fee platform</td>
                                        <td class="text-end">Rp. 10.000</td>
                                    </tr>
                                    <tr>
                                        <th>Total</th>
                                        <td class="text-end fw-bold">Rp. 30.000</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card border-0 mt-2">
                        <div class="card-body">
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input class="form-control shadow-none" type="email" name="" id="">
                                </div>
                                <div class="form-group mt-2">
                                    <label for="">Nama</label>
                                    <input class="form-control shadow-none" type="text" name="" id="" required>
                                </div>

                                <div class="payment-method">
                                    <div class="form-group">
                                        <label for="">Nama</label>
                                        <input type="radio" class="form-control" name="" id="">
                                        <input type="radio" class="form-control" name="" id="">
                                        <input type="radio" class="form-control" name="" id="">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>


                </div>
                <div class="card-footer border-0 mb-5">
                        <a href="#" id="btnAddToCart" class="btn btn-success bg-success bg-gradient w-100">Bayar Sekarang - Rp. 30.0000</a>

                </div>
            </div>
        </section>
        
    </div>

    <script src="{{ asset('assets/vendor/bootstrap5/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('assets') }}/vendor/jquery/jquery.min.js"></script>
    <script src="{{ asset('assets') }}/vendor/jquery-easing/jquery.easing.min.js"></script>

</body>
    <script>
    </script>
</html> --}}
@extends('layouts.products')
@push('styles')
    <style>

        .kotak{
            width: 100px;
            height: 50px;
            background-color: salmon;
        }
    </style>
@endpush
@section('produk')
    <section id="produk" class="">
        <div class="card border-0 h-100">
            <div class="card-body">

                <div class="card">
                    <div class="card-body">
                        <small>Order Summary</small>

                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Total Item</td>
                                    <td class="text-end">4 items</td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="p-0">
                                        <div class="accordion" id="accordionPanelsStayOpenExample">
                                            <div class="accordion-item border-0">
                                                <h2 class="accordion-header">
                                                    <button class="accordion-button bg-white  shadow-none" type="button"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
                                                        aria-controls="panelsStayOpen-collapseOne">
                                                        List Item
                                                    </button>
                                                </h2>
                                                <div id="panelsStayOpen-collapseOne"
                                                    class="accordion-collapse collapse show">
                                                    <div class="accordion-body py-0 px-2">

                                                        <div class="hstack justify-content-between">
                                                            <ol class="mt-2">
                                                                <li><span>Char PB (1x)</span></li>
                                                                <li><span>Valorant cheat (2x)</span></li>
                                                                <li><span>Ninja Saga (1x)</span></li>
                                                            </ol>
    
                                                            <ul class="mt-2" style="list-style-type: none">
                                                                <li><span>Rp. 20.000</span></li>
                                                                <li><span>Rp. 10.000</span></li>
                                                                <li><span>Rp. 30.000</span></li>
                                                            </ul>

                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    {{-- <td class="text-end">
                                        <div class="item">
                                            <span class="invisible">4</span>
                                            <ul class="mt-2" >
                                                <li><span>Rp. 20.000</span></li>
                                                <li><span>Rp. 10.000</span></li>
                                                <li><span>Rp. 30.000</span></li>
                                            </ul>
                                        </div>
                                    </td> --}}
                                </tr>
                                <tr>
                                    <td>Fee platform</td>
                                    <td class="text-end">Rp. 10.000</td>
                                </tr>
                                <tr>
                                    <th>Total</th>
                                    <td class="text-end fw-bold">Rp. 30.000</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card border-0 mt-2">
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="">Email</label>
                                <input class="form-control shadow-none" type="email" name="" id="">
                            </div>
                            <div class="form-group mt-2">
                                <label for="">Nama</label>
                                <input class="form-control shadow-none" type="text" name="" id=""
                                    required>
                            </div>

                            <div class="payment-method mt-2">
                                <div class="form-group">
                                    <label for="">Payments</label>

                                    <div class="hstack gap-2">

                                        <div class="kotak">QRIS</div>
                                        <div class="kotak">OVO</div>
                                        <div class="kotak">SHOPE</div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>


            </div>
            <div class="card-footer border-0 mb-5">
                <a href="#" id="btnAddToCart" class="btn btn-success bg-success bg-gradient w-100">Bayar Sekarang -
                    Rp. 30.0000</a>

            </div>
        </div>
    </section>
@endsection
