@extends('layouts.index')

@section('title')
    Closed Trades
@endsection

@section('content')
    <div class="nk-content nk-content-fluid py-0">
        <div class="container-xl wide-lg">
            <div class="nk-content-body">
                <div class="row g-2 my-5">
                    <div class="">
                        <h6>All Closed Order ({{ $closed->count() }})</h6>
                    </div>
                    @include('includes.closed-order')
                </div>
            </div>
        </div>
    </div>

    @include('includes.script')

@endsection
