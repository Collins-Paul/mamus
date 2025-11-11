@extends('layouts.index')

@section('title')
    Crypto Market Order
@endsection

@section('content')
    <div class="nk-content nk-content-fluid">
        <div class="container-xl wide-lg">
            <div class="nk-content-body">
                <div class="nk-block-head-content mb-4">
                    <h3 class="nk-block-title page-title">Crypto Chart</h3>
                </div>

                <div class="row g-2">
                    <div class="col-lg-9">
                      <!-- TradingView Widget BEGIN -->
                            <div class="tradingview-widget-container">
                                <div id="tradingview_bcf4b"></div>
                                <div class="tradingview-widget-copyright"><a href="https://www.tradingview.com/symbols/MATICUSDT/?exchange=BINANCE" rel="noopener" target="_blank"><span class="blue-text">ETHUSDT chart</span></a> by TradingView</div>
                                <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
                                <script type="text/javascript">
                                new TradingView.widget(
                                {
                                "width": "100%",
                                "height": 610,
                                "symbol": "BINANCE:MATICUSDT",
                                "interval": "D",
                                "timezone": "Etc/UTC",
                                "theme": "light",
                                "style": "1",
                                "locale": "en",
                                "toolbar_bg": "#f1f3f6",
                                "enable_publishing": false,
                                "container_id": "tradingview_bcf4b"
                            }
                                );
                                </script>
                            </div>
                    <!-- TradingView Widget END -->
                    </div>
                    <div class="col-lg-3">
                        <div class="mx-2 vertical-scrollable">
                            <div class="row px-2">
                                <table class="w-100">
                                    <thead>
                                        <tr>
                                            <th class="text-start">Symbol</th>
                                            <th class="text-end">Crypto Pair</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-start"><a href="">BTC</a></td>
                                            <td class="text-end"><a href="">BTC/USDT</a></td>
                                        </tr>
                                        <tr>
                                            <td class="text-start"><a href="">ETH</a></td>
                                            <td class="text-end"><a href="">ETH/USDT</a></td>
                                        </tr>
                                        <tr>
                                            <td class="text-start"><a href="">XRP</a></td>
                                            <td class="text-end"><a href="">XRP/USDT</a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
