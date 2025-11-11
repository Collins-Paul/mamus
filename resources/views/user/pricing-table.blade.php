@extends('layouts.index')

@section('title')
    Investment Plans
@endsection

@section('content')
<div class="nk-content ">
    <div class="container">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between g-3">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Available Plans</h3>
                            <div class="nk-block-des text-soft">
                                <p>Choose an investment plan and start enjoying our service.</p>
                            </div>
                        </div>
                    </div>
                </div><!-- .nk-block-head -->
                @include('includes.investment-packages')
            </div>
        </div>
    </div>
</div>

@endsection
