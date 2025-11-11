@extends('layouts.index')

@section('title')
    Live Trades
@endsection

@section('content')
    <div class="nk-content nk-content-fluid">
        @if ($trades->count() > 0)
            <p><img src="{{ asset('assets/images/live-robot.gif') }}" alt="" style="width: 100px"><span class="blink_me text-success">{{ $trades->count() }} running trades </span></p>
        @endif
        <div class="row">
           @include('includes.robot-order')
        </div>
    </div>
@endsection
