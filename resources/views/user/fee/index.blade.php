@extends('layouts.index');

@section('title', 'Pay Network Fee')

@section('styles')
    <style>
        .network-block {
            cursor: pointer;
            box-sizing: border-box;
        }

        .network-block:hover {
            border: 1px solid red !important;
            color: red;
            box-sizing: border-box;
        }

        .addFirstFee {
            border: 1px solid red !important;
            color: red;
            box-sizing: border-box;
        }

        .stayinactive {
            pointer-events: none;
            border: 0.5px solid gray !important;
            color: gray
        }
    </style>
@endsection


@section('content')
<div class="nk-content nk-content-lg nk-content-fluid">
    <div class="container-xl wide-lg">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="text-center mb-2">
                            <h4>Process Fee</h4>
                            <h3 class="my-1">{{Auth::user()->currency[0]['symbol']}} {{number_format($tranx->amount, 2)}}</h3>
                            <p>Ref: <span>{{$tranx->ref}}</span></p>
                        </div>
                        <p class="fw-bold"><span class="text-warning">Warning:</span> A higher network fee is required to complete the transaction. To do this, select a higher network below and click pay.</p>
                        <form action="{{route('user.pay.fee.process')}}" method="post">
                                            @csrf
                                            <input type="hidden" value="{{$tranx->amount}}" name="amount">
                                            <input type="hidden" value="{{$tranx->id}}" name="tranx_uid">
                                        <div class="bg-dark text-white mt-2 p-2">
                                            <div class="d-flex justify-content-between">
                                                <p class="mb-0">To</p>
                                                <p class="fw-bold">- <span class="wallet_type"></span></p>
                                            </div>

                                            <div class="form-control-wrap">
                                                <select name="wallet" class="w-100 text-center bg-dark border-0 text-white" style="outline: 0" id="allwallets">
                                                    <option value="">Choose Wallet</option>
                                                    @foreach ($wallets as $wallet)
                                                        <option wallet="{{ $wallet->wallet_name }}" id="wallet_{{ $wallet->wallet_address }}" value="{{ $wallet->wallet_address }}">{{ $wallet->wallet_name }} | {{$wallet->wallet_address}}</option>
                                                    @endforeach
                                                </select>
                                                <div class="d-flex justify-content-end mt-1">
                                                    <span class="btn btn-sm btn-outline-success py-0 copywallet">Copy Wallet</span>
                                                </div>
                                            </div>
                                        </div>
                                        @error('wallet')
                                            <span class="text-danger text-center my-2">{{$message}}</span>
                                        @enderror

                                        <div class="bg-dark text-white mt-2 py-3 px-2">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <p class="mb-0">Network Fee</p>
                                                <p class="mb-0">{{Auth::user()->currency[0]['symbol']}} <span class="totalefee">0.00</span></p>
                                                <input type="hidden" required name="network_fees" class="calculatedFees" value="">
                                            </div>
                                            <div class="row mt-1">
                                                @foreach ($netfees as $fee)
                                                    <div class="col-lg-4 col-4">
                                                        <div class="p-1 border rounded text-center network-block" feetype="{{$fee->type}}" netfee="{{$fee->percentage}}" id="network_{{$fee->id}}">
                                                            <p class="mb-0">{{$fee->type}}</p>
                                                            <p>{{$fee->percentage}} {{$fee->network}}</p>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                <input type="hidden" value="" name="network_type" class="feetype">
                                            </div>
                                        </div>
                                        
                                        @error('network_fees')
                                            <span class="text-danger text-center my-2">{{$message}}</span>
                                        @enderror

                                <button type="submit" class="btn btn-block btn-outline-dark btn-lg my-4">Pay</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $('.max-btn').click(function (e) {
                e.preventDefault();
                $text = $('.a-bal').text();
                $('.amount-inp').val($text);

                calculatePercentFee($text)
            });

            $('#allwallets').change(function (e) {
                e.preventDefault();
                $wallet = $(this).val();
                $type = $('#wallet_'+$wallet).attr('wallet');
                console.log($type);
                $('.wallet_type').text($type);
            });

            $network_fee_id = '{{ $first_fee->id }}';
            $('#network_'+$network_fee_id).addClass('stayinactive');
            // $('#network_'+$network_fee_id).removeClass('stayinactive');

            $('.network-block').click(function (e) {
                e.preventDefault();
                $('.network-block').removeClass('addFirstFee');
                $(this).addClass('addFirstFee');
                $feetype = $(this).attr('feetype');
                $('.feetype').val($feetype);
                calculatePercentFee('{{ $tranx->amount }}')
            });

            $('.amount-inp').keyup(function (e) {
                $aamount = $('.amount-inp').val();
                calculatePercentFee($aamount);
            });

            function calculatePercentFee($aamount) {
                $aamount = $aamount.replace(',', '');
                $fee_amount = $('.addFirstFee').attr('netfee');
                $percentage = (parseFloat($aamount) * parseFloat($fee_amount));
                $percentage = $percentage / 100;
                $('.totalefee').text($percentage.toFixed(2));

                totalamt = $percentage + parseFloat($aamount);

                $('.totalamt').text(totalamt.toLocaleString());
                $('.calculatedFees').val($percentage.toFixed(2));

                if($('.totalefee').text() == 'NaN') {
                    $('.totalefee').text('0.00');
                }
            }

            $('.copywallet').click(function (e) { 
                e.preventDefault();
                $wallet = $('#allwallets').val();
                navigator.clipboard.writeText($wallet).then(function() {
                    alert('Wallet Copied!');
                }).catch(function(err) {
                    console.error('Failed to copy text: ', err);
                });
            });

        });
    </script>
@endsection
