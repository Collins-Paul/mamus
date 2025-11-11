@extends('layouts.index')

@section('title')
    Copy Trades
@endsection

@section('content')
    <div class="nk-content nk-content-fluid p-1">
        <div class="container-xl wide-lg p-0">
            <div class="nk-content-body">
                @include('includes.bottomnav')
                <div class="nk-block-head pb-2">
                    <div class="g-4">
                        <div id="accordion" class="accordion p-0 rounded-bottom shadow-sm">
                            <div class="accordion-item">
                                <a href="#" class="accordion-head d-flex justify-content-between">
                                    <h6 class="title">Your stats</h6>
                                    <span class="">
                                        <em class="icon ni ni-downward-ios" onclick="showStats()" id="icon-down"></em>
                                        <em class="icon ni ni-upword-ios" onclick="hideStats()" style="display: none"
                                            id="icon-up"></em>
                                    </span>
                                </a>
                                <div class="accordion-body collapse" id="show-balances">
                                    <div class="accordion-inner pb-2">
                                        <div class="d-flex justify-content-between border-bottom">
                                            <p class="m-0">Balance</p>
                                            <p class="m-0">${{ number_format($balance->balance, 2) }}</p>
                                        </div>
                                        <div class="d-flex justify-content-between border-bottom pt-2">
                                            <p class="m-0">Profit</p>
                                            <p class="m-0">${{ number_format($balance->profit, 2) }}</p>
                                        </div>
                                        <div class="d-flex justify-content-between border-bottom pt-2">
                                            <p class="m-0">Unrealized P/L</p>
                                            <p class="m-0 text-{{ $unrealizedPL < 0 ? 'danger' : 'success' }}">
                                                ${{ $unrealizedPL }}</p>
                                        </div>
                                        <div class="d-flex justify-content-between border-bottom pt-2">
                                            <p class="m-0">Equity</p>
                                            <p class="m-0 text-success">${{ number_format($equity, 2) }}</p>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if ($copiers->count() == 0)
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 d-flex justify-content-center">
                       <div class="text-center my-5">
                            <div class="mb-3">
                                <span class="nk-menu-icon"><em class="icon ni ni-line-chart" style="font-size: 70px"></em></span>
                                <p>Currently, you are not copying any Master Trader.</p>
                            </div>
                            <div class="mb-0 ">
                                <a href="{{ route('user.rating') }}">
                                    <button class="btn btn-success rounded-pill" type="button">GO TO MASTER TRADERS' RATING</button>
                                </a>
                            </div>
                       </div>
                    </div>
                </div>
            </div>
        @else
            <div class="my-3">
                @include('includes.copytrades')
            </div>
        @endif
        <script>
            function showStats() {
                var showDetails = document.getElementById('show-balances');
                var icon_down = document.getElementById('icon-down');
                var icon_up = document.getElementById('icon-up');
                showDetails.style.display = 'block';
                icon_down.style.display = 'none';
                icon_up.style.display = 'block';
            }

            function hideStats() {
                var hideDetails = document.getElementById('show-balances');
                var icon_down = document.getElementById('icon-down');
                var icon_up = document.getElementById('icon-up');
                hideDetails.style.display = 'none';
                icon_up.style.display = 'none';
                icon_down.style.display = 'block';
            }
        </script>
    </div>
    {{-- @endif --}}
    @include('includes.script')
@endsection
