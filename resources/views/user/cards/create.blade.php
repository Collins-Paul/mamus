@extends('layouts.index')
@section('title')
    Cards Subscription
@endsection

@section('content')
<?php
    $logo = DB::table('app_logos')->first();
?>
<div class="card-preloader position-absolute justify-content-center top-0 start-0 bottom-0 end-0 align-items-center rounded" style="display:none; background: rgba(0, 0, 0, 0.6); z-index: 5000">
    <div class="text-center">
        <div class="spinner-border text-white" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>
        <h6 class="text-white mt-2 loadingText">Loading</h6>
      </div>
</div>
<div class="nk-content nk-content-lg nk-content-fluid">
    <div class="container-xl wide-lg">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head">
                    <div class="nk-block-head-content">
                        <div class="nk-block-head-sub"><span>New Card</span></div>
                        <div class="nk-block g-4">
                            <div class="nk-block-head-content">
                                <div class="d-flex justify-content-between">
                                    <h4 class="nk-block-title fw-normal">Subscribe Card</h4>
                                    <a href="{{ route('user.user.create.user-card') }}" class="btn btn-outline-secondary btn-sm">Go back</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="nk-block mb-5">
                    <div class="container">
                        <div class="row">
                            @php
                                if($card->id % 2 === 0) {
                                    $card_bg = 'card-bg-2.jpg';
                                } else {
                                    $card_bg = 'card-bg.jpg';
                                }
                            @endphp
                            <div class="col-lg-6">
                                <div class="card shadow p-2 m-1 text-white"
                                    style="border-radius: 18px; background: url({{ asset('tradingUi/images/'.$card_bg) }}); background-repeat: no-repeat;
                                    background-size: cover;
                                    background-position: bottom;">
                                    <div class="d-flex justify-content-between">
                                        <img src="{{ asset('assets/logo/' . $logo->logo) }}" style="width: 20px" alt="">
                                        <span class="badge rounded-pill text-bg-danger card_badge">Debit</span>
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <div class="d-flex justify-content-between">
                                                <div class="my-3">
                                                    <p class="mb-0">Card Number</p>
                                                    <input type="text" id="card_no"
                                                        class="card-number bg-transparent border-0 outline-0 fs-5 m-0 fw-bold"
                                                        value="xxxx xxxx xxxx xxxx" readonly>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-start">
                                                <div class="me-5">
                                                    <p class="mb-0">CVV</p>
                                                    <input type="text" class="fs-6 fw-bold m-0 bg-transparent cvv-number border-0"
                                                        value="xxx" readonly>
                                                </div>
                                                <div class="me-5">
                                                    <p class="mb-0">Valid Till</p>
                                                    <p class="fs-6 m-0">xx/xx</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="me-4">
                                            <img src="{{ asset('tradingUi/images/atm-chip.jpg') }}" style="width: 50px" alt="">
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-between mt-2">
                                        <div class="">
                                            <p class="fs-6 m-0">{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}
                                            </p>
                                        </div>
                                        <div>
                                            <img src="{{ asset('assets/images/Visa.png') }}" class="card_network_img" style="width: 50px" alt="">
                                        </div>
                                    </div>
                                </div>

                                @php
                                     if(is_numeric($card->max_withdrawal)) {
                                        $max_withdrawal = Auth::user()->currency[0]['symbol'] ." " . number_format($card->max_withdrawal, 2);
                                    } else {
                                        $max_withdrawal = $card->max_withdrawal;
                                    }
                                @endphp

                                <div class="card">
                                    <div class="text-center">
                                        <h4 class="fw-bold">{{ Auth::user()->currency[0]['symbol'] }} {{ number_format($card->reg_fee, 2) }}</h4>
                                        <p class="mb-0">Activation Fee</p>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <p class="mb-0 fw-bold">Max. Withdrawal</p>
                                        <p class="">{{ $max_withdrawal }}</p>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <p class="mb-0 fw-bold">Duration</p>
                                        <p class="">{{ $card->duration }} Years</p>
                                    </div>
                                    <form action="" id="card_form">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <p class="fw-bold mb-0">Card Type -</p>
                                            <select name="" id="card_type" class="border-0">
                                                <option value="">Select Type</option>
                                                <option value="Credit">Credit Card</option>
                                                <option value="Debit">Debit Card</option>
                                            </select>
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <p class="fw-bold mb-0">Card Network -</p>
                                            <select name="" id="card_network" class="border-0">
                                                <option value="">Select Network</option>
                                                <option value="Master">Master Card</option>
                                                <option value="Visa">Visa Card</option>
                                                <option value="American Express">American Express</option>
                                            </select>
                                        </div>

                                        <div>
                                            <button type="button" disabled class="btn btn-outline-warning block w-100 d-flex justify-content-center proceed-btn">Proceed</button>
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

 <!-- Modal -->
 <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('user.user.process.new.card') }}" method="post" enctype="multipart/form-data">
                @csrf
                    <div class="mb-3 text-center">
                      <label for="recipient-name" class="col-form-label">Amount ({{ Auth::user()->currency[0]['abbr'] }}):</label>
                      <h3>{{ Auth::user()->currency[0]['symbol'] }} {{ number_format($card->reg_fee, 2) }}</h3>
                    </div>
                    <div class="mb-3">
                      <label for="message-text" class="col-form-label">Choose Wallet:</label>
                        <select name="wallet_name" id="wallet_name" class="form-control">
                            <option value="0">Choose wallet</option>
                            @foreach ($allWallets as $name)
                                <option value="{{$name->id}}">
                                    {{ Str::ucfirst($name->wallet_name)}} {{ !is_null($name->wallet_format) ? " (".($name->wallet_format).")" : null }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Wallet Address</label>
                        <input placeholder="Click address to copy" readonly type="text" name="wallet_address" class="form-control" id="wallet_address" onclick="copyText('wallet_address')">
                        @error('wallet_address')
                            <span id="-error" class="invalid">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 text-center">
                        <img src="" alt="" id="qr_code" style="width: 200px">
                    </div>

                    <div class="mb-3">
                        <p class="mb-0">Kindly upload a screenshort of the payment receipt</p>
                        <label for="payment_receipt" class="col-form-label">Payment Receipt</label>
                        <input type="file" name="file" class="form-control" id="payment_receipt">
                        @error('file')
                            <span id="-error" class="invalid">{{ $message }}</span>
                        @enderror
                    </div>

                    <input type="hidden" name="card_id" value="{{ $card->id }}">
                    <input type="hidden" name="card_network" id="payment_card_network" value="">
                    <input type="hidden" name="card_type" id="payment_card_type" value="">

                    <p>Kindly click any of our trusted vendor below to proceed for the transaction</p>
                    <div class="my-3 d-flex justify-content-evenly">
                        <a href="https://www.moonpay.com/buy" target="_blank"><img src="{{ asset('assets/images/moonpay.svg') }}" alt="" style="width: 100px"></a>
                        <a href="https://buy.bitcoin.com/btc/" target="_blank"><img src="{{ asset('assets/images/bitcoin-com.png') }}" alt="" style="width: 100px"></a>
                    </div>
            </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" id="submitDeposit" style="display: none" class="btn btn-success">I've Made Deposit</button>
        </div>
    </form>
    </div>
    </div>
</div>

@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $('#card_type').change(function (e) {
                e.preventDefault();
                $type = $(this).val();
                $('#payment_card_type').val($type);
                    if($type == 'Credit') {
                        $('.card_badge').removeClass('text-bg-danger');
                        $('.card_badge').addClass('text-bg-success');
                        $('.card_badge').text('Credit')
                    } else {
                        $('.card_badge').removeClass('text-bg-success');
                        $('.card_badge').addClass('text-bg-danger');
                        $('.card_badge').text('Debit')
                    }
            });

            $('#card_network').change(function (e) {
                e.preventDefault();
                $card = $(this).val();
                $('#payment_card_network').val($card);
                $card_img = $('.card_network_img');
                $img = "{{ asset('tradingUi/images') }}";
                switch ($card) {
                    case 'Master':
                        $card_img.attr('src', $img+'/mastercard.png');
                        break;

                    case 'Visa':
                        $card_img.attr('src', $img+'/Visa.png');
                        break

                    case 'American Express':
                        $card_img.attr('src', $img+'/american-express.png');
                        break

                    default:
                        $card_img.attr('src', $img+'Visa.png');
                        break;
                }
            });

             // Function to create the loading effect
            function setLoadingText() {
                var loadingElement = $('.loadingText');
                var currentText = loadingElement.text();

                // Add a dot or reset to "Loading" if already reached three dots
                var newText = currentText.length < 10 ? currentText + '.' : 'Loading';

                loadingElement.text(newText);
            }

            function removePreloader() {
                $('.card-preloader').css('display', 'none');
            }

            $('.proceed-btn').click(function (e) {
                e.preventDefault();
                $('.card-preloader').css('display', 'flex');

                $myInterval = setInterval(() => {
                    setLoadingText();
                }, 300);

                setTimeout(() => {
                    removePreloader();
                    clearInterval($myInterval)
                    $('.modal').modal('show');
                }, 4000);
            });


            $('#card_form select').on('change', function() {
                // Check if all input fields are filled
                let allFilled = true;
                $('#card_form select').each(function() {
                    if ($(this).val() === '') {
                        allFilled = false;
                        return false; // Exit each loop
                    }
                });

                // Enable or disable the submit button based on allFilled
                if (allFilled) {
                    $('.proceed-btn').removeClass('disabled').prop('disabled', false);
                } else {
                    $('.proceed-btn').addClass('disabled').prop('disabled', true);
                }
            });
        });

        $(document).ready(function(){
            $('#wallet_name').change(function (e) {
                e.preventDefault();
                    var wallet_name = document.querySelector('#wallet_name').value;
                    $.get("/user/show-wallet/"+ wallet_name, function(data, status){
                        console.log(data);
                        document.querySelector('#wallet_address').value = data['wallet_address'];
                        document.querySelector('#qr_code').src = '/wallets-qrcode/'+data['qr_code'];
                        $('#submitDeposit').css('display', 'block');
                    });
                });
        });
    </script>
@endsection
