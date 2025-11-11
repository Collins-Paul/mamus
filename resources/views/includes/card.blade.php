<div class="row">
    @php
        if ($card->type == 'Debit') {
            $badge_bg = 'danger';
        } else {
            $badge_bg = 'success';
        }
    @endphp
    <div class="col-lg-6">
        <h5 class="ps-3 my-4">Withdrawal Card</h5>
        <div class="card shadow p-2 m-1 text-white"
            style="border-radius: 18px; background: url({{ asset('assets/images/atm-bg.jpg') }})">
            <div class="d-flex justify-content-between">
                <img src="{{ asset('assets/logo/' . $logo->logo) }}" style="width: 20px" alt="">
                <span class="badge rounded-pill text-bg-{{ $badge_bg }}">{{ $card->type }}</span>
            </div>
            <div class="d-flex justify-content-between">
                <div class="my-3">
                    <p class="mb-0">Card Number</p>
                    <input type="password" id="card_no"
                        class="card-number bg-transparent border-0 outline-0 fs-5 m-0 fw-bold"
                        value="{{ $card->card_no }}" readonly>
                </div>
                <div class="d-flex align-items-center">
                    <p><em class="icon ni ni-copy fs-5" for="card_no"
                            onclick="copyText('card_no')"></em></p>
                </div>
            </div>
            <div class="d-flex justify-content-start">
                <div class="me-5">
                    <p class="mb-0">CVV</p>
                    <input type="password" class="fs-6 m-0 bg-transparent cvv-number border-0"
                        value="{{ $card->cvv }}" readonly>
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
                    <p class="fs-6 m-0">{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}
                    </p>
                </div>
                <div>
                    <img src="{{ asset('assets/images/Visa.png') }}" style="width: 50px" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
