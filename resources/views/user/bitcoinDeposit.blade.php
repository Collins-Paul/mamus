@extends('layouts.index')

@section('title')
    Bitcoin Deposit
@endsection

@section('content')
    <div class="nk-content nk-content-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h6 class="ps-3 my-4">Proceed to depositing via Bitcoin (BTC)?</h6>
            </div>

            <div class="col-lg-6 ps-4">
                <div class="example-alert">
                    <div class="alert alert-warning alert-icon text-dark ps-2 pe-1">
                        <h6 class="mb-2">Important to know</h6>
                        <div class="d-flex justify-content-start">
                            <div class="pt-3 pe-1">
                                <img style="width: 70px" src="{{ asset('assets/images/warning-icon2.png') }}" class="rounded-circle" alt="...">
                            </div>
                            <div class="py-1">
                                <p class="m-0"><strong>We only accept Bitcoin (BTC).</strong> Bitcoin (BTC) is a stand-alone payment instrument and is not associated with Bitcoin Cash or any fork of this cryptocurrency.</p>
                            </div>
                        </div>
                        <div class="d-flex justify-content-start">
                            <div class="pt-3 pe-1">
                                <img style="width: 30px" src="{{ asset('assets/images/warning-icon2.png') }}" class="rounded-circle" alt="...">
                            </div>
                            <div class="py-1">
                                <p class="m-0">The total of all your Bitcoin deposits cannot exceed <strong>$20,000.00</strong> a day
                                <br>
                                </p>
                                <p class="mt-2">
                                    <a class="pt-1" id="show-details" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                        MORE DETAILS <em class="icon ni ni-chevron-down"></em>
                                    </a>
                                </p>
                            </div>
                        </div>

                        <div class="collapse" id="collapseExample">
                            <div class="py-1 ms-4">
                                <p class="" >
                                    If you do exceed the limit, all your Bitcoin deposit for the last 24 hours will be returned back, excluding the transfer fee. Transferringv and trading in your account will be suspended until then. This may take up to three days.
                                    <br><br>
                                    <a id="hide-details" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                        HIDE DETAILS <em class="icon ni ni-chevron-up"></em>
                                        </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6 ps-4">
                <div class="p-3 shadow rounded-3 mt-3">
                    <h6>How it works</h6>
                    <p>Copy one of the two Bitcoin addresses below into your Bitcoin Wallet app. Next, specify the deposit amount right in your Bitcoin Wallet app.</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6 ps-4">
                <div class="p-3 shadow rounded-3 mt-3">
                    <h6>Bitcoin addresses for your deposit</h6>
                    <p><strong>Use SegWit address format for lower commision.</strong><br>
                        If SegWit does't work, copy P2PKH address format.
                    </p>

                    <ul class="pricing-features payment-methods">
                        <li class="mb-1 border-bottom payment-wallet-area">
                            <span class="w-50">
                                <p class="m-0">Minimum amount</p>
                            </span>
                            <span class="ms-auto">
                                <p class="m-0">B0.001</p>
                            </span>
                        </li>

                        <li class="mb-1 border-bottom payment-wallet-area">
                            <span class="w-50">
                                <p class="m-0">Exchange rate</p>
                            </span>
                            <span class="ms-auto">
                                <p class="m-0">$24,390.55</p>
                            </span>
                        </li>

                        <li class="mb-1 border-bottom payment-wallet-area">
                            <span class="w-100">
                                <p class="m-0">Address, SegWit</p>
                                <input disabled style="width: 90%" class="border-0 text-center" type="text" name="" id="wallet_b" value="{{ is_null($wallet_b->wallet_address) ? 'N/A' : $wallet_b->wallet_address }}" readonly> <em class="icon ni ni-copy text-success fw-bold fs-4" onclick="copyText('wallet_b')"></em>
                            </span>
                        </li>

                        <li class="mb-1 border-bottom payment-wallet-area">
                            <span class="w-100">
                                <p class="m-0">Address, P2PKH</p>
                                <input disabled style="width: 90%" class="border-0 text-center" type="text" name="" id="wallet_1" value="{{ is_null($wallet_a->wallet_address) ? 'N/A' : $wallet_a->wallet_address }}"  readonly> <em class="icon ni ni-copy text-success fw-bold fs-4" onclick="copyText('wallet_1')"></em>
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="mt-3 text-center">
                    <button class="btn btn-success rounded-pill px-5"  data-bs-toggle="modal" data-bs-target="#staticBackdrop" type="button">PROCEED NOW</button>
                </div>
            </div>
        </div>
    </div>

    @include('includes.payment-method')

    <script>
        var showDetails = document.getElementById('show-details');
        showDetails.addEventListener('click', function () {
            showDetails.style.display = 'none';
        })

        var hideDetails = document.getElementById('hide-details');
        hideDetails.addEventListener('click', function () {
            showDetails.style.display = 'block';
        })
    </script>
@endsection
