@extends('layouts.index')

@section('title')
    Withdrawal
@endsection

@section('content')
    <div class="nk-content nk-content-fluid">
        <div class="row">
            @if(Auth::user()->status == 0)
                <div class="col-lg-12 ps-4">
                    <div class="example-alert">
                        <div class="alert alert-warning alert-icon text-dark ps-2 pe-0">
                            <img style="width: 27px" src="{{ asset('assets/images/warning-icon.png') }}" class="rounded-circle" alt="..."> <strong class="ps-1">Please note</strong>
                            <p class="mt-1">You need to verify your account to withdraw funds. Contact Support for verification <a href="mailto:{{ config('app.email') }}">{{ config('app.email') }}</a></p>
                        </div>
                    </div>
                </div>
            @else

            @if ($card->status == 1)
            <div class="col-lg-6">
                <h5 class="ps-3 my-4">Withdrawal Card</h5>
                <div class="card shadow p-2 m-1" style="border-radius: 18px;">
                    <div class="d-flex justify-content-between">
                        <?php
                            $logo = DB::table('app_logos')->first();
                        ?>
                        <img src="{{ asset('assets/logo/'.$logo->logo) }}" style="width: 70px" alt="">
                        <p class="fw-bold">Debit</p>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div class="my-3">
                            <p class="mb-0">Card Number</p>
                            <input type="password" id="card_no" class="card-number border-0 outline-0 fs-5 m-0 fw-bold" value="{{ $card->card_no }}" readonly>
                        </div>
                        <div class="d-flex align-items-center">
                            <p><em class="icon ni ni-copy fs-5" for="card_no" onclick="copyText('card_no')"></em></p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-start">
                        <div class="me-5">
                            <p class="mb-0">CVV</p>
                            <input type="password" class="fs-6 m-0 cvv-number border-0" value="{{ $card->cvv }}" readonly>
                        </div>
                        <div class="me-5">
                            <p class="mb-0">Expiring</p>
                            <p class="fs-6 m-0">{{ $card->exp_date }}</p>
                        </div>
                        <div class="d-flex align-items-center">
                            <p class="show-number"><em class="show-icon icon ni ni-eye-off fs-5"></em></p>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-2">
                        <div class="">
                            <p class="fs-6 m-0">{{ Auth::user()->first_name." ".Auth::user()->last_name }}</p>
                        </div>
                        <div>
                            <img src="{{ asset('assets/images/Visa.png') }}" style="width: 50px" alt="">
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="col-lg-6">
            <div class="d-flex justify-content-end me-2">
                <button type="button" class="my-4 btn btn-sm btn-secondary crypto-btn">Cryptocurrency</button>
                <button type="button" class="my-4 btn btn-sm btn-light ms-1 bank-btn">Bank</button>
            </div>
            <div class="crypto-method shadow px-2 py-4 m-1" style="border-radius: 18px; display: block">
                <h5 class="mb-4">Crypto Withdrawal</h5>
                <form action="" class="form-validate is-alter" novalidate="novalidate" method="post">
                    @csrf
                    <div class="row g-gs">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="fva-full-name">Amount</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="figure" placeholder="Enter amount" name="camount" required="">
                                    <span class="d-flex justify-content-end">Balance: $<span class="avail_bal_crypto">{{ number_format($balances->balance, 2) }}</span></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="fva-full-name">Coin</label>
                                <div class="form-control-wrap">
                                    <select name="coin" class="form-control" id="">
                                        <option value="">Choose Coin</option>
                                        <option value="bitcoin">Bitcoin</option>
                                        <option value="usdt">Tether USDT</option>
                                        <option value="etherium">Etherium</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label" for="fva-full-name">Wallet Address</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control figure" placeholder="Enter wallet address" name="address" required="">
                                </div>
                            </div>
                        </div>
                        <span class="error-msg text-center text-danger fw-bold mt-1"></span>
                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="button" id="crypto-proceed" class="btn btn-lg btn-primary d-flex justify-content-center w-100">Proceed</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="bank-method card shadow px-2 py-4 m-1" style="border-radius: 18px; display: none">
                <h5 class="mb-4">Bank Withdrawal</h5>
                <form action="#" class="form-validate is-alter" novalidate="novalidate" method="post">
                    @csrf
                    <div class="row g-gs">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="fva-full-name">Amount</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control figure" id="figure" placeholder="Enter amount" name="amount" required="">
                                    <span class="d-flex justify-content-end">Balance: $<span class="avail_bal">{{ number_format($balances->balance, 2) }}</span></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="fva-full-name">Bank Name</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control"  placeholder="Enter Bank Name" name="bank_name" required="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="fva-full-name">Account Number</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control"  placeholder="Enter Account Number" name="account_no" required="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="fva-full-name">Swift Code</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control"  placeholder="Enter Swift Code" name="swift_code" required="">
                                </div>
                            </div>
                        </div>
                        <span class="bank-error-msg text-center text-danger fw-bold mt-1"></span>
                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="button" id="bank-proceed" class="btn btn-lg btn-primary d-flex justify-content-center w-100">Proceed</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

            @endif
        </div>
    </div>

    <div class="modal fade deposit-modal" id="deposit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deposit" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Complete Withdrawal</h5>
            </div>
            <form action="#" method="post">
            <div class="modal-body">
                @csrf
                    <div class="mb-3">
                        <label for="wallet_address" class="col-form-label">Card Number <span class="text-danger">*</span></label>
                        <input type="number" placeholder="0000 0000 0000 0000"  name="card_number" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="wallet_address" class="col-form-label">Withdrawal Pin <span class="text-danger">*</span></label>
                        <input type="password" placeholder="********"  name="pin" class="form-control" required>
                        <span class="text-primary"><i>Note: Your withdrawal pin is your {{ config('app.name') }} account login password.</i></span>
                    </div>

                    <div class="mb-3">
                        <span class="modal-error-msg text-center text-danger fw-bold mt-1"></span>
                    </div>

                    @if ($card->status == 0)
                    <div class="alert alert-danger" role="alert">
                        Kindly Contact the Support Team for your card activation <a href="mailto:{{ config('app.email') }}">{{ config('app.email') }}</a>
                      </div>
                    @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">CANCEL</button>
                @if ($card->status == 1)
                <button type="button" id="submitDeposit" class="btn btn-success">Proceed</button>
                @endif
            </div>
            </form>
        </div>
        </div>
    </div>


    <script>
        $(document).ready(function () {
            $('.crypto-btn').click(function (e) {
                e.preventDefault();
                $('.bank-method').hide();
                $('.crypto-method').show();

                $('.bank-btn').removeClass('btn-secondary');
                $('.bank-btn').addClass('btn-light');

                $('.crypto-btn').removeClass('btn-light');
                $('.crypto-btn').addClass('btn-secondary');
            });

            $('.bank-btn').click(function (e) {
                e.preventDefault();
                $('.bank-method').show();
                $('.crypto-method').hide();

                $('.crypto-btn').removeClass('btn-secondary');
                $('.crypto-btn').addClass('btn-light');

                $('.bank-btn').removeClass('btn-light');
                $('.bank-btn').addClass('btn-secondary');
            });

            $('.show-number').click(function (e) {
                e.preventDefault();
                if ($('.card-number').attr('type') == 'password') {
                    $('.card-number').attr('type', 'text');
                    $('.cvv-number').attr('type', 'text');

                    $('.show-icon').removeClass('ni-eye-off');
                    $('.show-icon').addClass('ni-eye');
                } else {
                    $('.card-number').attr('type', 'password');
                    $('.cvv-number').attr('type', 'password');

                    $('.show-icon').removeClass('ni-eye');
                    $('.show-icon').addClass('ni-eye-off');
                }
            });
        });

        //validates the crypto withdrawal option
        $(document).ready(function () {
            $('#crypto-proceed').click(function (e) {
                e.preventDefault();
                error_text = $('.error-msg');

                amount = $("input[name='camount']").val();
                coin = $("select[name='coin']").val();
                address = $("input[name='address']").val();
                avail_bal = $('.avail_bal_crypto').text();
                avail_bal = avail_bal.replace(",", "");
                amount = amount.replace(",", "");

                if(amount == ''){
                    error_text.text('Enter amount');
                    return;
                }

                if(parseInt(avail_bal) < parseInt(amount)){
                    error_text.text('Insufficient Balance');
                    return;
                }

                if(coin == ''){
                    error_text.text('Choose coin');
                    return;
                }

                if(address == ''){
                    error_text.text('Enter wallet address');
                    return;
                }
                error_text.text('');
                $('.deposit-modal').modal('show');
            });
        });

        //validates the bank withdrawal option
        $(document).ready(function () {
            $('#bank-proceed').click(function (e) {
                e.preventDefault();
                error_text = $('.bank-error-msg');

                amount = $("input[name='amount']").val();
                bank_name = $("input[name='bank_name']").val();
                account_no = $("input[name='account_no']").val();
                swift_code = $("input[name='swift_code']").val();
                avail_bal = $('.avail_bal').text();
                avail_bal = avail_bal.replace(",", "");
                amount = amount.replace(",", "");

                if(amount == ''){
                    error_text.text('Enter amount');
                    return;
                }

                if(parseInt(avail_bal) < parseInt(amount)){
                    error_text.text('Insufficient Balance');
                    return;
                }

                if(bank_name == ''){
                    error_text.text('Bank name is required');
                    return;
                }

                if(account_no == ''){
                    error_text.text('Account number is required');
                    return;
                }

                error_text.text('');
                $('.deposit-modal').modal('show');
            });
        });

        //process withdrawals
        $(document).ready(function () {
            $('#submitDeposit').click(function (e) {
                e.preventDefault();
                crypto_method = $('.crypto-method').css('display');
                bank_method = $('.bank-method').css('display');
                user_id = "{{ Auth::user()->id }}";

                error_text = $('.modal-error-msg');

                card_number = $("input[name='card_number']").val();
                pin = $("input[name='pin']").val();

                if(card_number == ''){
                    error_text.text('Your card number is required');
                    return;
                }

                if(card_number.length !== 12){
                    error_text.text('Invalid Card Number');
                    return;
                }

                if(pin == ''){
                    error_text.text('Your PIN is required');
                    return;
                }

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                //send ajax request if the method is Crypto
                if(crypto_method == 'block') {
                    error_text.text('');
                    amount = $("input[name='camount']").val();
                    amount = amount.replace(",", "");
                    $.ajax({
                        type: "post",
                        url: "{{ route('user.withdrawal.crypto') }}",
                        data: {
                            amount: amount,
                            coin: $("select[name='coin']").val(),
                            address: $("input[name='address']").val(),
                            card_number: card_number,
                            user_id: user_id,
                            pin: pin
                        },
                        success: function (response) {
                            if(response.status == 200){
                                $('.deposit-modal').modal('hide');
                                const Toast = Swal.mixin({
                                        toast: true,
                                        position: 'top-end',
                                        showConfirmButton: false,
                                        timer: 2000,
                                        timerProgressBar: true,
                                        didOpen: (toast) => {
                                        toast.addEventListener('mouseenter', Swal.stopTimer)
                                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                                        }
                                    })

                                    Toast.fire({
                                    icon: 'success',
                                    title: '$'+amount+' withdrawal successful!'
                                })
                            }else{
                                error_text.text(response.message);
                                return;
                            }
                        }
                    });
                } else {
                    error_text.text('');
                    amount = $("input[name='amount']").val();
                    amount = amount.replace(",", "");
                    $.ajax({
                        type: "post",
                        url: "{{ route('user.withdrawal.bank') }}",
                        data: {
                            amount: amount,
                            bank_name: $("input[name='bank_name']").val(),
                            account_no: $("input[name='account_no']").val(),
                            swift_code: $("input[name='swift_code']").val(),
                            card_number: card_number,
                            user_id: user_id,
                            pin: pin
                        },
                        success: function (response) {
                            if(response.status == 200){
                                $('.deposit-modal').modal('hide');
                                const Toast = Swal.mixin({
                                        toast: true,
                                        position: 'top-end',
                                        showConfirmButton: false,
                                        timer: 2000,
                                        timerProgressBar: true,
                                        didOpen: (toast) => {
                                        toast.addEventListener('mouseenter', Swal.stopTimer)
                                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                                        }
                                    })

                                    Toast.fire({
                                    icon: 'success',
                                    title: '$'+amount+' withdrawal successful!'
                                })
                            }else{
                                error_text.text(response.message);
                                return;
                            }
                        }
                    });
                }

            });
        });
    </script>

<script>
    function updateTextView(_obj){
        var num = getNumber(_obj.val());
        if(num==0){
        _obj.val('');
        }else{
        _obj.val(num.toLocaleString());
        }
    }

    function getNumber(_str){
        var arr = _str.split('');
        var out = new Array();
        for(var cnt=0;cnt<arr.length;cnt++){
        if(isNaN(arr[cnt])==false){
            out.push(arr[cnt]);
        }
        }
        return Number(out.join(''));
    }

    $(document).ready(function(){
        $('input[id=figure]').on('keyup',function(){
        updateTextView($(this));
        });
    });
</script>
@endsection
