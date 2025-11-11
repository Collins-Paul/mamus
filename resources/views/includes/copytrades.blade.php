<div class="card card-bordered card-preview">
    <div class="card-inner">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                      <th scope="col">S/N</th>
                      @if (Auth::user()->who == 2)
                      <th scope="col">Copier</th>
                      <th scope="col">Master</th>
                      @endif
                      <th scope="col">Order</th>
                      <th scope="col">Symbol</th>
                      <th scope="col">Margin</th>
                      <th scope="col">Unrealized P/L</th>
                      <th scope="col">Copy Proportion</th>
                      <th scope="col">Open Price</th>
                      <th scope="col">Open Time</th>
                      <th scope="col">Closed Price</th>
                      <th scope="col">Closed Time</th>
                      <th scope="col">Order ID</th>
                      <th scope="col">Status</th>
                      @if (Auth::user()->who == 2)
                      <th scope="col">Action</th>
                      @endif
                    </tr>
                  </thead>
                  <tbody>
                    @php
                        use App\Models\User;
                        $i = 1;
                    @endphp
                    @forelse ($copiers as $copier)
                    @php
                        $user = User::find($copier->copier_id);
                        if ($copier->order_type == 'sell') {
                           $type = '<span class="badge rounded-pill bg-danger">Sell</span>';
                        } else {
                           $type = '<span class="badge rounded-pill bg-success">Buy</span>';
                        }
                    @endphp
                    <tr>
                        <th scope="row">{{ $i++ }}</th>
                        @if (Auth::user()->who == 2)
                        <td>{{ $user->first_name." ".$user->last_name }}</td>
                        <td>{{ $copier->master_name }}</td>
                        @endif
                        <td>{!! $type !!}</td>
                        <td>{{ $copier->currency_pair }}</td>
                        <td>${{ number_format($copier->total_amount, 2) }}</td>
                        <td class="text-{{ $copier->profit_or_loss < 0 ? 'danger' : 'success' }} fw-bold">${{ $copier->profit_or_loss }}</td>
                        <td>{{ $copier->copy_proportion }}</td>
                        <td>{{ $copier->open_price }}</td>
                        <td>{{ $copier->created_at }}</td>
                        <td>{{ !$copier->close_price ? '- - -' :  $copier->close_price}}</td>
                        <td>{{ $copier->status == 'opened' ? '- - -' :  $copier->updated_at}}</td>
                        <td>{{ $copier->order_id }}</td>
                        <td><span class="badge rounded-pill bg-success">{{ $copier->status }}</span></td>
                        @if (Auth::user()->who == 2)
                        <td>
                            <a href="{{ route('admin.edit.trade.view', ['order_id' => encrypt($copier->order_id)]) }}">Edit</a> |
                            <a href="{{ route('admin.close.trade.view', ['id' => encrypt($copier->order_id)]) }}">Close</a>
                        </td>
                        @endif
                      </tr>
                    @empty
                      <tr>
                        <th colspan="{{ Auth::user()->who == 2 ? '10' : '9' }}" class="py-4">No Copy Trade</th>
                      </tr>
                    @endforelse
                  </tbody>
            </table>
        </div>
    </div>
</div>
