<div class="row g-2">
    @foreach ($data as $plan)
    <div class="col-lg-3">
        <div class="shadow px-2 py-4 rounded">
            <div class="text-center">
                <h6>{{ $plan->heading }}</h6>
                <h5>${{ number_format($plan->price) }}</h5>
            </div>
            <div class="my-2">
                <ul>
                    <li><em class="icon ni ni-check-circle-cut text-primary"></em> <strong>{{ $plan->percentage }}%</strong> Success Rate</li>
                    <li><em class="icon ni ni-check-circle-cut text-primary"></em> <strong>{{ $plan->weeks }}</strong> Weeks Trading</li>
                    <li><em class="icon ni ni-check-circle-cut text-primary"></em> Entry, TP, SL</li>
                    <li><em class="icon ni ni-check-circle-cut text-primary"></em> Amount to risk per trade</li>
                    <li><em class="icon ni ni-check-circle-cut text-primary"></em> Risk Raward Ratio</li>
                </ul>
            </div>
            <div class="text-center">
                @if(Auth::user()->who == 2)
                    <a href="{{ route('admin.delete.plan', ['id' => encrypt($plan->id)]) }}" class="btn btn-outline-danger"><em class="icon ni ni-trash"></em> Delete</a>
                @else
                    <a href="{{ route('user.subscription.form', ['id' => encrypt($plan->id)]) }}" class="btn btn-outline-primary">Subscribe</a>
                @endif
            </div>
        </div>
    </div>
    @endforeach
</div>
