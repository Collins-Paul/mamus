    @extends('layouts.index')

    @section('title')
        Network Fees
    @endsection

    @section('content')
        <div class="nk-content nk-content-fluid">
            <div class="container-xl wide-lg">
                <div class="nk-content-body">
                    <div class="nk-block-head-content mb-4">
                       <div class="d-flex justify-content-between">
                            <h4 class="nk-block-title page-title">Network Fees Setup</h4>
                            <a href="{{ route('admin.admin.fees.all') }}" class="btn btn-dark">All Fees</a>
                       </div>
                    </div>

                    <div class="nk-block nk-block-md">
                        <div class="nk-block-head">
                            <div class="nk-block-head-content">
                                <p class="title nk-block-title">Fill the simple form to add fee</p>
                            </div>
                        </div>
                        <div class="card card-bordered">
                            <div class="card-inner">
                                <form action="{{ route('admin.admin.fees.store') }}" class="form-validate is-alter" novalidate="novalidate" method="post">
                                    @csrf
                                    <div class="row g-gs">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label" for="fva-full-name">Label (e.g Low, Middle, High)</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" id="fva-full-name" name="label" required="">
                                                    @error('label')
                                                        <span id="-error" class="invalid">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label" for="fva-full-name">Amount Percentage</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" id="fva-full-name" name="percentage" required="">
                                                    @error('percentage')
                                                        <span id="-error" class="invalid">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label" for="fva-full-name">Type (e.g sat/B)</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" id="fva-full-name" name="type" required="">
                                                    @error('type')
                                                        <span id="-error" class="invalid">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-sm btn-primary">Create</button>
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
