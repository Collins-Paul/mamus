<div class="col-lg-12">
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                          <th scope="col">S/N</th>
                          <th scope="col">Order ID</th>
                          <th scope="col">Symbol</th>
                          <th scope="col">Order</th>
                          <th scope="col">Open Price</th>
                          <th scope="col">Open Time</th>
                          <th scope="col">Margin</th>
                          <th scope="col">Position size</th>
                          <th scope="col">Unrealized P/L</th>
                          <th scope="col">Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @forelse ($trades as $trade)
                        @php
                            if ($trade->status == 'opened') {
                               $type = '<span class="badge rounded-pill bg-success">Opened</span>';
                            } else if($trade->status == 'closed') {
                               $type = '<span class="badge rounded-pill bg-dark">Closed</span>';
                            }
                            if ($trade->order_type == 'sell') {
                            $order_type = '<span class="badge rounded-pill bg-danger">Sell</span>';
                            } else if ($trade->order_type == 'buy') {
                            $order_type = '<span class="badge rounded-pill bg-success">Buy</span>';
                            } else {
                                $order_type = '- - -';
                            }
                        @endphp
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $trade->order_id }}</td>
                            <td>{{ $trade->currency_pair }}</td>
                            <td>{!! $order_type !!}</td>
                            <td>{{ $trade->open_price == null ? '- - -' : $trade->open_price }}</td>
                            <td>{{ $trade->created_at }}</td>
                            <td>${{ number_format($trade->amount,2) }}</td>
                            <td>{{ $trade->lot_size == null ? "- - -" : $trade->lot_size }}</td>
                            <td class="text-{{ $trade->profit_or_loss < 0 ? 'danger' : 'success' }} fw-bold">${{ $trade->profit_or_loss == null ? number_format(0, 2) : number_format($trade->profit_or_loss,2) }}</td>
                            <td>{!! $type !!}</td>
                        </tr>
                        @empty
                          <tr>
                            <th colspan="10" class="text-center py-4">No Robot Trading</th>
                          </tr>
                        @endforelse
                      </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
