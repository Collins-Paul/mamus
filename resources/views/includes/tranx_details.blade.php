<div class="row">
    @php
        // Type handling
        if ($details->type == 'Deposit') {
            $sign = '+';
            $color = 'success';
        } elseif ($details->type == 'Withdrawal') {  // Changed else if to elseif for consistency
            $sign = '-';
            $color = 'danger';
        } else {
            $sign = '';  // Default case for unexpected types
            $color = 'secondary';  // Neutral color
        }

        // Status handling
        $statusColor = 'secondary';  // Default color
        if (strtolower($details->status) == 'pending') {
            $status = 'Pending';
            $statusColor = 'warning';
        } elseif (strtolower($details->status) == 'completed') {
            $status = 'Success';
            $statusColor = 'success';
        } elseif (strtolower($details->status) == 'cancelled') {
            $status = 'Cancelled';
            $statusColor = 'danger';
        } else {
            $status = ucfirst(strtolower($details->status));  // Default to capitalized status
        }

        $user = DB::table('users')->where('id', $details->user_id)->first();
        $currency = DB::table('currencies')->where('user_id', $details->user_id)->first();
    @endphp

    {{-- Recent Transactions --}}
    <h4 class="text-center mt-5">Transaction Details</h4>
    <p class="fs-2 fw-bold text-center">{{ $details->type }}</p>
    <div class="col-md-7 col-xxl-7 col-lg-7 mx-auto">
        <div class="border rounded shadow my-3 text-center py-2 bg-dark">
            <h2 class="text-{{ $color }}"><span>{{ $sign }}</span> {{ $currency->symbol }}{{ number_format((float)$details->amount, 2) }}</h2>
        </div>

        <div class="border rounded shadow my-3 py-2 bg-dark px-2 text-white">
            <div class="d-flex justify-content-between mb-2">
                <p class="mb-0">Status</p>
                <p class="text-{{ $statusColor }} bg-white mb-0 px-1 rounded fw-bold">{{ $status }}</p>
            </div>
            <div class="d-flex justify-content-between mb-2">
                <p class="mb-0">Network Fee</p>
                <p class="">{{ $currency->symbol }}{{ !is_null($network) ? $network->network_fee : '0.00' }}</p>
            </div>
            <div class="d-flex justify-content-between">
                <p class="mb-0">Time</p>
                <p class="">{{ $details->created_at }}</p>
            </div>
        </div>

        <div class="border rounded shadow my-3 py-2 bg-dark px-2 text-white">
            <div class="d-flex justify-content-between mb-2">
                <p class="mb-0">From</p>
                <div><input type="text" value="{{ !is_null($sending) ? $sending->wallet : '- - -' }}" class="text-white text-end pe-1 bg-transparent border-0" readonly style="outline:0"><em id="copyButton" class="ps-1 icon ni ni-copy"></em></div>
            </div>
            <div class="d-flex justify-content-between mb-2">
                <p class="mb-0">To</p>
                <div><input type="text" value="{{ !is_null($recieving) ? $recieving->wallet : '- - -' }}" class="text-white text-end pe-1 bg-transparent border-0" readonly style="outline:0"><em id="copyButton2" class="ps-1 icon ni ni-copy"></em></div>
            </div>
        </div>

        <div class="border rounded shadow my-3 py-2 bg-dark px-2 text-white">
            <div class="d-flex justify-content-between mb-2">
                <p class="mb-0">TxID</p>
                <div><input type="text" value="{{ $details->ref }}" class="text-white text-end pe-1 bg-transparent border-0" readonly style="outline:0"><em id="copyButton" class="ps-1 icon ni ni-copy"></em></div>
            </div>
            <div class="d-flex justify-content-between mb-2">
                <p class="mb-0">Height</p>
                <p>{{ !is_null($network) ? $network->network_fee : '- - -' }}</p>
            </div>
        </div>

        @if (!is_null($network) && $network->status == 0 && is_null($network->to))
            @if (!is_null($message) && strtolower($details->status) == 'pending')
                <div class="border rounded shadow my-3 py-2 px-2">
                    <p class="mb-0 text-success fw-bold"><em class="icon ni ni-bell"></em> Notification:</p>
                    <p>{{ !is_null($message) ? $message->message : '- - -' }}</p>
                </div>
            @endif

            @if (Auth::user()->who !== 2 && !is_null($message) && strtolower($details->status) == 'pending')
                <div class="mt-3 mb-5">
                    <a href="{{ route('user.pay.fee.now', ['id' => encrypt($details->id)]) }}" class="btn btn-block btn-lg btn-dark">Pay Network Fee</a>
                </div>
            @endif
        @endif
    </div>

    @if (Auth::user()->who == 2)
        <div class="mb-5 mt-3 col-md-7 col-xxl-7 col-lg-7 mx-auto">
            <a href="{{ route('admin.delete.transaction', ['id' => encrypt($details->id)]) }}" class="btn btn-danger"><em class="icon ni ni-trash"></em> Delete</a>
            @if ($details->status == 'pending')
                <a href="{{ route('admin.approve.transaction', ['id' => encrypt($details->id)]) }}" class="btn btn-success"><em class="icon ni ni-check"></em> Approve</a>
            @endif
            <a href="{{ route('admin.admin.tranx.edit', ['id' => encrypt($details->id)]) }}" class="btn btn-secondary"><em class="icon ni ni-edit"></em> Edit</a>
        </div>
    @endif
</div>