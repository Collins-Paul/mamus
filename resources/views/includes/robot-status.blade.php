<div class="row">
    <div class="col-lg-8">
        <div class="shadow rounded px-2 py-4">
            <div class="row">
                <div class="col-lg-6 d-flex justify-content-center">
                    <div class="text-center">
                        <img src="{{ asset('assets/images/robot-trading.jpeg') }}" alt="">
                    </div>
                </div>
                <div class="col-lg-6 py-4">
                    <div class="d-flex justify-content-between py-1">
                        <h6>Status:</h6>
                        <h6 class="text-{{ $robot_sub->status == 'active' ? 'success' : 'warning' }}">{{ Str::ucfirst($robot_sub->status) }}</h6>
                    </div>
                    <div class="d-flex justify-content-between py-1">
                        <h6>Robot Plan:</h6>
                        <h6>{{ $robot_sub->plan_title }}</h6>
                    </div>
                    <div class="d-flex justify-content-between py-1">
                        <h6>Purchase Date:</h6>
                        <h6>{{ $robot_sub->purchase_date }}</h6>
                    </div>
                    <div class="d-flex justify-content-between py-1">
                        <h6>Expiring Date:</h6>
                        <h6>{{ $robot_sub->exp_date}}</h6>
                    </div>
                    <div class="d-flex justify-content-between py-1">
                        <h6>Robot ID</h6>
                        <h6>{{ $robot_sub->robot_id }}</h6>
                    </div>
                    @if ($robot_sub->status == 'active')
                        <div class="d-grid gap-2">
                            <a href="{{ route('user.robot.setup') }}" class="btn btn-outline-success d-flex justify-content-center">Start Trading</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
