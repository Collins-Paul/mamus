@forelse ($copyClosed as $order)
                    <?php
                        if ($order->order_type == 'sell') {
                            $order_color = 'bg-danger';
                        } else {
                            $order_color = 'bg-success';
                        }

                        if ($order->status == 'opened') {
                            $status_icon = 'ni-calendar-check';
                        } else {
                            $status_icon = 'ni-calender-date';
                        }
                    ?>
                    <div class="col-lg-12 mb-2">
                        <div class="shadow rounded-3 p-2">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <span class="badge rounded-pill {{ $order_color }}">{{ $order->order_type }}</span> <span>{{ $order->lot_size }}</span>
                                    <h6 class="pt-2 text-start">{{ $order->currency_pair }}</h6>
                                </div>
                                <div class="d-flex">
                                    <div>
                                        <span class="text-end"><em class="icon ni {{ $status_icon }}"></em> {{ $order->status }}</span>
                                        <h6 class="pt-2 text-{{ $order->profit_or_loss < 0 ? 'danger' : 'success' }} text-end">${{ number_format(str_replace('-', '', $order->profit_or_loss), 2) }}</h6>
                                    </div>
                                    <div class="d-flex align-items-center ps-2 fs-6">
                                        <em class="icon ni ni-downward-ios" onclick="showDetails({{ $order->id }})" id="show_{{ $order->id }}"></em>
                                        <em class="icon ni ni-upword-ios" onclick="hideDetails({{ $order->id }})" style="display: none"  id="hide_{{ $order->id }}"></em>
                                    </div>
                                </div>
                            </div>
                            <div class="collapse border-top pt-1 mt-2" id="trades_{{ $order->id }}">
                                <ul class="pricing-features payment-methods">
                                    <li class="mb-1 payment-wallet-area">
                                        <span class="w-25">
                                            <p class="m-0">Master Username</p>
                                        </span>
                                        <span class="ms-auto">
                                            <p class="m-0">{{ $order->master_name}}</p>
                                        </span>
                                    </li>
                                    <li class="mb-1 payment-wallet-area">
                                        <span class="w-25">
                                            <p class="m-0">Copy Proportion</p>
                                        </span>
                                        <span class="ms-auto">
                                            <p class="m-0">{{ $order->copy_proportion }}</p>
                                        </span>
                                    </li>
                                    <li class="mb-1 payment-wallet-area">
                                        <span class="w-25">
                                            <p class="m-0">Margin</p>
                                        </span>
                                        <span class="ms-auto">
                                            <p class="m-0">${{ number_format($order->total_amount, 2) }}</p>
                                        </span>
                                    </li>
                                    <li class="mb-1 payment-wallet-area">
                                        <span class="w-25">
                                            <p class="m-0">Open time</p>
                                        </span>
                                        <span class="ms-auto">
                                            <p class="m-0">{{ $order->created_at }}</p>
                                        </span>
                                    </li>
                                    @if ($order->status == 'closed')
                                    <li class="mb-1 payment-wallet-area">
                                        <span class="w-25">
                                            <p class="m-0">Close time</p>
                                        </span>
                                        <span class="ms-auto">
                                            <p class="m-0">{{ $order->updated_at }}</p>
                                        </span>
                                    </li>
                                    @endif

                                    <li class="mb-1 payment-wallet-area">
                                        <span class="w-25">
                                            <p class="m-0">Open price</p>
                                        </span>
                                        <span class="ms-auto">
                                            <p class="m-0">{{ $order->open_price }}</p>
                                        </span>
                                    </li>

                                    @if ($order->status == 'closed')
                                    <li class="mb-1 payment-wallet-area">
                                        <span class="w-25">
                                            <p class="m-0">Close price</p>
                                        </span>
                                        <span class="ms-auto">
                                            <p class="m-0">{{ $order->close_price }}</p>
                                        </span>
                                    </li>
                                    @endif

                                    <li class="mb-1 payment-wallet-area">
                                        <span class="w-25">
                                            <p class="m-0">Order ID</p>
                                        </span>
                                        <span class="ms-auto">
                                            <p class="m-0">#{{ $order->order_id }}</p>
                                        </span>
                                    </li>

                                    <li class="mb-1 payment-wallet-area">
                                        <span class="w-50">
                                            <p class="m-0">Commission Paid</p>
                                        </span>
                                        <span class="ms-auto">
                                            <p class="m-0">{{ $order->commission_copy_trade }}</p>
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
                                    <p>No Closed Copied Trade</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforelse
