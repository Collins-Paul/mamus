@extends('layouts.index')

@section('title')
    Wallet
@endsection

@section('content')
<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-lg">
        <div class="nk-content-body">
            <div class="nk-block-head text-center">
                <div class="nk-block-head-sub"><span>Balance</span> </div><!-- .nk-block-head-sub -->
                <div class="g-4">
                    <div class="nk-block-head-content">
                        <h2 class="nk-block-title fw-bolder">
                            $ {{ number_format($balances->balance, 2) }}
                        </h2>
                    </div>
                    <div class="line mb-1 p-0" style="border-bottom: solid 1px #d8d1d1;"></div>
                </div><!-- .nk-block-between -->
            </div><!-- .nk-block-head -->
            <ul class="nav nav-tabs nav-tabs-s2">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#tabItem9">ACTIONS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#tabItem10">HISTORY</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#tabItem11">ABOUT</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tabItem9">
                    <ul class="pricing-features">
                        <li class="py-2"><span class="w-50"><em class="fs-4 icon ni ni-wallet-in"></em> <a href="{{ route('user.deposit') }}">Deposit</a></span> <span class="ms-auto"><a href="{{ route('user.deposit') }}"><em class="icon ni ni-forward-ios"></em></a></span></li>
                        <li class="py-2"><span class="w-50"><em class="fs-4 icon ni ni-wallet-out"></em> <a href="{{ route('user.new.withdrawal') }}">Withdrawal</a></span> <span class="ms-auto"><a href="{{ route('user.new.withdrawal') }}"><em class="icon ni ni-forward-ios"></em></a></span></li>
                        <li class="py-2"><span class="w-50"><em class="fs-4 icon ni ni-tranx"></em> <a href="{{ route('user.internal.transfer') }}">Internal transfer</a></span> <span class="ms-auto"><a href="{{ route('user.internal.transfer') }}"><em class="icon ni ni-forward-ios"></em></a></span></li>
                        {{-- <li class="py-2"><span class="w-50"><em class="fs-4 icon ni ni-histroy"></em> <a href="#">Internal transfer history</a></span> <span class="ms-auto"><a href=""><em class="icon ni ni-forward-ios"></em></a></span></li> --}}
                    </ul>
                </div>
                <div class="tab-pane" id="tabItem10">
                    @include('includes.transaction-history')
                </div>
                <div class="tab-pane" id="tabItem11">
                    <div class="px-2 py-3">
                        <h6>We create Wallet for all our clients.</h6>
                        <div class="d-flex justify-content-start">
                            <div class="pt-3 pe-1">
                                <em class="fs-4 icon ni ni-wallet-saving"></em>
                            </div>
                            <div class="py-1">
                                <p class="m-0 fw-bold">For Everyone</p>
                                <p>Use it to make internal transfers, deposits, and withdrawals</p>
                            </div>
                        </div>

                        <div class="d-flex justify-content-start">
                            <div class="pt-3 pe-1">
                                <em class="fs-4 icon ni ni-share"></em>
                            </div>
                            <div class="py-1">
                                <p class="m-0 fw-bold">For Copiers</p>
                                <p>Use the Wallet to parcel your investment between Masters.</p>
                            </div>
                        </div>

                        <div class="d-flex justify-content-start">
                            <div class="pt-3 pe-1">
                                <em class="fs-4 icon ni ni-coins"></em>
                            </div>
                            <div class="py-1">
                                <p class="m-0 fw-bold">For Masters</p>
                                <p>Get your commission payouts to the Wallet.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
