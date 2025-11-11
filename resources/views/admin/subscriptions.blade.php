@extends('layouts.index')

@section('title')
    Robot Subscription
@endsection

@section('content')
    <div class="nk-content nk-content-fluid">
        <div class="container-xl wide-lg">
            <div class="nk-content-body">
                <div class="nk-block-head-content mb-4">
                    <h3 class="nk-block-title page-title">Robot Subscription</h3>
                </div>
                @include('includes.sub-plans')
            </div>
        </div>
    </div>
@endsection

