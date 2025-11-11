@extends('layouts.index')

@section('title')
    Trades
@endsection

@section('content')
    <div class="nk-content nk-content-fluid">
        @include('includes.bottomnav')
        <div class="row">
            @if ($copiers->count() == 0)
                <div class="col-lg-12">
                    <div class="w-50 mx-auto mt-5 align-content-center text-center"
                        style="position: relative;
                    top: 100%;">
                        <center>
                            <img src="{{ asset('assets/images/history-icon.png') }}" width="70" alt="">
                        </center>
                        <h6 class="pt-2">No Closed Copy Trades</h6>
                    </div>
                </div>
            @else
                <h6 class="text-center">Closed Copy Order ({{ $copiers->count() }})</h6>
                @include('includes.copytrades')
            @endif
        </div>
        {{-- <div class="position-fixed p-2 bg-black text-white rounded-circle" style="bottom: 12%; right: 3%; z-index: 1000; width: 50px; height:50px">
            <em class="fs-3 icon ni ni-opt-dot-alt"></em>
        </div> --}}
    </div>
    @include('includes.script')
@endsection
