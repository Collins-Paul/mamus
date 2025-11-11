@extends('layouts.index')

@section('title')
    Create Order
@endsection

@section('content')
    <div class="nk-content nk-content-fluid py-0">
        <div class="container-xl wide-lg">
            <div class="nk-content-body">
                <div class="row g-2">
                    <div class="col-lg-12 my-5">
                        <div class="d-flex justify-content-between me-2">
                            <div>
                                <select class="border-0 place-order-symbols" name="market" id="market" style="width: %">
                                    <option value="">Market</option>
                                    <option value="forex">Forex</option>
                                    <option value="crypto">Crypto</option>
                                    <option value="stock">Stock</option>
                                </select>
                            </div>
                            <div class="d-flex align-items-center">
                                <select name="symbols" id="symbols" class="border-0 place-order-symbols text-end">
                                    <option value="">Symbols</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="forex-interface row g-2">
                    <div class="col-lg-12 d-flex justify-content-center mt-0">
                        <select name="order-type" id="order_type" class="text-center border-0 place-order-symbols">
                            <option value="">Market Execution</option>
                        </select>
                    </div>

                    <div class="col-lg-12 d-flex justify-content-between">
                        <input type="button" value="- 0.1" id="decrease-lot-a"
                            class="text-center border-0 place-order-symbols">
                        <input type="button" value="- 0.01" id="decrease-lot-b"
                            class="text-center border-0 place-order-symbols">
                        <input type="number" value="0" id="lot-size" step="0.01"
                            class="text-center border-0 place-order-symbols">
                        <input type="button" value="+ 0.01" id="increase-lot-a"
                            class="text-center border-0 place-order-symbols">
                        <input type="button" value="+ 0.1" id="increase-lot-b"
                            class="text-center border-0 place-order-symbols">
                    </div>

                    <div class="col-lg-12 d-flex justify-content-center">
                        <input type="number" class="text-center border-0 place-order-symbols" placeholder="Entry Price"
                            id="lp">
                    </div>

                    <div class="col-lg-12 d-flex justify-content-center">
                        <div class="w-50">
                            <input type="button" value="-" class="sl-plus-btn" onclick="SLdecrease()">
                            <input type="number" value="0.00" placeholder="SL" class="text-center sl-field">
                            <input type="button" value="+" class="sl-minus-btn" onclick="SLincrease()">
                        </div>
                        <div class="w-50">
                            <input type="button" value="-" class="tp-plus-btn" onclick="TPdecrease()">
                            <input type="text" value="0.00" placeholder="TP" class="text-center tp-field">
                            <input type="button" value="+" class="tp-minus-btn" onclick="TPincrease()">
                        </div>
                    </div>

                    <input type="hidden" value="{{ $master_id }}" id="master_id">
                    <input type="hidden" value="{{ $master_bal }}" id="master_bal">

                    <div class="col-lg-12 widget-block" style="display: none;">
                        <!-- TradingView Widget BEGIN -->
                        {{-- <div class="col-lg-6 widget-block" style="display: none;"> --}}
                        <div class="tradingview-widget-container">
                            <div id="tradingview_bcf4b"></div>
                            <div class="tradingview-widget-copyright market-view"></div>
                            <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
                        </div>
                        <!-- TradingView Widget END -->
                    </div>

                    <div class="col-lg-12 d-flex justify-content-center mb-5">
                        <button type="button"
                            class="sellOrder btn btn-danger mx-1 w-100 d-flex justify-content-center">SELL <em
                                class="icon ni ni-trend-down"></em></button>
                        <button type="button" class="buyOrder btn btn-success mx-1 w-100 d-flex justify-content-center">BUY
                            <em class="icon ni ni-trend-up"></em></button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
                $(document).ready(function () {
            document.querySelector('.widget-block').style.display = 'block';
            var vendor = 'BINANCE';
            var symbol = 'BTCUSDT';

            $('.market-view').html('<a href="https://www.tradingview.com/symbols/'+symbol+'/?exchange="'+vendor+' rel="noopener" target="_blank"><span class="blue-text fw-bold">'+symbol+' Live Chart</span></a>');

                new TradingView.widget(
                        {
                        "width": "100%",
                        "height": 350,
                        "symbol": vendor +":"+ symbol,
                        "interval": "D",
                        "timezone": "Etc/UTC",
                        "theme": "light",
                        "style": "1",
                        "locale": "en",
                        "toolbar_bg": "#f1f3f6",
                        "enable_publishing": false,
                        "hide_top_toolbar": true,
                        "save_image": false,
                        "container_id": "tradingview_bcf4b"
                    }
                );
        });

        $(document).ready(function() {
            $('.buyOrder').click(function(e) {
                e.preventDefault();

                market = $('#market').val();
                symbols = $('#symbols').val();
                lot_size = $('#lot-size').val();
                last_price = $('#lp').val();
                master_id = $('#master_id').val();
                master_balance = $('#master_bal').val();

                if (market == "") {
                    alert('Select Market');
                    return;
                }

                if (symbols == "") {
                    alert('Select Pair');
                    return;
                }

                if (lot_size == "" || lot_size == 0) {
                    alert('Enter position size');
                    return;
                }

                if (last_price == "") {
                    alert('Enter Market Current Price');
                    return;
                }

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.buyOrder') }}",
                    data: {
                        market: $('#market').val(),
                        symbols: $('#symbols').val(),
                        lot_size: $('#lot-size').val(),
                        last_price: $('#lp').val(),
                        master_id: $('#master_id').val(),
                        master_bal: $('#master_bal').val()
                    },
                    // dataType: "application/json",
                    success: function(response) {
                        if (response.status == 200) {
                            console.log(response.message);
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 2000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal
                                        .stopTimer)
                                    toast.addEventListener('mouseleave', Swal
                                        .resumeTimer)
                                }
                            })

                            Toast.fire({
                                icon: 'success',
                                title: '$' + response.message + " buy order placed!"
                            })
                        } else {
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 2000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal
                                        .stopTimer)
                                    toast.addEventListener('mouseleave', Swal
                                        .resumeTimer)
                                }
                            })

                            Toast.fire({
                                icon: 'error',
                                title: response.message
                            })
                        }
                    }
                });
            });
        });

        $(document).ready(function() {
            $('.sellOrder').click(function(e) {
                e.preventDefault();

                market = $('#market').val();
                symbols = $('#symbols').val();
                lot_size = $('#lot-size').val();
                last_price = $('#lp').val();
                master_id = $('#master_id').val();
                master_balance = $('#master_bal').val();

                if (market == "") {
                    alert('Select Market');
                    return;
                }

                if (symbols == "") {
                    alert('Select Pair');
                    return;
                }

                if (lot_size == "" || lot_size == 0) {
                    alert('Enter position size');
                    return;
                }

                if (last_price == "") {
                    alert('Enter Market Current Price');
                    return;
                }

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.sellOrder') }}",
                    data: {
                        market: $('#market').val(),
                        symbols: $('#symbols').val(),
                        lot_size: $('#lot-size').val(),
                        last_price: $('#lp').val(),
                        master_id: $('#master_id').val(),
                        master_bal: $('#master_bal').val()
                    },
                    // dataType: "application/json",
                    success: function(response) {
                        if (response.status == 200) {
                            console.log(response.message);
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 2000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal
                                        .stopTimer)
                                    toast.addEventListener('mouseleave', Swal
                                        .resumeTimer)
                                }
                            })

                            Toast.fire({
                                icon: 'success',
                                title: '$' + response.message + " buy order placed!"
                            })
                        } else {
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 2000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal
                                        .stopTimer)
                                    toast.addEventListener('mouseleave', Swal
                                        .resumeTimer)
                                }
                            })

                            Toast.fire({
                                icon: 'error',
                                title: response.message
                            })
                        }
                    }
                });
            });
        });

        function SLincrease() {
            var sl = document.querySelector('.sl-field');
            var val = sl.value;
            sl.value = parseFloat(val) + 1;
        }

        function SLdecrease() {
            var sl = document.querySelector('.sl-field');
            var val = sl.value;
            sl.value = parseFloat(val) - 1;
        }

        function TPincrease() {
            var sl = document.querySelector('.tp-field');
            var val = sl.value;
            sl.value = parseFloat(val) + 1;
        }

        function TPdecrease() {
            var sl = document.querySelector('.tp-field');
            var val = sl.value;
            sl.value = parseFloat(val) - 1;
        }

        function forexPairs() {
            var forex_pairs = [
                'EUR/USD', 'GBP/USD', 'USD/JPY', 'GBP/JPY',
                'GBP/JPY', 'AUD/USD', 'USD/CAD', 'EUR/JPY',
                'USD/CHF', 'NZD/USD', 'AUD/JPY', 'EUR/GBP',
                'EUR/AUD', 'GBP/AUD', 'CAD/JPY', 'AUD/CAD',
                'EUR/CAD', 'CHF/JPY', 'GBP/CAD', 'AUD/NZD',
                'GBP/CHF', 'EUR/NZD', 'EUR/CHF', 'GBP/NZD',
                'NZD/CAD', 'AUD/CHF', 'CAD/CHF', 'NZD/JPY',
                'NZD/CHF', 'USD/ZAR', 'USD/MXN', 'USD/CNH'
            ]
            return forex_pairs;
        }

        function cryptoPairs() {
            var cryptos = [
                'BTCUSDT', 'BTCUSDT.P', 'ETHUSDT.P', 'BTCUSD.P',
                'INJUSDT.P', 'SOLUSDT.P', 'MATICUSDT.P', 'ARBUSDT.P',
                'XRPUSDT.P', 'BNBUSDT.P', 'RNDRUSDT.P', 'DOGEUSDT.P',
                'ADAUSDT.P', 'IDUSDT.P', 'DYDXUSDT.P', 'OPUSDT.P',
                'EGLDUSDT.P', 'AVAXUSDT.P', 'FTMUSDT.P', 'TOMOUSDT.P',
                'MASKUSDT.P', 'APTUSDT.P', 'LINKUSDT.P', 'SXPUSDT.P',
                'BTCBUSD.P', 'GALAUSDT.P', 'XBTUSDT.P', 'DOTUSDT.P',
                'COCOSUSDT.P', 'LTCUSDT.P', 'CFXUSDT.P', 'WOOUSDT.P',
                'ATOMUSDT.P', 'RNDRUSDT.P', 'APEUSDT.P', 'ZILUSDT.P',
                'ETHUSD.P', 'LDOUSDT.P', 'NEARUSDT.P', 'BANDUSDT.P',
                'LINAUSDT.P', 'SANDUSDT.P', 'GMTUSDT.P', 'MANAUSDT.P'
            ];
            return cryptos;
        }

        function stockSymbols() {
            var stocks = [
                'RIOT', 'TSLA', 'AAPL', 'MSFT', 'META', 'NVDA',
                'AMZN', 'AMD', 'GOOGL', 'NFLX', 'GOOG', 'COIN',
                'MARA', 'ENPG', 'INTC', 'BBBY', 'ROKU', 'PYPL',
                'LCID', 'COST', 'CXAI', 'ABNB', 'MU', 'MSTR', 'ATVI',
                'SAI', 'SBUX', 'MRNA', 'ADBE', 'RIVN', 'CRWD', 'AAL',
                'FSLR', 'SOFI', 'DKGN', 'DDOG', 'CROX', 'PEP', 'QCOM',
                'CLSK', 'PLUG', 'ZM', 'MULN', 'PACW', 'JD', 'CFRX', 'LULU'
            ];
            return stocks;
        }

        $(document).ready(function() {
            $('#market').change(function(e) {
                e.preventDefault();
                market = $('#market').val();

                var element = $('#symbols');
                var symbols = null;
                var vendor = null;
                var selectElement = $('<select>');

                $(element).find('option')
                    .remove()
                    .end()
                    // .append('<option value=""></option>')
                    .val('');

                if (market == 'forex') {
                    symbols = forexPairs();
                } else if (market == 'crypto') {
                    symbols = cryptoPairs();
                } else if (market == 'stock') {
                    symbols = stockSymbols();
                } else {
                    window.alert('Invalid Market');
                    return;
                }

                $.each(symbols, function(indexInArray, valueOfElement) {
                    selectElement.append($('<option></option>').val(valueOfElement).html(
                        valueOfElement));
                });
                $(element).append(selectElement.html());
            });


            $('#symbols').change(function(e) {
                e.preventDefault();

                market = $('#market :selected').val();
                symbol = $('#symbols :selected').val();

                if (market == 'forex') {
                    vendor = 'FX';
                    from = symbol.substring(0, 3);
                    to = symbol.substr(symbol.length - 3)

                    $.getJSON('https://api.fastforex.io/fetch-multi?from=' + from + '&to=' + to +
                        '&api_key=4d39c755a9-e34f008a19-ru9wj5',
                        function(data) {
                            console.log(data.results);
                            $('#lp').val(data.results[to]);
                        }
                    );

                } else if (market == 'crypto') {
                    vendor = 'BINANCE';
                    from = symbol.substring(0, 3);
                    to = symbol.substr(symbol.length - 3);

                    $.getJSON('https://api.fastforex.io/fetch-multi?from=' + from + '&to=' + to +
                        '&api_key=4d39c755a9-e34f008a19-ru9wj5',
                        function(data) {
                            console.log(data.results);
                            $('#lp').val(data.results[to]);
                        }
                    );
                } else if (market == 'stock') {
                    vendor = 'NASDAQ';
                    $('#lp').val('0');
                } else {
                    window.alert('Invalid Market');
                    return;
                }


                symbol = symbol.replace('/', '');


                document.querySelector('.widget-block').style.display = 'block';

                $('.market-view').html('<a href="https://www.tradingview.com/symbols/' + symbol +
                    '/?exchange="' + vendor +
                    ' rel="noopener" target="_blank"><span class="blue-text fw-bold">' + symbol +
                    ' Live Chart</span></a>');

                new TradingView.widget({
                    "width": "100%",
                    "height": 350,
                    "symbol": vendor + ":" + symbol,
                    "interval": "D",
                    "timezone": "Etc/UTC",
                    "theme": "light",
                    "style": "1",
                    "locale": "en",
                    "toolbar_bg": "#f1f3f6",
                    "enable_publishing": false,
                    "hide_top_toolbar": true,
                    "save_image": false,
                    "container_id": "tradingview_bcf4b"
                });
            });
        });

        $(document).ready(function() {
            $('#increase-lot-a').click(function(e) {
                e.preventDefault();
                lot = $('#lot-size');
                console.log();
                lot.val(parseFloat(lot.val()) + parseFloat(0.01));
                lot.val(Math.round(lot.val() * 100) / 100);
            });

            $('#increase-lot-b').click(function(e) {
                e.preventDefault();
                lot = $('#lot-size');
                console.log();
                lot.val(parseFloat(lot.val()) + parseFloat(0.1));
                lot.val(Math.round(lot.val() * 100) / 100);
            });

            $('#decrease-lot-b').click(function(e) {
                e.preventDefault();
                lot = $('#lot-size');
                console.log();
                if (lot.val() > 0) {
                    lot.val(parseFloat(lot.val()) - parseFloat(0.01));
                    lot.val(Math.round(lot.val() * 100) / 100);
                }
            });

            $('#decrease-lot-a').click(function(e) {
                e.preventDefault();
                lot = $('#lot-size');
                console.log();
                if (lot.val() > 0) {
                    lot.val(parseFloat(lot.val()) - parseFloat(0.1));
                    lot.val(Math.round(lot.val() * 100) / 100);
                }
            });
        });
    </script>
@endsection
