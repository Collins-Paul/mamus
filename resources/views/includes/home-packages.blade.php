<div class="row">
    @foreach ($plans as $plan)
    <div class="col-lg-4 col-sm-6 sm-padding">
        <div class="py-5 px-3 shadow" data-aos="zoom-in">
            <div class="cd-popular">
                <div>
                    <div class="text-center">
                        <h4>{{ $plan->plan_title }}</h4>
                        <h3>{{ $plan->interest_percent }}% ROI</h3>
                    </div>
                    <div class="text-center">
                        <ul class="ps-0" style="list-style-type: none">
                            <li class="fs-5"><span class="w-50">Min Deposit</span> - <span class="ms-auto">${{ number_format($plan->min_deposit,2) }}</span></li>
                            <li class="fs-5"><span class="w-50">Max Deposit</span> - <span class="ms-auto">${{ number_format($plan->max_deposit,2) }}</span></li>
                            <li class="fs-5"><span class="w-50">Deposit Return</span> - <span class="ms-auto">{{ Str::ucfirst($plan->deposit_return) }}</span></li>
                        </ul>
                    </div>
                    <div class="pricing-footer text-center">
                        <a class="btn btn-outline-primary" href="{{ route('auth.register') }}">Get Started<span></span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
