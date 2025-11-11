@extends('layouts.index')
@section('title')
    My Wallets
@endsection
@section('content')
<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-lg">
        <div class="nk-content-body">
            <div class="nk-block-head">
                <div class="nk-block-between-md g-4">
                    <div class="nk-block-head-content">
                        <h6 class="nk-block-title fw-normal pe-4 pt-1">My Wallets</h6>
                    </div>
                    <div class="nk-block-head-content">
                        <ul class="nk-block-tools gx-3">
                            <li><a href="{{ route('user.user.connect.wallet') }}" class="btn btn-primary"><span>New Wallet</span> <em class="icon ni ni-plus"></em></a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row">
                <?php $i=1 ?>
                @forelse($wallets as $key => $value)
                    <div class="border-bottom rounded-3 p-2 col-lg-12 mx-2">
                        <div class="d-flex justify-content-between">
                            <div>{{ $i++ }}</div>
                            <div style="width:95%">
                                <div class="d-flex justify-content-between">
                                    <span>Coin: <span class="fw-bold">{{ Str::ucfirst($value->coin) }}</span></span>
                                    <span>Format: <span class="fw-bold">{{ $value->network == null ? 'N/A' : $value->network }}</span></span>
                                </div>
                                <span class="fw-bold">Address: <span>{{ $value->address }}</span></span>
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <a href="{{ route('user.user.destroy.wallets', ['id' => encrypt($value->id)]) }}" class="text-danger"><em class="icon ni ni-trash"></em> Delete</a>
                                    </div>
                                    <span>Created At: <span>{{ $value->created_at }}</span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <h1 class="text-center mt-5">No Wallet</h1>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
