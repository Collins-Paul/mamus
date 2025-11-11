@extends('layouts.index')

@section('title')
   Close Order
@endsection

@section('content')
    <div class="nk-content nk-content-fluid">
        <div class="container-xl wide-lg">
            <div class="nk-content-body">
                <div class="nk-block-head-content mb-4">
                    <div class="d-flex justify-content-between">
                        <h4 class="nk-block-title page-title">{{ $pair }}</h4>
                        <h4 class="nk-block-title page-title text-{{ $pl < 0 ? 'danger' : 'success' }}">${{ $pl }}</h4>
                    </div>
                </div>

                <div class="row g-2">
                    <div class="col-lg-6 widget-block" style="display: block;">
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
                    <div class="col-lg-5">
                        <div class="mx-2 vertical-scrollable">
                            <div class="row px-2">
                                <div class="card card-bordered shadow">
                                    <div class="card-inner">
                                        <form action="{{ route('admin.save.closed.trade') }}" class="form-validate is-alter" method="post">
                                            @csrf
                                            <div class="row g-gs">

                                                    <div class="form-group mb-0">
                                                        <label class="form-label" for="fva-full-name">Enter Current Price</label>
                                                        <div class="form-control-wrap">
                                                            <input type="text" class="form-control" placeholder="Enter Current Price" id="fva-full-name" name="current_price" required="">
                                                            @error('current_price')
                                                                <span id="-error" class="invalid">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <input type="hidden" name="order_id" value="{{$order_id}}" id="">

                                                    <div class="form-group mb-0">
                                                        <label class="form-label" for="fva-full-name">Edit P/L</label>
                                                        <div class="form-control-wrap">
                                                            <input type="number" class="form-control" value="{{ $pl }}" id="fva-full-name" name="pl" required="">
                                                            @error('pl')
                                                                <span id="-error" class="invalid">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-lg btn-block btn-primary">Close</button>
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
