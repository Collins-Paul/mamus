@extends('layouts.index')
@section('title')
    App Settings
@endsection
@section('content')
    <div class="nk-content nk-content-fluid">
        <div class="container-xl wide-lg">
            <div class="nk-content-body">
                <div class="nk-block-head">
                    <div class="nk-block-between-md g-4">
                        <div class="nk-block-head-content">
                            <h6 class="nk-block-title fw-normal pe-4 pt-1">App Settings</h6>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12 border-bottom">
                        <div class="d-flex justify-content-between py-2">
                            <div>
                                <p><em class="icon ni ni-history"></em> Transaction History</p>
                            </div>
                            <div>
                                <a href="{{ route('admin.truncate.table', ['table' => 'trans_history']) }}"><em class="icon ni ni-trash"></em> Reset</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 border-bottom">
                        <div class="d-flex justify-content-between py-2">
                            <div>
                                <p><em class="icon ni ni-history"></em> Order History (Buy/Sell)</p>
                            </div>
                            <div>
                                <a href="{{ route('admin.truncate.table', ['table' => 'orders']) }}"><em class="icon ni ni-trash"></em> Reset</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 border-bottom">
                        <div class="d-flex justify-content-between py-2">
                            <div>
                                <p><em class="icon ni ni-wallet"></em> Wallets</p>
                            </div>
                            <div>
                                <a href="{{ route('admin.truncate.table', ['table' => 'wallets']) }}"><em class="icon ni ni-trash"></em> Reset</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 border-bottom">
                        <div class="d-flex justify-content-between py-2">
                            <div>
                                <p><em class="icon ni ni-coin"></em> Referral Bonus (${{$data->referral_price}})</p>
                            </div>
                            <div>
                                <a href="#" class="edit-referral-bonus"><em class="icon ni ni-edit"></em> Edit</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 border-bottom">
                        <div class="d-flex justify-content-between py-2">
                            <div>
                                <p><em class="icon ni ni-wallet"></em> Minimum Deposit (${{$data->min_deposit}})</p>
                            </div>
                            <div>
                                <a href="#" class="edit-min-deposit"><em class="icon ni ni-edit"></em> Edit</a>
                                {{-- <a href="#">| <em class="icon ni ni-trash"></em> Reset</a> --}}
                            </div>
                        </div>
                    </div>

                    {{-- <div class="col-lg-12 border-bottom">
                        <div class="d-flex justify-content-between py-2">
                            <div>
                                <p><em class="icon ni ni-wallet"></em> Minimum Withdrawal</p>
                            </div>
                            <div>
                                <a href="#"><em class="icon ni ni-edit"></em> Edit</a>
                                <a href="#">| <em class="icon ni ni-trash"></em> Reset</a>
                            </div>
                        </div>
                    </div> --}}

                    {{-- <div class="col-lg-12 border-bottom">
                        <div class="d-flex justify-content-between py-2">
                            <div>
                                <p><em class="icon ni ni-user"></em> Robot Trading</p>
                            </div>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" checked class="custom-control-input" id="robots">
                                <label class="custom-control-label" for="robots"></label>
                            </div>
                        </div>
                    </div> --}}

                    {{-- <div class="col-lg-12 border-bottom">
                        <div class="d-flex justify-content-between py-2">
                            <div>
                                <p><em class="icon ni ni-wallet"></em> Subscription Deposit Wallet</p>
                            </div>
                            <div>
                               <select name="" id="" class="border-0 wallet-settings-select">
                                    <option value="">Wallets</option>
                               </select>
                            </div>
                        </div>
                    </div> --}}
                </div>

                <div class="nk-block-head mt-4">
                    <div class="nk-block-between-md g-4">
                        <div class="nk-block-head-content">
                            <h6 class="nk-block-title fw-normal pe-4 pt-1">Password Settings</h6>
                        </div>
                    </div>
                </div>

                <form action="{{ route('admin.reset.admin.password') }}" method="post">
                    @csrf
                    <div class="row">
                            <div class="mb-3 col-lg-4">
                                <label for="old_password" class="col-form-label">Old Password</label>
                                <input type="text" placeholder="Enter old password" name="old_password" class="form-control" id="old_password">
                                @error('old_password')
                                    <span id="-error" class="invalid">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3 col-lg-4">
                                <label for="new_password" class="col-form-label">New Password</label>
                                <input type="password" placeholder="Enter new password" name="password" class="form-control" id="new_password">
                                @error('password')
                                    <span id="-error" class="invalid">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3 col-lg-4">
                                <label for="cpassword" class="col-form-label">Confirm New Password</label>
                                <input type="password" placeholder="Confirm new password" name="cpassword" class="form-control" id="cpassword">
                                @error('cpassword')
                                    <span id="-error" class="invalid">{{ $message }}</span>
                                @enderror
                            </div>
                    </div>
                    <div>
                        <button class="btn btn-success" type="submit">Save</button>
                    </div>
                </form>

            </div>
        </div>
    </div>


    <div class="modal fade deposit-modal" id="deposit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deposit" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Min. Deposit</h5>
            </div>
            <form action="{{ route('admin.update.min.deposit') }}" method="post">
            <div class="modal-body">
                @csrf
                    <div class="mb-3">
                        <label for="wallet_address" class="col-form-label">Amount<span class="text-danger">*</span></label>
                        <input type="number" placeholder="Enter minimum amount" value="{{$data->min_deposit}}"  name="amount" class="form-control" required>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">CANCEL</button>
                <button type="submit" id="submitMinDeposit" class="btn btn-success">SAVE</button>
            </div>
            </form>
        </div>
        </div>
    </div>

    <div class="modal fade referral-bonus" id="bonus" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="bonus" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Referral Bonus</h5>
            </div>
            <form action="{{ route('admin.update.ref.bonus') }}" method="post">
            <div class="modal-body">
                @csrf
                    <div class="mb-3">
                        <label for="wallet_address" class="col-form-label">Amount<span class="text-danger">*</span></label>
                        <input type="number" placeholder="Enter referral bonus amount" value="{{$data->referral_price}}"  name="amount" class="form-control" required>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">CANCEL</button>
                <button type="submit" id="submitMinDeposit" class="btn btn-success">SAVE</button>
            </div>
            </form>
        </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('.edit-referral-bonus').click(function (e) {
                e.preventDefault();
                $('.referral-bonus').modal('show');
            });

            $('.edit-min-deposit').click(function (e) {
                e.preventDefault();
                $('.deposit-modal').modal('show');
            });
        });
    </script>
@endsection
