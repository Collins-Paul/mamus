@extends('layouts.index')

@section('title')
    Robot Trading
@endsection

@section('content')
    <div class="nk-content nk-content-fluid">
        <div class="container-xl wide-lg">
            <div class="nk-content-body">
                <div class="nk-block-head-content mb-4">
                    <h3 class="nk-block-title page-title">Robot Trading</h3>
                </div>

                <div class="row g-2">
                    <div class="col-lg-6 widget-block" style="display: none;">
                        <div class="tradingview-widget-container">
                            <div id="tradingview_bcf4b"></div>
                            <div class="tradingview-widget-copyright market-view"></div>
                            <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="mx-2 vertical-scrollable">
                            <div class="row px-2">
                                <h6><img src="{{ asset('assets/images/robot-trading.jpeg') }}" alt="" style="width: 50px"> Robot Setup</h6>
                                <div class="card card-bordered">
                                    <div class="card-inner">
                                        <form action="{{ route('user.process.robot.order') }}" class="form-validate is-alter" novalidate="novalidate" method="post">
                                            @csrf
                                            <div class="row g-gs">

                                                <div class="form-group mb-0">
                                                    <label class="form-label" for="fva-full-name">Market</label>
                                                    <div class="form-control-wrap">
                                                        <select class="form-control" name="market" id="market"">
                                                            <option value="">Choose Market</option>
                                                            <option value="forex">Forex</option>
                                                            <option value="crypto">Crypto</option>
                                                            <option value="stock">Stock</option>
                                                        </select>
                                                        @error('market')
                                                            <span id="-error" class="invalid">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group mb-0">
                                                    <label class="form-label" for="fva-full-name">Symbol</label>
                                                    <div class="form-control-wrap">
                                                        <select  class="form-control" name="symbols" id="symbols">
                                                            <option value=""><-- Choose Symbol --></option>
                                                        </select>
                                                        @error('symbol')
                                                            <span id="-error" class="invalid">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                    <div class="form-group mb-0">
                                                        <label class="form-label" for="fva-full-name">Robot ID</label>
                                                        <div class="form-control-wrap">
                                                            <input type="text" class="form-control" placeholder="Enter ID" id="fva-full-name" name="robot_id" required="">
                                                            @error('robot_id')
                                                                <span id="-error" class="invalid">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="form-group mb-0">
                                                        <label class="form-label" for="fva-full-name">Margin</label>
                                                        <div class="form-control-wrap">
                                                            <input type="text" class="form-control" placeholder="Enter Margin in USD" id="fva-full-name" name="amount" required="">
                                                            @error('amount')
                                                                <span id="-error" class="invalid">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-lg btn-primary">Start</button>
                                                    </div>
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
@endsection

@section('script')
<script>

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

    $(document).ready(function(){
      $('#market').change(function (e) {
        e.preventDefault();
            market = $('#market').val();

            var element = $('#symbols');
            var symbols = null;
            var vendor = null;
            var selectElement = $('<select>');

            $(element).find('option')
                        .remove()
                        .end()
                        .append('<option value="">' + market + ' symbols</option>')
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

            $.each(symbols, function (indexInArray, valueOfElement) {
                selectElement.append($('<option></option>').val(valueOfElement).html(valueOfElement));
            });
            $(element).append(selectElement.html());
        });


        $('#symbols').change(function (e) {
            e.preventDefault();

            market = $('#market :selected').val();
            symbol = $('#symbols :selected').val();
            symbol = symbol.replace('/', '');

            if (market == 'forex') {
                vendor = 'FX';
            } else if (market == 'crypto') {
                vendor = 'BINANCE';
            } else if (market == 'stock') {
                vendor =  'NASDAQ';
            } else {
                window.alert('Invalid Market');
                return;
            }

            document.querySelector('.widget-block').style.display = 'block';

            $('.market-view').html('<a href="https://www.tradingview.com/symbols/'+symbol+'/?exchange="'+vendor+' rel="noopener" target="_blank"><span class="blue-text fw-bold">'+symbol+' Live Chart</span></a>');

            new TradingView.widget(
                    {
                    "width": "100%",
                    "height": 400,
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
    });
</script>

@endsection
