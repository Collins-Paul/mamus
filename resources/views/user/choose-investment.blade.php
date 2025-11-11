@extends('layouts.index')

@section('title')
    Choose Plan
@endsection

@section('content')
<div class="nk-content ">
    <div class="container">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between g-3">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Proceed with Plan</h3>
                            <div class="nk-block-des text-soft">
                                <p>Enter your capital amount below to get started.</p>
                            </div>
                        </div>
                    </div>
                </div><!-- .nk-block-head -->
                <div class="nk-block">
                    <div class="row g-gs">
                        <div class="col-md-6 col-xxl-3">
                            <div class="card card-bordered pricing shadow">
                                <div class="pricing-head">
                                    <div class="pricing-title">
                                        <h4 class="card-title title">{{ Str::ucfirst($plan->plan_title) }}</h4>
                                    </div>
                                    <div class="card-text">
                                        <div class="row">
                                            <div class="col-6">
                                                <span class="h4 fw-500">{{ number_format($plan->interest_percent, 1) }}%</span>
                                                <span class="sub-text">ROI</span>
                                            </div>
                                            <div class="col-6">
                                                <span class="h4 fw-500">{{ $plan->duration }}</span>
                                                <span class="sub-text">Week(s)</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="pricing-body">
                                    <ul class="pricing-features">
                                        <li><span class="w-50">Min Deposit</span> - <span class="ms-auto">${{ number_format($plan->min_deposit,2) }}</span></li>
                                        <li><span class="w-50">Max Deposit</span> - <span class="ms-auto">${{ number_format($plan->max_deposit,2) }}</span></li>
                                        <li><span class="w-50">Deposit Return</span> - <span class="ms-auto">{{ Str::ucfirst($plan->deposit_return) }}</span></li>
                                    </ul>
                                </div>
                                <form action="{{ route('user.investment.save') }}" method="post">
                                    @csrf
                                    <div class="form-group p-3">
                                        <input type="hidden" value="{{ encrypt($plan->id) }}" name="plan_id">
                                        <div class="form-control-wrap">
                                            <input type="text" name="amount" class="form-control form-control-lg text-center" placeholder="Enter amount $0.00">
                                            @error('amount')
                                                <span id="-error" class="invalid">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-control-wrap text-center mt-3">
                                            <input type="submit" class="btn btn-success" value="Get Started">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div><!-- .nk-block -->
            </div>
        </div>
    </div>
</div>
@endsection

