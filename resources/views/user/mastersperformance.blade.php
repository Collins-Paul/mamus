@extends('layouts.index')

@section('title')
    Master's performance
@endsection

@section('content')
    <div class="nk-content nk-content-fluid p-1">
        <div class="container-xl wide-lg">
            <div class="nk-content-body mb-2">
                <div class="d-flex">
                    <div style="
                    width: 50px !important;
                    height: 50px !important;
                    border-radius: 100px !important;
                    background-position: center !important;
                    background-size: contain !important;
                    background: url({{ asset('traders-photo/'.$masterInfo->photo) }});
                    "></div>
                    <div class="master-name ms-2 d-flex align-items-center">
                        <p class="fs-6">{{ Str::ucfirst($masterInfo->username) }}</p>
                    </div>
                </div>
            </div>

            <ul class="nav nav-tabs nav-tabs-s2 border-bottom border-normal">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#tabItem9">SUMMARY</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#tabItem10">TRADES</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tabItem9">
                    <div class="row">
                        <div class="col-lg-12">
                            <?php
                            use App\Models\Copier;
                            use App\Http\Controllers\AppLogicController;

                            //count the number of copiers the master has
                            $getCopiers = Copier::where('master_id' ,$masterInfo->id)->get();

                            if ($masterInfo->capital == 0.00) {
                               $gain = 0;
                            } else {
                                $gain = ($masterInfo->profit/$masterInfo->capital) * 100;
                            }

                            //set the color of the risk badge
                           if($masterInfo->risk_score <=2) {
                                $color = 'bg-success';
                           } elseif($masterInfo->risk_score <=4) {
                                $color = 'bg-warning';
                           } else {
                                $color = 'bg-danger';
                           }

                           ?>
                            <div class="border-bottom  rounded-bottom">
                                <ul class="pricing-features payment-methods">
                                    <li class="payment-wallet-area border-bottom border-normal mb-0 pb-2">
                                        <span class="w-50">
                                            <p class="m-0">Minimum investment</p>
                                        </span>
                                        <span class="ms-auto">
                                            <h4 class="m-0">${{ $masterInfo->minimum_investment }}</h4>
                                        </span>
                                    </li>

                                    <li class="payment-wallet-area  border-bottom border-normal mb-0 pb-2">
                                        <span class="w-50 d-flex align-items-center">
                                            <p class="m-0">
                                                <span class="badge rounded-pill {{$color}}">{{ $masterInfo->risk_score }} risk</span>
                                            </p>
                                        </span>
                                        <span class="ms-auto">
                                            <p class="m-0">
                                                <em class="icon ni ni-help-fill" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Risk Score: The higher it is, the greater the chance of losing your investment. The score depends on the Master Trader's average profit, number of orders, and how stable their strategy is."></em>
                                            </p>
                                        </span>
                                    </li>

                                    <li class="payment-wallet-area  border-bottom border-normal mb-0 pb-2">
                                        <span class="w-50 d-flex align-items-center">
                                            <p><em class="icon ni ni-star"></em> {{ $masterInfo->expertise }}</p>
                                        </span>
                                        <span class="ms-auto">
                                            <p class="m-0">
                                                <em class="icon ni ni-help-fill" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Master Traders' expertise: The expertise rank depends on how long the Master Trader trades with us, how many trades they have made, and what volume they've traded."></em>
                                            </p>
                                        </span>
                                    </li>
                                </ul>

                                <div class="mt-4 px-2 d-flex justify-content-between">
                                    <div>
                                        <p class="mb-1">Equity</p>
                                        <h6>$ {{ number_format($equity, 2) }}</h6>
                                    </div>
                                    <div>
                                        <p class="mb-1">Commission</p>
                                        <h6>{{ number_format($masterInfo->commission, 2) }}%</h6>
                                    </div>
                                    <div>
                                        <p class="mb-1">With Us</p>
                                        <h6>{{ AppLogicController::daysAgo($masterInfo->created_at) }}d</h6>
                                    </div>
                                </div>

                                <div class="my-4 px-2">
                                    <p class="fw-bold mb-0 pb-1">Strategy Description</p>
                                    <p style="text-align: justify">{{ $masterInfo->description }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="px-2 py-4 my-3 shadow rounded-3">
                                <h6>Performance</h6>

                                <div class="mt-4 d-flex justify-content-between">
                                    <div>
                                        <p class="mb-1">Gain</p>
                                        <h6>{{ number_format($gain,2) }}%</h6>
                                    </div>
                                    <div class="w-50">
                                        <p class="mb-1 d-flex align-items-start">Copiers</p>
                                        <h6 class="d-flex align-items-start">{{ $getCopiers->count() }}</h6>
                                    </div>
                                </div>

                                <div class="mt-2 border-bottom pb-1 border-3 border-success d-flex justify-content-between">
                                    <div>
                                        <p class="mb-0">Profit and loss</p>
                                        <h6 class="text-success">$ {{ number_format($masterInfo->profit,2) }}</h6>
                                    </div>
                                    <div class="d-flex align-items-end">
                                        <h6 class="text-danger">$ {{ number_format($masterInfo->loss,2) }}</h6>
                                    </div>
                                </div>

                                {{-- <div class="mt-2 d-flex justify-content-evenly">
                                    <span class="badge rounded-pill bg-light px-3">2W</span>
                                    <span class="badge rounded-pill bg-dark px-3">1M</span>
                                    <span class="badge rounded-pill bg-light px-3">3M</span>
                                    <span class="badge rounded-pill bg-light px-3">6M</span>
                                    <span class="badge rounded-pill bg-light px-3">All</span>
                                </div> --}}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="px-2 py-4 my-3 shadow rounded-3">
                                <h6>Account details</h6>

                                <div class="mt-4 d-flex justify-content-between">
                                    <div>
                                        <p class="mb-1">Floating Profit  <em class="icon ni ni-help-fill" data-bs-toggle="tooltip" data-bs-placement="bottom" title=""></em></p>
                                        <h6>$ {{ number_format($equity, 2) }}</h6>
                                    </div>
                                    <div>
                                        <p class="mb-1">Balance <em class="icon ni ni-help-fill" data-bs-toggle="tooltip" data-bs-placement="bottom" title=""></em></p>
                                        <h6 class="d-flex align-items-end">$ {{ number_format($masterInfo->balance, 2) }}</h6>
                                    </div>
                                </div>

                                <div class="mt-4 d-flex justify-content-between">
                                    <div>
                                        <p class="mb-1">Master Trader's Bonus <em class="icon ni ni-help-fill" data-bs-toggle="tooltip" data-bs-placement="bottom" title=""></em></p>
                                        <h6>$ {{ number_format($masterInfo->bonus, 2) }}</h6>
                                    </div>
                                    <div>
                                        <p class="mb-1">Leverage <em class="icon ni ni-help-fill" data-bs-toggle="tooltip" data-bs-placement="bottom" title=""></em></p>
                                        <h6 class="d-flex align-items-end">{{ $masterInfo->leverage }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="px-2 py-4 my-3 shadow rounded-3">
                                <h6>Risk management</h6>

                                <div class="mt-2">
                                    <div>
                                        <p class="mb-1">Maximum Unrealised Loss  <em class="icon ni ni-help-fill" data-bs-toggle="tooltip" data-bs-placement="bottom" title=""></em></p>
                                        <h6>-$ {{ $masterInfo->max_unrealised_loss }}</h6>
                                    </div>
                                    <div class="mt-3">
                                        <p class="mb-1">Maximum Drawdown Duration <em class="icon ni ni-help-fill" data-bs-toggle="tooltip" data-bs-placement="bottom" title=""></em></p>
                                        <h6 class="d-flex align-items-end">{{ $masterInfo->max_drawndown_duration }}d</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="row">
                        <div class="col-lg-6">
                            <div class="my-2 text-center">
                                @if($balances->balance <= 0.00)
                                    <button class="btn btn-success rounded-pill px-5"  data-bs-toggle="modal" data-bs-target="#staticBackdrop" type="button">SET UP COPYING</button>
                                @else
                                    <a href="{{ route('user.copy.setup', ['id' => encrypt($masterInfo->id)]) }}">
                                        <button class="btn btn-success rounded-pill px-5" type="button">SET UP COPYING</button>
                                    </a>
                                @endif

                            </div>
                        </div>
                    </div> --}}
                </div>

                <div class="tab-pane" id="tabItem10">
                    <div class="row">
                        @include('includes.open-order')
                    </div>
                </div>
            </div>



            <div class="position-fixed p-2 bg-black text-white rounded-circle" style="bottom: 4%; right: 3%; z-index: 1000; width: 50px; height:50px">
                <em class="fs-3 icon ni ni-opt-dot-alt"></em>
            </div>
        </div>
    </div>

     <!-- Modal -->
 <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-body">
            <div class="text-center">
                <div class="pb-2">
                    <img src="{{ asset('assets/images/info.jfif') }}" alt="" width="40">
                </div>
                <h5>Add money to start copying</h5>
                <p>We have a special Wallet to help you percel your investments between Masters. First, you need to deposit money to it -without commission.</p>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-light" data-bs-dismiss="modal">CANCEL</button>
            <a href="{{ route('user.deposit') }}">
                <button type="" id="submitDeposit" class="btn btn-success">DEPOSIT</button>
            </a>
        </div>
    </div>
    </div>
</div>

@include('includes.script')
@endsection
