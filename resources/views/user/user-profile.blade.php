@extends('layouts.index')

@section('title')
    User Profile
@endsection

@section('content')
    <div class="nk-content nk-content-fluid">
        <div class="container-xl wide-xl">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">User Account</h3>
                            </div>
                        </div>
                    </div>

                    <div class="nk-block">
                        <div class="row gy-gs">
                            <div class="col-lg-6">
                                <div class="d-flex justify-content-center">
                                    <div id="blah"
                                        style="
                                    width: 175px !important;
                                    height: 200px !important;
                                    background-repeat: no-repeat !important;
                                    background-size: cover !important;
                                    background-position: center !important;
                                    background: url({{ asset('traders-photo/' . $user->photo) }});">
                                        @if (Auth::user()->who == 1)
                                            <form action="{{ route('user.upload.photo') }}" method="post"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <input type='file' id="imgInp" name="image" class="d-none">
                                                <input type="hidden" name="master_id" value="{{ $user->user_id }}">
                                                <label for="imgInp" class="position-relative fs-4 bg-light"
                                                    style="
                                        top: -21px;
                                        right: 21px;
                                        padding: 8px;
                                        border-radius: 100%;
                                        height: 45px;
                                        width: 45px;"><em
                                                        class="icon ni ni-camera"
                                                        style="
                                        font-size: 26px;
                                        display: flex;
                                        justify-content: center;"></em></label>
                                                <button type="submit" class="position-relative border-0 fs-4 bg-light"
                                                    style="
                                        top: -21px;
                                        right: 21px;
                                        padding: 8px;
                                        border-radius: 100%;
                                        height: 45px;
                                        width: 45px;"><em
                                                        class="icon ni ni-upload"
                                                        style="
                                        font-size: 26px;
                                        display: flex;
                                        justify-content: center;"></em></button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                                <p class="text-center">{{ $user->username }}</p>
                                <div class="d-flex justify-content-start my-4 px-3">
                                    <span class="text-center"><span class="fw-bold">Firstname:
                                        </span>{{ Str::ucfirst($user->first_name) }}</span>
                                    <span class="text-center ms-3"><span class="fw-bold">Lastname:
                                        </span>{{ Str::ucfirst($user->last_name) }}</span>
                                </div>
                                <div class="d-flex justify-content-between my-4 px-3">
                                    <span class="text-center"><span class="fw-bold">Balance:</span>
                                        ${{ number_format($user->balance, 2) }}</span>
                                    {{-- <span class="text-center"><span class="fw-bold">Capital:</span> ${{ number_format($user->capital, 2) }}</span> --}}
                                    <span class="text-center"><span class="fw-bold">Profit:</span>
                                        ${{ number_format($user->profit, 2) }}</span>
                                </div>
                                @if (Auth::user()->who == 2)
                                    <div class="d-flex justify-content-between my-4 px-3">
                                        <span class="fs-6 me-3">Disable Withdrawal</span>
                                        <div class="custom-control custom-switch">
                                            <input type="hidden" value="{{ $user_id }}" id="withdrawal_id">
                                            <input type="checkbox" {{ $user->can_withdraw == 1 ? 'checked' : '' }}
                                                class="custom-control-input" id="can_withdraw">
                                            <label class="custom-control-label" for="can_withdraw"></label>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between my-4 px-3">
                                        <span class="fs-6">User Wallets</span>
                                        <a href="{{ route('admin.user.show.user.wallets', ['id' => encrypt($user->user_id)]) }}" class="fw-bold btn btn-sm btn-outline-primary">View All</a>
                                    </div>
                                    <div class="d-flex justify-content-between my-4 px-3">
                                        <h6>Admin Transact</h6>
                                        <a href="{{ route('admin.transact', ['id' => encrypt($user->user_id)]) }}"
                                            class="btn btn-success">Debit/Credit</a>
                                    </div>
                                @endif
                            </div>

                            <div class="col-lg-6">
                                <div class="">
                                    <ul class="master-menu">
                                        <li>
                                            @php
                                                if ($user->status == 0) {
                                                    $status = '<span class="badge rounded-pill bg-danger">Unverified</span>';
                                                } elseif ($user->status == 2) {
                                                    $status = '<span class="badge rounded-pill bg-danger">Suspended</span>';
                                                } elseif ($user->status == 3) {
                                                    $status = '<span class="badge rounded-pill bg-warning">Review</span>';
                                                } else {
                                                    $status = '<span class="badge rounded-pill bg-success">Verified</span>';
                                                }
                                            @endphp

                                            {{-- Admin --}}
                                            @if (Auth::user()->who == 2)
                                                <div class="d-flex justify-content-between">
                                                    <span class="fs-6 me-3">User Status
                                                        <sup>{!! $status !!}</sup></span>
                                                    @if ($user->status == 0 || $user->status == 2 || $user->status == 3)
                                                        <a href="{{ route('admin.admin.activate', ['id' => encrypt($user->user_id), 'who' => 'user']) }}"
                                                            class="btn  btn-success btn-sm"><em
                                                                class="icon ni ni-check"></em> Verify</a>
                                                    @else
                                                        <a href="{{ route('admin.admin.deactivate', ['id' => encrypt($user->user_id), 'who' => 'user']) }}"
                                                            class="btn  btn-danger btn-sm">X Unverify</a>
                                                    @endif
                                                </div>
                                            @else
                                                {{-- User --}}
                                                <div class="d-flex justify-content-between">
                                                    <span class="fs-6 me-3">Status</span>
                                                    <span class="fs-6 me-3">{!! $status !!}</span>
                                                </div>
                                            @endif
                                        </li>

                                        @if (Auth::user()->who == 2)
                                            @if (!is_null($card))
                                            <li>
                                                <div class="d-flex justify-content-between">
                                                    <span class="fs-6 me-3">Withdrawal Card</span>
                                                    <div class="custom-control custom-switch">
                                                        <input type="hidden" value="{{ $user_id }}"
                                                            id="card_setting">
                                                        <input type="checkbox" {{ !is_null($card) && $card->status == '1' ? 'checked' : '' }}
                                                            class="custom-control-input" id="card_toggle">
                                                        <label class="custom-control-label" for="card_toggle"></label>
                                                    </div>
                                                </div>
                                            </li>
                                            @endif
                                            <li>
                                                <div class="d-flex justify-content-between">
                                                    <span class="fs-6 me-3">Enable Copy Trade</span>
                                                    <div class="custom-control custom-switch">
                                                        <input type="hidden" value="{{ $user_id }}"
                                                            id="copy_trader_id">
                                                        <input type="checkbox"
                                                            {{ $user->copy_trade == 'yes' ? 'checked' : '' }}
                                                            class="custom-control-input" id="copy_trades">
                                                        <label class="custom-control-label" for="copy_trades"></label>
                                                    </div>
                                                </div>
                                            </li>
                                        @endif


                                        <li>
                                            <div class="d-flex justify-content-between">
                                                <span class="fs-6 me-3">Account Type</span>
                                                <span class="fs-6 me-3">{{ Str::ucfirst($user->account_type) }}</span>
                                            </div>
                                        </li>

                                        <li>
                                            <div class="d-flex justify-content-between">
                                                <span class="fs-6 me-3">Investment</span>
                                                <span class="fs-6 me-3">{{ Str::ucfirst($user->investment) }}</span>
                                            </div>
                                        </li>

                                        <li>
                                            <div class="d-flex justify-content-between">
                                                <span class="fs-6 me-3">Country</span>
                                                <span
                                                    class="fs-6 me-3">{{ Str::ucfirst($user->country_of_residence) }}</span>
                                            </div>
                                        </li>

                                        <li>
                                            <div class="d-flex justify-content-between">
                                                <span class="fs-6 me-3">Email</span>
                                                <span class="fs-6 me-3">{{ $user->email }}</span>
                                            </div>
                                        </li>

                                        <li>
                                            <div class="d-flex justify-content-between">
                                                <span class="fs-6 me-3">Phone</span>
                                                <span class="fs-6 me-3">{{ $user->phone }}</span>
                                            </div>
                                        </li>

                                        <li>
                                            <div class="d-flex justify-content-between">
                                                <span class="fs-6 me-3">Date of Birth</span>
                                                <span class="fs-6 me-3">{{ $user->dob }}</span>
                                            </div>
                                        </li>

                                        @if (Auth::user()->who == 2)
                                            <li>
                                                <div class="d-flex justify-content-between">
                                                    <span class="fs-6 me-3 fw-bold">Robot Trades:</span>
                                                    <span class="fs-6 me-3 fw-bold"><a class="text-decoration-underline"
                                                            href="{{ route('admin.user.robot.history', ['order' => 'opened', 'id' => encrypt($user->user_id)]) }}">Opened</a></span>
                                                    <span class="fs-6 me-3 fw-bold"><a class="text-decoration-underline"
                                                            href="{{ route('admin.user.robot.history', ['order' => 'closed', 'id' => encrypt($user->user_id)]) }}">Closed</a></span>
                                                </div>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>


                            @if ($user->account_type == 'corperate')
                                <div class="col-lg-4">
                                    <div class="d-flex justify-content-between">
                                        <span class="fs-6 me-3">Country of Registration</span>
                                        <span class="fs-6 me-3">
                                            @if ($user->country_of_reg == null)
                                                N/A
                                            @else
                                                {{ $user->country_of_reg }}
                                            @endif
                                        </span>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="d-flex justify-content-between">
                                        <span class="fs-6 me-3">Company:</span>
                                        <span class="fs-6 me-3">
                                            <span class="fs-6 me-3">
                                                @if ($user->company_name == null)
                                                    N/A
                                                @else
                                                    {{ $user->company_name }}
                                                @endif
                                            </span>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="d-flex justify-content-between">
                                        <span class="fs-6 me-3">Reg N0.:</span>
                                        <span class="fs-6 me-3">
                                            @if ($user->reg_no == null)
                                                N/A
                                            @else
                                                {{ $user->reg_no }}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            @endif




                            <div class="col-lg-12">
                                <ul class="nav nav-tabs nav-tabs-s2">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#tabItem9">History
                                            ({{ $transactions->count() }})</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#tabItem10">Opened
                                            ({{ $copyOpened->count() }})</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#tabItem11">Closed
                                            ({{ $copyClosed->count() }})</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tabItem9">
                                        <div class="card card-bordered card-preview">
                                            <div class="card-inner">
                                                <div class="table-responsive">
                                                    <table class="table table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">S/N</th>
                                                                <th scope="col">Amount</th>
                                                                <th scope="col">Type</th>
                                                                <th scope="col">Status</th>
                                                                <th scope="col">Details</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @php
                                                                $i = 1;
                                                            @endphp
                                                            @forelse ($transactions as $info)
                                                                @php
                                                                    if ($info->type == 'Deposit') {
                                                                        $type = '<span class="badge rounded-pill bg-success">Deposit</span>';
                                                                    } else {
                                                                        $type = '<span class="badge rounded-pill bg-danger">Withdrawal</span>';
                                                                    }
                                                                @endphp
                                                                <tr>
                                                                    <th scope="row">{{ $i++ }}</th>
                                                                    <td>${{ number_format((float)$info->amount, 2) }}</td>
                                                                    <td>{!! $type !!}</td>
                                                                    <td>{{ Str::ucfirst($info->status) }}</td>
                                                                    <td><a
                                                                            href="{{ route('user.tranx.details', ['id' => encrypt($info->id)]) }}">View</a>
                                                                    </td>
                                                                </tr>
                                                            @empty
                                                                <tr>
                                                                    <th colspan="5" class="text-center py-4">No
                                                                        Transaction</th>
                                                                </tr>
                                                            @endforelse
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tabItem10">
                                        <div class="tab-pane active" id="tabItem9">
                                            <div class="row">
                                                @include('includes.copy-open-order')
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tabItem11">
                                        <div class="row">
                                            @include('includes.copy-close-order')
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('includes.script')
@endsection

