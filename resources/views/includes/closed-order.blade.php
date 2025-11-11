@forelse ($closed as $close)
                                            <?php
                                                if ($close->order_type == 'sell') {
                                                    $order_color = 'bg-danger';
                                                } else {
                                                    $order_color = 'bg-success';
                                                }

                                                if ($close->status == 'opened') {
                                                    $status_icon = 'ni-calendar-check';
                                                } else {
                                                    $status_icon = 'ni-calender-date';
                                                }
                                            ?>
                                            <div class="col-lg-12 mb-2">
                                                <div class="shadow rounded-3 p-2">
                                                    <div class="d-flex justify-content-between">
                                                        <div>
                                                            <span class="badge rounded-pill {{ $order_color }}">{{ $close->order_type }}</span> <span>{{ $close->lot_size }}</span>
                                                            <h6 class="pt-2 text-start">{{ $close->currency_pair }}</h6>
                                                        </div>
                                                        <div class="d-flex">
                                                            <div>
                                                                <span class="text-end"><em class="icon ni {{ $status_icon }}"></em> {{ $close->status }}</span>
                                                                <h6 class="pt-2 text-{{ $close->profit_or_loss < 0 ? 'danger' : 'success' }} text-end">$ {{ number_format($close->profit_or_loss, 2) }}</h6>
                                                            </div>
                                                            <div class="d-flex align-items-center ps-2 fs-6">
                                                                <em class="icon ni ni-downward-ios" onclick="showDetails({{ $close->id }})" id="show_{{ $close->id }}"></em>
                                                                <em class="icon ni ni-upword-ios" onclick="hideDetails({{ $close->id }})" style="display: none"  id="hide_{{ $close->id }}"></em>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="collapse border-top pt-1 mt-2" id="trades_{{ $close->id }}">
                                                        <ul class="pricing-features payment-methods">
                                                            <li class="mb-1 payment-wallet-area">
                                                                <span class="w-25">
                                                                    <p class="m-0">Open time</p>
                                                                </span>
                                                                <span class="ms-auto">
                                                                    <p class="m-0">{{ $close->created_at }}</p>
                                                                </span>
                                                            </li>
                                                            @if ($close->status == 'closed')
                                                            <li class="mb-1 payment-wallet-area">
                                                                <span class="w-25">
                                                                    <p class="m-0">Close time</p>
                                                                </span>
                                                                <span class="ms-auto">
                                                                    <p class="m-0">{{ $close->updated_at }}</p>
                                                                </span>
                                                            </li>
                                                            @endif

                                                            <li class="mb-1 payment-wallet-area">
                                                                <span class="w-25">
                                                                    <p class="m-0">Open price</p>
                                                                </span>
                                                                <span class="ms-auto">
                                                                    <p class="m-0">{{ $close->open_price }}</p>
                                                                </span>
                                                            </li>

                                                            @if ($close->status == 'closed')
                                                            <li class="mb-1 payment-wallet-area">
                                                                <span class="w-25">
                                                                    <p class="m-0">Close price</p>
                                                                </span>
                                                                <span class="ms-auto">
                                                                    <p class="m-0">{{ $close->close_price }}</p>
                                                                </span>
                                                            </li>
                                                            @endif

                                                            <li class="mb-1 payment-wallet-area">
                                                                <span class="w-25">
                                                                    <p class="m-0">Order ID</p>
                                                                </span>
                                                                <span class="ms-auto">
                                                                    <p class="m-0">#{{ $close->order_id }}</p>
                                                                </span>
                                                            </li>

                                                            <li class="mb-1 payment-wallet-area">
                                                                <span class="w-50">
                                                                    <p class="m-0">Commission Paid</p>
                                                                </span>
                                                                <span class="ms-auto">
                                                                    <p class="m-0">$ {{ number_format($close->commission_paid, 2) }}</p>
                                                                </span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            @empty
                                            <div class="col-lg-12 mb-2">
                                                <div class="shadow rounded-3 p-2">
                                                    <div class="d-flex justify-content-center">
                                                        <div>
                                                            <p>No Closed Trades</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforelse

