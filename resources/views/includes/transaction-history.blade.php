<div>
    <div class="py-3">
        @forelse ($history as $data)
            @php
                // Type handling
                if ($data->type == 'Deposit') {
                    $sign = '+';
                    $color = 'success';
                } elseif ($data->type == 'Withdrawal') {  // Changed to elseif for consistency
                    $sign = '-';
                    $color = 'danger';
                } else {
                    $sign = '';  // Default for unexpected types
                    $color = 'secondary';
                }
                
                // Status handling
                $statusColor = 'secondary';  // Default color
                if (strtolower($data->status) == 'pending') {
                    $status = 'Pending';
                    $statusColor = 'warning';
                } elseif (strtolower($data->status) == 'completed' || strtolower($data->status) == 'success') {
                    $status = 'Success';
                    $statusColor = 'success';
                } elseif (strtolower($data->status) == 'cancelled') {
                    $status = 'Cancelled';
                    $statusColor = 'danger';
                } else {
                    $status = ucfirst(strtolower($data->status));  // Default to capitalized status
                }

                $currency = DB::table('currencies')->where('user_id', $data->user_id)->first();
                $currencySymbol = $currency ? $currency->symbol : '';  // Fallback to empty string if null
            @endphp
            <a href="{{ route('user.tranx.details', ['id' => encrypt($data->id)]) }}">
                <div class="alert alert-pro shadow alert-{{ $color }} mx-1 p-1" style="border-radius: 0 !important">
                    <div class="d-flex justify-content-between align-items-center">
                        <div style="color: #4d4d4d">
                            <p class="mb-2 fw-bold"><em class="icon ni ni-arrow-long-down text-{{ $color }}"></em> <span class="text-{{ $color }}">{{ $data->type }}</span></p>
                            <div class="d-flex justify-content-between gap-3">
                                <span class="time">{{ $data->created_at }}</span>
                                <p class=""><span class="badge bg-outline-{{ $statusColor }}">{{ $status }}</span></p>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end flex-column">
                            <p class="mb-2 fw-bold text-{{ $color }}">{{ $sign }} {{ $currencySymbol }} {{ number_format((float)$data->amount, 2) }}</p>
                            <p class="text-end"><a href="{{ route('user.tranx.details', ['id' => encrypt($data->id)]) }}">View Details</a></p>
                        </div>
                    </div>
                </div>
            </a>
        @empty
            <div class="d-flex justify-content-center align-items-center">
                <div>
                    <p class="text-center fs-6 mb-2">No Transaction</p>
                </div>
            </div>
        @endforelse
    </div>
</div>