@section('script')
<script>
        $(document).ready(function() {
            $('#copy_trades').click(function(e) {
                e.preventDefault();
                copy_trader_id = $('#copy_trader_id').val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "post",
                    url: "{{ route('admin.disable.copy') }}",
                    data: {
                        copy_trader_id: copy_trader_id
                    },
                    success: function(response) {
                        if (response.status == 200) {
                            // console.log(response.message);
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 2000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal
                                        .stopTimer)
                                    toast.addEventListener('mouseleave', Swal
                                        .resumeTimer)
                                }
                            })

                            Toast.fire({
                                icon: 'success',
                                title: response.message
                            });
                            location.reload();
                        } else {
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 2000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal
                                        .stopTimer)
                                    toast.addEventListener('mouseleave', Swal
                                        .resumeTimer)
                                }
                            })

                            Toast.fire({
                                icon: 'error',
                                title: response.message
                            })
                        }
                    }
                });
            });
        });

        $(document).ready(function() {
            $('#card_toggle').click(function(e) {
                e.preventDefault();
                card_owner = $('#card_setting').val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "post",
                    url: "{{ route('activate.card') }}",
                    data: {
                        card_owner: card_owner
                    },
                    success: function(response) {
                        // console.log(response.message);
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 2000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal
                                    .resumeTimer)
                            }
                        })

                        Toast.fire({
                            icon: 'success',
                            title: response.message
                        });
                        location.reload();
                    }
                });
            });

            $('#can_withdraw').click(function(e) {
                e.preventDefault();
                withdrawal_id = $('#withdrawal_id').val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "post",
                    url: "{{ route('withdwaral.settings') }}",
                    data: {
                        withdrawal_id: withdrawal_id
                    },
                    success: function(response) {
                        // console.log(response.message);
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 2000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal
                                    .resumeTimer)
                            }
                        })

                        Toast.fire({
                            icon: 'success',
                            title: response.message
                        });
                        location.reload();
                    }
                });
            });
        });
    </script>
@endsection
