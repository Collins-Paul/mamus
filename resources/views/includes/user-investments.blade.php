@if ($data->count() > 0)
                    <div class="nk-block mb-5">
                        @foreach ($data as $plan)
                            <div class="card card-bordered shadow">
                                <div class="card-inner">
                                    <div class="d-flex justify-content-between">
                                        <h4>{{ $plan->plan }}</h4>
                                        <h5>{{ $plan->duration }} week(s)</h5>
                                        <h5>ROI: {{ $plan->percentage }}%</h5>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <p>Capital Invested: <strong>${{ number_format($plan->amount, 2) }}</strong></p>
                                        <p>Status: <span class="badge bg-outline bg-{{ $plan->status == 1 ? 'success' : 'danger' }}">{{ $plan->status == 1 ? 'Running' : 'Expired' }}</span></p>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <p>Started: <strong>{{ $plan->start_date }}</strong></p>
                                        <p>Ending: <strong>{{ $plan->end_date }}</strong></p>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <p>Deposit Return: <strong>{{ $plan->capital_return }}</strong></p>
                                        @if ($plan->status == 1)
                                            <a href="{{ route('user.investments.update', ['id' => encrypt($plan->id)]) }}" class="btn btn-danger"><span>Cancel</span></a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="nk-block mb-5">
                        <div class="card card-bordered shadow">
                            <div class="card-inner text-center">
                                <h6>No Active Investment</h6>
                            </div>
                        </div>
                    </div>
                @endif

                @if ($expired->count() > 0)
                    <h6>Recent Ended Investment</h6>
                    <div class="nk-block">
                        @foreach ($expired as $plane)
                            <div class="card card-bordered shadow">
                                <div class="card-inner">
                                    <div class="d-flex justify-content-between">
                                        <h4>{{ $plane->plan }}</h4>
                                        <h5>{{ $plane->duration }} week(s)</h5>
                                        <h5>ROI: {{ $plane->percentage }}%</h5>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <p>Capital Invested: <strong>${{ number_format($plane->amount, 2) }}</strong></p>
                                        <p>Status: <span class="badge bg-outline bg-{{ $plane->status == 1 ? 'success' : 'danger' }}">{{ $plane->status == 1 ? 'Running' : 'Expired' }}</span></p>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <p>Started: <strong>{{ $plane->start_date }}</strong></p>
                                        <p>Ending: <strong>{{ $plane->end_date }}</strong></p>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <p>Deposit Return: <strong>{{ $plane->capital_return }}</strong></p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
