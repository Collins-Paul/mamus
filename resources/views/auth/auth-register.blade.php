@extends('layouts.auth')

@section('title')
   Register
@endsection

@section('content')
        <!-- main @s -->
        <div class="nk-main ">
            <!-- wrap @s -->
            <div class="nk-wrap nk-wrap-nosidebar">
                <!-- content @s -->
                <div class="nk-content ">
                    <div class="nk-block nk-block-middle nk-auth-body wide-xs">
                        @include('auth.auth-logo')
                        <div class="card card-bordered shadow">
                            <div class="card-inner card-inner-lg">
                                <div class="nk-block-head">
                                    <div class="nk-block-head-content">
                                        <h4 class="nk-block-title">Open New Account</h4>
                                        <div class="nk-block-des">
                                            {{-- <p>Create New {{ config('app.name') }} Account</p> --}}
                                            <p>Open a Live account in less than 3 minutes</p>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group mt-2">
                                            <div class="d-flex justify-content-evenly">
                                                <a href="#" class="btn btn-sm btn-primary individual" onclick="hideFields()"><em class="icon ni ni-user"></em><span>Individual</span> </a>
                                                <a href="#" class="btn btn-sm btn-light corporate" onclick="showFields()"><em class="icon ni ni-property"></em><span>Corporate</span> </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <form action="{{ route('auth.create-account') }}" method="post">
                                    @csrf
                                    <div id="corporate_acc" style="display: none">
                                        <div class="form-group">
                                            <label class="form-label" for="fv-topics">Country of Registration:</label>
                                            <div class="form-control-wrap ">
                                                <select class="form-control form-control-lg" name="country_of_reg">
                                                    @include('includes.countries')
                                                </select>
                                                @error('country_of_reg')
                                                <span id="-error" class="invalid">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label" for="name">Company Name:</label>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control form-control-lg"  name="company_name" placeholder="Company Name">
                                                @error('company_name')
                                                <span id="-error" class="invalid">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label" for="name">Registration Number:</label>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control form-control-lg" name="reg_no" placeholder="Registration Number">
                                                @error('reg_no')
                                                <span id="-error" class="invalid">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <h5 class="mt-4 mb-3">Representative Information</h5>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="fv-topics">Country of Residence:</label>
                                        <div class="form-control-wrap ">
                                            <select class="form-control form-control-lg" name="country_of_residence">
                                                @include('includes.countries')
                                            </select>
                                            @error('country_of_residence')
                                            <span id="-error" class="invalid">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="name">First Name:</label>
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control form-control-lg" value="{{old('first_name')}}" name="first_name" placeholder="Enter First Name">
                                            @error('first_name')
                                            <span id="-error" class="invalid">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="name">Last Name:</label>
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control form-control-lg" value="{{old('last_name')}}" name="last_name" placeholder="Enter Last Name">
                                            @error('last_name')
                                            <span id="-error" class="invalid">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="fv-topics">Investment Type</label>
                                        <div class="form-control-wrap ">
                                            <select class="form-control form-control-lg" name="investment">
                                                <option value="Short-term">Short Term</option>
                                                <option value="Long-term">Long Term</option>
                                            </select>
                                            @error('investment')
                                            <span id="-error" class="invalid">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="fv-phone">Phone:</label>
                                        <div class="form-control-wrap">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text icon ni ni-call" id="fv-phone"></span>
                                                </div>
                                                <input type="text" class="form-control" value="{{old('phone')}}" name="phone" aria-describedby="-error" aria-invalid="true">
                                            </div>
                                            @error('phone')
                                            <span id="-error" class="invalid">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="fv-email">Email address:</label>
                                        <div class="form-control-wrap">
                                            <div class="form-icon form-icon-right">
                                                <em class="icon ni ni-mail"></em>
                                            </div>
                                            <input type="text" class="form-control" value="{{old('email')}}" id="fv-email" name="email">
                                            @error('email')
                                            <span id="-error" class="invalid">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="fv-email">Date of Birth:</label>
                                        <div class="form-control-wrap">
                                            <input type="date" class="form-control" value="{{old('dob')}}" id="fv-email" name="dob">
                                            @error('dob')
                                            <span id="-error" class="invalid">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <label class="form-label" for="fv-topics">Currency</label>
                                        <div class="form-control-wrap">
                                            <select class="form-control form-control-lg" name="currency">
                                                <option value="">Select Currency</option>
                                                <option value="USD">USD</option>
                                                <option value="GBP">GBP</option>
                                                <option value="AUD">AUD</option>
                                                <option value="EUR">EUR</option>
                                                <option value="CAD">CAD</option>
                                            </select>
                                            @error('currency')
                                            <span id="-error" class="invalid">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="password">Password:</label>
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
                                        <label class="form-label" for="password">Confirm Password:</label>
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
                                    @if ($code !== null)
                                    <div class="form-group d-flex justify-content-between">
                                        <p class="form-label">Referral Code:</p>
                                        <p class="form-label">{{ $code }}</p>
                                    </div>
                                    <input type="hidden" readonly value="{{ $code }}" class="form-control form-control-lg border-0" name="code">
                                    @else
                                    <input type="hidden" readonly value="{{ null }}" class="form-control form-control-lg border-0" name="code">
                                    @endif
                                    <div class="form-group">
                                        <div class="custom-control custom-control-xs custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="checkbox" name="accept">
                                            <label class="custom-control-label" for="checkbox">I agree to {{ config('app.name') }} <a href="{{route('home.privacy-policy')}}">Privacy Policy</a> &amp; <a href="{{route('home.terms-conditions')}}"> Terms.</a></label>
                                            @error('accept')
                                            <span id="-error" class="invalid">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    @if (Session::has('message'))
                                        <div class="example-alert">
                                            <div class="alert alert-danger alert-icon">
                                                <em class="icon ni ni-cross-circle"></em> <strong>Error</strong>
                                                {{ Session::get('message') }}
                                                @php
                                                    Session::forget('message');
                                                @endphp
                                            </div>
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        <button class="btn btn-lg btn-primary btn-block">Register</button>
                                    </div>
                                </form>
                                <div class="form-note-s2 text-center pt-4"> Already have an account? <a href="{{ route('auth.login') }}"><strong>Sign in instead</strong></a>
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
