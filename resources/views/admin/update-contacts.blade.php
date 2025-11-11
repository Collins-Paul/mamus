@extends('layouts.index')

@section('title')
    Update Phone & Contact
@endsection

@section('content')
    <div class="nk-content nk-content-fluid">
        <div class="container-xl wide-lg">
            <div class="nk-content-body">
                <div class="nk-block nk-block-lg">
                    <div class="nk-block-head">
                        <div class="nk-block-head-content">
                            <h4 class="title nk-block-title">Update Contact/Phone</h4>
                        </div>
                    </div>
                    <div class="card card-bordered">
                        <div class="card-inner">
                            <h6>Update Phone</h6>

                            <p>Current Phone: <strong>{{ $data->phone_1 }}</strong></p>

                            <form action="{{ route('admin.contacts.phone') }}" class="form-validate is-alter" novalidate="novalidate" method="post">
                                @csrf
                                <div class="row g-gs">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label" for="fva-full-name">New Phone No.</label>
                                            <div class="form-control-wrap">
                                                <input type="text" placeholder="Paste new phone number here" class="form-control" id="fva-full-name" name="phone" required="">
                                                @error('phone')
                                                    <span id="-error" class="invalid">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-lg btn-primary">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card card-bordered">
                        <div class="card-inner">
                            <h6>Update Address</h6>
                            <form action="{{ route('admin.contacts.address') }}" class="form-validate is-alter" novalidate="novalidate" method="post">
                                @csrf
                                <div class="row g-gs">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label" for="fva-full-name">New Address</label>
                                            <div class="form-control-wrap">
                                                <textarea name="address" class="w-100 p-2" rows="10" placeholder="Type your new address here">{{ $data->address }}</textarea>
                                                @error('address')
                                                    <span id="-error" class="invalid">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-lg btn-primary">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
