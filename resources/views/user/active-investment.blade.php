@extends('layouts.index')
@section('title')
    Investment Scheme
@endsection
@section('content')
<div class="nk-content nk-content-lg nk-content-fluid">
    <div class="container-xl wide-lg">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head">
                    <div class="nk-block-head-content">
                        <div class="nk-block-head-sub"><span>My Plan</span></div>
                        <div class="nk-block-between-md g-4">
                            <div class="nk-block-head-content">
                                <h2 class="nk-block-title fw-normal">Active Investment</h2>
                                <div class="nk-block-des">
                                    <p>Here are your current active investement plans.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @include('includes.user-investments')
            </div>
        </div>
    </div>
</div>
@endsection
