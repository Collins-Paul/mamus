@extends('layouts.index')

@section('title')
    New Deposit
@endsection

@section('content')
    <div class="nk-content nk-content-fluid">
        <div class="row">
            <div class="col-lg-6 ps-4">
                <div class="example-alert">
                    <div class="alert alert-warning alert-icon text-dark ps-2 pe-0">
                        <img style="width: 27px" src="{{ asset('assets/images/warning-icon.png') }}" class="rounded-circle" alt="..."> <strong class="ps-1">Please note</strong>
                        <p class="mt-1">You need at least <strong>{{ $data->min_deposit }}</strong> USD to start a new investment.</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <h4 class="ps-3 my-4">Payment Method</h4>
                <div class="ps-3 my-4">
                    <ul class="pricing-features payment-methods">
                        <li class="py-2">
                            <span class="w-75">
                                <a href="#">
                                    <img style="width: 30px" src="{{ asset('assets/images/bitcoin-btc-logo.png') }}" class="rounded-circle" alt="...">
                                </a>
                                <a href="#">Bitcoin</a>
                            </span>
                            <span class="ms-auto">
                                <a href="#"><em class="icon ni ni-forward-ios"></em></a>
                            </span>
                        </li>
{{--
                        <li class="py-2">
                            <span class="w-75">
                                <img style="width: 30px" src="{{ asset('assets/images/doge-icon.png') }}" class="rounded-circle" alt="...">
                                <a href="#">Dogecoin</a>
                            </span>
                            <span class="ms-auto">
                                <a href="#"><em class="icon ni ni-forward-ios"></em></a>
                            </span>
                        </li>

                        <li class="py-2">
                            <span class="w-75">
                                <img style="width: 30px" src="{{ asset('home-assets/img/eth-icon.png') }}" class="rounded-circle" alt="...">
                                <a href="#">Ethereum</a>
                            </span>
                            <span class="ms-auto">
                                <a href="#"><em class="icon ni ni-forward-ios"></em></a>
                            </span>
                        </li> --}}

                        <li class="py-2">
                            <span class="w-75">
                                <img style="width: 30px" src="{{ asset('assets/images/tether-icon.png') }}" class="rounded-circle" alt="...">
                                <a href="#">Tether (ERC20)</a>
                            </span>
                            <span class="ms-auto">
                                <a href="#"><em class="icon ni ni-forward-ios"></em></a>
                            </span>
                        </li>

                        <p>There are more other options available for easy account funding...</p>
                    </ul>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="mt-3">
                    <a href="{{route('user.new.deposit')}}" class="btn btn-success rounded-pill px-5">PROCEED NOW</a>
                </div>
            </div>
        </div>
    </div>

@endsection
