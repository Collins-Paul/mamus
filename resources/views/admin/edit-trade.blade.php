@extends('layouts.index')

@section('title')
   Edit Order
@endsection

@section('content')
    <div class="nk-content nk-content-fluid">
        <div class="container-xl wide-lg">
            <div class="nk-content-body">
                <div class="row g-2">

                    <div class="col-lg-6 widget-block" style="display: {{ $method == 'robot' ? 'block' : 'none' }};">
                        <!-- TradingView Widget BEGIN -->
                        <div class="tradingview-widget-container">
                            <div id="tradingview_19621"></div>
                            <div class="tradingview-widget-copyright"><a href="https://www.tradingview.com/symbols/{{ $pair }}/" rel="noopener" target="_blank"><span class="blue-text">{{ $pair }} Chart</span></a></div>
                            <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
                            <script type="text/javascript">
                            new TradingView.widget(
                            {
                                "width": "100%",
                                "height": 320,
                                "symbol": "{{ $vendor }}:{{ $pair }}",
                                "interval": "D",
                                "timezone": "Etc/UTC",
                                "theme": "light",
                                "style": "1",
                                "locale": "en",
                                "toolbar_bg": "#f1f3f6",
                                "enable_publishing": false,
                                "hide_top_toolbar": true,
                                "save_image": false,
                                "container_id": "tradingview_19621"
                            }
                            );
                            </script>
                        </div>
                    <!-- TradingView Widget END -->
                    </div>

                    <div class="col-lg-6">
                        <div class="mx-2 vertical-scrollable">
                            <div class="row px-2">
                                <div class="card card-bordered shadow">
                                    <div class="card-inner">
                                        <form action="{{ route('admin.save.edited.trade') }}"  method="post">
                                            @csrf
                                            <div class="row g-gs">
                                                    <div class="form-group mb-0">
                                                        <label class="form-label" for="fva-full-name">Edit Trade Floating P/L</label>
                                                        <div class="form-control-wrap">
                                                            <ul>
                                                                <li>
                                                                    <div class="d-flex justify-content-between">
                                                                        <p>Order ID:</p>
                                                                        <p class="fw-bold">{{ $order_ref }}</p>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="d-flex justify-content-between">
                                                                        <p>Pair:</p>
                                                                        <p class="fw-bold">{{ $pair }}</p>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="d-flex justify-content-between">
                                                                        <p>Order:</p>
                                                                        <p class="text-{{ $type == 'sell' ? 'danger' : 'success' }} fw-bold">{{ Str::upper($type) }}</p>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="d-flex justify-content-between">
                                                                        <p>Floating P/L:</p>
                                                                        <p class="text-{{ $pl < 0 ? 'danger' : 'success' }} fw-bold">${{ number_format($pl, 2) }}</p>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                            <input type="hidden" value="{{ $order_id }}" name="order_id">
                                                            <input type="text" class="form-control" placeholder="Enter Profit or Loss" value="{{ $pl }}" name="pl" required>
                                                            @if ($method == 'robot' && $type == null)
                                                            <div class="my-2">
                                                                <select class="form-control" name="order_type">
                                                                    <option value="">Select Order</option>
                                                                    <option value="buy">Buy</option>
                                                                    <option value="sell">Sell</option>
                                                                </select>
                                                            </div>
                                                            <div class="my-2">
                                                                <input class="form-control type="text" placeholder="Entry Price" name="entry_price">
                                                            </div>
                                                            <div class="my-2">
                                                                <input class="form-control type="number" placeholder="Enter lot size" name="lot_size">
                                                            </div>
                                                            @endif
                                                            @error('pl')
                                                                <span id="-error" class="invalid">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-lg btn-block btn-outline-primary">Save</button>
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
