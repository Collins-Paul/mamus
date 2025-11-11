@extends('layouts.auth')

@section('title')
   Password Reset
@endsection

@section('content')
        <!-- main @s -->
        <div class="nk-main ">
            <!-- wrap @s -->
            <div class="nk-wrap nk-wrap-nosidebar">
                <!-- content @s -->
                <div class="nk-content ">
                    <div class="nk-block nk-block-middle nk-auth-body  wide-xs">
                        @include('auth.auth-logo')
                        <div class="card card-bordered shadow">
                            <div class="card-inner card-inner-lg">
                                <div class="nk-block-head">
                                    <div class="nk-block-head-content">
                                        <h4 class="nk-block-title">Reset Password</h4>
                                        <div class="nk-block-des">
                                            <p>Hello, <strong>{{ $fullname }}</strong></p>
                                        </div>
                                    </div>
                                </div>
                                <form action="{{ route('app.forgot-password.update') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label class="form-label" for="password">New Password:</label>
                                        <div class="form-control-wrap">
                                            <a href="#" class="form-icon form-icon-right passcode-switch lg" data-target="password">
                                                <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                                <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                            </a>
                                            <input type="password" value="{{old('password')}}" class="form-control form-control-lg" name="password" id="password" placeholder="New Password" required>
                                            @error('password')
                                            <span id="-error" class="invalid">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="password">Confirm New Password:</label>
                                        <div class="form-control-wrap">
                                            <a href="#" class="form-icon form-icon-right passcode-switch lg" data-target="password">
                                                <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                                <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                            </a>
                                            <input type="password" value="{{old('cpassword')}}" class="form-control form-control-lg" name="cpassword" placeholder="Confirm Password" required>
                                            @error('cpassword')
                                            <span id="-error" class="invalid">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <input type="hidden" value="{{ $token }}" name="token">
                                    <input type="hidden" value="{{ $id }}" name="id">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-lg btn-primary btn-block">Reset Now</button>
                                    </div>
                                </form>
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

