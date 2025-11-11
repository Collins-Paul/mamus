
@if (Route::currentRouteName() == 'home.plans' || Route::currentRouteName() == 'home.index')
<div class="row clearfix">
    @forelse ($plans as $plan)
    <div class="col-lg-4 col-md-6 col-sm-12 account-block my-3">
        <div class="account-block-two wow fadeInUp animated animated" data-wow-delay="00ms" data-wow-duration="1500ms" style="visibility: visible; animation-duration: 1500ms; animation-delay: 0ms; animation-name: fadeInUp;">
            <div class="inner-box">
                <div class="upper-box centred">
                    <div class="shape" style="background-image: url({{asset('home-assets/images/shape/shape-13.png')}});"></div>
                    <h3>{{ Str::ucfirst($plan->plan_title) }}</h3>
                    <p class="fw-500">{{ $plan->duration }} week(s)</p>
                    <div class="icon-box"><img src="{{asset('home-assets/images/icons/icon-37.png')}}" alt=""></div>
                </div>
                <div class="content-box">
                    <ul class="list-item clearfix">
                        <li>Min. Deposit <span>${{ number_format($plan->min_deposit,2) }}</span></li>
                        <li>Max. Deposit <span>${{ number_format($plan->max_deposit,2) }}</span></li>
                        <li>Capital Return <span>{{ Str::ucfirst($plan->deposit_return) }}</span></li>
                        <li>ROI <span>{{ number_format($plan->interest_percent, 1) }}%</span></li>
                    </ul>
                </div>
                <div class="lower-box">
                    <div class="link-box"><a href="{{route('auth.register')}}"><span>Open Your Account</span></a></div>
                </div>
            </div>
        </div>
    </div>
    @empty
        <div class="col-lg-8 col-md-8 col-sm-12 account-block my-5  mx-auto">
            <div class="text-center p-5 shadow rounded px-4">
                <h3 class="mb-3">No Available Investment Plans</h3>
                <a class="btn btn-outline-dark" href="{{route('auth.register')}}">Create Account</a>
            </div>
        </div>
    @endforelse
</div>
@else
<div class="nk-block">
    <div class="row g-gs">
       @foreach ($plans as $plan)
            <div class="col-md-6 col-xxl-3">
                <div class="card card-bordered pricing">
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
                        @if (Auth::user()->who == 1)
                            <div class="pricing-action">
                                <a href="{{ route('user.investment.choose', ['id' => encrypt($plan->id)]) }}" class="btn btn-outline-light">Proceed</a>
                            </div>
                        @else
                            <div class="pricing-action">
                                <a href="{{ route('admin.investment.delete', ['id' => encrypt($plan->id)]) }}" class="btn btn-outline-danger">Delete</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
       @endforeach
    </div>
</div><!-- .nk-block -->
@endif
