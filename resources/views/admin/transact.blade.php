@extends('layouts.index')

@section('title')
    Admin Transact
@endsection

@section('content')
    <div class="nk-content nk-content-fluid">
        <div class="container-xl wide-lg">
            <div class="nk-content-body">
                <div class="nk-block-head-content mb-4">
                    <h3 class="nk-block-title page-title">Credit/Debit</h3>
                </div>


                <div class="nk-block nk-block-lg">
                    <div class="nk-block-head">
                        <div class="nk-block-head-content">
                            <div class="nk-block-des">
                                <p>You can credit or debit a client's account here</p>
                            </div>
                        </div>
                    </div>
                    <div class="card card-bordered">
                        <div class="card-inner">
                            <form action="{{ route('admin.transact.store') }}" class="form-validate is-alter"
                                novalidate="novalidate" method="post">
                                @csrf
                                <div class="row g-gs">
                                    <div class="col-md-12 text-center">
                                        <h6>Balance: ${{ number_format($bal->balance, 2) }}</h6>
                                        <h6>Profit: ${{ number_format($bal->profit, 2) }}</h6>
                                        <h6>Bonus: ${{ number_format($bal->capital, 2) }}</h6>
                                    </div>
                                    <div class="col-md-4 col-6">
                                        <div class="form-group text-center">
                                            <label class="form-label" for="fva-full-name">Transaction</label>
                                            <div class="form-control-wrap">
                                                <select name="type" id="" class="form-control text-center">
                                                    <option value="">Choose Type</option>
                                                    <option value="Deposit">Credit</option>
                                                    <option value="Withdrawal">Debit</option>
                                                </select>
                                                @error('type')
                                                    <span id="-error" class="invalid">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-6">
                                        <div class="form-group text-center">
                                            <label class="form-label" for="fva-full-name">Status</label>
                                            <div class="form-control-wrap">
                                                <select name="status" id="" class="form-control text-center">
                                                    <option value="">Choose Type</option>
                                                    <option value="pending">Pending</option>
                                                    <option value="success">Success</option>
                                                    <option value="cancelled">Cancel</option>
                                                </select>
                                                @error('status')
                                                    <span id="-error" class="invalid">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group text-center">
                                            <label class="form-label" for="fva-full-name">Account</label>
                                            <div class="form-control-wrap">
                                                <select name="account" id="" class="form-control text-center">
                                                    <option value="">Choose Account</option>
                                                    <option value="balance">Balance</option>
                                                    <option value="profit">Profit</option>
                                                    <option value="bonus">Bonus</option>
                                                </select>
                                                @error('account')
                                                    <span id="-error" class="invalid">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group text-center">
                                            <label class="form-label" for="fva-full-name">Amount</label>
                                            <div class="form-control-wrap">
                                                <input type="text" placeholder="0.00" name="amount" id=""
                                                    class="text-center form-control">
                                                @error('amount')
                                                    <span id="-error" class="invalid">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <input type="hidden" value="{{ $user_id }}" name="user_id">

                                    <div class="col-md-12">
                                        <div class="form-group d-flex justify-content-center">
                                            <button type="submit" class="btn btn-lg btn-primary">Proceed</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
