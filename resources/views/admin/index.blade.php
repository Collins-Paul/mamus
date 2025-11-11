@extends('layouts.index')

@section('title')
    Account Overview
@endsection

@section('content')
    <div class="nk-content nk-content-fluid">
        <div class="container-xl wide-lg">
            <div class="nk-content-body">
                <div class="nk-block-head">
                    <div class="nk-block-between-md g-4">
                        <div class="nk-block-head-content">
                            <h2 class="nk-block-title fw-normal">{{ Auth::user()->first_name ." ". Auth::user()->last_name }}</h2>
                             <div class="nk-block-head-sub"><span style="color: #fff">Welcome to {{ config('app.name') }}</span></div>
                        </div><!-- .nk-block-head-content -->
                        <div class="nk-block-head-content">
                            <ul class="nk-block-tools gx-3">
                                <li><a href="{{ route('admin.new.master') }}" class="btn btn-primary"><span>Create Master Trader</span> <em class="icon ni ni-plus"></em></a></li>
                                <li><a href="{{ route('admin.admin.fees.setup') }}" class="btn btn-outline-warning"><span>Network Fees</span></a></li>
                            </ul>
                        </div><!-- .nk-block-head-content -->
                    </div><!-- .nk-block-between -->
                </div><!-- .nk-block-head -->
                <div class="nk-block">
                    <div class="row gy-gs">
                        <div class="col-lg-12 col-xl-12">
                            <div class="nk-block">

                                <div class="row g-2">

                                <div class="col-md-3">
                                    <a href="{{ route('admin.traders') }}">
                                        <div class="card card-bordered card-full shadow">
                                            <div class="card-inner">
                                                <div class="card-title-group align-start mb-0">
                                                    <div class="card-title">
                                                        <h6 class="subtitle">No. of Investors/Traders</h6>
                                                    </div>
                                                </div>
                                                <div class="card-amount">
                                                    <span class="amount"><a href="{{ route('admin.traders') }}">{{ $traders->count() - 1 }}</a></span>
                                                </div>
                                            </div>
                                        </div><!-- .card -->
                                    </a>
                                </div>
                                <div class="col-md-3">
                                    <a href="{{ route('admin.all-history') }}">
                                        <div class="card card-bordered card-full shadow">
                                            <div class="card-inner">
                                                <div class="card-title-group align-start mb-0">
                                                    <div class="card-title">
                                                        <h6 class="subtitle">No. of Transactions</h6>
                                                    </div>
                                                </div>
                                                <div class="card-amount d-flex justify-content-evenly">
                                                    <span class="amount"><a href="{{ route('admin.all-history') }}">{{ $depositCompleted->count() }} <sub style="font-size: 10px">Approved</sub></a></span>
                                                    <span class="amount"><a href="{{ route('admin.all-history') }}">{{ $depositPending->count() }} <sub style="font-size: 10px">Pending</sub></a></span>
                                                </div>
                                            </div>
                                        </div><!-- .card -->
                                    </a>
                                </div>

                                <div class="col-md-3">
                                    <div class="card card-bordered card-full shadow">
                                        <div class="card-inner">
                                            <div class="card-title-group align-start mb-0">
                                                <div class="card-title">
                                                    <h6 class="subtitle">No. of Withdrawal</h6>
                                                </div>
                                            </div>
                                            <div class="card-amount d-flex justify-content-evenly">
                                                <span class="amount"><a href="">{{ $depositCompleted->count() }} <sub style="font-size: 10px">Approved</sub></a></span>
                                                <span class="amount"><a href="">{{ $depositPending->count() }} <sub style="font-size: 10px">Pending</sub></a></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                  <div class="col-md-3">
                                    <a href="{{ route('admin.users.cards') }}">
                                        <div class="card card-bordered card-full shadow border rounded">
                                            <div class="card-inner">
                                                <div class="card-title-group align-center mb-0 justify-content-center">
                                                    <div class="card-title">
                                                        <h6 class="subtitle fw-bold">Withdrawal Cards</h6>
                                                    </div>
                                                </div>
                                                <div class="card-amount d-flex justify-content-evenly mt-2">
                                                    <em class="icon ni ni-cards" style="font-size: 3rem"></em>
                                                </div>
                                                <div class="d-flex justify-content-center align-items-center">
                                                    <p class="mb-0">Active: {{ $active_cards }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                </div><!-- .row -->
                            </div><!-- .nk-block -->

                        </div><!-- .col -->
                    </div><!-- .row -->
                </div><!-- .nk-block -->
            </div>
        </div>
    </div>
@endsection
