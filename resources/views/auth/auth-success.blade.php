@extends('layouts.auth')

@section('title')
   Success
@endsection

@section('content')
        <!-- main @s -->
        <div class="nk-main ">
            <!-- wrap @s -->
            <div class="nk-wrap nk-wrap-nosidebar">
                <!-- content @s -->
                <div class="nk-content ">
                    <div class="nk-block nk-block-middle nk-auth-body">
                        <div class="brand-logo pb-5 text-center">
                            <a href="{{ route('home.index') }}" class="logo-link">
                                <img class="" src="{{ asset('assets/images/success.gif') }}" srcset="{{ asset('assets/images/success.gif') }} 2x" alt="logo" width="200px">
                            </a>
                        </div>
                        <div class="nk-block-head">
                            <div class="nk-block-head-content">
                                <h4 class="nk-block-title">New Account Created Successfully!</h4>
                                <div class="nk-block-des text-success">
                                    <p>You can now sign in with your new password</p>
                                    <a href="{{ route('auth.login') }}">Sign In</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @include('includes.auth-footer')
                </div>
                <!-- wrap @e -->
            </div>
            <!-- content @e -->
        </div>
        <!-- main @e -->
@endsection
