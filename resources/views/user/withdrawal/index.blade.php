@extends('layouts.index')

@section('title')
    Send
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
                    <form action="{{route('user.new.withdrawal.store')}}" method="post">
                        @csrf
                    <div class="col-lg-6">
                        <div class="nk-block-head d-none d-md-block">
                            <div class="nk-block-head-content">
                                <div class="nk-block-head-sub fw-bold fs-4"><span>Withdrawal (Send)</span></div>
                            </div>
                        </div>

                        <div class="form-control-wrap">
                            <input required type="text" name="amount" class="fs-1 w-100 text-center bg-dark border-0 text-white amount-inp" id="figure" style="outline: 0 !important" placeholder="Amount - {{Auth::user()->currency[0]['symbol']}} 0.00">
                            <div class="d-flex justify-content-between align-items-center mt-1">
                                <p class="mb-0">Available Balance: <span class="fw-bold"> {{Auth::user()->currency[0]['symbol']}} <span class="a-bal">{{number_format($bal, 2)}}</span></span></p>
                                <button class="btn btn-outline-dark btn-sm max-btn">MAX</button>
                            </div>
                        </div>

                        <div class="bg-dark text-white mt-2 p-2">
                            <div class="d-flex justify-content-between">
                                <span>To</span>
                                <p class="fw-bold">- <span class="wallet_type"></span></p>
                            </div>

                            <input type="hidden" name="coin" id="wallet_coin" value="">

                            <div class="mt-2">
                                <select required name="address" id="allwallets" style="outline: 0" class="form-control w-100 text-center bg-dark border-0 text-white">
                                    <option value="">Choose Wallet</option>
                                    @foreach ($wallets as $wallet)
                                        <option wallet="{{ $wallet->coin }}" id="wallet_{{ $wallet->id }}" value="{{ $wallet->id }}">{{ $wallet->address }}</option>
                                    @endforeach;
                                </select>
                            </div>
                        </div>


                        <a href="{{ route('user.user.connect.wallet') }}" class="btn btn-sm fs-6 bg-dark text-white py-1 d-block mt-2"><em class="icon ni ni-plus-sm"></em> <br> Add Receiving Address</a>

                        <div class="bg-dark text-white mt-2 py-3 px-2">
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="mb-0">Network Fee</p>
                                <p class="mb-0">{{Auth::user()->currency[0]['symbol']}} <span class="totalefee">0.00</span></p>
                                <input type="hidden" id="payingfee" name="fee" value="">
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
                        <label for="" class="d-block text-center my-2 fw-bold">Withdrawal Card Details</label>
                        <div class="bg-dark text-white mt-2 py-3 px-2 rounded">
                            <div class="mb-3">
                                <label for="wallet_address" class="col-form-label">Card Number <span
                                        class="text-danger">*</span></label>
                                <input type="number" placeholder="0000 0000 0000 0000" name="card_number"
                                    class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="wallet_address" class="col-form-label">Withdrawal Pin <span
                                        class="text-danger">*</span></label>
                                <input type="password" placeholder="********" name="pin" class="form-control" required>
                                <span class="text-primary"><i>Note: Your withdrawal pin is your {{ config('app.name') }}
                                        account login password.</i></span>
                            </div>
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

                if($('.totalefee').text() == 'NaN') {
                    $('.totalefee').text('0.00');
                }

                $('#payingfee').val($('.totalefee').text());
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
