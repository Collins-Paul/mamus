@extends('layouts.index')

@section('title')
    Opened Trades
@endsection

@section('content')
    <div class="nk-content nk-content-fluid py-0">
        <div class="container-xl wide-lg">
            <div class="nk-content-body">
                <div class="row g-2 my-5">
                    <div class="">
                        <h6>All Open Order ({{ $orders->count() }})</h6>
                    </div>
                    @include('includes.open-order')
                </div>
            </div>
        </div>
    </div>

    @include('includes.script')

@endsection
