@extends('layouts.index')

@section('title')
    Live Trades
@endsection

@section('content')
    <div class="nk-content nk-content-fluid">
        <div class="row">
           @include('includes.robot-order')
        </div>
    </div>
@endsection
