@extends('layouts.index')

@section('title')
    Deposit
@endsection

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
                    <form action="{{route('user.new.deposit.store')}}" method="post">
                        @csrf
                        <div class="col-lg-6">
                            <div class="nk-block-head d-none d-md-block">
                                <div class="nk-block-head-content">
                                    <div class="nk-block-head-sub fw-bold fs-4"><span>Deposit</span></div>
                                </div>
                            </div>

                            <div class="p-3 shadow rounded-3 mb-3">
                                <h6>How it works</h6>
                                <p>Copy one of the wallet addresses below into your exchange app or click any of our trusted vendor below. Next, specify the deposit amount right in your exchange app.</p>
                            </div>

                            <div class="form-control-wrap">
                                <input type="text" name="amount" required class="fs-1 w-100 text-center bg-dark border-0 text-white amount-inp" id="figure" style="outline: 0 !important" placeholder="Amount - {{Auth::user()->currency[0]['symbol']}} 0.00">
                                <p class="text-center fs-6 fw-bold">Total Amount = {{Auth::user()->currency[0]['symbol']}} <span class="totalamt">0.00</span></p>
                                <div class="my-2">
                                    <p class="mb-0"><span class="text-success fw-bold">Instruction:</span> Make payment to the selected wallet address below.</p>
                                </div>
                            </div>

                            <div class="bg-dark text-white mt-2 p-2">
                                <div class="d-flex justify-content-between">
                                    <p class="mb-0">To</p>
                                    <p class="fw-bold">- <span class="wallet_type"></span></p>
                                </div>

                                <div class="form-control-wrap">
                                    <select name="wallet" required class="w-100 text-center bg-dark border-0 text-white" style="outline: 0" id="allwallets">
                                        <option value="">Choose Wallet</option>
                                        @foreach ($wallets as $wallet)
                                            <option wallet="{{ $wallet->wallet_name }}" id="wallet_{{ $wallet->id }}" value="{{$wallet->wallet_address}}"><span >{{ $wallet->wallet_name }}</span> | {{$wallet->wallet_address}}</option>
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
                                        <div class="p-1 border rounded text-center network-block stayinactive" netfee="{{$fee->percentage}}" id="network_{{$fee->id}}">
                                            <p class="mb-0">{{$fee->type}}</p>
                                            <p>{{$fee->percentage}} {{$fee->network}}</p>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                            <p class="mt-3">Kindly click any of our trusted vendor below to proceed for the transaction</p>
                            <div class="my-3 d-flex justify-content-evenly">
                                <a href="https://www.moonpay.com/buy" target="_blank"><img src="{{ asset('assets/images/moonpay.svg') }}" alt="" style="width: 100px"></a>
                                <a href="https://buy.bitcoin.com/btc/" target="_blank"><img src="{{ asset('assets/images/bitcoin-com.png') }}" alt="" style="width: 100px"></a>
                            </div>


                            <button type="submit" class="btn btn-block btn-outline-dark btn-lg my-4">Proceed</button>
                        </div>
                    </form>
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
                $('.wallet_type').text($type);
            });

            $network_fee_id = '{{ $first_fee->id }}';
            $('#network_'+$network_fee_id).addClass('addFirstFee');
            $('#network_'+$network_fee_id).removeClass('stayinactive');

            $('.network-block').click(function (e) {
                e.preventDefault();
                $('.network-block').removeClass('addFirstFee');
                $(this).addClass('addFirstFee');
                $aamount = $('.amount-inp').val();
                calculatePercentFee($aamount)
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

<script>
        function updateTextView(_obj) {
            var num = getNumber(_obj.val());
            if (num == 0) {
                _obj.val('');
            } else {
                _obj.val(num.toLocaleString());
            }
        }

        function getNumber(_str) {
            var arr = _str.split('');
            var out = new Array();
            for (var cnt = 0; cnt < arr.length; cnt++) {
                if (isNaN(arr[cnt]) == false) {
                    out.push(arr[cnt]);
                }
            }
            return Number(out.join(''));
        }

        $(document).ready(function() {
            $('input[id=figure]').on('keyup', function() {
                updateTextView($(this));
            });
        });
    </script>
@endsection
