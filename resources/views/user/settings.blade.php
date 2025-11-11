@extends('layouts.index')

@section('title')
    Settings
@endsection

@section('content')
<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-lg">
        <div class="nk-content-body">
            <div class="nk-block-head pb-2">
                <div class="g-4">
                    <div class="nk-block-head-content d-flex">
                        <a href="{{ route('user.view.user.profile', ['id' => encrypt(Auth::user()->id)]) }}">
                            <div style="
                                        width: 35px !important;
                                        height: 35px !important;
                                        border-radius: 100px !important;
                                        background-position: center !important;
                                        background-size: contain !important;
                                        background: url({{ asset('traders-photo/'.Auth::user()->photo) }});
                                        "></div>
                        </a>
                        <h2 class="nk-block-title fw-bolder fs-6 ps-2 d-flex align-items-center">
                            {{ Auth::user()->first_name ." ". Auth::user()->last_name }}
                        </h2>
                    </div>
                    <div class="line mb-1 p-0 shadow-sm bg-body" style="border-bottom: solid 1px #d8d1d1;"></div>
                    <a href="{{ route('user.view.user.profile', ['id' => encrypt(Auth::user()->id)]) }}">
                        <div class="position-fixed p-2 bg-success text-white rounded-circle settings-camera" style="bottom: 5%; right:2%; z-index: 1000; width: 50px; height:50px">
                            <em class="fs-3 icon ni ni-camera"></em>
                        </div>
                    </a>
                </div><!-- .nk-block-between -->
            </div><!-- .nk-block-head -->

            <div class="card-bordered shadow-sm">
                <div class="px-2 py-3">
                    <p class="fw-bold">Personal Info</p>
                    <div class="d-flex justify-content-start">
                        <div class="pt-3 pe-2">
                            <em class="fs-4 icon ni ni-call"></em>
                        </div>
                        <div class="py-1">
                            <p class="m-0 fw-normal">Phone</p>
                            <p>{{ Auth::user()->phone }}</p>
                        </div>
                    </div>

                    <div class="d-flex justify-content-start">
                        <div class="pt-3 pe-2">
                            <em class="fs-4 icon ni ni-globe"></em>
                        </div>
                        <div class="py-1">
                            <p class="m-0 fw-normal">Language</p>
                            <p>English</p>
                        </div>
                    </div>

                    <div class="d-flex justify-content-start">
                        <div class="pt-3 pe-2">
                            <em class="fs-4 icon ni ni-mail"></em>
                        </div>
                        <div class="py-1">
                            <p class="m-0 fw-normal">Email</p>
                            <p>{{ Auth::user()->email }}</p>
                        </div>
                    </div>

                    <div class="d-flex justify-content-start">
                        <div class="pt-3 pe-2">
                            <em class="fs-4 icon ni ni-home"></em>
                        </div>
                        <div class="py-1">
                            <p class="m-0 fw-normal">Address</p>
                            <p>{{ is_null(Auth::user()->address) ? 'N/A' : Auth::user()->address }}</p>
                        </div>
                    </div>

                    <div class="d-flex justify-content-start">
                        <div class="pt-3 pe-2">
                            <em class="fs-4 icon ni ni-calender-date"></em>
                        </div>
                        <div class="py-1">
                            <p class="m-0 fw-normal">Birthdate</p>
                            <p>{{ Auth::user()->dob }}</p>
                        </div>
                    </div>

                    <div class="d-flex justify-content-start">
                        <div class="pt-3 pe-2">
                            <em class="fs-4 icon ni ni-shield-check" style="color: orange;"></em>
                        </div>
                        <div class="py-1">
                            <p class="m-0 fw-normal">Verification status</p>
                            @php
                                $status = Auth::user()->status == 0  ? 'Unverified' : 'Verified';
                                $link = null;
                                if ($status == 'Unverified') {
                                    $status = '<span class="text-danger fw-bold">Unverified</span>';
                                }
                            @endphp
                            <p>{!!$status!!}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-bordered shadow-sm mt-2">
                <div class="px-2 py-3">
                    <p class="fw-bold">Social Accounts</p>

                    <div class="d-flex justify-content-start">
                        <div class="pt-1 pe-2">
                            <img src="{{ asset('assets/images/facebook.png') }}" alt="" width="20px">
                        </div>
                        <div class="py-1">
                            <p class="m-0 fw-normal">Facebook</p>
                        </div>
                    </div>

                    <div class="d-flex justify-content-start">
                        <div class="pt-1 pe-2">
                            <img src="{{ asset('assets/images/google.png') }}" alt="" width="20px">
                        </div>
                        <div class="py-1">
                            <p class="m-0 fw-normal">Google</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-2 mb-4">
                <div class="px-2 py-3 text-center">
                    <a href="{{route('user.logout')}}" class="btn btn-light">LOGOUT</a>
                </div>
            </div>
        </div>
    </div>
@endsection
