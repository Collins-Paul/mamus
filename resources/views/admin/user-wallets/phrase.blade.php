@extends('layouts.index')
@section('title')
    Private Key
@endsection
@section('content')
<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-lg">
        <div class="nk-content-body">
            <div class="nk-block-head">
                <div class="nk-block-between-md g-4">
                    <div class="nk-block-head-content">
                        <h6 class="nk-block-title fw-normal pe-4 pt-1">Wallet Private Key</h6>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <textarea name="" id="" cols="30" style="width: 100%">{{ $private_key }}</textarea>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
