@extends('layouts.index')

@section('title')
    Account Overview
@endsection

@section('content')
    <div class="nk-content nk-content-fluid">
        <div class="tradingview-widget-container">
            <div class="tradingview-widget-container__widget"></div>
            <!--  <div class="tradingview-widget-copyright"><a href="https://www.tradingview.com" rel="noopener" target="_blank"><span class="blue-text"></span></a></div> -->
            <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-ticker-tape.js" async>
                {
                    "symbols": [{
                            "proName": "FOREXCOM:SPXUSD",
                            "title": "S&P 500"
                        },
                        {
                            "proName": "FOREXCOM:NSXUSD",
                            "title": "Nasdaq 100"
                        },
                        {
                            "proName": "FX_IDC:EURUSD",
                            "title": "EUR/USD"
                        },
                        {
                            "proName": "BITSTAMP:BTCUSD",
                            "title": "BTC/USD"
                        },
                        {
                            "proName": "BITSTAMP:ETHUSD",
                            "title": "ETH/USD"
                        }
                    ],
                    "colorTheme": "dark",
                    "isTransparent": false,
                    "displayMode": "adaptive",
                    "locale": "en"
                }
            </script>
        </div>
        <!-- TradingView Widget END -->
        <br>
        <div class="container-xl wide-lg">
            <div class="nk-content-body">
                <div class="nk-block-head">
                    <div class="nk-block-between-md g-4">
                        <div class="nk-block-head-content">
                            <h2 class="nk-block-title fw-normal">Welcome back,
                                {{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}</h2>
                            {{-- <div class="nk-block-head-sub"><span style="color: #fff">Welcome to {{ config('app.name') }}</span> --}}
                        </div>
                    </div><!-- .nk-block-head-content -->

                    <div class="nk-block-head-content">
                        <ul class="nk-block-tools gx-3">
                            <li><a href="{{ route('user.deposit') }}" class="btn btn-primary"><span>Deposit</span> <em
                                        class="icon ni ni-arrow-long-right"></em></a></li>
                            <li><a href="{{ route('user.new.withdrawal') }}" class="btn btn-white btn-light"><span>Withdraw</span>
                                    <em class="icon ni ni-arrow-long-right d-none d-sm-inline-block"></em></a></li>
                        </ul>
                        <span class="text-success blink_me d-flex justify-content-end">{{ date('d-m-y H:i:s') }}</span>
                    </div><!-- .nk-block-head-content -->
                </div><!-- .nk-block-between -->
            </div><!-- .nk-block-head -->
            <div class="nk-block">
                <div class="row gy-gs">
                    <div class="col-lg-12 col-xl-12">
                        <div class="nk-block">

                            <div class="row g-2">

                                <div class="col-md-4">
                                    <div class="card card-bordered card-full">
                                        <div class="card-inner">
                                            <div class="card-title-group align-start mb-0">
                                                <div class="card-title">
                                                    <h6 class="subtitle">Available Balance</h6>
                                                </div>
                                                <div class="card-tools">
                                                    <em class="card-hint icon ni ni-help-fill" data-bs-toggle="tooltip"
                                                        data-bs-placement="left" title=""
                                                        data-bs-original-title="Total Amount Deposited and Earned on Modify Trades"
                                                        aria-label="Total Deposited"></em>
                                                </div>
                                            </div>
                                            <div class="card-amount">
                                                <span class="amount"><span>$</span>
                                                    {{ number_format($balances->balance, 2) }}<span
                                                        class="currency currency-usd">USD</span></span>
                                            </div>
                                            <div class="invest-data">
                                                <span><i class="icon ni ni-wallet-alt"></i> Capital</span>
                                            </div>
                                        </div>
                                    </div><!-- .card -->
                                </div>

                                <div class="col-md-4">
                                    <div class="card card-bordered card-full">
                                        <div class="card-inner">
                                            <div class="card-title-group align-start mb-0">
                                                <div class="card-title">
                                                    <h6 class="subtitle">Total Profit</h6>
                                                </div>
                                                <div class="card-tools">
                                                    <em class="card-hint icon ni ni-help-fill" data-bs-toggle="tooltip"
                                                        data-bs-placement="left" title=""
                                                        data-bs-original-title="Total Profit made with Modify Trades"
                                                        aria-label="Total Deposited"></em>
                                                </div>
                                            </div>
                                            <div class="card-amount">
                                                <span class="amount"><span>$</span>
                                                    {{ number_format($balances->profit, 2) }}<span
                                                        class="currency currency-usd">USD</span></span>
                                            </div>
                                            <div class="invest-data">
                                                <span><i class="icon ni ni-wallet-alt"></i> Earned</span>
                                            </div>
                                        </div>
                                    </div><!-- .card -->
                                </div>

                                <div class="col-md-4">
                                    <div class="card card-bordered card-full">
                                        <div class="card-inner">
                                            <div class="card-title-group align-start mb-0">
                                                <div class="card-title">
                                                    <h6 class="subtitle">Bonus</h6>
                                                </div>
                                                <div class="card-tools">
                                                    <em class="card-hint icon ni ni-help-fill" data-bs-toggle="tooltip"
                                                        data-bs-placement="left" title=""
                                                        data-bs-original-title="Currently Opened Positions (Investment) on Modify Trades"
                                                        aria-label="Total Deposited"></em>
                                                </div>
                                            </div>
                                            <div class="card-amount">
                                                <span
                                                    class="amount"><span>$</span>{{ number_format($balances->capital, 2) }}<span
                                                        class="currency currency-usd"> USD</span></span>
                                            </div>
                                            <div class="invest-data">
                                                <button id="openBonusModal"
                                                    class="btn btn-sm btn-primary {{ $balances->capital < 1 ? 'disabled' : '' }}"><i
                                                        class="icon ni ni-wallet-alt"></i>
                                                    Withdraw</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div><!-- .row -->
                        </div><!-- .nk-block -->

                    </div><!-- .col -->
                </div><!-- .row -->
            </div><!-- .nk-block -->
            <div class="nk-block">
                <div class="row">
                    <div class="col-lg-6" style="height: 500px !important">
                        <!-- TradingView Widget BEGIN -->
                        <div class="tradingview-widget-container" style="height:100%;width:100%">
                            <div id="tradingview_26077" style="height:calc(100% - 32px);width:100%"></div>
                            <div class="tradingview-widget-copyright"><a href="https://www.tradingview.com/"
                                    rel="noopener nofollow" target="_blank"><span class="blue-text">Track all markets on
                                        TradingView</span></a></div>
                            <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
                            <script type="text/javascript">
                                new TradingView.widget({
                                    "autosize": true,
                                    "symbol": "BINANCE:BTCUSDT",
                                    "interval": "1",
                                    "timezone": "Etc/UTC",
                                    "theme": "dark",
                                    "style": "1",
                                    "locale": "en",
                                    "enable_publishing": false,
                                    "allow_symbol_change": true,
                                    "container_id": "tradingview_26077"
                                });
                            </script>
                        </div>
                        <!-- TradingView Widget END -->
                    </div>
                    <div class="col-lg-6" style="height: 500px !important">
                        <!-- TradingView Widget BEGIN -->
                        <div class="tradingview-widget-container" style="height:100%;width:100%">
                            <div class="tradingview-widget-container__widget"></div>
                            <div class="tradingview-widget-copyright"><a href="https://www.tradingview.com/" rel="noopener nofollow" target="_blank"><span class="blue-text">Track all markets on TradingView</span></a></div>
                            <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-forex-cross-rates.js" async>
                            {
                            "currencies": [
                            "EUR",
                            "USD",
                            "JPY",
                            "GBP",
                            "CHF",
                            "AUD",
                            "CAD",
                            "NZD"
                            ],
                            "isTransparent": false,
                            "colorTheme": "light",
                            "locale": "en",
                            "backgroundColor": "#ffffff"
                        }
                            </script>
                        </div>
                        <!-- TradingView Widget END -->
                    </div>
                </div>
            </div>
            <div class="nk-block">
                <div class="card card-bordered">
                    <div class="nk-refwg">
                        <div class="nk-refwg-invite card-inner">
                            <div class="nk-refwg-head g-3">
                                <div class="nk-refwg-title">
                                    <h5 class="title">Refer Us & Earn ${{ $data->referral_price }}</h5>
                                    <div class="title-sub">Use the below link to invite your friends.</div>
                                </div>
                            </div>
                            <div class="nk-refwg-url">
                                <div class="form-control-wrap">
                                    <div class="form-clip clipboard-init" data-clipboard-target="#refUrl"
                                        data-success="Copied" data-text="Copy Link"><em
                                            class="clipboard-icon icon ni ni-copy"></em> <span class="clipboard-text">Copy
                                            Link</span></div>
                                    <div class="form-icon">
                                        <em class="icon ni ni-link-alt"></em>
                                    </div>
                                    <input readonly type="text" class="form-control copy-text" id="refUrl"
                                        value="{{ config('app.url') }}/myreferrals/{{ $referral->code }}">
                                </div>
                            </div>
                        </div><!-- .nk-refwg-invite -->
                        <div class="nk-refwg-stats card-inner bg-lighter">
                            <div class="nk-refwg-group g-3">
                                <div class="nk-refwg-name">
                                    <h6 class="title">My Referral <em class="icon ni ni-info" data-bs-toggle="tooltip"
                                            data-bs-placement="right" title="Referral Informations"></em></h6>
                                </div>
                                <div class="nk-refwg-info g-3">
                                    <div class="nk-refwg-sub">
                                        <div class="title">{{ $referral->count }}</div>
                                        <div class="sub-text">Total Joined</div>
                                    </div>
                                    <div class="nk-refwg-sub">
                                        <div class="title">$ {{ number_format($referral->bonus, 2) }}</div>
                                        <div class="sub-text">Referral Earn</div>
                                    </div>
                                </div>
                            </div>
                            <div class="nk-refwg-ck">
                                <canvas class="chart-refer-stats" id="refBarChart"></canvas>
                            </div>
                        </div><!-- .nk-refwg-stats -->
                    </div><!-- .nk-refwg -->
                </div><!-- .card -->
            </div><!-- .nk-block -->
        </div>
    </div>
    </div>

    <div class="modal fade bonusWithdrawalModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="bonusWithdrawalModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="bonusWithdrawalModalLabel">Process Bonus Withdrawal</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Bonus Amount</label>
                        <input type="text" class="form-control" id="bonus_amount"
                            value="{{ number_format($balances->capital, 2) }}">
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Wallet Name</label>
                        <select class="form-control" id="bonus_method">
                            <option value="">Select Wallet</option>
                            <option value="Bitcoin">Bitcoin</option>
                            <option value="Tether (USDT)">USDT</option>
                            <option value="Etherium">Etherium</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Wallet Address</label>
                        <input type="text" class="form-control" id="bonus_address"
                            placeholder="Enter Address Here">
                    </div>

                    <div class="text-center b-error text-danger"></div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id="submitBonus" class="btn btn-primary">Proceed</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#openBonusModal').click(function(e) {
            e.preventDefault();
            $('.bonusWithdrawalModal').modal('show');
        });
    });

    $(document).ready(function() {
        $('#submitBonus').click(function(e) {
            e.preventDefault();

            bonus_amount = $('#bonus_amount').val();
            bonus_method = $('#bonus_method').val();
            bonus_address = $('#bonus_address').val();

            if (bonus_amount == "") {
                $('.b-error').html('Enter Amount');
                return;
            }

            if (bonus_amount > {{ number_format($balances->capital, 2) }}) {
                $('.b-error').html('Insufficient Balance');
                return;
            }

            if (bonus_method == "") {
                $('.b-error').html('Select Wallet');
                return;
            }

            if (bonus_address == "") {
                $('.b-error').html('Enter Wallet Address');
                return;
            }


            $('.spinnner-wrapper').css('display', 'flex');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "post",
                url: "{{ route('user.withdrawal.bonus') }}",
                data: {
                    amount: bonus_amount,
                    address: bonus_address,
                    method: bonus_method
                },
                success: function(response) {
                    setTimeout(() => {
                        $('.spinnner-wrapper').css('display', 'none');
                        if (response.status == 200) {
                            $('.bonusWithdrawalModal').modal('hide');
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 2000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener(
                                        'mouseenter', Swal
                                        .stopTimer)
                                    toast.addEventListener(
                                        'mouseleave', Swal
                                        .resumeTimer)
                                }
                            })

                            Toast.fire({
                                icon: 'success',
                                title: '$' + bonus_amount +
                                    ' withdrawal successful!'
                            })
                        } else {
                            $('.b-error').html(response.message)
                            return;
                        }
                    }, 200);
                }
            });

        });
    });
</script>
@endsection
