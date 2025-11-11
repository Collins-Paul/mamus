@extends('layouts.index')

@section('title')
    Internal Transfer
@endsection

@section('content')
    <div class="nk-content nk-content-fluid">
        <div class="container-xl wide-lg">
            <div class="nk-content-body">
                <div class="nk-block-head-content mb-4">
                    <h3 class="nk-block-title page-title">Transfer Funds</h3>
                </div>


                <div class="nk-block nk-block-lg">
                    <div class="nk-block-head">
                        <div class="nk-block-head-content">
                            <div class="nk-block-des">
                                <p>You can make internal transfer of your <code class="code-class">Referral Bonuses/Profits</code> to your main <code class="code-class">Balance</code></p>
                            </div>
                        </div>
                    </div>
                    <div class="card card-bordered">
                        <div class="card-inner">
                            <form action="{{ route('user.internal.transfer.process') }}" class="form-validate is-alter" novalidate="novalidate" method="post">
                                @csrf
                                <div class="row g-gs">
                                    <div class="col-md-4">
                                        <div class="form-group text-center">
                                            <label class="form-label" for="fva-full-name">From</label>
                                            <div class="form-control-wrap">
                                                <select name="from" id="" class="form-control text-center">
                                                    <option value="">Choose Account</option>
                                                    <option value="referral">Referral Bonus (${{ number_format($bonus, 2) }})</option>
                                                    <option value="profit">Profit (${{ number_format($profit, 2) }})</option>
                                                </select>
                                                @error('from')
                                                    <span id="-error" class="invalid">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group text-center">
                                            <label class="form-label" for="fva-full-name">To</label>
                                            <div class="form-control-wrap">
                                                <select name="to" id="" class="form-control text-center">
                                                    <option value="to">Main Balance (${{ number_format($balance, 2) }})</option>
                                                </select>
                                                @error('to')
                                                    <span id="-error" class="invalid">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group text-center">
                                            <label class="form-label" for="fva-full-name">Amount</label>
                                            <div class="form-control-wrap">
                                                <input type="text" placeholder="0.00" name="amount" id="" class="text-center form-control">
                                                @error('amount')
                                                    <span id="-error" class="invalid">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group d-flex justify-content-end">
                                            <button type="submit" class="btn btn-lg btn-primary">Transfer</button>
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
