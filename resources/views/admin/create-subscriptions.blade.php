@extends('layouts.index')

@section('title')
    Create Subscriptions
@endsection

@section('content')
    <div class="nk-content nk-content-fluid">
        <div class="container-xl wide-lg">
            <div class="nk-content-body">
                <div class="nk-block-head-content mb-4">
                    <h3 class="nk-block-title page-title">Create New Plan</h3>
                </div>


                <div class="nk-block nk-block-lg">
                    <div class="nk-block-head">
                        <div class="nk-block-head-content">
                            {{-- <h4 class="title nk-block-title">Fill the simple form below</h4> --}}
                            <div class="nk-block-des">
                                <p>You can create a new subscription plan with a given <code class="code-class">Title</code> and <code class="code-class">Price</code> with the form below</p>
                            </div>
                        </div>
                    </div>
                    <div class="card card-bordered">
                        <div class="card-inner">
                            <form action="{{ route('admin.store.plans') }}" class="form-validate is-alter" novalidate="novalidate" method="post">
                                @csrf
                                <div class="row g-gs">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="fva-full-name">Plan Title</label>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control" id="fva-full-name" name="title" required="">
                                                @error('title')
                                                    <span id="-error" class="invalid">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="fva-full-name">Price</label>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control" id="fva-full-name" name="price" required="">
                                                @error('price')
                                                    <span id="-error" class="invalid">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="fva-full-name">Weeks</label>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control" name="weeks" required="" placeholder="Enter duration in number of weeks">
                                                @error('weeks')
                                                    <span id="-error" class="invalid">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="fva-full-name">Percentage %</label>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control" id="fva-full-name" name="percentage" required="" placeholder="Enter %">
                                                @error('percentage')
                                                    <span id="-error" class="invalid">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-lg btn-primary">Create</button>
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
