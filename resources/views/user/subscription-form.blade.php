@extends('layouts.index')

@section('title')
    Subscription
@endsection

@section('content')
    <div class="nk-content nk-content-fluid">
        <div class="container-xl wide-lg">
            <div class="nk-content-body">
                <div class="nk-block-head-content mb-4">
                    <h3 class="nk-block-title page-title">Payment</h3>
                </div>
                <div class="nk-block nk-block-lg">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="shadow rounded px-2 py-4">
                                <div class="row">
                                    @error('file')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <div class="col-lg-12 py-4">
                                        <div class="d-flex justify-content-between py-1">
                                            <h6>Status:</h6>
                                            <h6 class="text-warning">Processing</h6>
                                        </div>

                                        <div class="d-flex justify-content-between py-1">
                                            <h6>Robot Plan:</h6>
                                            <h6>{{ $plan->heading }}</h6>
                                        </div>

                                        <div class="d-flex justify-content-between py-1">
                                            <h6>Price:</h6>
                                            <h6>${{ number_format($plan->price, 2)}}</h6>
                                        </div>

                                        <div class="d-flex justify-content-between py-1">
                                            <h6>Expiring Date:</h6>
                                            <h6>{{ date('dS M, Y', strtotime('+'.$plan->weeks.' week')) }}</h6>
                                        </div>

                                        <div class="proceed-btn-wrap pt-3" style="display: block">
                                            <button class="btn btn-outline-warning d-flex justify-content-center proceed-btn w-100" type="button">Proceed</button>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 pb-4 payment-details" style="display: none">
                                        <div>
                                            <h6 class="text-center">Payment Details</h6>
                                            <p><span class="fw-bold text-success">Instruction:</span> Copy the wallet address below and make <strong>${{ number_format($plan->price, 2) }}</strong> {{ Str::upper($wallet->wallet_name) }} transfer. Thereafter upload a screenshot/reciept of the transaction and click the payment button below.</p>
                                            <div class="d-flex justify-content-between py-1">
                                                <h6>Payment Channel:</h6>
                                                <h6>Cryptocurrency</h6>
                                            </div>
                                            <div class="d-flex justify-content-between py-1">
                                                <h6>Coin:</h6>
                                                <h6> {{ Str::upper($wallet->wallet_name) }}</h6>
                                            </div>
                                            <div class="d-flex justify-content-between py-1">
                                                <h6>Wallet Format:</h6>
                                                <h6>{{ $wallet->wallet_format }}</h6>
                                            </div>
                                            <h6 class="text-center">Wallet Address</h6>
                                            <div class="py-1">
                                                <input class="w-100 border-0 text-center" type="text" value="{{ $wallet->wallet_address }}" readonly>
                                            </div>

                                        <form action="{{ route('user.process.sub') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <h6 class="text-center">Screenshot/Reciept:</h6>
                                            <div class="pt-1  pb-3">
                                                <input type="file" name="file">
                                            </div>
                                        </div>
                                            <input type="hidden" value="{{ $plan->heading }}" name="plan_title">
                                            <input type="hidden" value="{{ $plan->price }}" name="price">
                                            <input type="hidden" value="{{ date('dS M, Y', strtotime('+'.$plan->weeks.' week')) }}" name="exp_date">
                                        <div class="d-grid gap-2">
                                            <button class="btn btn-outline-primary d-flex justify-content-center" type="submit">I've made transfer</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        var element = document.querySelector('.proceed-btn');
        element.addEventListener("click", function() {
            document.querySelector('.proceed-btn-wrap').style.display = 'none';
            document.querySelector('.payment-details').style.display = 'block';
        });
    </script>
@endsection
